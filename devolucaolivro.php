<?php
require 'user.php';
require 'conexao.php';

// Verificar se foi passado um ID válido
$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) {
    header("Location: devolucaolivro.php?erro=ID inválido");
    exit;
}

// Carregar os dados do cadastro
$stmt = $pdo->prepare("SELECT * FROM movimentacao WHERE id = ?");
$stmt->execute([$id]);
$emprestimo = $stmt->fetch();

if (!$emprestimo) {
    header("Location: devolucaolivro.php?erro=Cadastro não encontrado");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Devolução</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar-item { transition: background-color 0.2s; }
        .sidebar-item:hover { background-color: rgba(0,0,0,0.05); }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f5f0e5; }
        ::-webkit-scrollbar-thumb { background: #d6cdb7; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #c2b89f; }
    </style>
</head>
<body>
<div class="min-h-screen flex">
    <!-- Barra Lateral -->
    <div class="w-64 border-r border-gray-300 flex flex-col h-screen sticky top-0">
        <div class="p-4 flex items-center">
            <div class="w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center overflow-hidden">
                <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-3">
                <h2><?= htmlspecialchars($usuario_nome) ?></h2>
            </div>
        </div>
        <nav class="mb-4">
            <a href="menu.html" class="flex items-center p-3 text-xl sidebar-item rounded-full mx-2 mb-1">
                <i class="fas fa-home mr-4"></i>Início
            </a>
            <a href="livro.php" class="flex items-center p-3 text-xl sidebar-item rounded-full mx-2 mb-1">Livros</a>
            <a href="usuarios.php" class="flex items-center p-3 text-xl sidebar-item rounded-full mx-2 mb-1">Usuários</a>
            <a href="relatorios.php" class="flex items-center p-3 text-xl sidebar-item rounded-full mx-2 mb-1">Relatórios</a>
            <a href="logout.php" class="flex items-center p-3 text-xl sidebar-item rounded-full mx-2 mb-1">
                <i class="fas fa-sign-out-alt mr-4"></i>Sair
            </a>
        </nav>
    </div>

    <!-- Conteúdo Principal -->
    <div class="flex-1 min-w-0">
        <header class="sticky top-0 bg-cream/80 backdrop-blur-md z-10 border-b border-gray-300 bg-opacity-90 p-4">
            <h1 class="text-xl font-bold">Registrar Devolução</h1>
        </header>

        <form id="cadastroForm" action="registrardevolucao.php" method="POST" class="p-4">
            <div class="form-section bg-white border border-gray-200 p-4">
                <div class="form-header bg-blue-600 text-white p-2 rounded">
                    <h2 class="text-base font-semibold">Dados Gerais</h2>
                </div>
                <br>
                <table style="width:50%" align="center">
                    <tr>
                        <td><label for="nome" class="block text-xs font-medium text-gray-700">Livro</label></td>
                        <td><input type="text" id="nome" name="nome" value="<?= htmlspecialchars($emprestimo['titulo']) ?>" class="w-full border border-gray-300 rounded-md focus:outline-none" readonly></td>
                    </tr>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($emprestimo['id']) ?>">
                    <tr>
                        <td><label for="serie" class="block text-xs font-medium text-gray-700">Aluno</label></td>
                        <td><input type="text" id="serie" name="serie" value="<?= htmlspecialchars($emprestimo['aluno']) ?>" class="w-full border border-gray-300 rounded-md focus:outline-none" readonly></td>
                    </tr>
                    <tr>
                        <td><label for="turma" class="block text-xs font-medium text-gray-700">Turma</label></td>
                        <td><input type="text" id="turma" name="turma" value="<?= htmlspecialchars($emprestimo['turma']) ?>" class="w-full border border-gray-300 rounded-md focus:outline-none" readonly></td>
                    </tr>
                    <tr>
                        <td><label for="data_retirada" class="block text-xs font-medium text-gray-700">Data de Retirada</label></td>
                        <td>
                            <input type="date" id="data_retirada" name="data_retirada" value="<?= date('Y-m-d', strtotime($emprestimo['data_retirada'])) ?>" class="w-full border border-gray-300 rounded-md focus:outline-none" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="data_devolucao" class="block text-xs font-medium text-gray-700">Data de Devolução</label></td>
                        <td>
                            <input type="date" id="data_devolucao" name="data_devolucao" class="w-full border border-gray-300 rounded-md focus:outline-none" required>
                        </td>
                    </tr>
                </table>
                <div class="flex justify-center mt-3 space-x-4">
                    <button type="submit" class="px-4 py-1 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm">Salvar</button>
                    <button type="reset" class="px-4 py-1 bg-gray-300 text-gray-700 font-semibold rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all text-sm">Limpar</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>
