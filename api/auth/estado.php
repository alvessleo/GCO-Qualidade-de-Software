<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/api/cabecalhos.php');

if (verificarArgumentos($_SESSION, false, 'codigo_usuario', 'nome', 'usuario'))
    respostaJson(array('codigo_usuario' => $_SESSION['codigo_usuario'], 'nome' => $_SESSION['nome'], 'usuario' => $_SESSION['usuario']), 200);

respostaJson(null, 200);
