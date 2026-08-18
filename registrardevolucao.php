<?php
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $data_devolucao = $_POST['data_devolucao'] ?? null;

    if (!$id || !$data_devolucao) {
        header("Location: registros.php?erro=Dados incompletos");
        exit;
    }

    // Atualizar a tabela movimentacao
    $sql = "UPDATE movimentacao SET data_devolucao = :data_devolucao WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':data_devolucao', $data_devolucao);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header("Location: registro.php?sucesso=Devolução registrada com sucesso");
        exit;
    } else {
        echo "Erro ao registrar devolução";
    }
}
?>
