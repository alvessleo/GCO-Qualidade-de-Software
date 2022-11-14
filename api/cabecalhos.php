<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/api/auxiliar.php');

if (session_status() != PHP_SESSION_ACTIVE)
    session_start();
