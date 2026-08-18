<?php
require 'conexao.php';
require 'user.php';

// Configurações de paginação
$registrosPorPagina = 10;
$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($paginaAtual - 1) * $registrosPorPagina;

// Filtro de serie
$statusFiltro = $_GET['serie'] ?? null;

// Construir a consulta base
$sqlBase = "SELECT * FROM livros";
$sqlCount = "SELECT COUNT(*) AS total FROM livros";
$params = [];
$paramsCount = [];

// Ordenação
$sqlBase .= " ORDER BY titulo LIMIT ? OFFSET ?";
$params[] = $registrosPorPagina;
$params[] = $offset;

// Consulta para contar o total de registros
$stmtCount = $pdo->prepare($sqlCount);
$stmtCount->execute($paramsCount);
$totalRegistros = $stmtCount->fetchColumn();
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);

// Consulta principal com paginação
$stmt = $pdo->prepare($sqlBase);
$stmt->execute($params);
$livros = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Mensagem de sucesso
$sucesso = $_GET['sucesso'] ?? null;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de livros</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar-item {
            transition: background-color 0.2s;
        }
        .sidebar-item:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f5f0e5;
        }
        ::-webkit-scrollbar-thumb {
            background: #d6cdb7;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #c2b89f;
        }
    </style>
</head>
<body>
    <div class="min-h-screen flex">
        <!-- Barra Lateral Esquerda -->
        <div class="w-64 border-r border-gray-300 flex flex-col h-screen sticky top-0">
            <!-- Perfil do Usuário -->
            <div class="p-4">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center overflow-hidden">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h2><?= htmlspecialchars($usuario_nome) ?></h2>
                    </div>
                </div>
            </div>
            
            <!-- Navegação -->
            <nav class="mb-4">
                <a href="menu.html" class="flex items-center p-3 text-xl sidebar-item rounded-full mx-2 mb-1">
                    <i class="fas fa-home mr-4"></i><span>Início</span>
                </a>
                <a href="livro.php" class="flex items-center p-3 text-xl sidebar-item rounded-full mx-2 mb-1">
                    <span>Livros</span>
                </a>
                <a href="usuarios.php" class="flex items-center p-3 text-xl sidebar-item rounded-full mx-2 mb-1">
                    <span>Usuários</span>
                </a>
                <a href="relatorios.php" class="flex items-center p-3 text-xl sidebar-item rounded-full mx-2 mb-1">
                    <span>Relatórios</span>
                </a>
                <a href="logout.php">
                    <button class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i><span>Sair</span>
                    </button>
                </a>
            </nav>
        </div>
        
        <!-- Conteúdo Principal -->
        <div class="flex-1 min-w-0">
            <!-- Cabeçalho -->
            <header class="sticky top-0 bg-cream/80 backdrop-blur-md z-10 border-b border-gray-300 bg-opacity-90" style="background-color: rgba(245, 240, 229, 0.9);">
                <div class="p-4">
                    <h1 class="text-xl font-bold">Cadastro de livros</h1>
                </div>
            </header>
            
            <div class="p-4">
                <div class="form-section bg-white border border-gray-200">
                    <div class="form-header bg-blue-600 text-white">
                        <h2 class="text-base font-semibold">Lista Geral</h2> 
                    </div><br>
                    
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700" align="left">
                                <th class="py-2 px-4">Código</th>
                                <th class="py-2 px-4">Título</th>
                                <th class="py-2 px-4">Autor</th>
                                <th class="py-2 px-4">Data de Cadastro</th>
                                <th class="py-2 px-4">Disponível</th>
                                <th class="py-2 px-4">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($livros) > 0): ?>
                                <?php foreach ($livros as $livro): ?>
                                    <tr class="border-t hover:bg-gray-50">
                                        <td class="py-2 px-4"><?= htmlspecialchars($livro['codigo']) ?></td>
                                        <td class="py-2 px-4"><?= htmlspecialchars($livro['titulo']) ?></td>
                                        <td class="py-2 px-4"><?= htmlspecialchars($livro['autor']) ?></td>
                                        <td class="py-2 px-4"><?= htmlspecialchars($livro['data_cadastro']) ?></td>
                                        <td class="py-2 px-4"><?= htmlspecialchars($livro['disponivel'] ?? '-') ?></td>
                                        <td class="py-2 px-4 flex flex-col space-y-2">
                                            <a href="editarlivro.php?id=<?= $livro['id'] ?>" class="px-4 py-1 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 text-center transition-colors">
                                                Editar
                                            </a>
                                            <a href="excluirlivro.php?id=<?= $livro['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este cadastro?')" class="px-4 py-1 bg-red-600 text-white font-semibold rounded-md hover:bg-red-700 text-center transition-colors">
                                                Excluir
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="py-4 text-center text-gray-500">Nenhum livro encontrado</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    
                    <?php if ($totalPaginas > 1): ?>
                        <div class="mt-6 flex justify-center">
                            <nav class="inline-flex rounded-md shadow">
                                <?php if ($paginaAtual > 1): ?>
                                    <a href="?pagina=1&status=<?= $statusFiltro ?>" class="px-3 py-1 rounded-l-md border border-gray-300 bg-white text-gray-500 hover:bg-gray-50">
                                        Primeira
                                    </a>
                                    <a href="?pagina=<?= $paginaAtual - 1 ?>&status=<?= $statusFiltro ?>" class="px-3 py-1 border-t border-b border-gray-300 bg-white text-gray-500 hover:bg-gray-50">
                                        Anterior
                                    </a>
                                <?php endif; ?>
                                
                                <?php for ($i = max(1, $paginaAtual - 2); $i <= min($totalPaginas, $paginaAtual + 2); $i++): ?>
                                    <a href="?pagina=<?= $i ?>&status=<?= $statusFiltro ?>" class="px-3 py-1 border-t border-b border-gray-300 <?= $i == $paginaAtual ? 'bg-blue-50 text-blue-600 border-blue-500' : 'bg-white text-gray-500 hover:bg-gray-50' ?>">
                                        <?= $i ?>
                                    </a>
                                <?php endfor; ?>
                                
                                <?php if ($paginaAtual < $totalPaginas): ?>
                                    <a href="?pagina=<?= $paginaAtual + 1 ?>&status=<?= $statusFiltro ?>" class="px-3 py-1 border-t border-b border-gray-300 bg-white text-gray-500 hover:bg-gray-50">
                                        Próxima
                                    </a>
                                    <a href="?pagina=<?= $totalPaginas ?>&status=<?= $statusFiltro ?>" class="px-3 py-1 rounded-r-md border border-gray-300 bg-white text-gray-500 hover:bg-gray-50">
                                        Última
                                    </a>
                                <?php endif; ?>
                            </nav>
                        </div>
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>
