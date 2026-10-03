-- Cria o banco e a tabela usada pelo sistema de login.
-- Importe pelo phpMyAdmin ou rode: mysql -u root < schema.sql

CREATE DATABASE IF NOT EXISTS sistema_login
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE sistema_login;

CREATE TABLE IF NOT EXISTS usuarios (
    id           INT NOT NULL AUTO_INCREMENT,
    nome         VARCHAR(255) NOT NULL,
    email        VARCHAR(255) NOT NULL,
    senha        VARCHAR(255) NOT NULL,  
    data_cadastro TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY email (email)             
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
