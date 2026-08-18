

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
<script src="https://cdn.tailwindcss.com"></script>
    
</head>
  <style>
        /* Corpo da página com fundo azul indigo sólido */
        body {
            background: #1f4362; /* Cor azul indigo sólida */
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; /* Fonte moderna */
        }
        /* Container principal do formulário de login */
        .login-container {
            backdrop-filter: blur(10px); /* Efeito de desfoque no fundo */
            background: rgba(255, 255, 255, 0.95); /* Fundo branco semi-transparente */
        }
        /* Efeito visual quando o campo de entrada está em foco */
        .input-field:focus {
            transform: translateY(-1px); /* Move o campo ligeiramente para cima */
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); /* Adiciona sombra suave */
        }
        /* Efeito visual quando o mouse passa sobre o botão de login */
        .login-btn:hover {
            transform: translateY(-2px); /* Eleva o botão quando hover */
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4); /* Sombra azul no hover */
        }
      
    </style>
<body align="center" class="min-h-screen flex items-center justify-center p-4 relative">
      <div class="login-container w-full max-w-md p-8 rounded-2xl shadow-2xl relative z-10">
        <!-- Logo/Icon -->
        <div class="text-center mb-8">
           
            <h3class="text-4xl font-bold text-gray-800 mb-4">SGL - Sistema de Gestão de locação de Livros WEB</h3><br><br><br>
            <p class="text-gray-600">Faça login em sua conta</p>
        </div>
        
        <?php if (isset($erro)): ?>
            <div class="erro"><?= $erro ?></div>
        <?php endif; ?>
		<table style="width:30%" align="center">

         <form id="loginForm" action="acesso.php"class="space-y-6" method="POST">
            <!-- Username Field -->
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                    Usuário
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <input 
                        type="text" 
                        id="usuario" 
                        name="usuario" 
                        required
                        class="input-field w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white"
                        placeholder="Digite seu usuário"
                    >
                </div>
            </div>

            <!-- Password Field -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Senha
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <input  type="password" id="senha"  name="senha"  required  class="input-field w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white"placeholder="Digite sua senha">
                    <br><br><button 
                        type="button" 
                        id="togglePassword"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center"
                    >
               <svg id="eyeIcon" class="h-5 w-5 text-gray-400 hover:text-gray-600 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
            </div>

           
            <!-- Login Button -->
            <button 
                type="submit" 
                class="login-btn w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 px-4 rounded-lg font-medium hover:from-blue-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200"
            >
                Entrar
            </button>
        </form>

        <!-- Sign Up Link -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-600">
                Não tem uma conta? 
                <a href="cadastro_login.php#" class="text-blue-600 hover:text-blue-500 font-medium">
                    Cadastre-se aqui
                </a>
            </p>
        </div>
    </div>

<script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'985b328565744ecb',t:'MTc1ODk3ODE2Ni4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script><script>
    const togglePassword = document.querySelector("#togglePassword");
    const senhaInput = document.querySelector("#senha");
    const eyeIcon = document.querySelector("#eyeIcon");

    togglePassword.addEventListener("click", function () {
        // Alterna o tipo do input (mostra/esconde senha)
        const isPassword = senhaInput.getAttribute("type") === "password";
        senhaInput.setAttribute("type", isPassword ? "text" : "password");

        // Troca o ícone do olho (aberto ⇆ riscado)
        if (isPassword) {
            // Olho fechado (senha visível)
            eyeIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7
                         a10.048 10.048 0 012.271-3.578M15 12a3 3 0 01-6 0M3 3l18 18"></path>
            `;
        } else {
            // Olho aberto (senha escondida)
            eyeIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M2.458 12C3.732 7.943 7.523 5 12 5
                         c4.478 0 8.268 2.943 9.542 7
                         -1.274 4.057-5.064 7-9.542 7
                         -4.477 0-8.268-2.943-9.542-7z"></path>
            `;
        }
    });
</script>
</body>
</html>
