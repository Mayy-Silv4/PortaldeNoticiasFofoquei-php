<?php
session_start();
require_once 'config/config.php';
require_once 'classes/Conexao.php';
require_once 'Noticia.php';
require_once 'Auth.php';

Auth::proteger();

if($_SESSION['tipo'] != 'autor'){
    die("🚫 Apenas autores podem editar notícias!");
}

$con = new Conexao();
$db = $con->conectar();
$noticia = new Noticia($db);

$id = $_GET['id'] ?? null;
if(!$id){
    die("🚫 Notícia não encontrada!");
}

// 🔥 EVITA ERRO FATAL CASO "buscar" NÃO FUNCIONE
if(!method_exists($noticia, 'buscar')){
    die("🚨 ERRO: método buscar() não existe na classe Noticia");
}

$n = $noticia->buscar($id);

if(!$n){
    die("🚫 Notícia não encontrada no banco!");
}

if ($_POST) {
    $titulo = $_POST['titulo'];
    $conteudo = $_POST['noticia'];
    $categoria = $_POST['categoria']; // 🔥 ADICIONADO

    $imagem = $n['imagem'];

    if(!empty($_FILES['imagem']['name'])){
        $imagem = time() . "_" . $_FILES['imagem']['name'];
        move_uploaded_file($_FILES['imagem']['tmp_name'], "img/".$imagem);
    }

    // 🔥 ADICIONADO categoria
    $ok = $noticia->atualizar(
        $id,
        $titulo,
        $conteudo,
        $_SESSION['usuario_id'],
        $imagem,
        $categoria
    );

    if($ok){
        header("Location: index.php");
        exit;
    } else {
        echo "Erro ao atualizar a notícia!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Editar Notícia</title>

<style>
body{
  font-family:'Segoe UI';
  margin:0;
  background:linear-gradient(135deg,#8a00ff,#ff0080);
  display:flex;
  justify-content:center;
  align-items:center;
  height:100vh;
}

.card{
  background:white;
  padding:30px;
  border-radius:20px;
  width:400px;
  box-shadow:0 10px 30px rgba(0,0,0,0.3);
}

h2{
  text-align:center;
}

input, textarea, select{
  width:100%;
  padding:10px;
  margin-top:10px;
  border-radius:8px;
  border:1px solid #ccc;
}

button{
  width:100%;
  margin-top:15px;
  padding:10px;
  background:linear-gradient(90deg,#ff0080,#8a00ff);
  border:none;
  color:white;
  border-radius:10px;
  font-size:16px;
  cursor:pointer;
}

button:hover{
  transform:scale(1.05);
}

a{
  display:block;
  text-align:center;
  margin-top:10px;
}
</style>
</head>

<body>

<div class="card">
<h2>✏️ Editar Fofoca</h2>

<form method="POST" enctype="multipart/form-data">

<input name="titulo" value="<?= $n['titulo'] ?>" required>

<textarea name="noticia" required><?= $n['noticia'] ?></textarea>

<!-- 🔥 SELECT DE CATEGORIA -->
<select name="categoria" required>
  <option value="tv" <?= $n['categoria']=='tv'?'selected':'' ?>>TV</option>
  <option value="celebridades" <?= $n['categoria']=='celebridades'?'selected':'' ?>>Celebridades</option>
  <option value="eventos" <?= $n['categoria']=='eventos'?'selected':'' ?>>Eventos</option>
  <option value="musica" <?= $n['categoria']=='musica'?'selected':'' ?>>Música</option>
  <option value="astrologia" <?= $n['categoria']=='astrologia'?'selected':'' ?>>Astrologia</option>
  <option value="significados" <?= $n['categoria']=='significados'?'selected':'' ?>>Significados</option>
</select>

<input type="file" name="imagem">

<button>Salvar alterações</button>
</form>

<a href="index.php">⬅ Voltar</a>
</div>

</body>
</html>