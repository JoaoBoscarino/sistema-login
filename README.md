# Sistema de Login

Projeto de estudo em PHP puro e MySQL com cadastro, login, painel e logout.

## Funcionalidades

- Cadastro com nome, email e senha (senha guardada com `password_hash`)
- Login com verificação via `password_verify`
- Proteção de sessão com `session_regenerate_id` no login
- Proteção CSRF nos formulários de cadastro e login
- Painel acessível somente com sessão ativa

## Tecnologias

- PHP 7.1+, com as extensões `pdo_mysql` e `mbstring` ativas (o Laragon já inclui ambas)
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

## Limitações conhecidas

Projeto de estudo, então algumas coisas ainda estão simples de propósito:

- A mensagem de erro é lida da URL (`?erro=...`). O texto é escapado, então não há XSS, mas qualquer texto pode aparecer na página. O ideal é usar uma lista de mensagens permitidas, como já é feito para `?msg=`.
- Se dois cadastros com o mesmo email acontecerem ao mesmo tempo, o `UNIQUE` do banco recusa o segundo, mas o PHP não captura o erro e o usuário vê uma exceção técnica.
- O login não tem limite de tentativas.
- Os cookies de sessão usam as configurações padrão do PHP, sem `httponly`, `secure` e `samesite` explícitos.
- O logout é feito por link (GET), o que permite encerrar a sessão de outro site.
- A senha tem mínimo de 6 caracteres e nenhum máximo. O bcrypt usa só os primeiros 72 bytes da senha.
