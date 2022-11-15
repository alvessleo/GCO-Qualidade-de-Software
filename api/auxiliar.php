<?php
// Permite o recebimento de json no corpo como se fosse x-www-form-urlencoded
function receberJson()
{
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER["CONTENT_TYPE"] == 'application/json')
		$_POST = json_decode(file_get_contents('php://input'), true); 
}

// Termina a execução mandando uma resposta json, obtida de uma array do PHP
function respostaJson($arrayPHP = null, $codigoHTTP = 200)
{
	// header_remove(); // destrói sessão
    header('Content-Type: application/json');
   
	http_response_code($codigoHTTP);
	echo json_encode($arrayPHP);
    
	exit();
}

// Verifica se uma array possuí todas as chaves passadas ou termina a execução
function verificarArgumentos($arrayPHP, $lanca, ...$chaves)
{
	foreach ($chaves as $chave)
	{
		if (!isset($arrayPHP[$chave]))
			if ($lanca)
				respostaJson(array('erro' => 'Argumento não recebido: ' . $chave), 400);
			else
				return false;
    }

	if (!$lanca)
		return true;
}

// Obtém a conexão em cache ou cria uma nova caso ela não seja válida
function obterConexaoDB()
{
	static $conexao = null;
	
	if (is_null($conexao) || !$conexao->ping())
	{
		try
		{
			include_once($_SERVER["DOCUMENT_ROOT"] . '/db/config.php');
			$conexao = mysqli_connect($servername, $username, $password, $database);
		}
		catch (mysqli_sql_exception $e) 
		{
			respostaJson(array('erro' => 'Falha na conexão com banco de dados'), 500);
		}
	}

	return $conexao;
}

// Executa uma query, aceitando argumentos para placeholder '?'
function executarQuery($sql, $tipos = null, ...$valores)
{
	$conexao = obterConexaoDB();
    $query = $conexao->prepare($sql);

	if (!is_null($tipos))
    	$query->bind_param($tipos, ...$valores);

	if ($query->execute())
		return $query;

    return null;
}
