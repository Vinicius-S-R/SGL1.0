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
                    <h1 class="text-xl font-bold">Cadastro de Alunos</h1>
        </div>
                
 <form id="cadastroForm" action="inseriraluno.php" method="POST">
            <!-- Seção 1: Dados Gerais -->
            <div class="form-section bg-white border border-gray-200">
                <div class="form-header bg-blue-600 text-white">
                    <h2 class="text-base font-semibold">Dados Gerais</h2> 
                </div><br>
				
                <div class="form-grid">
                    <table style="width:50%" align="center" >
						<tr > 
							
							
							<td> <label for="nome" class="block text-xs font-medium text-gray-700">Nome</label>		</td>
							<td> <input type="text" id="nome" name="nome" class="w-full border border-gray-300 rounded-md focus:outline-none">		</td>
						</tr>	
						<tr >	<td> <label for="serie" class="block text-xs font-medium text-gray-700">Serie</label>	</td> 
								<td> <select id="serie" name="serie" class="w-full border border-gray-300 rounded-md focus:outline-none">		
									<option value="">Selecione</option>		
									<option value="1ª ">1ª </option>		
									<option value="2ª ">2ª </option>		
									<option value="3ª ">3ª </option>		
									<option value="4ª ">4ª </option>		
									<option value="5ª ">5ª</option>		
								</select>	
								
							</td>										
						</tr >	
															
						<tr >	<td> <label for="turma" class="block text-xs font-medium text-gray-700">Turma</label>	</td>
							<td> <input type="text" id="turma" name="turma" class="w-full border border-gray-300 rounded-md focus:outline-none"> </td>
						</tr >			
						<tr >		<td> <label for="data_cadastro" class="block text-xs font-medium text-gray-700">Data de Cadastro</label> </td>
				
								<td> <input type="date" id="data_cadastro" name="data_cadastro" class="w-full border border-gray-300 rounded-md focus:outline-none" onchange="calcularIdade()">		</td>
							</tr>	                    		
						</tr >				
							
            <tr ><div class="flex justify-center mt-3 space-x-4">
			<td></td>
			<td></td>
				<td>   <button type="submit" class="px-4 py-1 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm">
						Salvar
						</button> 
				</td>
             <td>   <button type="reset" class="px-4 py-1 bg-gray-300 text-gray-700 font-semibold rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all text-sm">
                    Limpar
             </td>   </button>
           </tr > </div>
        </form>
    </div>

   </html>