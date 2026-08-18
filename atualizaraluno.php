<?php
require 'conexao.php';

// Verificar se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    // Coletar os dados básicos do formulário
    $turma = $_POST['turma'] ?? '';
    $nome = $_POST['nome'] ?? '';
    $serie = $_POST['serie'] ?? '';
    $data_cadastro = $_POST['data_cadastro'] ?? '';
	$id= $_POST['id'] ??'';
	
// Query SQL
$sql = "UPDATE alunos SET nome = :nome, serie = :serie, turma = :turma, data_cadastro = :data_cadastro WHERE id = :id";

// Preparar statement
$stmt = $pdo->prepare($sql);

// Vincular parâmetros
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':serie', $serie);
$stmt->bindParam(':turma', $turma);
$stmt->bindParam(':data_cadastro', $data_cadastro);
$stmt->bindParam(':id', $id);

// Executar
if ($stmt->execute()) {
    echo "<script>alert('Cadastro atualizado com sucesso!'); window.location.href = 'listaraluno.php';</script>";
	
} else {
    echo "Erro ao atualizar dados";
}
}
?>