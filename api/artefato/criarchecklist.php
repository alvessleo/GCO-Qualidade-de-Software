<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/api/cabecalhos.php');
verificarArgumentos($_POST, true, 'codigo_artefato', 'nome');

if (!isset($_SESSION['codigo_usuario']))
    respostaJson(array('erro' => 'É necessário estar logado'), 403);
    
try
{
    {
        $resultado = executarQuery(
            <<<EOL
                SELECT 1 FROM `artefato`
                INNER JOIN `usuario_empresa`
                ON `usuario_empresa`.`codigo_empresa` = `artefato`.`codigo_empresa`
                WHERE `artefato`.`codigo_artefato` = ? AND `usuario_empresa`.`codigo_usuario` = ? AND `usuario_empresa`.`auditor` = 1;
            EOL,
            'ii',
            $_POST['codigo_artefato'],
            $_SESSION['codigo_usuario']
        );

        if ($resultado && $resultado_sql = $resultado->get_result())
        {
            if ($resultado_sql->num_rows <= 0)
                respostaJson(array('erro' => 'É necessário ser auditor da empresa'), 403);
        }       
        else
            respostaJson(array('erro' => 'Resposta query SQL inválida'), 500);
    }

    
    $resultado = executarQuery(
        'INSERT INTO `checklist` (`codigo_autor`, `codigo_artefato`, `nome`) VALUES (?, ?, ?)', 
        'iis',
        $_SESSION['codigo_usuario'],
        $_POST['codigo_artefato'],
        $_POST['nome']
    );

    if ($resultado && $resultado->affected_rows)
        respostaJson(null, 201);

    respostaJson(array('erro' => 'Resposta query SQL inválida'), 500);
} 
catch (mysqli_sql_exception $e)
{
    switch ($e->getCode())
    {
        default:
            respostaJson(array('erro' => 'Erro SQL não capturado: ' . $e->getCode()), 500);
            break;
    }
    
}
