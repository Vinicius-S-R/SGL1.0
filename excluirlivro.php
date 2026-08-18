<?php
session_start(); // ESSENCIAL para acessar $_SESSION
require 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

$post_id = $_GET['id'] ?? 0;

// restante do código continua igual
$usuario_id = $_SESSION['usuario_id'];
$usuario_perfil = $_SESSION['usuario_perfil'];

/* Verificação de permissão comentada
...
*/

// Excluir Cadastro
$stmt = $pdo->prepare("DELETE FROM livros WHERE id = ?");
if ($stmt->execute([$post_id])) {
    $_SESSION['mensagem'] = "Livro excluído com sucesso!";
} else {
    $_SESSION['erro'] = "Erro ao excluir Cadastro. Tente novamente.";
}

header('Location: listarlivro.php');
exit;
