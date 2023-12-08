-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2023 at 08:57 PM
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
-- Table structure for table `bairros`
--

CREATE TABLE `bairros` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `cidade` varchar(30) NOT NULL DEFAULT 'Goianésia',
  `valor_entrega` decimal(10,2) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bairros`
--

INSERT INTO `bairros` (`id`, `nome`, `slug`, `cidade`, `valor_entrega`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Carrilho', 'carrilho', 'Goianésia', '5.00', 1, '2023-11-14 09:59:47', '2023-11-17 19:00:46', NULL),
(2, 'Setor Sul', 'setor-sul', 'Goianésia', '5.00', 1, '2023-11-17 17:59:00', '2023-11-21 14:29:27', NULL),
(4, 'Centro', 'centro', 'Goianésia', '5.00', 1, '2023-11-17 18:03:42', '2023-11-18 11:47:39', NULL),
(5, 'Residencial Morada Nova', 'residencial-morada-nova', 'Goianésia', '5.00', 1, '2023-11-21 14:27:24', '2023-11-21 14:27:24', NULL);

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
(1, 'Pizza Doce', 'pizza-doce', 1, '2023-11-06 10:16:53', '2023-11-21 14:31:21', NULL),
(2, 'Porções', 'porcoes', 1, '2023-11-06 11:58:04', '2023-11-06 12:34:02', NULL),
(3, 'Fritas', 'fritas', 1, '2023-11-06 11:58:50', '2023-11-06 12:35:02', NULL),
(4, 'Batata', 'batata', 1, '2023-11-06 12:00:17', '2023-11-06 12:00:17', NULL),
(5, 'Burgers', 'burgers', 1, '2023-11-21 15:33:47', '2023-11-21 15:33:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `entregadores`
--

CREATE TABLE `entregadores` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `cnh` varchar(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `endereco` varchar(240) NOT NULL,
  `imagem` varchar(240) DEFAULT NULL,
  `veiculo` varchar(240) NOT NULL,
  `placa` varchar(20) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `entregadores`
--

INSERT INTO `entregadores` (`id`, `nome`, `cpf`, `cnh`, `email`, `telefone`, `endereco`, `imagem`, `veiculo`, `placa`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Pedro Luiz Souza', '987.508.650-99', '65985320', 'pedroluiz@email.com', '(62) 99999-9999', 'Rua do trabalho N 45, Centro Cívico - Curitiba - PR', '1699963687_6cde2cce6f7c7b629d45.png', 'Titan 160 - Preta - 2018', 'KBQ-5821', 1, '2023-11-12 10:10:59', '2023-11-14 09:08:07', NULL),
(2, 'Malu Simone Mendes', '971.617.595-79', '69683203211', 'email@email.com', '(62) 93353-7317', 'Rua 25 n 434 - Goianesia-GO', '1699964675_07e4ccfa86bdb0751ba6.png', 'CG 2018 Vermelha', 'NNU-9N94', 1, '2023-11-14 08:48:05', '2023-11-14 09:24:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expediente`
--

