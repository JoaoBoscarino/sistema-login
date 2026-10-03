<?php

session_start();
require 'conexao.php';
require 'funcoes.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

if (!csrf_valido()) {
    voltar_com_erro('login.php', 'Sessão expirada. Tente novamente.');
}

$email = strtolower(trim($_POST['email'] ?? ''));
$senha = $_POST['senha'] ?? '';

if ($email === '' || $senha === '') {
    voltar_com_erro('login.php', 'Preencha todos os campos.');
}

$stmt = $pdo->prepare('SELECT id, nome, senha FROM usuarios WHERE email = ?');
$stmt->execute([$email]);
$usuario = $stmt->fetch();

if ($usuario && password_verify($senha, $usuario['senha'])) {

    session_regenerate_id(true);

    $_SESSION['id']   = $usuario['id'];
    $_SESSION['nome'] = $usuario['nome'];

    header('Location: painel.php');
    exit;
}

voltar_com_erro('login.php', 'Email ou senha incorretos.');
