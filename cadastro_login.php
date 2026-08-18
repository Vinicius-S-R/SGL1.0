<?php
session_start();
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $confirmar_senha = $_POST['confirmar_senha'] ?? '';
    
    // Validações
    if (empty($nome) || empty($usuario) || empty($senha)) {
        $erro = "Todos os campos são obrigatórios!";
    } elseif ($senha !== $confirmar_senha) {
        $erro = "As senhas não coincidem!";
    } else {
        // Verificar se usuario já existe
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE usuario = ?");
        $stmt->execute([$usuario]);
        
        if ($stmt->fetch()) {
            $erro = "Este e-mail já está cadastrado!";
        } else {
            // Cadastrar novo usuário
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO usuarios (nome, usuario, senha) VALUES (?, ?, ?)");
            
            if ($stmt->execute([$nome, $usuario, $senha_hash])) {
                $_SESSION['mensagem'] = "Cadastro realizado com sucesso! Faça login.";
                header('Location: login.php');
                exit;
            } else {
                $erro = "Erro ao cadastrar usuário. Tente novamente.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Login </title>

</head>
    <style>
        /* Corpo da página com fundo azul indigo sólido */
        body {
            background: #1f4362; /* Cor azul indigo sólida */
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; /* Fonte moderna */
        }
        /* Container principal do formulário de login */
        .login-container {
            backdrop-filter: blur(10px); /* Efeito de desfoque no fundo */
            background: rgba(255, 255, 255, 0.95); /* Fundo branco semi-transparente */
        }
        /* Efeito visual quando o campo de entrada está em foco */
        .input-field:focus {
            transform: translateY(-1px); /* Move o campo ligeiramente para cima */
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); /* Adiciona sombra suave */
        }
        /* Efeito visual quando o mouse passa sobre o botão de login */
        .login-btn:hover {
            transform: translateY(-2px); /* Eleva o botão quando hover */
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4); /* Sombra azul no hover */
        }
    </style>
<body align="center">
<div class="login-container">
        <div class="login-card">
            <div class="p-8">
    <div class="container">
        <h1>Cadastro de Login</h1>
        <?php if (isset($erro)): ?>
            <div class="erro"><?= $erro ?></div>
        <?php endif; ?>

		<table style="width:30%" align="center">
        <form method="POST">
           <tr> <div class="input-group">
              <td>  <label for="nome">Nome:</label> </td>
              <td>  <input type="text" id="nome" name="nome" required></td>
            </div>
			</tr>
		   <div class="input-group">
            <tr> <td>     <label for="usuario">Usuário:</label> </td>
             <td>   <input type="usuario" id="usuario" name="usuario" required>  </td>
            </div>
            </tr> <div class="input-group">
          <tr>   <td>   <label for="senha">Senha:</label> </td>
               <td> <input type="password" id="senha" name="senha" required>  </td>
            </div>
           </tr> 
		   <tr> <div class="input-group">
              <td>   <label for="confirmar_senha"> Confirmar Senha:</label> </td>
                <td> <input type="password" id="confirmar_senha" name="confirmar_senha" required> </td>
            </tr> </div>
             
        <tr> </tr>
		<tr> <tr> </tr>
		<tr> <td></td><td><button type="submit" class="login-btn">Cadastrar</button></td>
		<td><button type="cancel" class="cancel-btn">Limpar</button></td>
		</tr>
		
		<tr> <td></td><td></td><td></tr>
		<tr> <td></td><td></td><td><p>Já tem uma conta? <a href="login.php"> <button type="submit" class="login.php">Faça login</button></a></p></tr>
        
   
   </form>
	</div>
	 </div>
	  </div>
	   </div>
</body>
</html>