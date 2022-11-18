<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/api/cabecalhos.php');
verificarArgumentos($_POST, true, 'codigo_empresa', 'nome_artefato', 'recurso', 'descricao');

if (!isset($_SESSION['codigo_usuario']))
    respostaJson(array('erro' => 'É necessário estar logado'), 403);

try
{
    {
        $resultado = executarQuery(
            <<<EOL
                SELECT 1 FROM `usuario_empresa`
                WHERE `usuario_empresa`.`codigo_empresa` = ? AND `usuario_empresa`.`codigo_usuario` = ? AND `usuario_empresa`.`auditor` = 1;
            EOL,
            'ii',
            $_POST['codigo_empresa'],
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
        'INSERT INTO `artefato` (`codigo_empresa`, `nome_artefato`, `recurso`, `descricao`) 
        VALUES (?, ?, ?, ?);', 
        'isss',
        $_POST['codigo_empresa'],
        $_POST['nome_artefato'],
        $_POST['recurso'],
        $_POST['descricao']
    );

    if ($resultado && $resultado->affected_rows)
    {
        respostaJson(null, 201);
    }
        
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
