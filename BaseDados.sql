-- --------------------------------------------------------
-- Anfitrião:                    127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- SO do servidor:               Win64
-- HeidiSQL Versão:              12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- A despejar estrutura da base de dados para epocaespecialdweb
CREATE DATABASE IF NOT EXISTS `epocaespecialdweb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `epocaespecialdweb`;

-- A despejar estrutura para tabela epocaespecialdweb.orcamentos
CREATE TABLE IF NOT EXISTS `orcamentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL DEFAULT '0',
  `telefone` varchar(20) NOT NULL DEFAULT '0',
  `servicos` varchar(255) NOT NULL,
  `descricao` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `criado` timestamp NULL DEFAULT (now()),
  `resposta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `estado` enum('p','a','r') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT (_utf8mb4'p'),
  `nota_entrega` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela epocaespecialdweb.orcamentos: ~6 rows (aproximadamente)
INSERT INTO `orcamentos` (`id`, `nome`, `email`, `telefone`, `servicos`, `descricao`, `criado`, `resposta`, `estado`, `nota_entrega`) VALUES
	(1, 'Ana Nuñez', 'ana.nunez0317@gmail.com', '910166052', 'Desenvolvimento Web, Manutenção', 'Projetoooooooooooooooooooooo', '2025-07-08 08:58:21', '1100', 'r', NULL),
	(2, 'Ana Nuñez', 'ana.nunez0317@gmail.com', '910166052', 'Desenvolvimento Web, Marketing Digital', 'Projetooooooooooooooooooooooooooooooooo1', '2025-07-08 08:58:59', '500', 'a', 'Entregue com sucesso'),
	(3, 'Ana Nuñez', 'ana.nunez0317@gmail.com', '910166052', 'Desenvolvimento Web, Marketing Digital', 'Projetooooooooooooooooooooooooooooooooo1', '2025-07-08 08:59:09', '200', 'r', NULL),
	(4, 'Ana Nuñez', 'ana.nunez0317@gmail.com', '910166052', 'Desenvolvimento Web, Ecommerce', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2025-07-08 09:07:48', '1111', 'a', NULL),
	(5, 'Ana Nuñez', 'ana.nunez0317@gmail.com', '910166052', 'Desenvolvimento Web, Marketing Digital', 'aaaaaaaaaaaaaaadddddddddddddddd', '2025-07-08 09:31:57', '1222', 'a', NULL),
	(6, 'Ana Nuñez', 'ana.nunez0317@gmail.com', '910166052', 'Desenvolvimento Web, Manutenção', 'vvvvvvvvvvvvvvvvvvvvvvvvvv', '2025-07-08 21:46:16', '111111111', 'a', NULL);

-- A despejar estrutura para tabela epocaespecialdweb.projetos
CREATE TABLE IF NOT EXISTS `projetos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL DEFAULT '0',
  `descricao` text NOT NULL,
  `imagem` varchar(255) NOT NULL DEFAULT '',
  `criado` timestamp NOT NULL DEFAULT (now()),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela epocaespecialdweb.projetos: ~2 rows (aproximadamente)
INSERT INTO `projetos` (`id`, `titulo`, `descricao`, `imagem`, `criado`) VALUES
	(2, 'Projeto B', 'O Projeto B', '1751964748_ChatGPT Image 31_03_2025, 19_11_43.png', '2025-07-08 08:52:28'),
	(3, 'Projeto C', 'O Projeto C', '1751964761_ChatGPT Image 31_03_2025, 19_11_43.png', '2025-07-08 08:52:41');

-- A despejar estrutura para tabela epocaespecialdweb.utilizadores
CREATE TABLE IF NOT EXISTS `utilizadores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipo_utilizador` enum('admin','equipa','cliente') NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `visivel` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela epocaespecialdweb.utilizadores: ~4 rows (aproximadamente)
INSERT INTO `utilizadores` (`id`, `nome`, `email`, `password`, `tipo_utilizador`, `imagem`, `visivel`) VALUES
	(1, 'Ana Nuñez', 'ananunez@gmail.com', '$2y$10$pScZ4m8KbQuipzG8JrLEUuXuaryBu0vUfBp7yS1oEkWufpZfRfyta', 'equipa', '686cdba189fc0_desktop-wallpaper-kawaii-bear-laptop-aesthetic-bear-cute-pc.jpg', 0),
	(2, 'Paulo Soares', 'paulosoares@gmail.com', '$2y$10$AOnGRJ.dmIuJLZit5SJoi.pxii5HYSv9WkNGcA1fNNe1fxGnZweye', 'equipa', '686cdbbaddf9d_imagem1.jpg', 0),
	(3, 'João João', 'joao@gmail.com', '$2y$10$7HfIxBiZv1hMAAlggaDcmuGHa7N5kLZfCwxnkHQ4337LdCUNtNMU6', 'equipa', '686cdbecdb1d9_imagem1.jpg', 1),
	(4, 'Ana Nuñez', 'ana.nunez0317@gmail.com', '$2y$10$21fD/RMoAklBqsleWZyxP.I8wqlaCFxmRAoXIHGnucvs2s7PLu68m', 'cliente', NULL, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
