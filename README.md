# Sistema de Login

Projeto de estudo em PHP puro e MySQL com cadastro, login, painel e logout.

## Funcionalidades

- Cadastro com nome, email e senha (senha guardada com `password_hash`)
- Login com verificação via `password_verify`
- Proteção de sessão com `session_regenerate_id` no login
- Proteção CSRF nos formulários de cadastro e login
- Painel acessível somente com sessão ativa

## Tecnologias

- PHP 8+
- MySQL / MariaDB
- PDO com prepared statements

## Como rodar (Laragon)

1. Copie a pasta do projeto para `C:\laragon\www\sistema_login`.
2. Inicie o Apache e o MySQL pelo Laragon.
3. Crie o banco importando o arquivo `schema.sql` (pelo phpMyAdmin ou pelo terminal):
   ```bash
   mysql -u root < schema.sql
   ```
4. Crie o arquivo de configuração a partir do exemplo:
   ```bash
   copy config.example.php config.php
   ```
   Depois ajuste usuário e senha do MySQL dentro de `config.php`.
5. Acesse no navegador: `http://localhost/sistema_login/cadastro.php`

> O `config.php` não deve ser enviado ao GitHub. Ele já está listado no `.gitignore`.

## Estrutura

| Arquivo | Função |
| --- | --- |
| `cadastro.php` | Formulário de criação de conta |
| `tratar_cadastro.php` | Valida e salva o novo usuário |
| `login.php` | Formulário de login |
| `tratar_login.php` | Confere email e senha e cria a sessão |
| `painel.php` | Página protegida, só para usuários logados |
| `logout.php` | Encerra a sessão |
| `conexao.php` | Cria a conexão PDO com o banco |
| `funcoes.php` | Funções auxiliares (token CSRF, redirecionamento com erro) |
| `config.example.php` | Modelo de configuração do banco |
| `schema.sql` | Criação do banco e da tabela `usuarios` |

## Fluxo

```
cadastro.php → tratar_cadastro.php → login.php → tratar_login.php → painel.php → logout.php
```

## Próximos passos (ideias para estudar)

- Limitar tentativas de login
- Recuperação de senha por email
- Confirmação de email no cadastro
- Testes automatizados
