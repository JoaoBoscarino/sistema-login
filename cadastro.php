<?php

session_start();
require 'funcoes.php';

$erro = $_GET['erro'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
</head>
<body>

    <h1>Criar conta</h1>

    <?php if ($erro !== ''): ?>
        <p style="color: red;"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <form action="tratar_cadastro.php" method="post">

        <?= campo_csrf() ?>

        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" maxlength="100" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" maxlength="255" required>

        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" minlength="6" autocomplete="new-password" required>

        <button type="submit">Cadastrar</button>

    </form>

    <a href="login.php">Já tenho conta</a>

</body>
</html>
