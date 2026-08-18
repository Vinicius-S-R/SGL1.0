<?php
require 'conexao.php';

header('Content-Type: application/json');

// Buscar livros
if (isset($_GET['acao']) && $_GET['acao'] == 'buscar_livros' && isset($_GET['termo'])) {
    $termo = '%' . $_GET['termo'] . '%';
    
    try {
        $sql = "SELECT codigo, titulo, autor, editora, disponivel
                FROM livros 
                WHERE (titulo LIKE ? OR autor LIKE ? OR codigo LIKE ?)
                AND disponivel = 'Disponivel'
                LIMIT 10";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$termo, $termo, $termo]);
        
        $livros = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($livros);
        
    } catch(PDOException $e) {
        echo json_encode(['error' => 'Erro na busca de livros: ' . $e->getMessage()]);
    }
    exit;
}

// Buscar alunos
if (isset($_GET['acao']) && $_GET['acao'] == 'buscar_alunos' && isset($_GET['termo'])) {
    $termo = '%' . $_GET['termo'] . '%';
    
    try {
        $sql = "SELECT id, nome, serie, turma 
                FROM alunos 
                WHERE nome LIKE ? OR id LIKE ?
                LIMIT 10";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$termo, $termo]);
        
        $alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($alunos);
        
    } catch(PDOException $e) {
        echo json_encode(['error' => 'Erro na busca de alunos: ' . $e->getMessage()]);
    }
    exit;
}

echo json_encode([]);
?>