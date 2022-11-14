<?php
// Termina a execução mandando uma resposta json, obtida de uma array do PHP
function respostaJson($arrayPHP = null, $codigoHTTP = 200)
{
	header_remove();
    header("Content-Type: application/json");
   
	http_response_code($codigoHTTP);
	echo json_encode($arrayPHP);
    
	exit();
}