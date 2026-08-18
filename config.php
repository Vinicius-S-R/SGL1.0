<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

// Obter informações do usuário
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$usuario_id]);
$usuario = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha_atual = $_POST['senha_atual'] ?? '';
    $nova_senha = $_POST['nova_senha'] ?? '';
    $confirmar_senha = $_POST['confirmar_senha'] ?? '';
    
    // Validações
    if (empty($nome) || empty($email)) {
        $erro = "Nome e e-mail são obrigatórios!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "E-mail inválido!";
    } else {
        // Verificar se email já existe (para outro usuário)
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ? AND id != ?");
        $stmt->execute([$email, $usuario_id]);
        
        if ($stmt->fetch()) {
            $erro = "Este e-mail já está em uso por outro usuário!";
        } else {
            // Atualizar informações básicas
            $stmt = $pdo->prepare("UPDATE usuarios SET nome = ?, email = ? WHERE id = ?");
            $stmt->execute([$nome, $email, $usuario_id]);
            
            if (!empty($senha_atual)) 
			{
                if (password_verify($senha_atual, $usuario['senha'])) 
				{
                    if ($nova_senha === $confirmar_senha) 
					{
                        $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
                        $stmt = $pdo->prepare("UPDATE usuarios SET senha = ? WHERE id = ?");
                        $stmt->execute([$nova_senha_hash, $usuario_id]);
                        
                        $_SESSION['mensagem'] = "Perfil e senha atualizados com sucesso!";
                    } 
					else 
					{
                        $erro = "As novas senhas não coincidem!";
                    }
                } 
				else 
				{
                    $erro = "Senha atual incorreta!";
                }
            } 
			else 
			{
                $_SESSION['mensagem'] = "Perfil atualizado com sucesso!";
            }
            
            if (!isset($erro)) {
                // Atualizar dados na sessão
                $_SESSION['usuario_nome'] = $nome;
                header('Location: config.php');
                exit;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Meu Perfil</title>
    <link rel="stylesheet" href="estiloapp.css">
</head>
<body>
    <header>
        <h1>Alterar Email ou Senha</h1>
        <nav>
            <a href="navegação.php">Voltar</a>
        </nav>
    </header>
    
    <div class="container">
        <?php if (isset($_SESSION['mensagem'])): ?>
            <div class="mensagem"><?= $_SESSION['mensagem'] ?></div>
            <?php unset($_SESSION['mensagem']); ?>
        <?php endif; ?>
        
        <?php if (isset($erro)): ?>
            <div class="erro"><?= $erro ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div>
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
            </div>
            <div>
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>
            </div>
            <div>
                <label for="senha_atual">Senha Atual (para alterar senha):</label>
                <input type="password" id="senha_atual" name="senha_atual">
            </div>
            <div>
                <label for="nova_senha">Nova Senha:</label>
                <input type="password" id="nova_senha" name="nova_senha">
            </div>
            <div>
                <label for="confirmar_senha">Confirmar Nova Senha:</label>
                <input type="password" id="confirmar_senha" name="confirmar_senha">
            </div>
            <button type="submit">Salvar Alterações</button>
        </form>
    </div>
</body>
</html>