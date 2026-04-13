<?php
require_once 'config/config.php';
require_once 'classes/Usuario.php';

$user = new Usuario($db);

if ($_POST) {
    $user->cadastrar(
        $_POST['nome'],
        $_POST['email'],
        $_POST['senha'],
        $_POST['tipo'] ?? 'leitor' // se não selecionar, usa 'leitor'
    );

    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Cadastro 💅</title>
<style>
body {
    margin: 0;
    font-family: 'Segoe UI';
    background: linear-gradient(120deg, #8a00ff, #ff0080);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* CARD */
.box {
    background: white;
    padding: 30px;
    border-radius: 15px;
    width: 320px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    text-align: center;
}

h2 {
    margin-bottom: 20px;
    color: #333;
}

/* INPUTS */
input, select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 8px;
    border: 1px solid #ccc;
}

/* BOTÃO */
button {
    width: 100%;
    padding: 10px;
    background: linear-gradient(90deg, #ff0080, #8a00ff);
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
}

button:hover {
    opacity: 0.9;
}

/* LINK */
a {
    display: block;
    margin-top: 10px;
    color: #ff0080;
    text-decoration: none;
}
</style>
</head>
<body>

<div class="box">
    <h2>Cadastro</h2>

    <form method="POST">
        <input name="nome" placeholder="Nome" required>
        <input name="email" placeholder="Email" required>
        <input name="senha" type="password" placeholder="Senha" required>

        <select name="tipo">
            <option value="leitor">👀 Leitor</option>
            <option value="autor">✍️ Autor</option>
        </select>

        <button>Cadastrar</button>
    </form>

    <a href="login.php">Já tem uma conta? Login</a>
</div>


</body>
</html>