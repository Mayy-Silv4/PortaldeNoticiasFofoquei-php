<?php
// =========================
// excluir_usuario.php
// =========================
session_start();

require 'classes/Conexao.php';
require 'classes/Usuario.php';
require 'Auth.php';
Auth::proteger();

$con = new Conexao();
$db = $con->conectar();
$user = new Usuario($db);

$user->excluir($_SESSION['usuario_id']);
session_destroy();
header("Location: index.php");
?>