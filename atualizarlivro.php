<?php
require 'conexao.php';

// Verificar se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    // Coletar os dados básicos do formulário
    $codigo = $_POST['codigo'] ?? '';
    $titulo = $_POST['titulo'] ?? '';
    $autor = $_POST['autor'] ?? '';
	$editora = $_POST['editora'] ?? '';
    $data_cadastro = $_POST['data_cadastro'] ?? '';
	$id= $_POST['id'] ??'';
	
// Query SQL
$sql = "UPDATE livros SET titulo = :titulo, autor = :autor, editora = :editora, codigo = :codigo, data_cadastro = :data_cadastro WHERE id = :id";

// Preparar statement
$stmt = $pdo->prepare($sql);

// Vincular parâmetros
$stmt->bindParam(':titulo', $titulo);
$stmt->bindParam(':autor', $autor);
$stmt->bindParam(':editora', $editora);
$stmt->bindParam(':codigo', $codigo);
$stmt->bindParam(':data_cadastro', $data_cadastro);
$stmt->bindParam(':id', $id);

// Executar
if ($stmt->execute()) {
    echo "<script>alert('Livro atualizado com sucesso!'); window.location.href = 'listarlivro.php';</script>";
	
} else {
    echo "Erro ao atualizar dados";
}
}
?>