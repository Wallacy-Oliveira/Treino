-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18/04/2025 às 10:30
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `treinamento3`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `tipo_item` enum('filosofia','poema') NOT NULL,
  `comentario` text NOT NULL,
  `data_comentario` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `comentarios`
--

INSERT INTO `comentarios` (`id`, `item_id`, `tipo_item`, `comentario`, `data_comentario`) VALUES
(12, 6, 'filosofia', 'A mesmo filosofia do pc gamer ', '2025-04-16 05:28:00'),
(13, 5, 'poema', 'Esse foi feito por mim KKSKSKSKSK', '2025-04-16 05:28:23');

-- --------------------------------------------------------

--
-- Estrutura para tabela `filosofia`
--

CREATE TABLE `filosofia` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `autor` varchar(255) DEFAULT NULL,
  `text_filo` text DEFAULT NULL,
  `data_criacao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `filosofia`
--

INSERT INTO `filosofia` (`id`, `titulo`, `autor`, `text_filo`, `data_criacao`) VALUES
(6, 'Constante Oscilação', 'Arthur Schopenhauer', ' \"A vida é uma constante oscilação entre a ânsia de ter e o tédio de possuir\"', '2025-04-16 05:14:11');

-- --------------------------------------------------------

--
-- Estrutura para tabela `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `tipo_item` enum('filosofia','poema') NOT NULL,
  `contador` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `likes`
--

INSERT INTO `likes` (`id`, `item_id`, `tipo_item`, `contador`) VALUES
(1, 1, 'filosofia', 15),
(2, 2, 'filosofia', 3),
(3, 5, 'filosofia', 4),
(4, 4, 'filosofia', 2),
(5, 2, 'poema', 3),
(6, 5, 'poema', 1),
(7, 6, 'filosofia', 7),
(8, 3, 'poema', 4),
(9, 4, 'poema', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `poemas`
--

CREATE TABLE `poemas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `autor` varchar(255) DEFAULT NULL,
  `text_poema` text DEFAULT NULL,
  `data_criacao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `poemas`
--

INSERT INTO `poemas` (`id`, `titulo`, `autor`, `text_poema`, `data_criacao`) VALUES
(3, 'Não te Amo mais Estaria Mentindo', 'Clarice Lispector', 'Poema de trás para frente e vice versa\r\n\r\nNão te amo mais.\r\nEstarei mentindo dizendo que\r\nAinda te quero como sempre quis.\r\nTenho certeza que\r\nNada foi em vão.\r\nSinto dentro de mim que\r\nVocê não significa nada.\r\nNão poderia dizer jamais que\r\nAlimento um grande amor.\r\nSinto cada vez mais que\r\nJá te esqueci!\r\nE jamais usarei a frase\r\nEu te amo!\r\nSinto, mas tenho que dizer a verdade\r\nÉ tarde demais...\r\n\r\n(Agora leia de baixo para cima. Este texto possui duas interpretações distintas conforme o fluxo da leitura)', '2025-04-16 05:14:56'),
(4, 'Incenso fosse música', 'Paulo Leminski', '\"Isso de querer\r\nser exatamente aquilo\r\nque a gente é\r\nainda vai\r\nnos levar além\"', '2025-04-16 05:15:28'),
(5, 'Pecado', 'Wallacy Oliveira ', 'This woman is beautiful as the sunset seen from a beach in the late afternoon, her skin white as snow, curly hair and brown eyes the color of sin and with lips as sweet as honey, she loves to read books, and has a patience like the fuse of a bomb ready to explode but as the saying goes \"Every rose has thorns\".', '2025-04-16 05:15:53');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `filosofia`
--
ALTER TABLE `filosofia`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `poemas`
--
ALTER TABLE `poemas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `filosofia`
--
ALTER TABLE `filosofia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `poemas`
--
ALTER TABLE `poemas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
