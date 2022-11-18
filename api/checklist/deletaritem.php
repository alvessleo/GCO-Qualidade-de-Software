<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/api/cabecalhos.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/api-interna/checklist.php');

if (!isset($_SESSION['codigo_usuario']))
    respostaJson(array('erro' => 'É necessário estar logado'), 403);


$resultado = deletaItem($_POST['codigo_itemChecklist']);

if ($resultado)
    respostaJson(array('ok' => true), 200);
else
    respostaJson(array('ok' => false), 500);