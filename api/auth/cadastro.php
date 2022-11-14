<?php
include_once('../auxiliar.php');

if (!isset($_POST['nome'], $_POST['usuario'], $_POST['senha']))
    respostaJson(array('erro' => 'Nome, login ou senha não recebidos'), 400);

include_once('../../db/config.php');
try
{
    $query = $conexao->prepare('INSERT INTO `usuario` (`nome`, `usuario`, `senha`) VALUES (?, ?, ?)');
    
    $nome = $_POST['nome'];
    $usuario = $_POST['usuario'];
    $senha_hash = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    
    $query->bind_param('sss', $nome, $usuario, $senha_hash);
    
    $resultado = $query->execute();

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

$conexao->close();