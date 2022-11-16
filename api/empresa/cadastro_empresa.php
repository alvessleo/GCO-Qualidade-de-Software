<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/api/cabecalhos.php');
verificarArgumentos($_POST, true, 'nome', 'cargo', 'auditor');

if (!isset($_SESSION['codigo_usuario']))
    respostaJson(array('erro' => 'É necessário estar logado'), 403);

try
{
    // Não atômico, condenado a dar PT em algum ponto, mas é pra sexta né
    $resultado_a = executarQuery(
        'INSERT INTO `empresa` (`codigo_criador`, `nome`) VALUES (?, ?)', 
        'is',
        $_SESSION['codigo_usuario'],
        $_POST['nome']
    );

    $resultado_b = executarQuery(
        'INSERT INTO `usuario_empresa` (`codigo_usuario`, `codigo_empresa`, `cargo`, `auditor`) VALUES (?, ?, ?, ?)', 
        'iisi',
        $_SESSION['codigo_usuario'],
        $resultado_a->insert_id,
        $_POST['cargo'],
        $_POST['auditor']
    );

    if ($resultado_b && $resultado_b->affected_rows)
    {
        respostaJson(null, 201);
    }
        
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
