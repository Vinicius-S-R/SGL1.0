<?php
// buscar_livros.php - VERSÃO COM DEBUG
require 'conexao.php';

header('Content-Type: application/json');

// Habilitar exibição de erros para debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log para debug
file_put_contents('debug.log', "[" . date('Y-m-d H:i:s') . "] buscar_livros.php chamado\n", FILE_APPEND);

try {
    if (isset($_POST['termo']) && strlen($_POST['termo']) >= 3) {
        $termo = $_POST['termo'];
        
        file_put_contents('debug.log', "[" . date('Y-m-d H:i:s') . "] Buscando livros com termo: $termo\n", FILE_APPEND);
        
        $sql = "SELECT codigo, titulo, autor, editora FROM livros 
                WHERE titulo LIKE ? OR autor LIKE ? OR codigo LIKE ?
                LIMIT 10";
        
        $stmt = $conn->prepare($sql);
        $like_termo = "%$termo%";
        $stmt->bind_param("sss", $like_termo, $like_termo, $like_termo);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $livros = $result->fetch_all(MYSQLI_ASSOC);
        
        file_put_contents('debug.log', "[" . date('Y-m-d H:i:s') . "] Encontrados " . count($livros) . " livros\n", FILE_APPEND);
        
        echo json_encode($livros);
    } else {
        file_put_contents('debug.log', "[" . date('Y-m-d H:i:s') . "] Termo muito curto ou não definido\n", FILE_APPEND);
        echo json_encode([]);
    }
} catch (Exception $e) {
    file_put_contents('debug.log', "[" . date('Y-m-d H:i:s') . "] ERRO: " . $e->getMessage() . "\n", FILE_APPEND);
    echo json_encode(['error' => $e->getMessage()]);
}
?>