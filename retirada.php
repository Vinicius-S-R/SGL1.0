<?php
require 'user.php';

require 'conexao.php'; 
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
        
        .autocomplete-items {
            position: absolute;
            border: 1px solid #d1d5db;
            border-top: none;
            z-index: 99;
            top: 100%;
            left: 0;
            right: 0;
            background-color: white;
            max-height: 200px;
            overflow-y: auto;
        }
        
        .autocomplete-item {
            padding: 10px;
            cursor: pointer;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .autocomplete-item:hover {
            background-color: #f3f4f6;
        }
        
        .autocomplete-active {
            background-color: #3b82f6 !important;
            color: white;
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
                        <p><h2><?= htmlspecialchars($usuario_nome) ?></h2></p>
                    </div>
                </div>
            </div>
            
            <!-- Navegação -->
            <nav class="mb-4">
                <a href="menu.html" class="flex items-center p-3 text-xl sidebar-item rounded-full mx-2 mb-1">
                    <i class="fas fa-home mr-4"></i>
                    <span>Início</span>
                </a>
                
                <a href="aluno.php" class="flex items-center p-3 text-xl sidebar-item rounded-full mx-2 mb-1">
                    <span>Alunos</span>
                </a>
                <a href="usuarios.php" class="flex items-center p-3 text-xl sidebar-item rounded-full mx-2 mb-1">
                    <span>Usuários</span>
                </a>
                <a href="relatorios.php" class="flex items-center p-3 text-xl sidebar-item rounded-full mx-2 mb-1">
                    <span>Relatórios</span>
                </a>
                <a href="logout.php">
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
                    <h1 class="text-xl font-bold">Empréstimo de Livro</h1>
                </div>
            </header>

            <form id="cadastroForm" action="criarregistro.php" method="POST">
                <!-- Seção 1: Dados do Livro -->
                <div class="form-section bg-white border border-gray-200 p-4">
                    <div class="form-header bg-blue-600 text-white p-2 rounded-t">
                        <h2 class="text-base font-semibold">Dados do livro</h2>
                    </div>
                    <br>
                    
                    <div class="space-y-4">
                        <div class="flex space-x-2">
                            <div class="flex-1 relative">
                                <label for="busca_livro" class="block text-xs font-medium text-gray-700">Buscar Livro (digite pelo menos 3 caracteres)</label>
                                <input type="text" id="busca_livro" name="busca_livro" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" autocomplete="off">
                                <div id="autocomplete-livros" class="autocomplete-items hidden"></div>
                            </div>
                            <div class="flex items-end">
                                <button type="button" onclick="buscarLivros()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 h-10">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="codigo" class="block text-xs font-medium text-gray-700">Código</label>
                                <input type="text" id="codigo" name="codigo" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none" readonly>
                            </div>
                            
                            <div>
                                <label for="titulo" class="block text-xs font-medium text-gray-700">Título</label>
                                <input type="text" id="titulo" name="titulo" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none" readonly>
                            </div>
                            
                            <div>
                                <label for="autor" class="block text-xs font-medium text-gray-700">Autor</label>
                                <input type="text" id="autor" name="autor" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none" readonly>
                            </div>
                            
                            <div>
                                <label for="editora" class="block text-xs font-medium text-gray-700">Editora</label>
                                <input type="text" id="editora" name="editora" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none" readonly>
                            </div>
                        </div>
                        
                        <input type="hidden" id="disp" name="disp" value="Disponivel">
                    </div>
                </div>
                
                <!-- Seção 2: Dados do Aluno -->
                <div class="form-section bg-white border border-gray-200 p-4 mt-4">
                    <div class="form-header bg-green-600 text-white p-2 rounded-t">
                        <h2 class="text-base font-semibold">Dados do Aluno</h2>
                    </div>
                    <br>
                    
                    <div class="space-y-4">
                        <div class="flex space-x-2">
                            <div class="flex-1 relative">
                                <label for="busca_aluno" class="block text-xs font-medium text-gray-700">Buscar Aluno (digite pelo menos 3 caracteres)</label>
                                <input type="text" id="busca_aluno" name="busca_aluno" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-500" autocomplete="off">
                                <div id="autocomplete-alunos" class="autocomplete-items hidden"></div>
                            </div>
                            <div class="flex items-end">
                                <button type="button" onclick="buscarAlunos()" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 h-10">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="nome" class="block text-xs font-medium text-gray-700">Nome</label>
                                <input type="text" id="nome" name="nome" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none" readonly>
                            </div>
                            
                            <div>
                                <label for="serie" class="block text-xs font-medium text-gray-700">Série</label>
                                <input type="text"select id="serie" name="serie" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none" readonly>
                                 <input type="hidden"select id="status" name="status" value="Retirado">
                            </div>
                            
                            <div>
                                <label for="turma" class="block text-xs font-medium text-gray-700">Turma</label>
                                <input type="text" id="turma" name="turma" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Seção 3: Controle -->
                <div class="form-section bg-white border border-gray-200 p-4 mt-4">
                    <div class="form-header bg-amber-600 text-white p-2 rounded-t">
                        <h2 class="text-base font-semibold">Controle</h2>
                    </div>
                    <br>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="data_retirada" class="block text-xs font-medium text-gray-700">Data de Retirada</label>
                            <input type="date" id="data_retirada" name="data_retirada" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none">
                        </div>
                        
                        <div>
                            <label for="data_devolucao" class="block text-xs font-medium text-gray-700">Previsão de Devolução</label>
                            <input type="date" id="data_prevista" name="data_prevista" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none">
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-center mt-6 space-x-4">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
                        Salvar Empréstimo
                    </button>
                    <button type="reset" class="px-6 py-2 bg-gray-300 text-gray-700 font-semibold rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all" onclick="limparCampos()">
                        Limpar
                    </button>
                </div>
            </form>
        </div>
    </div>
<script>
// Função para buscar livros
async function buscarLivros() {
    const termo = document.getElementById('busca_livro').value.trim();
    
    if (termo.length < 3) {
        alert('Digite pelo menos 3 caracteres para buscar livros.');
        return;
    }
    
    try {
        const response = await fetch(`buscar.php?acao=buscar_livros&termo=${encodeURIComponent(termo)}`);
        
        if (!response.ok) {
            throw new Error('Erro na requisição');
        }
        
        const livros = await response.json();
        
        // Verifica se é um erro
        if (livros.error) {
            console.error('Erro:', livros.error);
            alert('Erro ao buscar livros: ' + livros.error);
            return;
        }
        
        const autocomplete = document.getElementById('autocomplete-livros');
        autocomplete.innerHTML = '';
        autocomplete.classList.remove('hidden');
        
        if (livros.length === 0) {
            const item = document.createElement('div');
            item.innerHTML = 'Nenhum livro encontrado';
            item.className = 'autocomplete-item';
            autocomplete.appendChild(item);
        } else {
            livros.forEach(livro => {
                const item = document.createElement('div');
                item.innerHTML = `<strong>${livro.titulo}</strong> - ${livro.autor} (${livro.codigo})`;
                item.className = 'autocomplete-item';
                item.addEventListener('click', () => {
                    preencherDadosLivro(livro);
                    autocomplete.classList.add('hidden');
                });
                autocomplete.appendChild(item);
            });
        }
    } catch (error) {
        console.error('Erro ao buscar livros:', error);
        alert('Erro ao conectar com o servidor. Verifique o console para mais detalhes.');
    }
}

// Função para buscar alunos
async function buscarAlunos() {
    const termo = document.getElementById('busca_aluno').value.trim();
    
    if (termo.length < 3) {
        alert('Digite pelo menos 3 caracteres para buscar alunos.');
        return;
    }
    
    try {
        const response = await fetch(`buscar.php?acao=buscar_alunos&termo=${encodeURIComponent(termo)}`);
        
        if (!response.ok) {
            throw new Error('Erro na requisição');
        }
        
        const alunos = await response.json();
        
        // Verifica se é um erro
        if (alunos.error) {
            console.error('Erro:', alunos.error);
            alert('Erro ao buscar alunos: ' + alunos.error);
            return;
        }
        
        const autocomplete = document.getElementById('autocomplete-alunos');
        autocomplete.innerHTML = '';
        autocomplete.classList.remove('hidden');
        
        if (alunos.length === 0) {
            const item = document.createElement('div');
            item.innerHTML = 'Nenhum aluno encontrado';
            item.className = 'autocomplete-item';
            autocomplete.appendChild(item);
        } else {
            alunos.forEach(aluno => {
                const item = document.createElement('div');
                item.innerHTML = `<strong>${aluno.nome}</strong> - ${aluno.serie}${aluno.turma}`;
                item.className = 'autocomplete-item';
                item.addEventListener('click', () => {
                    preencherDadosAluno(aluno);
                    autocomplete.classList.add('hidden');
                });
                autocomplete.appendChild(item);
            });
        }
    } catch (error) {
        console.error('Erro ao buscar alunos:', error);
        alert('Erro ao conectar com o servidor. Verifique o console para mais detalhes.');
    }
}

// Função para preencher dados do livro
function preencherDadosLivro(livro) {
    document.getElementById('codigo').value = livro.codigo || '';
    document.getElementById('titulo').value = livro.titulo || '';
    document.getElementById('autor').value = livro.autor || '';
    document.getElementById('editora').value = livro.editora || '';
    document.getElementById('busca_livro').value = livro.titulo || '';
}

// Função para preencher dados do aluno
function preencherDadosAluno(aluno) {
    document.getElementById('nome').value = aluno.nome || '';
    document.getElementById('serie').value = aluno.serie || '';
    document.getElementById('turma').value = aluno.turma || '';
    document.getElementById('busca_aluno').value = aluno.nome || '';
}

// Função para limpar campos
function limparCampos() {
    document.getElementById('cadastroForm').reset();
    document.getElementById('autocomplete-livros').classList.add('hidden');
    document.getElementById('autocomplete-alunos').classList.add('hidden');
    
    // Resetar datas
    const hoje = new Date().toISOString().split('T')[0];
    document.getElementById('data_retirada').value = hoje;
    
    const dataDevolucao = new Date();
    dataDevolucao.setDate(dataDevolucao.getDate() + 7);
    document.getElementById('data_devolucao').value = dataDevolucao.toISOString().split('T')[0];
}

// Event listeners para busca automática ao digitar
document.addEventListener('DOMContentLoaded', function() {
    const buscaLivro = document.getElementById('busca_livro');
    const buscaAluno = document.getElementById('busca_aluno');
    
    let timeoutLivro;
    let timeoutAluno;
    
    // Busca de livros ao digitar com debounce
    buscaLivro.addEventListener('input', function() {
        clearTimeout(timeoutLivro);
        if (this.value.length >= 3) {
            timeoutLivro = setTimeout(buscarLivros, 500);
        } else {
            document.getElementById('autocomplete-livros').classList.add('hidden');
        }
    });
    
    // Busca de alunos ao digitar com debounce
    buscaAluno.addEventListener('input', function() {
        clearTimeout(timeoutAluno);
        if (this.value.length >= 3) {
            timeoutAluno = setTimeout(buscarAlunos, 500);
        } else {
            document.getElementById('autocomplete-alunos').classList.add('hidden');
        }
    });
    
    // Fechar autocomplete ao clicar fora
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.relative')) {
            document.getElementById('autocomplete-livros').classList.add('hidden');
            document.getElementById('autocomplete-alunos').classList.add('hidden');
        }
    });
    
    // Fechar autocomplete com ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.getElementById('autocomplete-livros').classList.add('hidden');
            document.getElementById('autocomplete-alunos').classList.add('hidden');
        }
    });
    
    // Inicializar datas
    limparCampos();
});
</script>
</body>
</html>