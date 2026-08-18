<?php
require 'conexao.php'; // Usa o arquivo conexao.php

if (isset($_GET['acao']) && $_GET['acao'] == 'buscar_alunos' && isset($_GET['termo'])) {
    $termo = $_GET['termo'] . '%';
    
    $sql = "SELECT id, nome, serie, turma 
            FROM alunos 
            WHERE nome LIKE :termo OR id LIKE :termo
            LIMIT 10";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':termo', $termo);
    $stmt->execute();
    
    $alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($alunos);
    exit;
}
?>