<?php

session_start();
require 'funcoes.php';

$erro = $_GET['erro'] ?? '';
$msg  = $_GET['msg'] ?? '';

$mensagens = [
    'cadastrado' => 'Conta criada! Faça login para continuar.',
];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

    <h1>Entrar</h1>

    <?php if (isset($mensagens[$msg])): ?>
        <p style="color: green;"><?= htmlspecialchars($mensagens[$msg]) ?></p>
    <?php endif; ?>

    <?php if ($erro !== ''): ?>
        <p style="color: red;"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <form action="tratar_login.php" method="post">

        <?= campo_csrf() ?>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" autocomplete="current-password" required>

        <button type="submit">Entrar</button>

    </form>

    <a href="cadastro.php">Criar conta</a>

</body>
</html>
