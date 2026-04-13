<?php
session_start();
require_once 'classes/Conexao.php';

$con = new Conexao();
$db = $con->conectar();

$id = $_SESSION['usuario_id'];

// BUSCAR DADOS
$stmt = $db->prepare("SELECT nome, email, foto FROM usuarios WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// ATUALIZAR
if($_POST){
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $foto = $user['foto'];

    // upload da foto
    if(!empty($_FILES['foto']['name'])){
        $foto = time() . "_" . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], "img/".$foto);
    }

    $stmt = $db->prepare("UPDATE usuarios SET nome=?, email=?, foto=? WHERE id=?");
    $stmt->bind_param("sssi", $nome, $email, $foto, $id);
    $stmt->execute();

    header("Location: editarUsuario.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Perfil</title>

<style>
body{
  font-family:'Segoe UI';
  background:linear-gradient(135deg,#ff0066,#7b2ff7);
  margin:0;
}

/* CONTAINER */
.perfil-container{
  display:flex;
  justify-content:center;
  align-items:center;
  height:100vh;
}

/* CARD */
.perfil-card{
  background:white;
  padding:30px;
  border-radius:20px;
  width:350px;
  text-align:center;
  box-shadow:0 20px 40px rgba(0,0,0,0.2);
  position:relative;
  animation:fade 0.5s ease;
}

@keyframes fade{
  from{opacity:0; transform:translateY(20px);}
  to{opacity:1; transform:translateY(0);}
}

/* BOTÃO VOLTAR */
.voltar{
  position:absolute;
  top:15px;
  left:15px;
  text-decoration:none;
  background:#eee;
  padding:6px 10px;
  border-radius:8px;
  font-size:12px;
  color:#333;
  transition:0.2s;
}

.voltar:hover{
  background:#ddd;
}

/* FOTO */
.perfil-foto{
  width:120px;
  height:120px;
  border-radius:50%;
  object-fit:cover;
  border:4px solid #ff0066;
  margin-bottom:10px;
}

/* INPUTS */
.perfil-card input{
  width:90%;
  padding:10px;
  margin:8px 0;
  border-radius:8px;
  border:1px solid #ddd;
  transition:0.2s;
}

.perfil-card input:focus{
  border-color:#ff0066;
  outline:none;
  box-shadow:0 0 5px rgba(255,0,102,0.4);
}

/* BOTÃO */
.perfil-card button{
  width:95%;
  padding:12px;
  margin-top:10px;
  border:none;
  border-radius:10px;
  background:linear-gradient(90deg,#ff0066,#7b2ff7);
  color:white;
  font-weight:bold;
  cursor:pointer;
  transition:0.3s;
}

.perfil-card button:hover{
  transform:scale(1.05);
  box-shadow:0 5px 15px rgba(0,0,0,0.2);
}

/* UPLOAD */
.upload-label{
  display:block;
  margin:10px 0;
  font-size:14px;
  cursor:pointer;
  color:#666;
}

/* TEXTO EMAIL */
.email{
  font-size:13px;
  color:#777;
  margin-bottom:10px;
}
</style>
</head>

<body>

<div class="perfil-container">
  <div class="perfil-card">

    <!-- BOTÃO VOLTAR -->
    <a href="index.php" class="voltar">⬅ Voltar</a>

    <!-- FOTO -->
    <?php if(!empty($user['foto'])): ?>
      <img src="img/<?= $user['foto'] ?>" class="perfil-foto">
    <?php else: ?>
      <img src="https://via.placeholder.com/120" class="perfil-foto">
    <?php endif; ?>

    <h2><?= $user['nome'] ?></h2>
    <div class="email"><?= $user['email'] ?></div>

    <form method="POST" enctype="multipart/form-data">

      <input type="text" name="nome" value="<?= $user['nome'] ?>" required>
      <input type="email" name="email" value="<?= $user['email'] ?>" required>

      <label class="upload-label">📸 Alterar foto</label>
      <input type="file" name="foto">

      <button>Salvar alterações</button>
    </form>

  </div>
</div>

</body>
</html>