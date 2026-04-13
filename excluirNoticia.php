<?php
// =========================
// excluir_noticia.php
// =========================
session_start();
require_once 'config/config.php';
require_once 'classes/Conexao.php';
require_once 'Noticia.php';
require_once 'Auth.php';
Auth::proteger();

$con = new Conexao();
$db = $con->conectar();
$noticia = new Noticia($db);

$noticia->excluir($_GET['id'], $_SESSION['usuario_id']);
header("Location: dashboard.php");
?>
