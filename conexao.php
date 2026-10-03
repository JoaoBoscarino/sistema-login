<?php

if (!file_exists(__DIR__ . '/config.php')) {
    die('Crie o arquivo config.php a partir do config.example.php (veja o README.md).');
}

$config = require __DIR__ . '/config.php';

$pdo = new PDO(
    "mysql:host={$config['host']};dbname={$config['banco']};charset=utf8mb4",
    $config['usuario'],
    $config['senha'],
    [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
);
