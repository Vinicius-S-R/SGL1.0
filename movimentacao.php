<?php
require 'user.php';

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
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
<body >
    <div class="min-h-screen flex">
        <!-- Barra Lateral Esquerda -->
        <div class="w-64 border-r border-gray-300 flex flex-col h-screen sticky top-0">
            <!-- Perfil do Usuário -->
            <div class="p-4" >
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
                <div class="p-4" >
                    <h1 class="text-xl font-bold">Movimentações</h1>
        </div>
<table style="width:40%">				 <div class="max-w-4xl mx-auto">
				<div class="grid grid-cols-1 md:grid-cols-2 gap-2" >
                <!-- Retirada -->
			<tr>	<a href="retirada.php" >      <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer group">
                    <div class="p-8 text-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition-colors">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Retirada</h3>
                        <p class="text-gray-600 text-sm">Controle de saídas</p>
				
                    </div>
				</a>	
                </div>
</tr>
                <!-- Devolução -->
              <a href="listardevolucao.php" >   <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer group">
                    <div class="p-8 text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-green-200 transition-colors">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Devoluções</h3>
                        <p class="text-gray-600 text-sm">Controle de Devoluções</p></a>
                    </div>
					
                </div>
</table>				
</html>
    				
