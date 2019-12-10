-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10-Dez-2019 às 00:59
-- Versão do servidor: 10.4.8-MariaDB
-- versão do PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `loja_site`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(5) NOT NULL,
  `descricao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `descricao`) VALUES
(1, 'tradicional'),
(2, 'especial'),
(3, 'premium');

-- --------------------------------------------------------

--
-- Estrutura da tabela `item`
--

CREATE TABLE `item` (
  `itemid` int(12) NOT NULL,
  `prodid` int(12) NOT NULL,
  `pedid` int(12) NOT NULL,
  `quantidade` int(5) NOT NULL,
  `id_cliente` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `item`
--

INSERT INTO `item` (`itemid`, `prodid`, `pedid`, `quantidade`, `id_cliente`) VALUES
(30, 1, 10, 2, 14),
(35, 11, 10, 2, 14),
(37, 9, 10, 2, 14),
(38, 8, 10, 2, 14),
(39, 6, 10, 1, 14),
(40, 2, 47, 1, 51),
(41, 2, 48, 3, 52),
(42, 2, 50, 1, 54),
(43, 8, 50, 1, 54),
(44, 6, 50, 1, 54),
(46, 4, 50, 1, 54),
(47, 4, 50, 1, 54),
(48, 4, 53, 1, 57),
(49, 3, 53, 1, 57),
(50, 2, 54, 2, 58),
(51, 3, 54, 3, 58),
(52, 4, 55, 2, 59),
(53, 4, 51, 1, 55);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(12) NOT NULL,
  `id_cliente` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_cliente`) VALUES
(8, 12),
(9, 13),
(10, 14),
(11, 15),
(12, 15),
(13, 15),
(14, 15),
(15, 15),
(16, 15),
(17, 15),
(18, 22),
(19, 22),
(20, 22),
(21, 22),
(22, 22),
(23, 22),
(24, 28),
(25, 28),
(26, 28),
(27, 28),
(28, 28),
(29, 28),
(30, 28),
(31, 28),
(32, 28),
(33, 28),
(34, 28),
(35, 28),
(36, 28),
(37, 28),
(38, 28),
(39, 28),
(40, 28),
(41, 28),
(42, 28),
(43, 28),
(44, 28),
(45, 28),
(46, 28),
(47, 51),
(48, 52),
(49, 53),
(50, 54),
(51, 55),
(52, 56),
(53, 57),
(54, 58),
(55, 59);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `descricao` varchar(500) COLLATE utf8_unicode_ci DEFAULT '',
  `id_categoria` int(12) NOT NULL,
  `quantidade` int(20) NOT NULL DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `preco`, `image`, `descricao`, `id_categoria`, `quantidade`) VALUES
(2, 'Blondie(Massa de Chocolate Branco)', '2.50', '1162718338.jpg', 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', 1, 10),
(3, 'Chocolate Branco', '3.00', '858823641.jpg', '', 2, 10),
(4, 'Oreo', '3.00', '2100076519.jpg', '', 2, 10),
(5, 'Doce de leite', '3.00', '93751276.jpg', '', 2, 10),
(6, 'Avelas', '3.00', '880988319.jpg', '', 2, 10),
(7, 'Nozes', '3.00', '490875570.jpg', '', 2, 10),
(8, 'Confete', '3.00', '1367214783.jpg', '', 2, 10),
(9, 'Paçoca', '3.00', '109324950.jpg', '', 2, 10),
(10, 'Kinder', '4.00', '2116711469.jpg', '', 3, 10),
(11, 'Nutella', '4.00', '41291925.jpg', '', 3, 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `situacao` int(1) NOT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `rua` varchar(40) DEFAULT NULL,
  `numero` varchar(50) DEFAULT NULL,
  `bairro` varchar(40) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `cep` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `pass`, `situacao`, `telefone`, `rua`, `numero`, `bairro`, `cidade`, `cep`) VALUES
(55, 'administrador', 'administrador@gmail.com', '$2y$10$eg6EkFj8bmHMRP09FC1aCuPOnUb6svuV19I4RL/gQRDZXOl55DgBa', 1, '3372177', 'Rua Luís Spezia', '47', 'Jaraguá Esquerdo', 'Jaraguá do Sul', '89253210'),
(58, 'Arturo', 'arturoandreatta@gmail.com', '$2y$10$iggxdW9C1HjHlvyJTcevh.hfli6KAmQEhPTsexVpVaCms.eVXdYbG', 1, '98910-8576', 'Rua Antônio Francisco Diemonn', '296', 'Vila Nova', 'Jaraguá do Sul', '89259210'),
(59, 'Arturo Teste', 'arturo@andreatta.net', '$2y$10$TQkP8K1zGuSYwtiM18DwMOkg.O/wVaf20iVuGx0T63Wa6Og7P4H66', 1, '999999-99', 'Rua Antônio Francisco Diemonn', '296', 'Vila Nova', 'Jaraguá do Sul', '89259210');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`itemid`),
  ADD KEY `prodid` (`prodid`),
  ADD KEY `pedid` (`pedid`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categoria` (`id_categoria`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `item`
--
ALTER TABLE `item`
  MODIFY `itemid` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
