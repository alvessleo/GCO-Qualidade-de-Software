<?php
include_once($_SERVER["DOCUMENT_ROOT"] . '/api/auxiliar.php');
verificarArgumentos($_POST, 'nome', 'usuario', 'senha');

try
{
    $resultado = executarQuery(
        'INSERT INTO `usuario` (`nome`, `usuario`, `senha`) VALUES (?, ?, ?)', 
        'sss',
        $_POST['nome'],
        $_POST['usuario'],
        password_hash($_POST['senha'], PASSWORD_DEFAULT),
    );

    if ($resultado && $resultado->affected_rows)
        respostaJson(null, 201);

    respostaJson(array('erro' => 'Resposta query SQL inválida'), 500);
} 
catch (mysqli_sql_exception $e)
{
    switch ($e->getCode())
    {
        case 1062:
            respostaJson(array('erro' => 'Nome de usuário já cadastrado'), 400);
            break;

        default:
            respostaJson(array('erro' => 'Erro SQL não capturado: ' . $e->getCode()), 500);
            break;
    }
    
}
