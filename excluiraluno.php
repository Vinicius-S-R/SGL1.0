<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

$post_id = $_GET['id'] ?? 0;
$usuario_id = $_SESSION['usuario_id'];
$usuario_perfil = $_SESSION['usuario_perfil'];
/*
// Verificar se usuário tem permissão para excluir
$stmt = $pdo->prepare("SELECT usuario_id FROM posts WHERE id = ?");
$stmt->execute([$post_id]);
$post = $stmt->fetch();

if (!$post || ($post['usuario_id'] != $usuario_id && $usuario_perfil != 'admin')) {
    $_SESSION['erro'] = "Você não tem permissão para excluir este post.";
    header('Location: cadastroexcluir.php');
    exit;
}
*/
// Excluir Cadastro
$stmt = $pdo->prepare("DELETE FROM alunos WHERE id = ?");
if ($stmt->execute([$post_id])) {
    $_SESSION['mensagem'] = "Cadastro excluído com sucesso!";
} else {
    $_SESSION['erro'] = "Erro ao excluir Cadastro. Tente novamente.";
}

header('Location: listaraluno.php');
exit;