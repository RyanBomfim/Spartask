-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23/07/2025 às 03:08
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `spartask-pro`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `id` int(11) NOT NULL,
  `email` text DEFAULT NULL,
  `senha` varchar(11) DEFAULT NULL,
  `perfil` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cadastro`
--

INSERT INTO `cadastro` (`id`, `email`, `senha`, `perfil`) VALUES
(3, 'ryan@gmail.com', 'ryan', 'domestica'),
(4, 'mari@gmail.com', 'mari', 'contratante'),
(5, 'gustavo123@gmail.com', 'ryan', NULL),
(6, 'ryanocbomfim7@gmail.com', 'ryan', NULL),
(7, 'ryanocbomfim@gmail.com', 'ryan', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `chat_mensagens`
--

CREATE TABLE `chat_mensagens` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `remetente` enum('contratante','domestica') NOT NULL,
  `mensagem` text NOT NULL,
  `data_envio` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `chat_mensagens`
--

INSERT INTO `chat_mensagens` (`id`, `pedido_id`, `remetente`, `mensagem`, `data_envio`) VALUES
(1, 2, 'domestica', 'asadsa', '2025-06-24 12:38:51'),
(2, 3, 'contratante', 'as', '2025-06-25 01:39:38'),
(3, 2, 'contratante', 'as', '2025-06-25 01:39:43'),
(4, 1, 'contratante', 'as', '2025-06-25 01:39:46'),
(5, 3, 'domestica', 'eae', '2025-06-25 01:40:05'),
(6, 3, 'contratante', 'eae', '2025-06-25 01:50:06'),
(7, 2, 'domestica', 'ola', '2025-06-25 02:07:05'),
(8, 2, 'contratante', 'ola', '2025-06-25 02:07:09'),
(9, 2, 'contratante', 'oi', '2025-06-25 02:08:14'),
(10, 2, 'domestica', 'ae', '2025-06-25 02:16:14'),
(11, 2, 'contratante', 'ae', '2025-06-25 02:17:10'),
(12, 4, 'contratante', 'eae', '2025-06-25 02:17:25'),
(13, 4, 'domestica', 'eae', '2025-06-25 02:32:59'),
(14, 4, 'contratante', 'eae', '2025-06-25 02:33:11'),
(15, 3, 'domestica', 'ae', '2025-06-25 02:37:57'),
(16, 3, 'domestica', 'eae', '2025-06-25 11:15:22'),
(17, 3, 'domestica', 'as', '2025-06-25 11:55:19'),
(18, 3, 'contratante', 'shgdubas', '2025-07-11 10:26:14');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `id_contratante` int(11) NOT NULL,
  `id_domestica` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `data_pedido` datetime NOT NULL,
  `status` enum('pendente','aceito','recusado') DEFAULT 'pendente',
  `codigo_confirmacao` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_contratante`, `id_domestica`, `descricao`, `data_pedido`, `status`, `codigo_confirmacao`) VALUES
(1, 4, 3, 'asdas', '2025-06-24 12:27:05', 'aceito', NULL),
(2, 4, 3, 'asd', '2025-06-24 12:27:22', 'aceito', NULL),
(3, 4, 3, 'klhjk', '2025-06-24 12:34:26', 'aceito', NULL),
(4, 4, 3, 'ae', '2025-06-25 02:17:19', 'recusado', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos_contratante`
--

CREATE TABLE `pedidos_contratante` (
  `id` int(11) NOT NULL,
  `id_contratante` int(11) NOT NULL,
  `id_domestica` int(11) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `status` enum('pendente','aceito','recusado','concluido') DEFAULT 'pendente',
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tarefas_domestica`
--

CREATE TABLE `tarefas_domestica` (
  `id` int(11) NOT NULL,
  `id_domestica` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `data` date DEFAULT NULL,
  `concluido` tinyint(1) DEFAULT 0,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `chat_mensagens`
--
ALTER TABLE `chat_mensagens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_contratante` (`id_contratante`),
  ADD KEY `id_domestica` (`id_domestica`);

--
-- Índices de tabela `pedidos_contratante`
--
ALTER TABLE `pedidos_contratante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_contratante` (`id_contratante`),
  ADD KEY `id_domestica` (`id_domestica`);

--
-- Índices de tabela `tarefas_domestica`
--
ALTER TABLE `tarefas_domestica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_domestica` (`id_domestica`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastro`
--
ALTER TABLE `cadastro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `chat_mensagens`
--
ALTER TABLE `chat_mensagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `pedidos_contratante`
--
ALTER TABLE `pedidos_contratante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tarefas_domestica`
--
ALTER TABLE `tarefas_domestica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `chat_mensagens`
--
ALTER TABLE `chat_mensagens`
  ADD CONSTRAINT `chat_mensagens_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_contratante`) REFERENCES `cadastro` (`id`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`id_domestica`) REFERENCES `cadastro` (`id`);

--
-- Restrições para tabelas `pedidos_contratante`
--
ALTER TABLE `pedidos_contratante`
  ADD CONSTRAINT `pedidos_contratante_ibfk_1` FOREIGN KEY (`id_contratante`) REFERENCES `cadastro` (`id`),
  ADD CONSTRAINT `pedidos_contratante_ibfk_2` FOREIGN KEY (`id_domestica`) REFERENCES `cadastro` (`id`);

--
-- Restrições para tabelas `tarefas_domestica`
--
ALTER TABLE `tarefas_domestica`
  ADD CONSTRAINT `tarefas_domestica_ibfk_1` FOREIGN KEY (`id_domestica`) REFERENCES `cadastro` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
