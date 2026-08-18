<?php
require 'conexao.php';

// Verificar se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coletar os dados básicos do formulário
    $turma = $_POST['turma'] ?? '';
    $nome = $_POST['nome'] ?? '';
    $serie = $_POST['serie'] ?? '';
    $data_cadastro = $_POST['data_cadastro'] ?? '';
   
    // Preparar a query SQL com prepared statements
    $sql = "INSERT INTO alunos (
        /* Dados básicos */
        turma, nome, serie, data_cadastro
    ) VALUES (
        /* Dados básicos */
        :turma, :nome, :serie, :data_cadastro
    )";

    try {
        $stmt = $pdo->prepare($sql);
        
        // Bind dos parâmetros básicos
        $stmt->bindParam(':turma', $turma);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':serie', $serie);
        $stmt->bindParam(':data_cadastro', $data_cadastro);
        
        
        // Executar a query
        $stmt->execute();
        
        echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href = 'listaraluno.php';</script>";
    } catch (PDOException $e) {
        die("Erro ao cadastrar: " . $e->getMessage());
    }
} else {
    // Se não for POST, redirecionar para o formulário
    header("Location: cadastronav.php");
    exit;
}
?>