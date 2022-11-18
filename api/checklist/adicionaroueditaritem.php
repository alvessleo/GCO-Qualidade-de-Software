<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/api/cabecalhos.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/api-interna/checklist.php');

//verificarArgumentos($_POST, true, 'codigo_checklist', 'codigo_itemChecklist', 'codigo_estado', 'item', 'comentario');

if (!isset($_SESSION['codigo_usuario']))
    respostaJson(array('erro' => 'É necessário estar logado'), 403);

$resultado = criaOuEditaItem($_POST['codigo_checklist'], $_POST['codigo_itemChecklist'], $_POST['codigo_estado'], $_POST['item'], $_POST['comentario']);

if ($resultado)
    respostaJson(array('ok' => true), 200);
else
    respostaJson(array('ok' => false), 500);