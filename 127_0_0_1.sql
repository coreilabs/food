-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2023 at 12:58 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `slug`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Pizza Doce', 'pizza-doce', 1, '2023-11-06 10:16:53', '2023-11-06 11:45:59', NULL),
(2, 'Porções', 'porcoes', 1, '2023-11-06 11:58:04', '2023-11-06 12:34:02', NULL),
(3, 'Fritas', 'fritas', 1, '2023-11-06 11:58:50', '2023-11-06 12:35:02', NULL),
(4, 'Batata', 'batata', 1, '2023-11-06 12:00:17', '2023-11-06 12:00:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `extras`
--

CREATE TABLE `extras` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `descricao` text NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `extras`
--

INSERT INTO `extras` (`id`, `nome`, `slug`, `preco`, `descricao`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(2, 'Borda de Cheddar', 'borda-de-cheddar', '5.00', 'borda de cheddar como opcional', 1, '2023-11-06 14:02:41', '2023-11-06 15:44:11', '2023-11-06 15:44:11'),
(3, 'Fritas', 'fritas', '7.00', 'batata frita', 1, '2023-11-06 14:09:39', '2023-11-06 14:09:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `medidas`
--

CREATE TABLE `medidas` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `descricao` text NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medidas`
--

INSERT INTO `medidas` (`id`, `nome`, `descricao`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Pizza Grande 20 pedaços', 'Pizza Grande 12 pedaços', 1, '2023-11-06 14:26:07', '2023-11-06 15:05:52', NULL),
(2, 'Pequeno', 'pequeno', 0, '2023-11-06 15:12:42', '2023-11-06 15:45:18', NULL),
(3, 'Brotinho', 'pizza brotinho', 0, '2023-11-06 15:13:38', '2023-11-06 15:13:38', NULL),
(4, 'Gigante', 'pizza gigante', 1, '2023-11-06 15:15:46', '2023-11-06 15:15:46', NULL),
(5, 'Mini', 'mini pizza', 1, '2023-11-06 15:26:19', '2023-11-06 15:27:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(2, '2023-11-01-122815', 'App\\Database\\Migrations\\CriaTabelaUsuarios', 'default', 'App', 1698844380, 1),
(5, '2023-11-05-224632', 'App\\Database\\Migrations\\CriaTabelaCategorias', 'default', 'App', 1699276607, 2),
(6, '2023-11-06-153915', 'App\\Database\\Migrations\\CriaTabelaExtras', 'default', 'App', 1699285400, 3),
(7, '2023-11-06-172406', 'App\\Database\\Migrations\\CriaTabelaMedidas', 'default', 'App', 1699291555, 4),
(8, '2023-11-08-112617', 'App\\Database\\Migrations\\CriaTabelaProdutos', 'default', 'App', 1699444100, 5);

-- --------------------------------------------------------

--
-- Table structure for table `produtos`
--

CREATE TABLE `produtos` (
  `id` int(5) UNSIGNED NOT NULL,
  `categoria_id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `ingredientes` text NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `imagem` varchar(200) NOT NULL,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produtos`
--

INSERT INTO `produtos` (`id`, `categoria_id`, `nome`, `slug`, `ingredientes`, `ativo`, `imagem`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 1, 'Pizza de chocolate com morango', '', 'Pizza de chocolate com morango', 1, '', '2023-11-08 08:56:07', '2023-11-08 08:56:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `telefone` varchar(20) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `ativo` tinyint(1) NOT NULL DEFAULT 0,
  `password_hash` varchar(255) NOT NULL,
  `ativacao_hash` varchar(64) DEFAULT NULL,
  `reset_hash` varchar(64) DEFAULT NULL,
  `reset_expira_em` datetime DEFAULT NULL,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `cpf`, `telefone`, `is_admin`, `ativo`, `password_hash`, `ativacao_hash`, `reset_hash`, `reset_expira_em`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(7, 'sdsdfdsf', 'eldesadasddodeouro@gmail.com', '734.345.730-62', '(22) 22222-2222', 0, 1, '$2y$10$/lpuYJSl5sIc3x3as36Qeule6WRa5Cb.xMhAthh/fDczKEmJCOfgi', NULL, NULL, NULL, '2023-11-02 20:44:46', '2023-11-03 09:29:36', '2023-11-03 09:29:36'),
(8, 'MARCO AURELIO SILVA', 'eldedodeouro@gmail.com', '024.569.811-62', '(62) 3353-7317', 1, 1, '$2y$10$Z9wmf8VJv14h3KrEd4h6YuL.CRaDDLeQzR52PxPWcvYomr073RH4m', NULL, NULL, NULL, '2023-11-02 20:55:01', '2023-11-05 17:15:54', NULL),
(9, 'MARCO AURELIO SILVA', 'eldedodaeouro@gmail.com', '403.441.930-04', '(62) 3353-7317', 0, 0, '$2y$10$S4ocQ0xmbjVASppFPDU3nOP4GPut5DQVOySxQNump.psST1YKy.9.', NULL, NULL, NULL, '2023-11-02 20:59:26', '2023-11-03 16:40:08', '2023-11-03 16:40:08'),
(10, 'Marta', 'adseldedodeouro@gmail.com', '620.678.130-56', '(55) 55555-5555', 0, 1, '$2y$10$BTbIrWDU99qSx9/xNRF.r.UqZWELQZK1wf9VFM5th6GjDCCHeRiCm', NULL, NULL, NULL, '2023-11-03 08:35:03', '2023-11-06 11:40:06', '2023-11-06 11:40:06'),
(11, 'maria', 'elasdasddedodeouro@gmail.com', '894.932.900-00', '(62) 3353-7317', 0, 0, '$2y$10$hhndKSXcWekSyVZfIk6k1.lD63lRaVhiHAf9Jc.nAFKPKj75699Ba', NULL, NULL, NULL, '2023-11-03 09:40:50', '2023-11-03 09:40:50', NULL),
(12, 'Pedro', 'eldedoasdassdaeouro@gmail.com', '930.416.960-70', '(62) 3353-7317', 0, 0, '$2y$10$C2qQ14sZf58FXGbSdQJRM.BzVEczvaX9VQJf4QQ3waamEXjXmmAh.', NULL, NULL, NULL, '2023-11-03 09:41:14', '2023-11-03 09:41:14', NULL),
(13, 'Luis', 'eldedodeourasdasdo@gmail.com', '034.973.180-27', '(62) 3353-7317', 0, 0, '$2y$10$X2RP7AlM6jn850ZpSifQ2O3M7xbk7Lxdl4ikQrO4FQxDfwWFaw.tW', NULL, NULL, NULL, '2023-11-03 09:41:36', '2023-11-03 09:41:36', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Indexes for table `extras`
--
ALTER TABLE `extras`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Indexes for table `medidas`
--
ALTER TABLE `medidas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`),
  ADD KEY `produtos_categoria_id_foreign` (`categoria_id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `ativacao_hash` (`ativacao_hash`),
  ADD UNIQUE KEY `reset_hash` (`reset_hash`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `extras`
--
ALTER TABLE `extras`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medidas`
--
ALTER TABLE `medidas`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
