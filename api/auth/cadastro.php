<?php
include_once($_SERVER["DOCUMENT_ROOT"] . '/api/auxiliar.php');
verificarArgumentos($_POST, 'nome', 'usuario', 'senha');

try
{
    $resultado = executarQuery(
        'INSERT INTO `usuario` (`nome`, `usuario`, `senha`) VALUES (?, ?, ?)', 
        'sss', // 'sss' = string, string, string: Um caractere para cada tipo de variável do BD.
        $_POST['nome'],
        $_POST['usuario'],
        password_hash($_POST['senha'], PASSWORD_DEFAULT),
    );

    if ($resultado) 
        respostaJson(null, 201);

    respostaJson(array('erro' => 'Erro desconhecido'), 500);
} 
catch (mysqli_sql_exception $e)
{
    switch ($e->getCode())
    {
        case 1062:
            respostaJson(array('erro' => 'Nome de usuário já cadastrado'), 400);
            break;

        default:
            respostaJson(array('erro' => 'Erro desconhecido'), 500);
            break;

    }
    
}
