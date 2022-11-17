<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/api/cabecalhos.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/api-interna/empresa.php');
verificarArgumentos($_POST, true, 'codigo_artefato');

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
                WHERE `artefato`.`codigo_artefato` = ? AND `usuario_empresa`.`codigo_usuario` = ?
                LIMIT 1;
            EOL,
            'ii',
            $_POST['codigo_artefato'],
            $_SESSION['codigo_usuario']
        );

        if ($resultado && $resultado_sql = $resultado->get_result())
        {
            if ($resultado_sql->num_rows <= 0)
                respostaJson(array('erro' => 'É necessário fazer parte da empresa'), 403);
        }       
        else
            respostaJson(array('erro' => 'Resposta query SQL inválida'), 500);
    }

    $resultado = executarQuery(
        'SELECT `checklist`.*, `usuario`.`nome` AS `nomecriador` FROM `checklist`
        INNER JOIN `usuario`
        ON `usuario`.`codigo_usuario` = `checklist`.`codigo_autor`
        WHERE `codigo_artefato` = ?;', 
        'i',
        $_POST['codigo_artefato']
    );

    if ($resultado && $resultado_sql = $resultado->get_result())
    {
        $linhas = array();
        
        while ($linha = $resultado_sql->fetch_assoc())
            $linhas[$linha['codigo_checklist']] = $linha;

        respostaJson($linhas, 200);
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
