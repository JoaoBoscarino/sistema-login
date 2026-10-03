<?php

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function campo_csrf(): string
{
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars(csrf_token()) . '">';
}

function csrf_valido(): bool
{
    $enviado = $_POST['csrf_token'] ?? '';
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $enviado);
}

function voltar_com_erro(string $pagina, string $mensagem): void
{
    header('Location: ' . $pagina . '?erro=' . urlencode($mensagem));
    exit;
}
