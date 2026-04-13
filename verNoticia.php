<?php
require_once 'classes/Conexao.php';
require_once 'Noticia.php';

$con = new Conexao();
$db = $con->conectar();
$noticia = new Noticia($db);

$id = $_GET['id'] ?? null;

if(!$id){
    die("Notícia não encontrada!");
}

$n = $noticia->buscar($id);

if(!$n){
    die("Notícia não encontrada!");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title><?= $n['titulo'] ?></title>

<style>
body{
  font-family:'Segoe UI';
  background:#f4f4f4;
  margin:0;
  padding:20px;
}

.container{
  max-width:800px;
  margin:auto;
  background:white;
  padding:20px;
  border-radius:15px;
  box-shadow:0 5px 20px rgba(0,0,0,0.2);
}

img{
  width:100%;
  border-radius:10px;
}

a{
  display:inline-block;
  margin-top:15px;
  text-decoration:none;
  background:#8a00ff;
  color:white;
  padding:10px;
  border-radius:8px;
}
</style>

</head>
<body>

<div class="container">

<h1><?= $n['titulo'] ?></h1>

<?php if($n['imagem']): ?>
<img src="img/<?= $n['imagem'] ?>">
<?php endif; ?>

<p><?= nl2br($n['noticia']) ?></p>

<a href="index.php">⬅ Voltar</a>

</div>

</body>
</html>