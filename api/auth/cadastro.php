<?php
$nome = $_POST['nome'];
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

if (!isset($nome, $usuario, $senha))
{
    echo('nome, login ou senha não recebidos');
    exit(400);
}

filter_var_array($_POST);
include_once('../../db/config.php');

$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

$insert_usuario = "INSERT INTO `usuario` (`nome`, `usuario`, `senha`) VALUES ('$nome', '$usuario', '$senha_hash')";

try
{
    $resultado = $conexao->query($insert_usuario);

    if ($resultado) 
        exit(201);
    else 
    {
        echo('erro desconhecido');
        exit(500);
    }
} 
catch (mysqli_sql_exception $e)
{
    switch ($e->getCode())
    {
        case 1062:
            echo('nome de usuário já cadastrado');
            break;

        default:
            echo('erro desconhecido');

    }

    exit(500);
}
