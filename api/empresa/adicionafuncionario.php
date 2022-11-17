<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/api/cabecalhos.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/api-interna/empresa.php');
verificarArgumentos($_POST, true, 'codigo_usuario', 'codigo_empresa', 'cargo', 'auditor');

if (isset($_SESSION['codigo_usuario']))
{
    $empresas = obterRelacionadas();

    if (!$empresas)
        respostaJson(array('erro' => 'É necessário ser o dono da empresa'), 403);

    if (!isset($empresas[$_POST['codigo_empresa']]))
        respostaJson(array('erro' => 'É necessário ser o dono da empresa'), 403);

    $empresa = $empresas[$_POST['codigo_empresa']];

    if (!($empresa['codigo_dono'] == $_SESSION['codigo_usuario']))
        respostaJson(array('erro' => 'É necessário ser o dono da empresa'), 403);
}
else
    respostaJson(array('erro' => 'É necessário estar logado'), 403);


try
{
    $resultado = executarQuery(
        'INSERT INTO `usuario_empresa` (`codigo_usuario`, `codigo_empresa`, `cargo`, `auditor`) VALUES (?, ?, ?, ?)', 
        'iisi',
        $_POST['codigo_usuario'],
        $_POST['codigo_empresa'],
        $_POST['cargo'],
        $_POST['auditor']
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
