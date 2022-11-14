<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/api/cabecalhos.php');

$_SESSION = array();
session_destroy();

respostaJson(null, 200);
