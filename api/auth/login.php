<?php
include_once($_SERVER["DOCUMENT_ROOT"] . '/api/auxiliar.php');
verificarArgumentos($_POST, 'usuario', 'senha');

try
{
    $resultado = executarQuery(
        'SELECT * FROM `usuario` WHERE `usuario`.`usuario` = ?', 
        's',
        $_POST['usuario']
    );

    if ($resultado && $dados_resultado = $resultado->get_result())
    {
        if ($dados_resultado->num_rows)
        {
            $linha = $dados_resultado->fetch_assoc();
            if (password_verify($_POST['senha'], $linha['senha']))
            {
                session_start();
                $_SESSION['codigo_usuario'] = $linha['codigo_usuario'];
                $_SESSION['nome'] = $linha['nome'];
                $_SESSION['usuario'] = $linha['usuario'];

                respostaJson(null, 200);           
            }      
        }
    }

    respostaJson(array('erro' => 'Usuário ou senha incorretos'), 400);
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
