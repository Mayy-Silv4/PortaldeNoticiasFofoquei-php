<?php
session_start();
require_once 'config/config.php';
require_once 'classes/Usuario.php';

$user = new Usuario($db);

if ($_POST) {
    $usuario = $user->login($_POST['email'], $_POST['senha']);

    if ($usuario) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['tipo'] = $usuario['tipo'];

        header("Location: index.php");
        exit;
    } else {
        $erro = "❌ Email ou senha inválidos";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Login 💅</title>

<style>
body {
margin:0;
font-family:'Segoe UI';
background: linear-gradient(120deg, #ff0080, #8a00ff);
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.box {
background:white;
padding:30px;
border-radius:15px;
width:320px;
box-shadow:0 10px 25px rgba(0,0,0,0.2);
text-align:center;
}

h2 {
margin-bottom:20px;
color:#333;
}

input {
width:100%;
padding:10px;
margin-bottom:15px;
border-radius:8px;
border:1px solid #ccc;
}

button {
width:100%;
padding:10px;
background: linear-gradient(90deg, #ff0080, #8a00ff);
color:white;
border:none;
border-radius:8px;
font-weight:bold;
cursor:pointer;
}

button:hover {
opacity:0.9;
}

a {
display:block;
margin-top:10px;
color:#ff0080;
text-decoration:none;
}

.erro {
color:red;
margin-bottom:10px;
}
</style>
</head>

<body>

<div class="box">
<h2>Login</h2>

<?php if(isset($erro)) echo "<div class='erro'>$erro</div>"; ?>

<form method="POST">
<input name="email" placeholder="Email" required>
<input name="senha" type="password" placeholder="Senha" required>
<button>Entrar</button>
</form>

<a href="cadastro.php">Não tem uma conta? Cadastre-se</a>
</div>
 

</body>
</html>