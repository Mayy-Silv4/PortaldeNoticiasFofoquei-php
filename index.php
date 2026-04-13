<?php
session_start();
require_once 'classes/Conexao.php';
require_once 'Noticia.php';

$con = new Conexao();
$db = $con->conectar();
$noticia = new Noticia($db);

$cat = $_GET['cat'] ?? 'ultimas';
$lista = $noticia->listar($cat);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Fofoquei 💅</title>

<style>
body{
  font-family:'Segoe UI', Arial;
  margin:0;
  background:#f4f6fb;
  transition:.3s;
}

/* HEADER */
.header{
  background: linear-gradient(90deg,#ff0066,#7b2ff7);
  color:white;
  text-align:center;
  padding:30px;
  box-shadow:0 10px 30px rgba(0,0,0,0.2);
}

.header h1{
  margin:0;
  font-size:34px;
  letter-spacing:1px;
}

.header h2{
  font-weight:300;
  font-size:16px;
  opacity:.9;
}

/* PERFIL */
.perfil-bar{
  background:#111;
  color:white;
  padding:12px 20px;
  display:flex;
  justify-content:space-between;
  align-items:center;
}

.perfil-bar .acoes a{
  color:white;
  text-decoration:none;
  margin-left:10px;
  padding:6px 12px;
  border-radius:6px;
  background:rgba(255,255,255,0.1);
}

.perfil-bar .acoes a:hover{
  background:rgba(255,255,255,0.3);
}

/* MENU */
.menu{
  background:white;
  padding:15px 20px;
  display:flex;
  align-items:center;
  box-shadow:0 4px 15px rgba(0,0,0,0.08);
}

.menu .links{
  flex:1;
  display:flex;
  justify-content:center;
  gap:35px;
}

.menu a{
  text-decoration:none;
  color:#444;
  font-weight:500;
  position:relative;
}

.menu a::after{
  content:"";
  position:absolute;
  width:0%;
  height:2px;
  background:#ff0066;
  left:0;
  bottom:-5px;
  transition:.3s;
}

.menu a:hover::after{
  width:100%;
}

.menu a:hover{
  color:#ff0066;
}

.menu .auth-links a{
  background:#ff0066;
  color:white;
  padding:6px 12px;
  border-radius:6px;
}

.menu button{
  margin-left:10px;
  background:#222;
  color:white;
  border:none;
  padding:6px 10px;
  border-radius:8px;
  cursor:pointer;
}

/* NOTICIAS */
.noticias-container{
  display:grid;
  grid-template-columns:repeat(auto-fill,minmax(280px,1fr));
  gap:25px;
  padding:25px;
}

.noticia{
  background:white;
  border-radius:15px;
  overflow:hidden;
  box-shadow:0 10px 25px rgba(0,0,0,0.08);
  transition:.3s;
  height:420px;
  display:flex;
  flex-direction:column;
  justify-content:space-between;
}

.noticia:hover{
  transform:translateY(-6px);
}

.noticia img{
  width:100%;
  height:180px;
  object-fit:cover;
}

.noticia h3{
  padding:10px 15px;
  margin:0;
}

.noticia p{
  padding:0 15px 10px;
  font-size:14px;
  color:#555;
}

.noticia .texto{
  display:-webkit-box;
  -webkit-line-clamp:4;
  -webkit-box-orient:vertical;
  overflow:hidden;
}

.noticia a{
  margin:10px;
  display:inline-block;
  padding:6px 10px;
  background:#ff0066;
  color:white;
  border-radius:6px;
  text-decoration:none;
  font-size:12px;
}

.noticia a:hover{
  background:#d10052;
}

.noticia .ler-mais{
  margin:0 15px 10px;
  display:block;
  padding:6px 10px;
  background:#a855f7 !important;
  color:white;
  border-radius:6px;
  text-decoration:none;
  font-size:12px;
  text-align:center;
}

.noticia .ler-mais:hover{
  background:#9333ea !important;
}

/* 🔥 ADICIONADO SÓ ISSO PARA ALINHAR EDITAR/EXCLUIR */
.noticia .acoes{
  display:flex;
  justify-content:space-between;
  padding:0 15px 15px;
  gap:10px;
}

.noticia .acoes a{
  flex:1;
  text-align:center;
}

/* CLIMA */
.clima-float{
  position:fixed;
  bottom:20px;
  right:20px;
  z-index:999;
}

.clima-icone{
  font-size:22px;
  background:linear-gradient(90deg,#ff0066,#7b2ff7);
  color:white;
  width:55px;
  height:55px;
  display:flex;
  align-items:center;
  justify-content:center;
  border-radius:50%;
  cursor:pointer;
  box-shadow:0 6px 18px rgba(0,0,0,0.25);
}

.clima-box{
  position:absolute;
  bottom:70px;
  right:0;
  width:240px;
  background:white;
  padding:16px;
  border-radius:15px;
  box-shadow:0 10px 25px rgba(0,0,0,0.12);
  display:none;

  flex-direction:column;
  align-items:center;
  gap:10px;
}

.clima-box.ativo{
  display:flex;
}

.clima-box h4{
  margin:0;
  text-align:center;
}

.clima-box input{
  width:100%;
  padding:10px;
  border-radius:10px;
  border:1px solid #ddd;
  text-align:center;
  box-sizing:border-box;
}

.clima-box button{
  width:100%;
  padding:10px;
  background:#ff0066;
  color:white;
  border:none;
  border-radius:10px;
}

#temperatura{
  text-align:center;
  margin:0;
  font-weight:bold;
}

#descricao{
  text-align:center;
  margin:0;
  color:#666;
}