CREATE TABLE `expediente` (
  `id` int(5) UNSIGNED NOT NULL,
  `dia` int(5) NOT NULL,
  `dia_descricao` varchar(50) NOT NULL,
  `abertura` time DEFAULT NULL,
  `fechamento` time DEFAULT NULL,
  `situacao` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expediente`
--

INSERT INTO `expediente` (`id`, `dia`, `dia_descricao`, `abertura`, `fechamento`, `situacao`) VALUES
(22, 0, 'Domingo', '23:00:00', '23:00:00', 0),
(23, 1, 'Segunda', '21:04:00', '23:00:00', 1),
(24, 2, 'Terça', '18:00:00', '23:00:00', 1),
(25, 3, 'Quarta', '18:00:00', '23:00:00', 1),
(26, 4, 'Quinta', '15:00:00', '23:00:00', 1),
(27, 5, 'Sexta', '12:00:00', '23:00:00', 1),
(28, 5, 'Sábado', '18:00:00', '23:00:00', 1);

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
(2, 'Borda de Cheddar', 'borda-de-cheddar', '5.00', 'borda de cheddar como opcional', 1, '2023-11-06 14:02:41', '2023-11-22 09:53:31', NULL),
(3, 'Fritas', 'fritas', '7.00', 'batata frita', 1, '2023-11-06 14:09:39', '2023-11-06 14:09:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `formas_pagamento`
--

CREATE TABLE `formas_pagamento` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(128) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `formas_pagamento`
--

INSERT INTO `formas_pagamento` (`id`, `nome`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Dinheiro', 1, '2023-11-12 07:24:25', '2023-11-12 07:24:25', NULL),
(2, 'Cartão de Crédito', 1, '2023-11-12 08:52:47', '2023-12-06 17:18:07', NULL),
(3, 'Cartão de Débito', 0, '2023-11-12 09:27:36', '2023-11-12 09:27:36', NULL);

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
(1, 'Pizza Grande 20 pedaços', 'Pizza Grande 12 pedaços', 1, '2023-11-06 14:26:07', '2023-11-21 14:30:16', NULL),
(2, 'Pequeno', 'pequeno', 0, '2023-11-06 15:12:42', '2023-11-06 15:45:18', NULL),
(3, 'Brotinho', 'pizza brotinho', 0, '2023-11-06 15:13:38', '2023-11-06 15:13:38', NULL),
(4, 'Gigante', 'pizza gigante', 1, '2023-11-06 15:15:46', '2023-11-06 15:15:46', NULL),
(5, 'Mini', 'mini pizza', 1, '2023-11-06 15:26:19', '2023-11-06 15:27:28', NULL),
(6, 'Hamburger', '', 1, '2023-11-21 15:36:41', '2023-11-21 15:36:41', NULL);

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
(8, '2023-11-08-112617', 'App\\Database\\Migrations\\CriaTabelaProdutos', 'default', 'App', 1699444100, 5),
(9, '2023-11-11-122055', 'App\\Database\\Migrations\\CriaTabelaProdutosExtras', 'default', 'App', 1699705535, 6),
(10, '2023-11-11-183949', 'App\\Database\\Migrations\\CriaTabelaProdutosEspecificacoes', 'default', 'App', 1699728219, 7),
(11, '2023-11-12-093533', 'App\\Database\\Migrations\\CriaTabelaFormasPagamento', 'default', 'App', 1699782057, 8),
(13, '2023-11-12-130055', 'App\\Database\\Migrations\\CriaTabelaEntregadores', 'default', 'App', 1699794650, 9),
(14, '2023-11-14-125608', 'App\\Database\\Migrations\\CriaTabelaBairros', 'default', 'App', 1699966773, 10),
(15, '2023-11-21-121109', 'App\\Database\\Migrations\\CriaTabelaExpediente', 'default', 'App', 1700569908, 11),
(16, '2023-12-06-233228', 'App\\Database\\Migrations\\CriaTabelaPedidos', 'default', 'App', 1701906084, 12),
(17, '2023-12-08-193510', 'App\\Database\\Migrations\\CriaTabelaPedidosProdutos', 'default', 'App', 1702064278, 13);

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(5) UNSIGNED NOT NULL,
  `usuario_id` int(5) UNSIGNED NOT NULL,
  `entregador_id` int(5) UNSIGNED DEFAULT NULL,
  `codigo` varchar(10) NOT NULL,
  `forma_pagamento` varchar(50) NOT NULL,
  `situacao` tinyint(1) NOT NULL DEFAULT 0,
  `produtos` text NOT NULL,
  `valor_produtos` decimal(10,2) NOT NULL,
  `valor_entrega` decimal(10,2) NOT NULL,
  `valor_pedido` decimal(10,2) NOT NULL,
  `endereco_entrega` varchar(255) NOT NULL,
  `observacoes` varchar(255) NOT NULL,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`id`, `usuario_id`, `entregador_id`, `codigo`, `forma_pagamento`, `situacao`, `produtos`, `valor_produtos`, `valor_entrega`, `valor_pedido`, `endereco_entrega`, `observacoes`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(11, 8, NULL, '60948334', 'Dinheiro', 0, 'a:1:{i:0;a:5:{s:4:\"slug\";s:94:\"gigante-metade-chocolate-com-morango-e-mm-metade-pizza-de-calabresa-com-extra-borda-de-cheddar\";s:4:\"nome\";s:94:\"Gigante metade Chocolate com morango e MM metade Pizza de Calabresa Com extra Borda de Cheddar\";s:5:\"preco\";s:5:\"60.00\";s:10:\"quantidade\";i:1;s:7:\"tamanho\";s:7:\"Gigante\";}}', '60.00', '5.00', '65.00', 'Setor Sul - Goianésia - Rua 25 - GO - CEP 76382-175 - Número 434', 'Ponto de Referência: Post Impiranga - Número: 434. Troco para: R$ 100,00', '2023-12-08 12:42:39', '2023-12-08 16:04:45', NULL),
(12, 8, 1, '33410593', 'Cartão de Crédito', 0, 'a:1:{i:0;a:6:{s:2:\"id\";s:1:\"5\";s:4:\"nome\";s:18:\"Mustang Hamburger \";s:4:\"slug\";s:17:\"mustang-hamburger\";s:5:\"preco\";s:5:\"25.00\";s:10:\"quantidade\";i:1;s:7:\"tamanho\";s:9:\"Hamburger\";}}', '25.00', '5.00', '30.00', 'Setor Sul - Goianésia - Rua 25 - GO - CEP 76382-175 - Número 434', 'Ponto de Referência: ipiranga - Número: 434', '2023-12-08 12:49:35', '2023-12-08 16:27:45', NULL),
(13, 8, 1, '91348757', 'Cartão de Crédito', 0, 'a:1:{i:0;a:6:{s:2:\"id\";s:1:\"1\";s:4:\"nome\";s:61:\"Chocolate com morango e MM Gigante Com extra Borda de Cheddar\";s:4:\"slug\";s:61:\"chocolate-com-morango-e-mm-gigante-com-extra-borda-de-cheddar\";s:5:\"preco\";s:5:\"55.00\";s:10:\"quantidade\";i:1;s:7:\"tamanho\";s:7:\"Gigante\";}}', '55.00', '5.00', '60.00', 'Setor Sul - Goianésia - Rua 25 - GO - CEP 76382-175 - Número 434', 'Ponto de Referência: ipiranga - Número: 434', '2023-12-08 16:28:26', '2023-12-08 16:28:43', NULL),
(14, 8, 1, '57656825', 'Dinheiro', 2, 'a:1:{i:0;a:6:{s:2:\"id\";s:1:\"5\";s:4:\"nome\";s:18:\"Mustang Hamburger \";s:4:\"slug\";s:17:\"mustang-hamburger\";s:5:\"preco\";s:5:\"25.00\";s:10:\"quantidade\";i:1;s:7:\"tamanho\";s:9:\"Hamburger\";}}', '25.00', '5.00', '30.00', 'Setor Sul - Goianésia - GO - Rua 25 - CEP 76382-175 - Número 434', 'Ponto de Referência: ipiranga - Número: 434. Troco para: R$ 100,00', '2023-12-08 16:30:45', '2023-12-08 16:54:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pedidos_produtos`
--

CREATE TABLE `pedidos_produtos` (
  `id` int(5) UNSIGNED NOT NULL,
  `pedido_id` int(5) UNSIGNED NOT NULL,
  `produto` varchar(128) NOT NULL,
  `quantidade` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 1, 'Chocolate com morango e MM', 'chocolate-com-morango-e-mm', 'Pizza de chocolate com morango', 1, '1700593833_bfdccfe429921f666c03.png', '2023-11-08 08:56:07', '2023-11-21 16:10:34', NULL),
(4, 2, 'Porção Batata Frita', 'porcao-batata-frita', 'Batatas Fritas', 0, '1700593757_532ca902b788197cfea2.jpg', '2023-11-08 11:41:58', '2023-11-24 18:58:44', NULL),
(5, 5, 'Mustang', 'mustang', 'Pão brioche, burger 130g, Queijo Cheddar, Bacon, Ovo, Picles, Molho Defumado, Alface, Tomate e Cebola', 1, '1700591753_d2ffd08f40efa2c86739.webp', '2023-11-21 15:35:41', '2023-11-21 15:35:53', NULL),
(6, 1, 'Pizza de Calabresa', 'pizza-de-calabresa', 'Queijo, Calabresa, Cebola', 1, '1701007201_366e23c6091fd30ca738.jpg', '2023-11-26 10:59:33', '2023-11-26 11:00:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produtos_especificacoes`
--

CREATE TABLE `produtos_especificacoes` (
  `id` int(5) UNSIGNED NOT NULL,
  `produto_id` int(5) UNSIGNED NOT NULL,
  `medida_id` int(5) UNSIGNED NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `customizavel` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produtos_especificacoes`
--

INSERT INTO `produtos_especificacoes` (`id`, `produto_id`, `medida_id`, `preco`, `customizavel`) VALUES
(3, 1, 4, '50.00', 1),
(6, 4, 4, '50.00', 1),
(7, 1, 6, '25.00', 0),
(8, 5, 6, '25.00', 0),
(9, 6, 4, '55.00', 1),
(10, 6, 5, '25.00', 1),
(11, 1, 5, '25.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `produtos_extras`
--

CREATE TABLE `produtos_extras` (
  `id` int(5) UNSIGNED NOT NULL,
  `produto_id` int(5) UNSIGNED NOT NULL,
  `extra_id` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produtos_extras`
--

INSERT INTO `produtos_extras` (`id`, `produto_id`, `extra_id`) VALUES
(2, 4, 3),
(3, 1, 3),
(4, 1, 2),
(5, 6, 2);

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
(8, 'MARCO AURELIO SILVA', 'eldedodeouro@gmail.com', '024.569.811-62', '(62) 3353-7317', 1, 1, '$2y$10$oaRooaEznbX9Jf2wssFou.owzICFhfSHrVpFsRHswlv5CZ3EkcTUe', NULL, NULL, NULL, '2023-11-02 20:55:01', '2023-12-06 13:54:07', NULL),
(9, 'MARCO AURELIO SILVA', 'eldedodaeouro@gmail.com', '403.441.930-04', '(62) 3353-7317', 0, 0, '$2y$10$S4ocQ0xmbjVASppFPDU3nOP4GPut5DQVOySxQNump.psST1YKy.9.', NULL, NULL, NULL, '2023-11-02 20:59:26', '2023-11-03 16:40:08', '2023-11-03 16:40:08'),
(10, 'Marta', 'adseldedodeouro@gmail.com', '620.678.130-56', '(55) 55555-5555', 0, 1, '$2y$10$BTbIrWDU99qSx9/xNRF.r.UqZWELQZK1wf9VFM5th6GjDCCHeRiCm', NULL, NULL, NULL, '2023-11-03 08:35:03', '2023-11-06 11:40:06', '2023-11-06 11:40:06'),
(11, 'maria', 'elasdasddedodeouro@gmail.com', '894.932.900-00', '(62) 3353-7317', 0, 0, '$2y$10$hhndKSXcWekSyVZfIk6k1.lD63lRaVhiHAf9Jc.nAFKPKj75699Ba', NULL, NULL, NULL, '2023-11-03 09:40:50', '2023-11-03 09:40:50', NULL),
(12, 'Pedro', 'eldedoasdassdaeouro@gmail.com', '930.416.960-70', '(62) 3353-7317', 0, 0, '$2y$10$C2qQ14sZf58FXGbSdQJRM.BzVEczvaX9VQJf4QQ3waamEXjXmmAh.', NULL, NULL, NULL, '2023-11-03 09:41:14', '2023-11-03 09:41:14', NULL),
(13, 'Luis', 'eldedodeourasdasdo@gmail.com', '034.973.180-27', '(62) 3353-7317', 0, 0, '$2y$10$X2RP7AlM6jn850ZpSifQ2O3M7xbk7Lxdl4ikQrO4FQxDfwWFaw.tW', NULL, NULL, NULL, '2023-11-03 09:41:36', '2023-11-03 09:41:36', NULL),
(14, 'MARCO AURELIO SILVA', 'coreilabsbr@gmail.com', '872.494.130-15', '(62) 3353-7317', 0, 1, '$2y$10$Bhvns7YhIBKXqe5sLFc8cepEyLQcEeuj0NTR4RvT6VFTzMB4ZUj1.', NULL, NULL, NULL, '2023-11-29 08:48:03', '2023-12-05 14:41:00', NULL),
(15, 'Marco Aurelio', 'contato@corei.com.br', '067.695.520-78', '', 0, 0, '$2y$10$0i8mXESOnMwOo836qQjCnOwkMGL6rXzYiZTGIwpxRA2LYZnlzo0Km', '28dfc0ee4f19f088e60cb059c06259013327ef3a818b97713f87ef64b7a3f48d', NULL, NULL, '2023-11-29 09:05:25', '2023-11-29 09:05:25', NULL),
(16, 'View Teste', 'contasdasdato@corei.com.br', '724.383.420-56', '', 0, 0, '$2y$10$bRI.3qIrbXSGPusdLplrseIntJCB2kliEH8NswkKhh4PNdLXDXL1G', '939308a3e5f764d910b70cab7e1d2b977fe4df1f86b91c5ef18cca5bc45d1ea4', NULL, NULL, '2023-11-29 13:06:02', '2023-11-29 13:06:02', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bairros`
--
ALTER TABLE `bairros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Indexes for table `entregadores`
--
ALTER TABLE `entregadores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `cnh` (`cnh`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `telefone` (`telefone`);

--
-- Indexes for table `expediente`
--
ALTER TABLE `expediente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extras`
--
ALTER TABLE `extras`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Indexes for table `formas_pagamento`
--
ALTER TABLE `formas_pagamento`
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
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidos_usuario_id_foreign` (`usuario_id`),
  ADD KEY `pedidos_entregador_id_foreign` (`entregador_id`);

--
-- Indexes for table `pedidos_produtos`
--
ALTER TABLE `pedidos_produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidos_produtos_pedido_id_foreign` (`pedido_id`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`),
  ADD KEY `produtos_categoria_id_foreign` (`categoria_id`);

--
-- Indexes for table `produtos_especificacoes`
--
ALTER TABLE `produtos_especificacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produtos_especificacoes_produto_id_foreign` (`produto_id`),
  ADD KEY `produtos_especificacoes_medida_id_foreign` (`medida_id`);

--
-- Indexes for table `produtos_extras`
--
ALTER TABLE `produtos_extras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produtos_extras_produto_id_foreign` (`produto_id`),
  ADD KEY `produtos_extras_extra_id_foreign` (`extra_id`);

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
-- AUTO_INCREMENT for table `bairros`
--
ALTER TABLE `bairros`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `entregadores`
--
ALTER TABLE `entregadores`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expediente`
--
ALTER TABLE `expediente`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `extras`
--
ALTER TABLE `extras`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `formas_pagamento`
--
ALTER TABLE `formas_pagamento`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medidas`
--
ALTER TABLE `medidas`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pedidos_produtos`
--
ALTER TABLE `pedidos_produtos`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `produtos_especificacoes`
--
ALTER TABLE `produtos_especificacoes`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `produtos_extras`
--
ALTER TABLE `produtos_extras`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_entregador_id_foreign` FOREIGN KEY (`entregador_id`) REFERENCES `entregadores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pedidos_produtos`
--
ALTER TABLE `pedidos_produtos`
  ADD CONSTRAINT `pedidos_produtos_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Constraints for table `produtos_especificacoes`
--
ALTER TABLE `produtos_especificacoes`
  ADD CONSTRAINT `produtos_especificacoes_medida_id_foreign` FOREIGN KEY (`medida_id`) REFERENCES `medidas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produtos_especificacoes_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produtos_extras`
--
ALTER TABLE `produtos_extras`
  ADD CONSTRAINT `produtos_extras_extra_id_foreign` FOREIGN KEY (`extra_id`) REFERENCES `extras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produtos_extras_produto_id_foreign` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
