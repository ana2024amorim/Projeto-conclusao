-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/11/2024 às 03:10
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_guardian`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_cargos`
--

CREATE TABLE `tb_cargos` (
  `id` int(11) NOT NULL,
  `cargo` enum('gerente','vendedor','estoquista','caixa') NOT NULL,
  `permissao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_cargos`
--

INSERT INTO `tb_cargos` (`id`, `cargo`, `permissao`) VALUES
(1, 'gerente', 'gerente'),
(2, 'vendedor', 'vendedor'),
(3, 'estoquista', 'estoquista'),
(4, 'caixa', 'caixa');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_cliente`
--

CREATE TABLE `tb_cliente` (
  `id` int(11) NOT NULL,
  `cpf_cnpj` varchar(20) NOT NULL,
  `razao_nome` varchar(100) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `endereco` varchar(110) NOT NULL,
  `complemento` varchar(10) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `uf` varchar(10) NOT NULL,
  `telefone` varchar(10) NOT NULL,
  `email` varchar(70) NOT NULL,
  `rginscricao` varchar(50) NOT NULL,
  `sitcad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_cliente`
--

INSERT INTO `tb_cliente` (`id`, `cpf_cnpj`, `razao_nome`, `cep`, `cidade`, `endereco`, `complemento`, `bairro`, `uf`, `telefone`, `email`, `rginscricao`, `sitcad`) VALUES
(1, '70421137134', 'NOME DA CASA', '72241-624', 'Brasília', 'Quadra QNP 15 Conjunto Z', '', 'Ceilândia Norte (Ceilândia)', 'DF', '(61)99674-', 'casa@casa.com.br', '', ''),
(2, '70421137134', 'NOME DA CASA', '72241-624', 'Brasília', 'Quadra QNP 15 Conjunto Z', 'casa 14', 'Ceilândia Norte (Ceilândia)', 'DF', '(61)99674-', 'casa@casa.com.br', '', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_compra`
--

CREATE TABLE `tb_compra` (
  `id` int(11) NOT NULL,
  `cliente_cpfcnpj` varchar(20) DEFAULT NULL,
  `cliente_nome` varchar(100) DEFAULT NULL,
  `produto_nome` varchar(100) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `valor_unitario` decimal(10,2) DEFAULT NULL,
  `valor_total` decimal(10,2) DEFAULT NULL,
  `forma_pagamento` varchar(50) DEFAULT NULL,
  `finalizado` tinyint(1) NOT NULL DEFAULT 0 CHECK (`finalizado` in (0,1)),
  `data_compra` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_compra`
--

INSERT INTO `tb_compra` (`id`, `cliente_cpfcnpj`, `cliente_nome`, `produto_nome`, `quantidade`, `valor_unitario`, `valor_total`, `forma_pagamento`, `finalizado`, `data_compra`) VALUES
(3, '704.211.371-34', 'NOME DA CASA', 'Pneu', 3, 617.74, 1853.22, 'dinheiro', 0, '2024-10-29 19:43:21'),
(4, '704.211.371-34', 'NOME DA CASA', 'Cabo de Freio', 2, 327.08, 654.16, 'pix', 0, '2024-10-29 19:45:43'),
(5, '704.211.371-34', 'NOME DA CASA', 'Pneu', 1, 364.33, 364.33, 'pix', 0, '2024-10-29 19:47:46'),
(6, '704.211.371-34', 'NOME DA CASA', 'Cabo de Freio', 1, 327.08, 327.08, 'pix', 0, '2024-10-29 19:48:51'),
(7, '', '', 'Coxim do Motor', 1, 606.43, 606.43, 'dinheiro', 0, '2024-10-29 19:49:51'),
(8, '704.211.371-34', 'NOME DA CASA', NULL, NULL, NULL, 164.13, 'pix', 1, '2024-10-29 19:52:27'),
(9, '704.211.371-34', 'NOME DA CASA', NULL, NULL, NULL, 492.39, 'dinheiro', 0, '2024-10-29 19:53:17'),
(10, '704.211.371-34', 'NOME DA CASA', 'Válvula', 1, 452.45, 452.45, 'dinheiro', 0, '2024-10-29 19:55:05'),
(11, '704.211.371-34', 'NOME DA CASA', 'Cabo de Freio', 2, 327.08, 654.16, 'pix', 1, '2024-10-29 19:55:32'),
(12, '704.211.371-34', 'NOME DA CASA', 'Pneu', 2, 617.74, 1235.48, 'dinheiro', 0, '2024-10-29 22:58:03'),
(13, '704.211.371-34', 'NOME DA CASA', 'Pneu', 1, 364.33, 364.33, 'pix', 1, '2024-10-29 22:58:10'),
(14, '704.211.371-34', 'NOME DA CASA', 'Cabo de Freio', 1, 327.08, 327.08, 'pix', 1, '2024-10-30 00:12:50'),
(15, '704.211.371-34', 'NOME DA CASA', 'Carter', 1, 883.05, 883.05, 'pix', 1, '2024-10-30 00:12:50'),
(16, '704.211.371-34', 'NOME DA CASA', 'Válvula', 1, 452.45, 452.45, 'pix', 1, '2024-10-30 00:12:50'),
(17, '704.211.371-34', 'NOME DA CASA', 'Pneu', 1, 617.74, 617.74, 'dinheiro', 0, '2024-10-30 00:13:56'),
(18, '704.211.371-34', 'NOME DA CASA', 'Pneu', 1, 364.33, 364.33, 'dinheiro', 0, '2024-10-30 00:13:56'),
(19, '12345678901', 'Nome do Cliente', 'Produto 1', 2, 50.00, 100.00, 'pix', 1, '2024-10-30 00:49:09'),
(20, '12345678901', 'Nome do Cliente', 'Produto 2', 1, 30.00, 30.00, 'pix', 1, '2024-10-30 00:49:09'),
(21, '704.211.371-34', 'NOME DA CASA', 'Pneu', 1, 617.74, 617.74, 'cartao_credito', 0, '2024-10-30 00:51:28'),
(22, '704.211.371-34', 'NOME DA CASA', 'Cabo de Freio', 1, 327.08, 327.08, 'cartao_credito', 0, '2024-10-30 00:51:28'),
(23, '704.211.371-34', 'NOME DA CASA', 'Válvula', 1, 452.45, 452.45, 'cartao_credito', 0, '2024-10-30 00:51:28'),
(24, '704.211.371-34', 'NOME DA CASA', 'Pneu', 3, 617.74, 1853.22, 'pix', 1, '2024-10-30 01:29:50'),
(25, '704.211.371-34', 'NOME DA CASA', 'Cabo de Freio', 3, 327.08, 981.24, 'pix', 1, '2024-10-30 01:29:50');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_estoque`
--

CREATE TABLE `tb_estoque` (
  `id` int(11) NOT NULL,
  `codigo_peca` varchar(255) NOT NULL,
  `localizacao` varchar(255) NOT NULL,
  `corredor` varchar(100) NOT NULL,
  `posicao` varchar(100) NOT NULL,
  `nivel` varchar(50) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `fornecedor` varchar(255) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_estoque`
--

INSERT INTO `tb_estoque` (`id`, `codigo_peca`, `localizacao`, `corredor`, `posicao`, `nivel`, `quantidade`, `fornecedor`, `data_cadastro`) VALUES
(1, 'ABC123', 'Estoque A', 'Corredor B', 'GAVETA 1', 'A20', 30, 'COFAP', '2024-11-06 00:28:52'),
(2, '123ABC', 'Estoque B', 'Corredor A', 'GAVETA 2', 'A10', 10, 'COFAP', '2024-11-06 00:40:40');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_fornecedor`
--

CREATE TABLE `tb_fornecedor` (
  `id` int(11) NOT NULL,
  `fornecedor` varchar(255) NOT NULL,
  `razao_social` varchar(255) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `insc_estadual` varchar(20) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` char(2) NOT NULL,
  `situacao` enum('Ativa','Desativada','Bloqueada') NOT NULL,
  `email` varchar(255) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_fornecedor`
--

INSERT INTO `tb_fornecedor` (`id`, `fornecedor`, `razao_social`, `cnpj`, `insc_estadual`, `endereco`, `bairro`, `telefone`, `cidade`, `estado`, `situacao`, `email`, `data_cadastro`) VALUES
(1, 'COFAP', '123456789', '12.123.123/0001-42', '', 'rua do doido', 'barracao', '61-98765432', 'brasolia', 'Di', 'Ativa', 'cofap@cofap.com', '2024-11-06 00:27:18');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_funcionario`
--

CREATE TABLE `tb_funcionario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `genero` varchar(30) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `matricula` varchar(8) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `nivel_acesso` varchar(50) NOT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_funcionario`
--

INSERT INTO `tb_funcionario` (`id`, `nome`, `email`, `genero`, `data_nascimento`, `matricula`, `cargo`, `nivel_acesso`, `telefone`, `foto`, `data_cadastro`) VALUES
(1, 'gerente', 'leonardo.amorim2011@gmail.com', 'Masculino', '2024-10-02', '15151', 'Gerente', 'gerente', NULL, '../uploads/profile2.png', '2024-10-25 00:05:59'),
(4, 'teste', 'leonardo@teste.com.br', 'Masculino', '1212-12-12', '20201', 'Administrador', 'vendedor', '(61) 99666-5656', '../uploads/d76f10594ad2892af3f01399bad945d9.jpg', '2024-10-30 01:15:42'),
(5, 'teste2', 'leonardo2@teste.com.br', 'Masculino', '3232-02-13', '90413400', 'Administrador', 'Gerente', NULL, NULL, '2024-10-30 01:16:31'),
(6, 'teste3', 'leonardo3@teste.com.br', 'Masculino', '1212-12-12', '84880904', 'Administrador', 'Gerente', '(61) 99666-5656', NULL, '2024-10-30 01:16:55'),
(7, 'teste5', 'leonardo5@teste.com.br', 'Feminino', '1212-12-12', '26133070', 'Administrador', 'Gerente', '(61) 99666-5656', '../uploads/profile.png', '2024-10-30 01:21:45'),
(8, 'teste6', 'leonardo6@teste.com.br', 'Feminino', '1212-12-12', '24149930', 'Administrador', 'Gerente', '(61) 99666-5656', '../uploads/profile2.png', '2024-10-30 01:23:05');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_login`
--

CREATE TABLE `tb_login` (
  `id` int(11) NOT NULL,
  `matricula` varchar(8) NOT NULL,
  `password` varchar(200) NOT NULL,
  `permissao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_login`
--

INSERT INTO `tb_login` (`id`, `matricula`, `password`, `permissao`) VALUES
(1, '15151', '$2y$10$k5gFgEh7GUhHCCuqD4p6q.sGpp0cQvx0mv0kuQsd3w//6BoDKnOAa', 'gerente'),
(2, '20201', '$2y$10$HE8Pf4Tn0.SF9JbQe/krpOxBrrq6o58OuZW1NHbQxgGIpU.Dx.mye', 'vendedor'),
(5, '30301', '$2y$10$k5gFgEh7GUhHCCuqD4p6q.sGpp0cQvx0mv0kuQsd3w//6BoDKnOAa', 'estoquista'),
(8, '31708375', '$2y$10$8S8//3ZcaSZLzQSmUT0RDOqmMkxYn66yJsNDZENIcEIeC9Ak5oE86', 'Gerente'),
(9, '90413400', '$2y$10$Ix7w8meZ4ScmJ7SC7RFRZOw1D7wPpf2oNTlCRMJfN6Xbfg4.rf2bS', 'Gerente'),
(10, '84880904', '$2y$10$LWhKeOuJtucw8vWAYdEmNeLMsLdQBaflzReVthp/cYkLkMdWJFmSq', 'Gerente'),
(11, '26133070', '$2y$10$pBYL2ynHyhXglHJPWEYd8O/hS9RUTdjExT/dJIIVIb54L6KABzgiO', 'Gerente'),
(12, '24149930', '$2y$10$OtxnGGNmRUU/cwb84LfNeuOcy5ULiWH40pgabVhoMg64SzS8GYsSW', 'Gerente');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_produto`
--

CREATE TABLE `tb_produto` (
  `id` int(11) NOT NULL,
  `codigo_produto` varchar(50) NOT NULL,
  `fornecedor` varchar(100) NOT NULL,
  `nome_peca` varchar(150) NOT NULL,
  `peso` decimal(10,2) DEFAULT NULL,
  `valor_varejo` decimal(10,2) DEFAULT NULL,
  `modelo_carro` varchar(100) DEFAULT NULL,
  `marca_fabricante` varchar(100) DEFAULT NULL,
  `descricao_peca` text DEFAULT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_produto`
--

INSERT INTO `tb_produto` (`id`, `codigo_produto`, `fornecedor`, `nome_peca`, `peso`, `valor_varejo`, `modelo_carro`, `marca_fabricante`, `descricao_peca`, `data_cadastro`) VALUES
(1, 'A1B2C3', 'COFAP', 'BIELA', 1.00, 10.00, 'SEDAN', 'FIAT', 'detalhe', '2024-11-06 02:01:25'),
(2, 'D1F2G3', 'COFAP', 'PNEU', 2.00, 50.00, 'SEDAN', 'FIAT', 'detalhe do pneu', '2024-11-06 02:02:24');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_veiculo`
--

CREATE TABLE `tb_veiculo` (
  `id` int(11) NOT NULL,
  `fabricante` varchar(255) NOT NULL,
  `veiculo` varchar(255) NOT NULL,
  `tipo_motor` varchar(100) NOT NULL,
  `ano_lancamento` year(4) NOT NULL,
  `ano_encerramento` year(4) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `item_agregado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_veiculo`
--

INSERT INTO `tb_veiculo` (`id`, `fabricante`, `veiculo`, `tipo_motor`, `ano_lancamento`, `ano_encerramento`, `modelo`, `item_agregado`) VALUES
(1, 'FIAT', 'SIENA', '1', '2000', '2020', 'SEDAN', 'ABS');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_cargos`
--
ALTER TABLE `tb_cargos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissao` (`permissao`);

--
-- Índices de tabela `tb_cliente`
--
ALTER TABLE `tb_cliente`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_compra`
--
ALTER TABLE `tb_compra`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_estoque`
--
ALTER TABLE `tb_estoque`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fornecedor` (`fornecedor`);

--
-- Índices de tabela `tb_fornecedor`
--
ALTER TABLE `tb_fornecedor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cnpj` (`cnpj`),
  ADD KEY `fornecedor` (`fornecedor`);

--
-- Índices de tabela `tb_funcionario`
--
ALTER TABLE `tb_funcionario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nivel_acesso` (`nivel_acesso`),
  ADD KEY `matricula` (`matricula`);

--
-- Índices de tabela `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_login` (`permissao`),
  ADD KEY `matricula` (`matricula`);

--
-- Índices de tabela `tb_produto`
--
ALTER TABLE `tb_produto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_fornecedor` (`fornecedor`),
  ADD KEY `fk_modelo_carro` (`modelo_carro`),
  ADD KEY `fk_fabricante` (`marca_fabricante`);

--
-- Índices de tabela `tb_veiculo`
--
ALTER TABLE `tb_veiculo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modelo` (`modelo`),
  ADD KEY `fabricante` (`fabricante`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_cargos`
--
ALTER TABLE `tb_cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `tb_cliente`
--
ALTER TABLE `tb_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `tb_compra`
--
ALTER TABLE `tb_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `tb_estoque`
--
ALTER TABLE `tb_estoque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `tb_fornecedor`
--
ALTER TABLE `tb_fornecedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `tb_funcionario`
--
ALTER TABLE `tb_funcionario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `tb_produto`
--
ALTER TABLE `tb_produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de tabela `tb_veiculo`
--
ALTER TABLE `tb_veiculo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tb_estoque`
--
ALTER TABLE `tb_estoque`
  ADD CONSTRAINT `fk_fornecedor` FOREIGN KEY (`fornecedor`) REFERENCES `tb_fornecedor` (`fornecedor`);

--
-- Restrições para tabelas `tb_funcionario`
--
ALTER TABLE `tb_funcionario`
  ADD CONSTRAINT `fk_matricula` FOREIGN KEY (`matricula`) REFERENCES `tb_login` (`matricula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nivel_acesso` FOREIGN KEY (`nivel_acesso`) REFERENCES `tb_cargos` (`permissao`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_login`
--
ALTER TABLE `tb_login`
  ADD CONSTRAINT `fk_login` FOREIGN KEY (`permissao`) REFERENCES `tb_cargos` (`permissao`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_produto`
--
ALTER TABLE `tb_produto`
  ADD CONSTRAINT `fk_fabricante` FOREIGN KEY (`marca_fabricante`) REFERENCES `tb_veiculo` (`fabricante`),
  ADD CONSTRAINT `fk_id_fornecedor` FOREIGN KEY (`fornecedor`) REFERENCES `tb_fornecedor` (`fornecedor`),
  ADD CONSTRAINT `fk_modelo_carro` FOREIGN KEY (`modelo_carro`) REFERENCES `tb_veiculo` (`modelo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
