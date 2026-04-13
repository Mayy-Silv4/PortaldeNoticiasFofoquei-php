<?php
// =========================
// dashboard.php
// =========================
session_start();
require_once 'config/config.php';
require_once 'classes/usuario.php';
require_once 'classes/conexao.php';
require_once 'Auth.php';

Auth::proteger();

echo "<h1>Dashboard Fofoquei</h1>";
echo "<a href='nova_noticia.php'>Nova Fofoca</a><br>";
echo "<a href='index.php'>Ver site</a><br>";
echo "<a href='logout.php'>Sair</a>";
?>