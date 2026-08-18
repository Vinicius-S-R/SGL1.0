# 📚 SGL 1.0 — Sistema de Gestão de Livros

Sistema web desenvolvido para gerenciamento de uma biblioteca, permitindo controlar livros, alunos, usuários, empréstimos e devoluções.

O projeto foi desenvolvido utilizando PHP e MySQL, com autenticação de usuários e operações de cadastro, consulta e movimentação de livros.

> 🚧 **Status:** Projeto funcional em desenvolvimento e evolução.

---

## 🎯 Objetivo

O objetivo do SGL é facilitar o gerenciamento de uma biblioteca através de um sistema web centralizado.

O sistema permite administrar:

- 📚 Livros
- 👨‍🎓 Alunos
- 👤 Usuários
- 🔄 Empréstimos
- ↩️ Devoluções
- 📋 Registros
- 📊 Relatórios

---

## ⚙️ Funcionalidades

### 🔐 Autenticação

- Login de usuários
- Cadastro de usuários
- Controle de sessão
- Controle de acesso
- Logout
- Armazenamento seguro de senhas utilizando `password_hash()`
- Verificação de senhas utilizando `password_verify()`

### 📚 Livros

- Cadastro de livros
- Edição de livros
- Exclusão de livros
- Consulta de livros
- Pesquisa por título, autor ou código
- Controle de disponibilidade

### 👨‍🎓 Alunos

- Cadastro de alunos
- Edição de alunos
- Exclusão de alunos
- Consulta de alunos
- Informações de série e turma
- Pesquisa de alunos

### 🔄 Empréstimos

- Seleção de livros
- Seleção de alunos
- Registro da retirada
- Definição da data prevista para devolução
- Controle de disponibilidade do livro
- Registro das movimentações

### ↩️ Devoluções

- Listagem de empréstimos
- Registro de devoluções
- Atualização da data de devolução
- Controle das movimentações realizadas

### 📊 Relatórios

Área destinada à consulta das informações registradas no sistema.

---

## 🖥️ Interface

O sistema possui uma interface web desenvolvida utilizando HTML, CSS, JavaScript e Tailwind CSS.

Entre os elementos utilizados estão:

- Navegação lateral
- Tabelas para apresentação de dados
- Formulários de cadastro
- Campos de pesquisa
- Autocomplete
- Feedback visual
- Ícones utilizando Font Awesome
- Layout adaptado para diferentes tamanhos de tela

---

## 🛠️ Tecnologias utilizadas

### Front-end

- HTML5
- CSS3
- JavaScript
- Tailwind CSS
- Font Awesome

### Back-end

- PHP
- PDO

### Banco de dados

- MySQL / MariaDB

### Ambiente de desenvolvimento

- WAMP
- Apache
- MySQL
- phpMyAdmin

### Versionamento

- Git
- GitHub

---

## 🗂️ Estrutura do projeto

```text
SGL1.0/
│
├── login.php
├── cadastro_login.php
├── logout.php
├── user.php
├── conexao.php
│
├── menu.html
│
├── livro.php
├── aluno.php
├── usuarios.php
├── relatorios.php
│
├── movimentacao.php
├── retirada.php
├── devolucao.php
├── devolucaolivro.php
├── registrardevolucao.php
├── registro.php
├── criarregistro.php
│
├── buscar.php
├── buscar_alunos.php
├── buscar_livros.php
│
├── tabelas.sql
└── README.md
