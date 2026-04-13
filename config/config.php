<?php
// inicia sessão com segurança
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// buffer (evita erro de header)
ob_start();

// conexão
require_once __DIR__ . '/../classes/Conexao.php';

$con = new Conexao();
$db = $con->conectar();