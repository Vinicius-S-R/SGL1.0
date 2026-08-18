# 📚 SGL — Sistema de Gestão de Locação de Livros WEB

Sistema web desenvolvido para gerenciamento de uma biblioteca, permitindo controlar livros, alunos, usuários e o processo de empréstimo e devolução de livros.

O projeto está sendo desenvolvido com foco em organização, praticidade e facilidade de utilização, possuindo autenticação de usuários, gerenciamento de registros e interface responsiva.

> 🚧 **Status do projeto:** Em desenvolvimento

---

## 🎯 Objetivo

O objetivo do SGL é oferecer uma solução web para facilitar o gerenciamento de uma biblioteca, centralizando informações de:

* 📚 Livros
* 👨‍🎓 Alunos
* 👤 Usuários
* 🔄 Empréstimos
* ↩️ Devoluções
* 📋 Registros
* 📊 Relatórios

O sistema também possui controle de sessão para usuários autenticados.

---

## ⚙️ Funcionalidades

### 🔐 Autenticação

* Login de usuários
* Cadastro de novos usuários
* Senhas armazenadas utilizando `password_hash()`
* Verificação de senha utilizando `password_verify()`
* Controle de sessão
* Perfil do usuário
* Logout

### 📚 Gerenciamento de livros

* Cadastro e gerenciamento de livros
* Consulta de livros
* Pesquisa por título, autor ou código
* Controle de disponibilidade

### 👨‍🎓 Gerenciamento de alunos

* Cadastro de alunos
* Consulta de alunos
* Informações de série e turma
* Pesquisa de alunos para realização de empréstimos

### 🔄 Empréstimos

* Seleção de livro
* Seleção de aluno
* Pesquisa automática
* Preenchimento automático das informações
* Registro da data de retirada
* Previsão de devolução
* Controle de disponibilidade

### ↩️ Devoluções

* Listagem de empréstimos
* Controle de devoluções
* Atualização do status dos empréstimos

### 📋 Registros

* Histórico das movimentações realizadas no sistema

### 📊 Relatórios

* Área destinada à consulta de informações e relatórios do sistema

---

## 🖥️ Interface

A interface está sendo desenvolvida com uma proposta visual limpa e institucional.

O projeto possui:

* Design responsivo
* Interface clara
* Modo escuro
* Navegação lateral
* Cards de funcionalidades
* Ícones utilizando Font Awesome e SVG
* Feedback visual nas interações
* Campos de pesquisa com autocomplete

A identidade visual utiliza principalmente tons neutros, vermelho como cor de destaque e elementos claros para facilitar a leitura.

---

## 🛠️ Tecnologias utilizadas

### Front-end

* HTML5
* CSS3
* JavaScript
* Tailwind CSS
* Font Awesome

### Back-end

* PHP
* PDO

### Banco de dados

* MySQL / MariaDB

### Ambiente de desenvolvimento

* WAMP
* Apache
* PHP
* MySQL

---

## 🗂️ Estrutura atual

A estrutura pode variar conforme o desenvolvimento do projeto, mas atualmente possui arquivos relacionados a:

```text
SGL/
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
├── listardevolucao.php
├── registro.php
├── criarregistro.php
│
└── buscar.php
```

---

## 🔐 Segurança

O projeto utiliza alguns recursos básicos de segurança, incluindo:

* PDO para comunicação com o banco de dados
* Prepared Statements
* `password_hash()` para armazenamento de senhas
* `password_verify()` para autenticação
* Controle de sessão
* `htmlspecialchars()` para exibição segura de informações

O sistema ainda está em desenvolvimento e novas medidas de segurança serão implementadas conforme sua evolução.

---

## 🚀 Como executar o projeto

### 1. Instalar um ambiente local

Recomenda-se utilizar um ambiente como:

* WAMP
* XAMPP
* Laragon

O projeto foi desenvolvido originalmente utilizando WAMP.

### 2. Clonar o repositório

```bash
git clone URL_DO_REPOSITORIO
```

### 3. Colocar o projeto no servidor local

No WAMP, por exemplo:

```text
C:\wamp64\www\
```

Coloque a pasta do projeto dentro desse diretório.

Exemplo:

```text
C:\wamp64\www\SGL\
```

### 4. Criar o banco de dados

Abra o phpMyAdmin e crie o banco de dados utilizado pelo sistema.

Exemplo:

```sql
CREATE DATABASE sgl;
```

Depois importe o arquivo SQL do projeto, caso ele esteja disponível no repositório.

### 5. Configurar a conexão

Configure o arquivo:

```text
conexao.php
```

com as informações do seu ambiente MySQL/MariaDB.

Exemplo:

```php
$host = 'localhost';
$db   = 'sgl';
$user = 'root';
$pass = '';
```

> Os valores podem variar de acordo com a configuração do ambiente local.

### 6. Executar

Com o Apache e MySQL ativos, acesse pelo navegador:

```text
http://localhost/SGL/
```

---

## 👤 Fluxo básico do sistema

O funcionamento principal segue aproximadamente este fluxo:

```text
Login
  │
  ▼
Menu Principal
  │
  ├── Livros
  │
  ├── Alunos
  │
  ├── Usuários
  │
  ├── Movimentações
  │       │
  │       ├── Retirada
  │       │
  │       └── Devolução
  │
  ├── Registros
  │
  └── Relatórios
```

### Exemplo de empréstimo

```text
Selecionar livro
      ↓
Buscar aluno
      ↓
Selecionar aluno
      ↓
Definir data de retirada
      ↓
Definir previsão de devolução
      ↓
Registrar empréstimo
      ↓
Atualizar disponibilidade
```

---

## 📌 Próximos passos

O projeto continua em desenvolvimento.

Entre as melhorias planejadas estão:

* [ ] Padronização completa da interface
* [ ] Layout reutilizável entre as páginas
* [ ] Aprimoramento do modo claro/escuro
* [ ] Controle de permissões por perfil
* [ ] Melhorias no sistema de relatórios
* [ ] Dashboard com indicadores
* [ ] Melhorias no controle de empréstimos
* [ ] Melhorias no controle de devoluções
* [ ] Validações adicionais
* [ ] Aprimoramentos de segurança
* [ ] Organização da estrutura do projeto
* [ ] Documentação completa do banco de dados

---

## 🧠 Desenvolvimento

Este projeto está sendo desenvolvido como um projeto de estudo e portfólio na área de desenvolvimento de sistemas.

A proposta é aplicar conhecimentos de:

* Desenvolvimento Web
* Programação PHP
* Banco de Dados
* SQL
* JavaScript
* HTML/CSS
* Segurança e autenticação
* Modelagem de sistemas
* Interface e experiência do usuário

---

## 📄 Licença

Este projeto está em desenvolvimento.

A licença e as condições de utilização serão definidas posteriormente.

---

## 👨‍💻 Autor

**Vinicius**

Projeto desenvolvido para fins acadêmicos, de aprendizado e portfólio.

---

⭐ Se você estiver acompanhando o desenvolvimento deste projeto, fique à vontade para acompanhar sua evolução através dos commits e futuras versões.
