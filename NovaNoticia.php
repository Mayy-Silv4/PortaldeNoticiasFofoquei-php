<?php
session_start();
require_once 'classes/Conexao.php';
require_once 'Noticia.php';

if(!isset($_SESSION['usuario_id']) || $_SESSION['tipo'] != 'autor'){
    die("🚫 Apenas autores podem acessar!");
}

$con = new Conexao();
$db = $con->conectar();
$noticia = new Noticia($db);

if($_POST){
    $titulo = $_POST['titulo'];
    $conteudo = $_POST['noticia'];
    $autor = $_SESSION['usuario_id'];

    // 🔥 categoria
    $categoria = $_POST['categoria'];

    $imagem = null;

    if(!empty($_FILES['imagem']['name'])){
        $imagem = time() . "_" . $_FILES['imagem']['name'];
        move_uploaded_file($_FILES['imagem']['tmp_name'], "img/" . $imagem);
    }

    // 🔥 CORRIGIDO (ordem correta dos parâmetros)
    if($noticia->criar($titulo, $conteudo, $autor, $categoria, $imagem)){
        header("Location: index.php");
        exit;
    } else {
        $erro = "Erro ao postar!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Postar Notícia</title>

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
<h2>📝 Nova Fofoca</h2>

<?php if(isset($erro)) echo "<p>$erro</p>"; ?>

<form method="POST" enctype="multipart/form-data">
<input name="titulo" placeholder="Título" required>
<textarea name="noticia" placeholder="Escreva a fofoca..." required></textarea>

<select name="categoria" required>
  <option value="">Selecione a categoria</option>
  <option value="tv">TV</option>
  <option value="celebridades">Celebridades</option>
  <option value="eventos">Eventos</option>
  <option value="musica">Música</option>
  <option value="astrologia">Astrologia</option>
  <option value="significados">Significados</option>
</select>

<input type="file" name="imagem">
<button>Publicar</button>
</form>

<a href="index.php">⬅ Voltar</a>
</div>


</body>
</html>