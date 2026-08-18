<?php
require 'conexao.php';
require 'user.php';

// Configurações de paginação
$registrosPorPagina = 10;
$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($paginaAtual - 1) * $registrosPorPagina;

// Filtro de aluno
$statusFiltro = $_GET['aluno'] ?? null;

// Construir a consulta base
$sqlBase = "SELECT * FROM movimentacao WHERE data_devolucao = '0000-00-00' ";
$sqlCount = "SELECT COUNT(*) AS total FROM movimentacao WHERE data_devolucao = '0000-00-00'";
$emprestimos= $sqlCount;
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

$emprestimos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Mensagem de sucesso
$sucesso = $_GET['sucesso'] ?? null;
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
       
        
        .sidebar-item {
            transition: background-color 0.2s;
        }
        
        .sidebar-item:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }
        
        /* Barra de rolagem personalizada */
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
                        <p <h2><?= htmlspecialchars($usuario_nome) ?></h2></p>
                    </div>
                </div>
            </div>
            
            <!-- Navegação -->
            <nav class="mb-4">
                <a href="menu.html" class="flex items-center p-3 text-xl sidebar-item rounded-full mx-2 mb-1">
                    <i class="fas fa-home mr-4"></i>
                    <span>Início</span>
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
                <a href="logout.php" >
				    <button class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Sair</span>
				</a>
                </button>
            </nav>
            
            
        </div>
        
        <!-- Conteúdo Principal -->
        <div class="flex-1 min-w-0">
            <!-- Cabeçalho -->
            <header class="sticky top-0 bg-cream/80 backdrop-blur-md z-10 border-b border-gray-300 bg-opacity-90" style="background-color: rgba(245, 240, 229, 0.9);">
                <div class="p-4">
                    <h1 class="text-xl font-bold">Lista de Empréstimos</h1>
                </div>
                
 <form id="cadastroForm"  >
            <!-- Seção 1: Dados Gerais -->
            <div class="form-section bg-white border border-gray-200">
                <div class="form-header bg-blue-600 text-white">
                    <h2 class="text-base font-semibold">Lista Geral</h2> 
                </div><br>
				
                <div class="form-grid">
                      <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-gray-200 text-gray-700" align="left">
                        
                        <th class="py-2 px-4">Livro</th>
                        <th class="py-2 px-4">Aluno</th>
                        <th class="py-2 px-4">Data do Empréstimo</th>
                        <th class="py-2 px-4">Data de Devolução Prevista</th>
						
						
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($emprestimos) > 0): ?>
                        <?php foreach ($emprestimos as $emprestimos): ?>
                            <tr class="border-t hover:bg-gray-50">
                               
                                <td class="py-2 px-4"><?= htmlspecialchars($emprestimos['titulo']) ?></td>
                                <td class="py-2 px-4"><?= htmlspecialchars($emprestimos['aluno']) ?></td>
                                <td class="py-2 px-4"><?= htmlspecialchars($emprestimos['data_retirada']) ?></td>
                                <td class="py-2 px-4"><?= htmlspecialchars($emprestimos['data_prevista']) ?></td> 
						    <td class="py-2 px-4"><a href="devolucaolivro.php?id=<?= $emprestimos['id'] ?>" onclick="return confirm('Tem certeza que deseja registrar a devolução?')" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition-colors">Devolução </a>
                           </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="py-4 text-center text-gray-500">Nenhum Empréstimo encontrado</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
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

   </html>