/* DARK MODE */
body.dark{
  background:#0d0d0d;
  color:white;
}

body.dark .menu{
  background:#1a1a1a;
}

body.dark .noticia{
  background:#1a1a1a;
}

body.dark .clima-box{
  background:#1a1a1a;
  color:white;
}

body.dark #descricao{
  color:#aaa;
}
</style>
</head>

<body>

<div class="header">
<h1>Fofoquei 💅</h1>
<h2>não contamos, só divulgamos</h2>
</div>

<?php if(isset($_SESSION['usuario_id'])): ?>
<div class="perfil-bar">
<div>Olá, <?= $_SESSION['nome'] ?> (<?= $_SESSION['tipo'] ?>)</div>

<div class="acoes">
<?php if($_SESSION['tipo']==='autor'): ?>
<a href="NovaNoticia.php">📝 Postar</a>
<?php endif; ?>

<a href="editarUsuario.php">Perfil</a>
<a href="logout.php">Sair</a>
</div>
</div>
<?php endif; ?>

<div class="menu">
  <div class="links">
    <a href="index.php?cat=ultimas">Últimas notícias</a>
    <a href="index.php?cat=tv">TV</a>
    <a href="index.php?cat=celebridades">Celebridades</a>
    <a href="index.php?cat=eventos">Eventos</a>
    <a href="index.php?cat=musica">Música</a>
    <a href="index.php?cat=astrologia">Astrologia</a>
    <a href="index.php?cat=significados">Significados</a>
  </div>

  <div class="auth-links">
    <?php if(!isset($_SESSION['usuario_id'])): ?>
      <a href="login.php">Login</a>
      <a href="cadastro.php">Cadastro</a>
    <?php endif; ?>
  </div>

  <button onclick="toggleTema()">🌙</button>
</div>

<div class="noticias-container">
<?php while($n = $lista->fetch_assoc()): ?>
<div class="noticia">

<?php if(!empty($n['imagem'])): ?>
<img src="img/<?= $n['imagem'] ?>">
<?php endif; ?>

<h3><?= $n['titulo'] ?></h3>

<p class="texto">
<?= substr($n['noticia'], 0, 120) ?>...
</p>

<a href="verNoticia.php?id=<?= $n['id'] ?>" class="ler-mais">
Ler mais
</a>

<?php if(isset($_SESSION['tipo']) && $_SESSION['tipo']==='autor'): ?>
<div class="acoes">
<a href="excluirNoticia.php?id=<?= $n['id'] ?>">Excluir</a>
<a href="EditarNoticia.php?id=<?= $n['id'] ?>">Editar</a>
</div>
<?php endif; ?>

</div>
<?php endwhile; ?>
</div>

<!-- CLIMA -->
<div class="clima-float">
  <div class="clima-icone">🌤️</div>

  <div class="clima-box">
    <h4>🌤️ Previsão</h4>
    <input type="text" id="cidadeInput" placeholder="Digite uma  cidade">
    <button onclick="buscarClima()">Ver clima</button>

    <p id="temperatura"></p>
    <p id="descricao"></p>
  </div>
</div>

<script src="script.js"></script>


</body>
</html>