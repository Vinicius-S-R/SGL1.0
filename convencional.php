<?php
require 'user.php';

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividade Convencional</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f5f0e5; /* Fundo creme */
            color: #333;
        }
        
        .calendar-day {
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .calendar-day:hover {
            background-color: #1d9bf0;
            color: white;
        }
        
        .calendar-day.selected {
            background-color: #1d9bf0;
            color: white;
            font-weight: bold;
        }
        
        .post {
            transition: all 0.3s ease;
        }
        
        .post-enter {
            opacity: 0;
            transform: translateY(20px);
        }
        
        .post-enter-active {
            opacity: 1;
            transform: translateY(0);
        }
        
        .post-exit {
            opacity: 1;
        }
        
        .post-exit-active {
            opacity: 0;
            transform: translateY(-20px);
        }
        
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
        
        /* Estilos para o seletor de mês/ano */
        .month-year-selector {
            position: absolute;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            padding: 16px;
            z-index: 10;
            width: 280px;
            display: none;
        }
        
        .month-grid, .year-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }
        
        .month-item, .year-item {
            padding: 8px;
            text-align: center;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .month-item:hover, .year-item:hover {
            background-color: #e6f7ff;
        }
        
        .month-item.selected, .year-item.selected {
            background-color: #1d9bf0;
            color: white;
        }
        
        .selector-tabs {
            display: flex;
            margin-bottom: 12px;
            border-bottom: 1px solid #eee;
        }
        
        .selector-tab {
            flex: 1;
            text-align: center;
            padding: 8px;
            cursor: pointer;
            font-weight: 500;
        }
        
        .selector-tab.active {
            border-bottom: 2px solid #1d9bf0;
            color: #1d9bf0;
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
                           <p <h1><?= htmlspecialchars($usuario_nome) ?></h1></p>
                    </div>
                </div>
            </div>
            
            <!-- Navegação -->
            <nav class="mb-4">
                <a href="navegação.php" class="flex items-center p-3 text-xl sidebar-item rounded-full mx-2 mb-1">
                    <i class="fas fa-home mr-4"></i>
                    <span>Início</span>
                </a>
                <a href="cadastronav.php" class="flex items-center p-3 text-xl sidebar-item rounded-full mx-2 mb-1">
                   
                    <span>Cadastro</span>
                </a>
                <a href="enfermagem.php" class="flex items-center p-3 text-xl sidebar-item rounded-full mx-2 mb-1">
                 
                    <span>Atividade Enfermagem</span>
                </a>
                <a href="frequencia.php" class="flex items-center p-3 text-xl sidebar-item rounded-full mx-2 mb-1">
                   
                    <span>Frequência</span>
                </a>
                <a href="encaminhamento.php" class="flex items-center p-3 text-xl sidebar-item rounded-full mx-2 mb-1">

                    <span>Encaminhamentos</span>
                </a>
                <a href="config.php" class="flex items-center p-3 text-xl sidebar-item rounded-full mx-2 mb-1">
                    
                    <span>Configurações</span>
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
                    <h1 class="text-xl font-bold">Início</h1>
                </div>
                <div class="border-b border-gray-300">
                    <div class="py-4 text-center font-bold border-b-4 border-blue-500">Atividade Convencional</div>
                </div>
            </header>
            
            <!-- Formulário de Postagem -->
            <div class="border-b border-gray-300 p-4">
                <div class="flex">
                    <div class="w-12 h-12 rounded-full bg-blue-500 flex-shrink-0 flex items-center justify-center overflow-hidden">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3 flex-1">
                        <textarea class="w-full bg-transparent text-xl outline-none resize-none placeholder-gray-500 border-b border-gray-300 focus:border-blue-500" placeholder="O que está acontecendo?" rows="2"></textarea>
                        <div class="flex justify-between items-center mt-4">
                            <div class="flex space-x-4 text-blue-500">
                                
                            </div>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full transition">
                                Postar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Feed de Postagens -->
            <div id="posts-container">
                <!-- As postagens serão inseridas dinamicamente aqui -->
            </div>
        </div>
        
        <!-- Barra Lateral Direita -->
        <div class="w-80 p-4 border-l border-gray-300 hidden lg:block sticky top-0 h-screen overflow-y-auto">
            <!-- Pesquisa -->
            <div class="relative mb-6">
                <input type="text" placeholder="Pesquisar" class="w-full bg-white rounded-full py-3 px-5 pl-12 outline-none focus:ring-2 focus:ring-blue-400 shadow-sm">
                <i class="fas fa-search absolute left-4 top-3.5 text-gray-500"></i>
            </div>
            
            <!-- Calendário movido para abaixo da pesquisa -->
            <div class="mb-6 relative">
                <h2 class="text-xl font-bold mb-4">Filtrar por Data</h2>
                <div id="calendar" class="bg-white rounded-lg p-4 shadow-sm">
                    <div class="flex justify-between items-center mb-4">
                        <button id="prevMonth" class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <h3 id="monthYear" class="text-lg font-bold cursor-pointer hover:text-blue-500"></h3>
                        <button id="nextMonth" class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                    <div class="grid grid-cols-7 gap-1 text-center text-sm mb-2">
                        <div class="text-gray-500">D</div>
                        <div class="text-gray-500">S</div>
                        <div class="text-gray-500">T</div>
                        <div class="text-gray-500">Q</div>
                        <div class="text-gray-500">Q</div>
                        <div class="text-gray-500">S</div>
                        <div class="text-gray-500">S</div>
                    </div>
                    <div id="calendarDays" class="grid grid-cols-7 gap-1 text-center"></div>
                </div>
                
                <!-- Seletor de Mês e Ano -->
                <div id="monthYearSelector" class="month-year-selector">
                    <div class="selector-tabs">
                        <div class="selector-tab active" data-tab="month">Mês</div>
                        <div class="selector-tab" data-tab="year">Ano</div>
                    </div>
                    
                    <div id="monthSelector" class="month-grid">
                        <!-- Meses serão inseridos aqui dinamicamente -->
                    </div>
                    
                    <div id="yearSelector" class="year-grid" style="display: none;">
                        <!-- Anos serão inseridos aqui dinamicamente -->
                    </div>
                </div>
                
                <div class="mt-4">
                    <div id="activeFilter" class="hidden bg-blue-100 p-3 rounded-lg">
                        <div class="flex justify-between items-center">
                            <span>Filtrando por: <span id="filterDate" class="font-bold"></span></span>
                            <button id="clearFilter" class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-times"></i> Limpar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <script>
        // Dados de exemplo de postagens com datas
        const allPosts = [
            {
                id: 1,
                username: "TechGuru",
                date: "2023-06-15",
                content: "Acabei de lançar meu novo site! Confira e me diga o que você acha.",
                
            },
            {
                id: 2,
                username: "DesignMaster",
                date: "2023-06-15",
                content: "Dica de UI: Sempre considere a hierarquia visual dos seus elementos. Isso guia os usuários pela sua interface na ordem de importância.",
                
            },
            {
                id: 3,
                username: "CodeNinja",
                date: "2023-06-14",
                content: "Aprender uma nova linguagem de programação é sempre empolgante! Comecei com Rust hoje e já estou adorando.",
                
            },
            {
                id: 4,
                username: "DevLife",
                date: "2023-06-13",
                content: "Quando seu código funciona na primeira tentativa e você não sabe por quê 😅",
                
            },
            {
                id: 5,
                username: "TechNews",
                date: "2023-06-12",
                content: "Urgente: Novo framework JavaScript lançado! Promete resolver todos os problemas que os frameworks anteriores criaram.",
                
            },
            {
                id: 6,
                username: "UXResearcher",
                date: "2023-06-11",
                content: "Realizei testes com usuários hoje e obtive insights incríveis! Sempre teste seus designs com usuários reais.",
                
            },
            {
                id: 7,
                username: "AIEnthusiast",
                date: "2023-06-10",
                content: "Os avanços em IA e aprendizado de máquina são incríveis! Acabei de treinar um modelo que pode gerar imagens realistas a partir de descrições de texto.",
                
            }
        ];

        // Função para renderizar postagens
        function renderPosts(posts) {
            const postsContainer = document.getElementById('posts-container');
            postsContainer.innerHTML = '';
            
            if (posts.length === 0) {
                postsContainer.innerHTML = `
                    <div class="p-8 text-center text-gray-500">
                        <p class="text-xl">Nenhuma postagem encontrada para esta data</p>
                        <p class="mt-2">Tente selecionar uma data diferente</p>
                    </div>
                `;
                return;
            }
            
            posts.forEach(post => {
                const postDate = new Date(post.date);
                const formattedDate = postDate.toLocaleDateString('pt-BR', { 
                    day: 'numeric',
                    month: 'short',
                    year: postDate.getFullYear() !== new Date().getFullYear() ? 'numeric' : undefined
                });
                
                const postElement = document.createElement('div');
                postElement.className = 'border-b border-gray-300 p-4 hover:bg-gray-100 transition-colors post';
                postElement.innerHTML = `
                    <div class="flex">
                        <div class="w-12 h-12 rounded-full bg-blue-500 flex-shrink-0 flex items-center justify-center overflow-hidden">
                            <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3 flex-1">
                            <div class="flex items-center">
                                <span class="font-bold">${post.username}</span>
                                <span class="text-gray-500 mx-1">·</span>
                                <span class="text-gray-500">${formattedDate}</span>
                            </div>
                            <p class="mt-1 mb-3">${post.content}</p>
                           
                            </div>
                        </div>
                    </div>
                `;
                postsContainer.appendChild(postElement);
                
                // Adicionar efeito de animação
                setTimeout(() => {
                    postElement.classList.add('post-enter');
                    setTimeout(() => {
                        postElement.classList.remove('post-enter');
                    }, 300);
                }, 10);
            });
        }

        // Funcionalidade do calendário
        let currentDate = new Date();
        let selectedDate = null;
        const monthNames = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
        
        function renderCalendar() {
            const monthYear = document.getElementById('monthYear');
            const calendarDays = document.getElementById('calendarDays');
            
            // Definir mês e ano
            monthYear.textContent = `${monthNames[currentDate.getMonth()]} ${currentDate.getFullYear()}`;
            
            // Limpar dias anteriores
            calendarDays.innerHTML = '';
            
            // Obter primeiro dia do mês e total de dias
            const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1).getDay();
            const daysInMonth = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0).getDate();
            
            // Adicionar células vazias para os dias antes do primeiro dia do mês
            for (let i = 0; i < firstDay; i++) {
                const emptyDay = document.createElement('div');
                emptyDay.className = 'h-8 w-8 flex items-center justify-center text-gray-400';
                calendarDays.appendChild(emptyDay);
            }
            
            // Adicionar dias do mês
            for (let day = 1; day <= daysInMonth; day++) {
                const dayElement = document.createElement('div');
                const dateString = `${currentDate.getFullYear()}-${String(currentDate.getMonth() + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                
                // Verificar se há postagens para esta data
                const hasPostsForDate = allPosts.some(post => post.date === dateString);
                
                dayElement.className = `calendar-day h-8 w-8 flex items-center justify-center rounded-full ${hasPostsForDate ? 'font-medium' : 'text-gray-500'}`;
                
                // Verificar se este dia está selecionado
                if (selectedDate && selectedDate === dateString) {
                    dayElement.classList.add('selected');
                }
                
                dayElement.textContent = day;
                dayElement.dataset.date = dateString;
                
                // Adicionar evento de clique para filtrar postagens
                dayElement.addEventListener('click', () => {
                    // Se já estiver selecionado, limpar filtro
                    if (selectedDate === dateString) {
                        clearFilter();
                        return;
                    }
                    
                    // Remover classe selecionada de todos os dias
                    document.querySelectorAll('.calendar-day').forEach(day => {
                        day.classList.remove('selected');
                    });
                    
                    // Adicionar classe selecionada ao dia clicado
                    dayElement.classList.add('selected');
                    
                    // Definir data selecionada e filtrar postagens
                    selectedDate = dateString;
                    const filteredPosts = allPosts.filter(post => post.date === selectedDate);
                    renderPosts(filteredPosts);
                    
                    // Mostrar filtro ativo
                    const activeFilter = document.getElementById('activeFilter');
                    const filterDate = document.getElementById('filterDate');
                    activeFilter.classList.remove('hidden');
                    
                    // Formatar data para exibição
                    const displayDate = new Date(selectedDate);
                    filterDate.textContent = displayDate.toLocaleDateString('pt-BR', { 
                        day: 'numeric',
                        month: 'short',
                        year: displayDate.getFullYear() !== new Date().getFullYear() ? 'numeric' : undefined
                    });
                });
                
                calendarDays.appendChild(dayElement);
            }
        }
        
        // Inicializar seletor de mês e ano
        function initMonthYearSelector() {
            const monthYearTitle = document.getElementById('monthYear');
            const selector = document.getElementById('monthYearSelector');
            const monthSelector = document.getElementById('monthSelector');
            const yearSelector = document.getElementById('yearSelector');
            const tabs = document.querySelectorAll('.selector-tab');
            
            // Preencher seletor de meses
            monthSelector.innerHTML = '';
            monthNames.forEach((month, index) => {
                const monthItem = document.createElement('div');
                monthItem.className = `month-item ${index === currentDate.getMonth() ? 'selected' : ''}`;
                monthItem.textContent = month;
                monthItem.dataset.month = index;
                
                monthItem.addEventListener('click', () => {
                    currentDate.setMonth(index);
                    renderCalendar();
                    selector.style.display = 'none';
                });
                
                monthSelector.appendChild(monthItem);
            });
            
            // Preencher seletor de anos
            yearSelector.innerHTML = '';
            const currentYear = new Date().getFullYear();
            for (let year = currentYear - 5; year <= currentYear + 5; year++) {
                const yearItem = document.createElement('div');
                yearItem.className = `year-item ${year === currentDate.getFullYear() ? 'selected' : ''}`;
                yearItem.textContent = year;
                yearItem.dataset.year = year;
                
                yearItem.addEventListener('click', () => {
                    currentDate.setFullYear(year);
                    renderCalendar();
                    selector.style.display = 'none';
                });
                
                yearSelector.appendChild(yearItem);
            }
            
            // Alternar entre abas de mês e ano
            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    tabs.forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');
                    
                    const tabName = tab.dataset.tab;
                    if (tabName === 'month') {
                        monthSelector.style.display = 'grid';
                        yearSelector.style.display = 'none';
                    } else {
                        monthSelector.style.display = 'none';
                        yearSelector.style.display = 'grid';
                    }
                });
            });
            
            // Mostrar/ocultar seletor ao clicar no título
            monthYearTitle.addEventListener('click', () => {
                if (selector.style.display === 'block') {
                    selector.style.display = 'none';
                } else {
                    selector.style.display = 'block';
                    
                    // Atualizar seleção atual
                    document.querySelectorAll('.month-item').forEach(item => {
                        item.classList.toggle('selected', parseInt(item.dataset.month) === currentDate.getMonth());
                    });
                    
                    document.querySelectorAll('.year-item').forEach(item => {
                        item.classList.toggle('selected', parseInt(item.dataset.year) === currentDate.getFullYear());
                    });
                }
            });
            
            // Fechar seletor ao clicar fora dele
            document.addEventListener('click', (event) => {
                if (!selector.contains(event.target) && event.target !== monthYearTitle) {
                    selector.style.display = 'none';
                }
            });
        }
        
        // Inicializar navegação do calendário
        document.getElementById('prevMonth').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        });
        
        document.getElementById('nextMonth').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        });
        
        // Função para limpar filtro
        function clearFilter() {
            selectedDate = null;
            document.querySelectorAll('.calendar-day').forEach(day => {
                day.classList.remove('selected');
            });
            renderPosts(allPosts);
            document.getElementById('activeFilter').classList.add('hidden');
        }
        
        // Adicionar ouvinte de evento ao botão de limpar filtro
        document.getElementById('clearFilter').addEventListener('click', clearFilter);
        
        // Inicializar a página
        renderCalendar();
        initMonthYearSelector();
        renderPosts(allPosts);
        
        // Tornar a página responsiva
        function handleResize() {
            const width = window.innerWidth;
            // Ajustes responsivos se necessário
        }
        
        window.addEventListener('resize', handleResize);
        handleResize();
    </script>
<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'93937ab93647621f',t:'MTc0NjE0NjU1NC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>