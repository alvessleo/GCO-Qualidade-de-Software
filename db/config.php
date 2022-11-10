<?php 

$servername = 'localhost:3306';
$username = 'conformity_admin';
$password = '123';
$database = 'conformity';

$conexao = mysqli_connect($servername, $username, $password, $database);
unset($servername, $username, $password, $database);