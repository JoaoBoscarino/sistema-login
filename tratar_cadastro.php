<?php

session_start();
require 'conexao.php';
require 'funcoes.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: cadastro.php');
    exit;
}

if (!csrf_valido()) {
    voltar_com_erro('cadastro.php', 'Sessão expirada. Tente novamente.');
}

$nome  = trim($_POST['nome'] ?? '');
$email = strtolower(trim($_POST['email'] ?? ''));
$senha = $_POST['senha'] ?? '';

if ($nome === '' || $email === '' || $senha === '') {
    voltar_com_erro('cadastro.php', 'Preencha todos os campos.');
}

if (mb_strlen($nome) > 100) {
    voltar_com_erro('cadastro.php', 'O nome pode ter no máximo 100 caracteres.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    voltar_com_erro('cadastro.php', 'Email inválido.');
}

if (strlen($senha) < 6) {
    voltar_com_erro('cadastro.php', 'A senha precisa ter pelo menos 6 caracteres.');
}

$stmt = $pdo->prepare('SELECT id FROM usuarios WHERE email = ?');
$stmt->execute([$email]);

if ($stmt->fetch()) {
    voltar_com_erro('cadastro.php', 'Não foi possível concluir o cadastro.');
}

$hash = password_hash($senha, PASSWORD_DEFAULT);

$stmt = $pdo->prepare('INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)');
$stmt->execute([$nome, $email, $hash]);

header('Location: login.php?msg=cadastrado');
exit;
