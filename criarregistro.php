<?php
require 'conexao.php';

// Verificar se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coletar os dados básicos do formulário
    
    
	$codigo = $_POST['codigo'] ?? '';
    $titulo = $_POST['titulo'] ?? '';
    $autor = $_POST['autor'] ?? '';
    $serie = $_POST['serie'] ?? '';
    $turma = $_POST['turma'] ?? '';
	$nome = $_POST['nome'] ?? '';
    $editora = $_POST['editora'] ?? '';
    $data_codigo = $_POST['data_codigo'] ?? '';
    $status = 'Retirado';
	$data_retirada = $_POST['data_retirada'] ?? '';
    $data_prevista = $_POST['data_prevista'] ?? null;
    $data_devolucao ="0";

    // Preparar a query SQL com prepared statements

    $sql = "INSERT INTO movimentacao (
        /* Dados básicos */
        codigo_livro, aluno, titulo, autor, serie, data_retirada, 
        turma, editora, status, data_prevista, data_devolucao 
       
    ) VALUES (
        /* Dados básicos */
        :codigo, :nome, :titulo, :autor, :serie, :data_retirada, 
        :turma, :editora,  :status, :data_prevista, :data_devolucao
    )";

    try {
        $stmt = $pdo->prepare($sql);
        
        // Bind dos parâmetros básicos
        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':serie', $serie);
        $stmt->bindParam(':data_retirada', $data_retirada);
        $stmt->bindParam(':turma', $turma);
        $stmt->bindParam(':editora', $editora);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':data_prevista', $data_prevista);
		$stmt->bindParam(':data_devolucao', $data_devolucao);
                
    
	
		if ($stmt->execute()) {
			echo "<script>alert('Emprestimo realizado com sucesso!'); window.location.href = 'registro.php';</script>";
		}
		
	
    } catch (PDOException $e) {
        die("Erro ao cadastrar: " . $e->getMessage());
    }
} else {
    // Se não for POST, redirecionar para o formulário
    header("Location: retirada.php");
    exit;
}
?>