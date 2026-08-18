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
    } else { echo"entrou na buscar no bd ";
        // Verificar se usuario já existe
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE usuario = ?");
        $stmt->execute([$usuario]);
       
        if ($stmt->fetch()) {
            $erro = "Este Usuário já está cadastrado!";
        } else {
            // Cadastrar novo usuário
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO usuarios (nome, usuario, senha) VALUES (?, ?, ?)");
            
            if ($stmt->execute([$nome, $usuario, $senha_hash])) {
                $_SESSION['mensagem'] = "Cadastro realizado com sucesso! Faça login.";
                header('Location: login.php');
                exit;
            } else {
				$_SESSION['mensagem'] = "Falha no cadastro, Tente Novamente.";
               header('Location: cadastro_login.php');
			   // $erro = "Erro ao cadastrar usuário. Tente novamente.";
			   
            }
        }
    }
}
?>