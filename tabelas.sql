CREATE DATABASE IF NOT EXISTS bdapp;
USE bdapp;

DROP TABLE IF EXISTS `alunos`;
CREATE TABLE IF NOT EXISTS `alunos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `serie` varchar(255) NOT NULL,
  `turma` varchar(255) NOT NULL,
  `data_cadastro` date NOT NULL,
  `usuario_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



-- --------------------------------------------------------

--
-- Estrutura para tabela `livros`
--

DROP TABLE IF EXISTS `livros`;
CREATE TABLE IF NOT EXISTS `livros` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` int NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `autor` varchar(255) DEFAULT NULL,
  `editora` varchar(255) DEFAULT NULL,
  `data_cadastro` date DEFAULT NULL,
  `disponivel` enum('Disponivel','Emprestado','Perdido','Excluido') DEFAULT 'Disponivel',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- --------------------------------------------------------

--
-- Estrutura para tabela `movimentacao`
--

DROP TABLE IF EXISTS `movimentacao`;
CREATE TABLE IF NOT EXISTS `movimentacao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo_livro` int NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `aluno` varchar(255) DEFAULT NULL,
  `editora` varchar(255) DEFAULT NULL,
  `data_retirada` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `data_devolucao` date DEFAULT NULL,
  `data_prevista` date NOT NULL,
  `autor` VARCHAR(255) NOT NULL , 
  `serie` VARCHAR(255) NOT NULL , 
  `turma` VARCHAR(255) NOT NULL ;
  PRIMARY KEY (`id`),
  KEY `aluno` (`aluno`(250)),
  KEY `codigo_livro` (`codigo_livro`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_cadastro` datetime DEFAULT CURRENT_TIMESTAMP,
  `perfil` enum('admin','usuario') DEFAULT 'usuario',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


	
	);