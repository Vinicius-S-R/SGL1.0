<?php
require 'conexao.php';

// Verificar se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coletar os dados básicos do formulário
    $codigo = $_POST['codigo'] ?? '';
    $titulo = $_POST['titulo'] ?? '';
    $autor = $_POST['autor'] ?? '';
	$editora = $_POST['editora'] ?? '';
    $data_cadastro = $_POST['data_cadastro'] ?? '';
	$disp = $_POST['disp'] ?? '';
   
    // Preparar a query SQL com prepared statements
    $sql = "INSERT INTO livros (
        /* Dados básicos */
        codigo, titulo, autor,editora, data_cadastro, disponivel
    ) VALUES (
        /* Dados básicos */
        :codigo, :titulo, :autor,:editora, :data_cadastro, :disp 
    )";

    try {
        $stmt = $pdo->prepare($sql);
        
        // Bind dos parâmetros básicos
        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':autor', $autor);
		$stmt->bindParam(':editora', $editora);
        $stmt->bindParam(':data_cadastro', $data_cadastro);
		  $stmt->bindParam(':disp', $disp);
        
        
        // Executar a query
        $stmt->execute();
        
        echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href = 'listarlivro.php';</script>";
    } catch (PDOException $e) {
        die("Erro ao cadastrar: " . $e->getMessage());
    }
} else {
    // Se não for POST, redirecionar para o formulário
    header("Location: cadastronav.php");
    exit;
}
?>