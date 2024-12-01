-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/12/2024 às 20:38
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
-- Estrutura para tabela `aceita_documento`
--

CREATE TABLE `aceita_documento` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nome_usuario` varchar(255) DEFAULT NULL,
  `data_aceite` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aceita_documento`
--

INSERT INTO `aceita_documento` (`id`, `usuario_id`, `nome_usuario`, `data_aceite`) VALUES
(41, 0, 'felipe', '2024-11-27 17:09:01'),
(42, 0, 'ana', '2024-11-27 19:29:03'),
(43, 0, 'carlos', '2024-11-29 18:26:24'),
(44, 0, 'boladao', '2024-11-30 22:31:24'),
(45, 0, 'boladao', '2024-11-30 23:00:14'),
(46, 0, 'miguel', '2024-12-01 16:11:56');

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagens`
--

CREATE TABLE `mensagens` (
  `id` int(11) NOT NULL,
  `conteudo` text NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `mensagens`
--

INSERT INTO `mensagens` (`id`, `conteudo`, `data_criacao`) VALUES
(21, '<p>Boa noite!<br>estaremos realizado update da versão!</p><p>Att,<br>Gerencia</p>', '2024-11-20 23:17:16'),
(22, '<p>Boa noite!<br>estaremos realizado update da versão!</p><p>&nbsp;</p><p>Att,<br>Gerência</p>', '2024-11-20 23:17:56'),
(23, '<p>Boa noite!<br>Estaremos realizado update da versão!</p><p><br>Gerência</p>', '2024-11-20 23:18:23'),
(24, '<p>Boa noite!</p><p>Estaremos passando por manutenção!<br><br><br>Grato a gerência.</p>', '2024-11-20 23:20:31');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_cargos`
--

CREATE TABLE `tb_cargos` (
  `id` int(11) NOT NULL,
  `cargo` enum('gerente','vendedor','estoquista','caixa','separador','administrador') NOT NULL,
  `permissao` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_cargos`
--

INSERT INTO `tb_cargos` (`id`, `cargo`, `permissao`) VALUES
(1, 'gerente', 'Gerente'),
(2, 'vendedor', 'Vendedor'),
(3, 'estoquista', 'Estoquista'),
(4, 'caixa', 'Caixa'),
(5, 'separador', 'Separador'),
(7, 'administrador', 'Administrador');

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
  `uf` varchar(2) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `email` varchar(70) NOT NULL,
  `rginscricao` varchar(50) NOT NULL,
  `sitcad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_cliente`
--

INSERT INTO `tb_cliente` (`id`, `cpf_cnpj`, `razao_nome`, `cep`, `cidade`, `endereco`, `complemento`, `bairro`, `uf`, `telefone`, `email`, `rginscricao`, `sitcad`) VALUES
(98, '704.211.371-34', 'BOLADAOasda', '72241-624', 'Brasília', 'Quadra QNP 15 Conjunto Z', '14', 'Ceilândia Norte (Ceilândia)', 'DF', '(61) 99666-5656', 'leonardasaso6@teste.com.br', '201030', 'Ativo'),
(99, '121.212.121-21', 'BOLADAOasdasdasd', '72241-624', 'Brasília', 'Quadra QNP 15 Conjunto Z', '14', 'Ceilândia Norte (Ceilândia)', 'DF', '(61) 99666-5656', 'coasaddasdfap@cofap.com', '201030', 'Ativo'),
(100, '123.123.121-22', 'BOLADAOasdasd', '72241-624', 'Brasília', 'Quadra QNP 15 Conjunto Z', '15', 'Ceilândia Norte (Ceilândia)', 'DF', '(61) 99666-5656', 'leonardo6@teste.com.br', '201030', 'Ativo'),
(102, '123.456.789-01', 'Maria Silva', '12345678', 'São Paulo', 'Rua Maria 123', 'Apto 101', 'Centro', 'SP', '912345678', 'maria.silva@email.com', 'MG-123456', 'Ativo'),
(103, '123.456.789-02', 'João Souza', '23456789', 'Rio de Janeiro', 'Avenida João 456', 'Casa 2', 'Copacabana', 'RJ', '923456789', 'joao.souza@email.com', 'RJ-234567', 'Ativo'),
(104, '123.456.789-03', 'Ana Costa', '34567890', 'Belo Horizonte', 'Rua Ana 789', 'Apto 202', 'Savassi', 'MG', '934567890', 'ana.costa@email.com', 'SP-345678', 'Ativo'),
(105, '123.456.789-04', 'Carlos Oliveira', '45678901', 'Curitiba', 'Rua Carlos 101', 'Bloco B', 'Batel', 'PR', '945678901', 'carlos.oliveira@email.com', 'PR-456789', 'Ativo'),
(106, '123.456.789-05', 'Luiza Pereira', '56789012', 'Porto Alegre', 'Avenida Luiza 202', 'Sala 303', 'Centro', 'RS', '956789012', 'luiza.pereira@email.com', 'RS-567890', 'Ativo'),
(107, '123.456.789-06', 'Pedro Almeida', '67890123', 'Recife', 'Rua Pedro 303', 'Casa 5', 'Boa Viagem', 'PE', '967890123', 'pedro.almeida@email.com', 'PE-678901', 'Ativo'),
(108, '123.456.789-07', 'Fernanda Rodrigues', '78901234', 'Fortaleza', 'Avenida Fernanda 404', 'Apto 404', 'Meireles', 'CE', '978901234', 'fernanda.rodrigues@email.com', 'CE-789012', 'Ativo'),
(109, '123.456.789-08', 'Roberto Costa', '89012345', 'Salvador', 'Rua Roberto 505', 'Bloco A', 'Barra', 'BA', '989012345', 'roberto.costa@email.com', 'BA-890123', 'Ativo'),
(110, '123.456.789-09', 'Lucas Ferreira', '90123456', 'Brasília', 'Rua Lucas 606', 'Apto 101', 'Asa Norte', 'DF', '900123456', 'lucas.ferreira@email.com', 'DF-901234', 'Ativo'),
(111, '123.456.789-10', 'Juliana Silva', '01234567', 'Manaus', 'Avenida Juliana 707', 'Apto 303', 'Centro', 'AM', '911234567', 'juliana.silva@email.com', 'AM-012345', 'Ativo'),
(112, '123.456.789-11', 'Marcos Santos', '23456789', 'São Paulo', 'Rua Marcos 101', 'Apto 102', 'Jardim Paulista', 'SP', '912345678', 'marcos.santos@email.com', 'SP-234567', 'Ativo'),
(113, '123.456.789-12', 'Tatiane Lima', '34567890', 'Rio de Janeiro', 'Avenida Tatiane 202', 'Casa 4', 'Lapa', 'RJ', '923456789', 'tatiane.lima@email.com', 'RJ-345678', 'Ativo'),
(114, '123.456.789-13', 'Gustavo Silva', '11223344', 'São Paulo', 'Rua Gustavo 808', 'Casa 5', 'Pinheiros', 'SP', '923456789', 'gustavo.silva@email.com', 'SP-123456', 'Ativo'),
(115, '123.456.789-14', 'Carla Costa', '22334455', 'Rio de Janeiro', 'Avenida Carla 909', 'Apto 505', 'Leblon', 'RJ', '934567890', 'carla.costa@email.com', 'RJ-234567', 'Ativo'),
(116, '123.456.789-15', 'Renato Oliveira', '33445566', 'Belo Horizonte', 'Rua Renato 1010', 'Bloco C', 'Pampulha', 'MG', '945678901', 'renato.oliveira@email.com', 'MG-345678', 'Ativo'),
(117, '123.456.789-16', 'Jéssica Santos', '44556677', 'Curitiba', 'Rua Jéssica 2020', 'Sala 303', 'Centro', 'PR', '956789012', 'jessica.santos@email.com', 'PR-456789', 'Ativo'),
(118, '123.456.789-17', 'Thiago Pereira', '55667788', 'Porto Alegre', 'Avenida Thiago 3030', 'Apto 101', 'Moinhos de Vento', 'RS', '967890123', 'thiago.pereira@email.com', 'RS-567890', 'Ativo'),
(119, '123.456.789-18', 'Isabela Almeida', '66778899', 'Recife', 'Rua Isabela 4040', 'Casa 9', 'Boa Viagem', 'PE', '978901234', 'isabela.almeida@email.com', 'PE-678901', 'Ativo'),
(120, '123.456.789-19', 'Felipe Rodrigues', '77889900', 'Fortaleza', 'Avenida Felipe 5050', 'Apto 202', 'Aldeota', 'CE', '989012345', 'felipe.rodrigues@email.com', 'CE-789012', 'Ativo'),
(121, '123.456.789-20', 'Vânia Silva', '88990011', 'Salvador', 'Rua Vânia 6060', 'Bloco B', 'Barra', 'BA', '900123456', 'vania.silva@email.com', 'BA-890123', 'Ativo'),
(122, '123.456.789-21', 'Rafael Ferreira', '99001122', 'Brasília', 'Rua Rafael 7070', 'Apto 303', 'Asa Sul', 'DF', '911234567', 'rafael.ferreira@email.com', 'DF-901234', 'Ativo'),
(123, '123.456.789-22', 'Patrícia Costa', '00112233', 'Manaus', 'Avenida Patrícia 8080', 'Apto 505', 'Centro', 'AM', '922345678', 'patricia.costa@email.com', 'AM-012345', 'Ativo'),
(124, '123.456.789-23', 'Leandro Lima', '11223344', 'São Paulo', 'Rua Leandro 9090', 'Bloco D', 'Vila Progredior', 'SP', '933456789', 'leandro.lima@email.com', 'SP-123457', 'Ativo'),
(125, '123.456.789-24', 'Bruna Santos', '22334455', 'Rio de Janeiro', 'Avenida Bruna 1010', 'Casa 6', 'Ipanema', 'RJ', '944567890', 'bruna.santos@email.com', 'RJ-234568', 'Ativo'),
(126, '123.456.789-25', 'Walter Souza', '33445566', 'Belo Horizonte', 'Rua Walter 2020', 'Sala 404', 'Lourdes', 'MG', '955678901', 'walter.souza@email.com', 'MG-345679', 'Ativo'),
(127, '123.456.789-26', 'Mônica Oliveira', '44556677', 'Curitiba', 'Rua Mônica 3030', 'Apto 101', 'Cabral', 'PR', '966789012', 'monica.oliveira@email.com', 'PR-456790', 'Ativo'),
(128, '123.456.789-27', 'José Pereira', '55667788', 'Porto Alegre', 'Avenida José 4040', 'Bloco C', 'Vila Flores', 'RS', '977890123', 'jose.pereira@email.com', 'RS-567891', 'Ativo'),
(129, '123.456.789-28', 'Cecília Almeida', '66778899', 'Recife', 'Rua Cecília 5050', 'Casa 8', 'Caxangá', 'PE', '988901234', 'cecilia.almeida@email.com', 'PE-678902', 'Ativo'),
(130, '123.456.789-29', 'Rodrigo Rodrigues', '77889900', 'Fortaleza', 'Avenida Rodrigo 6060', 'Apto 204', 'Meireles', 'CE', '999012345', 'rodrigo.rodrigues@email.com', 'CE-789013', 'Ativo'),
(131, '123.456.789-30', 'Débora Silva', '88990011', 'Salvador', 'Rua Débora 7070', 'Bloco A', 'Stella Maris', 'BA', '900123456', 'debora.silva@email.com', 'BA-890124', 'Ativo'),
(132, '123.456.789-31', 'Daniel Ferreira', '99001122', 'Brasília', 'Rua Daniel 8080', 'Apto 404', 'Águas Claras', 'DF', '911234567', 'daniel.ferreira@email.com', 'DF-901235', 'Ativo'),
(133, '123.456.789-32', 'Paula Costa', '00112233', 'Manaus', 'Avenida Paula 9090', 'Apto 202', 'Adrianópolis', 'AM', '922345678', 'paula.costa@email.com', 'AM-012346', 'Ativo'),
(134, '123.456.789-33', 'Mário Lima', '11223344', 'São Paulo', 'Rua Mário 1010', 'Casa 3', 'Vila Progredior', 'SP', '933456789', 'mario.lima@email.com', 'SP-123458', 'Ativo'),
(135, '123.456.789-34', 'Carlos Martins', '22334455', 'São Paulo', 'Rua Carlos 9090', 'Bloco A', 'Itaim Bibi', 'SP', '934567890', 'carlos.martins@email.com', 'SP-123459', 'Ativo'),
(136, '123.456.789-35', 'Cláudia Ribeiro', '33445566', 'Rio de Janeiro', 'Avenida Cláudia 1010', 'Apto 808', 'Copacabana', 'RJ', '945678901', 'claudia.ribeiro@email.com', 'RJ-234570', 'Ativo'),
(137, '123.456.789-36', 'Alexandre Souza', '44556677', 'Belo Horizonte', 'Rua Alexandre 2020', 'Casa 4', 'Savassi', 'MG', '956789012', 'alexandre.souza@email.com', 'MG-345680', 'Ativo'),
(138, '123.456.789-37', 'Marta Lima', '55667788', 'Curitiba', 'Rua Marta 3030', 'Apto 303', 'Batel', 'PR', '967890123', 'marta.lima@email.com', 'PR-456791', 'Ativo'),
(139, '123.456.789-38', 'Eduardo Pereira', '66778899', 'Porto Alegre', 'Avenida Eduardo 4040', 'Bloco E', 'Vila Nova', 'RS', '978901234', 'eduardo.pereira@email.com', 'RS-567892', 'Ativo'),
(140, '123.456.789-39', 'Patrícia Costa', '77889900', 'Recife', 'Rua Patrícia 5050', 'Sala 607', 'Campo Grande', 'PE', '989012345', 'patricia.costa@email.com', 'PE-678903', 'Ativo'),
(141, '123.456.789-40', 'Rogério Almeida', '88990011', 'Salvador', 'Rua Rogério 6060', 'Casa 3', 'Pituba', 'BA', '900123456', 'rogerio.almeida@email.com', 'BA-890125', 'Ativo'),
(142, '123.456.789-41', 'Sandra Oliveira', '99001122', 'Brasília', 'Rua Sandra 7070', 'Apto 404', 'Taguatinga', 'DF', '911234567', 'sandra.oliveira@email.com', 'DF-901236', 'Ativo'),
(143, '123.456.789-42', 'Vitor Costa', '00112233', 'Manaus', 'Avenida Vitor 8080', 'Bloco F', 'Adrianópolis', 'AM', '922345678', 'vitor.costa@email.com', 'AM-012347', 'Ativo'),
(144, '123.456.789-43', 'Silvia Almeida', '11223344', 'São Paulo', 'Rua Silvia 9090', 'Apto 505', 'Liberdade', 'SP', '933456789', 'silvia.almeida@email.com', 'SP-123460', 'Ativo'),
(145, '123.456.789-44', 'Gustavo Souza', '22334455', 'Rio de Janeiro', 'Avenida Gustavo 1010', 'Casa 6', 'Botafogo', 'RJ', '944567890', 'gustavo.souza@email.com', 'RJ-234571', 'Ativo'),
(146, '123.456.789-45', 'Juliana Costa', '33445566', 'Belo Horizonte', 'Rua Juliana 2020', 'Bloco A', 'Centro', 'MG', '955678901', 'juliana.costa@email.com', 'MG-345681', 'Ativo'),
(147, '123.456.789-46', 'André Lima', '44556677', 'Curitiba', 'Rua André 3030', 'Apto 101', 'Centro', 'PR', '966789012', 'andre.lima@email.com', 'PR-456792', 'Ativo'),
(149, '123.456.789-48', 'Thiago Ferreira', '66778899', 'Recife', 'Rua Thiago 5050', 'Casa 1', 'Boa Vista', 'PE', '988901234', 'thiago.ferreira@email.com', 'PE-678904', 'Ativo'),
(150, '123.456.789-49', 'Roberta Oliveira', '77889900', 'Salvador', 'Avenida Roberta 6060', 'Apto 202', 'Graça', 'BA', '999012345', 'roberta.oliveira@email.com', 'BA-890126', 'Ativo'),
(151, '123.456.789-50', 'Daniela Souza', '88990011', 'Brasília', 'Rua Daniela 7070', 'Bloco D', 'Ceilândia', 'DF', '900123456', 'daniela.souza@email.com', 'DF-901237', 'Ativo'),
(152, '123.456.789-51', 'Ricardo Ferreira', '99001122', 'Manaus', 'Rua Ricardo 8080', 'Casa 5', 'Flores', 'AM', '911234567', 'ricardo.ferreira@email.com', 'AM-012348', 'Ativo'),
(153, '123.456.789-52', 'Fábio Lima', '00112233', 'São Paulo', 'Rua Fábio 9090', 'Bloco E', 'Jardim Paulista', 'SP', '922345678', 'fabio.lima@email.com', 'SP-123461', 'Ativo'),
(164, '789.888.987-77', 'Felipe', '72241-624', 'Brasília', 'Quadra QNP 15 Conjunto Z', '14', 'Ceilândia Norte (Ceilândia)', 'DF', '(61) 99666-5656', 'felipe@gmail.com', '123', 'Ativo'),
(165, '888.555.544-44', 'ana', '72241-624', 'Brasília', 'Quadra QNP 15 Conjunto Z', '14', 'Ceilândia Norte (Ceilândia)', 'DF', '(61) 99666-5656', 'ana@cofap.com', '123', 'Ativo'),
(166, '888.777.666-11', 'Ana', '44444-444', 'Santo Antônio de Jesus', 'Rua Via Coletora B', '14', 'Nossa Senhora das Graças', 'BA', '(61) 99666-5656', 'ana@cofap.com', '123123', 'Ativo'),
(167, '999.888.777-66', 'Carlos', '44444-444', 'Santo Antônio de Jesus', 'Rua Via Coletora B', '14', 'Nossa Senhora das Graças', 'BA', '(61) 99666-5656', 'carlos@teste.com', '123123', 'Ativo'),
(168, '888.999.999-77', 'WESLEY', '44444-444', 'Santo Antônio de Jesus', 'Rua Via Coletora B', '14', 'Nossa Senhora das Graças', 'BA', '(61) 99666-5656', 'vendedwwwor@teste.com', '123123', 'Ativo'),
(169, '704.211.371-88', 'BOLADAO', '72241-624', 'Brasília', 'Quadra QNP 15 Conjunto Z', '44', 'Ceilândia Norte (Ceilândia)', 'DF', '(61) 99666-5656', 'vessndedor@teste.com', '123', 'Ativo'),
(170, '111.111.222-22', 'Miguel', '72241-624', 'Brasília', 'Quadra QNP 15 Conjunto Z', '14', 'Ceilândia Norte (Ceilândia)', 'DF', '(61) 99666-5656', 'vendedor@teste.com', '123123', 'Ativo');

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
  `update` int(1) NOT NULL,
  `entrega` int(1) NOT NULL,
  `data_compra` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_compra`
--

INSERT INTO `tb_compra` (`id`, `cliente_cpfcnpj`, `cliente_nome`, `produto_nome`, `quantidade`, `valor_unitario`, `valor_total`, `forma_pagamento`, `finalizado`, `update`, `entrega`, `data_compra`) VALUES
(3, '704.211.371-34', 'NOME DA CASA', 'Pneu', 3, 617.74, 1853.22, 'dinheiro', 1, 0, 0, '2024-10-29 19:43:21'),
(4, '704.211.371-34', 'NOME DA CASA', 'Cabo de Freio', 2, 327.08, 654.16, 'pix', 1, 0, 0, '2024-10-29 19:45:43'),
(5, '704.211.371-34', 'NOME DA CASA', 'Pneu', 1, 364.33, 364.33, 'pix', 1, 0, 0, '2024-10-29 19:47:46'),
(6, '704.211.371-34', 'NOME DA CASA', 'Cabo de Freio', 1, 327.08, 327.08, 'pix', 1, 0, 0, '2024-10-29 19:48:51'),
(10, '704.211.371-34', 'NOME DA CASA', 'Válvula', 1, 452.45, 452.45, 'dinheiro', 1, 0, 0, '2024-10-29 19:55:05'),
(11, '704.211.371-34', 'NOME DA CASA', 'Cabo de Freio', 2, 327.08, 654.16, 'pix', 1, 0, 0, '2024-10-29 19:55:32'),
(12, '704.211.371-34', 'NOME DA CASA', 'Pneu', 2, 617.74, 1235.48, 'dinheiro', 1, 0, 0, '2024-10-29 22:58:03'),
(13, '704.211.371-34', 'NOME DA CASA', 'Pneu', 1, 364.33, 364.33, 'pix', 1, 0, 0, '2024-10-29 22:58:10'),
(14, '704.211.371-34', 'NOME DA CASA', 'Cabo de Freio', 1, 327.08, 327.08, 'pix', 1, 0, 0, '2024-10-30 00:12:50'),
(15, '704.211.371-34', 'NOME DA CASA', 'Carter', 1, 883.05, 883.05, 'pix', 1, 0, 0, '2024-10-30 00:12:50'),
(16, '704.211.371-34', 'NOME DA CASA', 'Válvula', 1, 452.45, 452.45, 'pix', 1, 0, 0, '2024-10-30 00:12:50'),
(17, '704.211.371-34', 'NOME DA CASA', 'Pneu', 1, 617.74, 617.74, 'dinheiro', 1, 1, 1, '2024-10-30 00:13:56'),
(18, '704.211.371-34', 'NOME DA CASA', 'Pneu', 1, 364.33, 364.33, 'dinheiro', 1, 1, 1, '2024-10-30 00:13:56'),
(19, '12345678901', 'Nome do Cliente', 'Produto 1', 2, 50.00, 100.00, 'pix', 1, 1, 1, '2024-10-30 00:49:09'),
(20, '12345678901', 'Nome do Cliente', 'Produto 2', 1, 30.00, 30.00, 'pix', 1, 1, 1, '2024-10-30 00:49:09'),
(21, '704.211.371-34', 'NOME DA CASA', 'Pneu', 1, 617.74, 617.74, 'cartao_credito', 1, 0, 0, '2024-10-30 00:51:28'),
(22, '704.211.371-34', 'NOME DA CASA', 'Cabo de Freio', 1, 327.08, 327.08, 'cartao_credito', 1, 0, 0, '2024-10-30 00:51:28'),
(23, '704.211.371-34', 'NOME DA CASA', 'Válvula', 1, 452.45, 452.45, 'cartao_credito', 1, 1, 0, '2024-10-30 00:51:28'),
(24, '704.211.371-34', 'NOME DA CASA', 'Pneu', 3, 617.74, 1853.22, 'pix', 1, 0, 0, '2024-10-30 01:29:50'),
(25, '704.211.371-34', 'NOME DA CASA', 'Cabo de Freio', 3, 327.08, 981.24, 'pix', 1, 0, 0, '2024-10-30 01:29:50'),
(38, '704.211.371-29', 'dasda', 'BIELA', 1, 10.00, 10.00, 'dinheiro', 1, 1, 1, '2024-11-16 01:14:20'),
(39, '704.211.371-29', 'dasda', 'Amortecedor Dianteiro', 1, 200.00, 200.00, 'dinheiro', 1, 1, 1, '2024-11-16 01:14:20'),
(40, '704.211.371-29', 'dasda', 'Amortecedor Dianteiro', 4, 200.00, 800.00, 'cartao_credito', 1, 1, 0, '2024-11-16 01:15:24'),
(41, '704.211.371-29', 'dasda', 'PNEU1', 5, 50.00, 250.00, 'cartao_credito', 1, 1, 0, '2024-11-17 01:15:24'),
(42, '704.211.371-30', 'BOLADAO6546', 'PNEU1', 4, 50.00, 200.00, 'cartao_credito', 1, 0, 0, '2024-11-16 01:16:28'),
(43, '704.211.371-30', 'BOLADAO6546', 'Amortecedor Dianteiro', 4, 200.00, 800.00, 'cartao_credito', 1, 1, 0, '2024-11-16 01:16:28'),
(44, '704.211.371-10', 'BOLADAO', 'PNEU1', 3, 50.00, 150.00, 'pix', 1, 1, 0, '2024-11-17 01:17:08'),
(45, '704.211.371-10', 'BOLADAO', 'Amortecedor Dianteiro', 6, 200.00, 1200.00, 'pix', 1, 1, 0, '2024-11-17 01:17:08'),
(46, '123.456.789-12', 'Tatiane Lima', 'PNEU1', 2, 50.00, 100.00, 'dinheiro', 1, 1, 1, '2024-11-16 01:18:10'),
(47, '123.456.789-12', 'Tatiane Lima', 'Amortecedor Dianteiro', 2, 200.00, 400.00, 'dinheiro', 1, 1, 1, '2024-11-17 01:18:10'),
(48, '704.211.371-34', 'BOLADAOasda', 'PNEU1', 4, 50.00, 200.00, 'dinheiro', 1, 0, 0, '2024-11-16 13:29:59'),
(49, '704.211.371-34', 'BOLADAOasda', 'PNEU1', 2, 50.00, 100.00, 'pix', 1, 1, 1, '2024-11-16 23:55:17'),
(50, '704.211.371-34', 'BOLADAOasda', 'Amortecedor Dianteiro', 2, 200.00, 400.00, 'pix', 1, 1, 1, '2024-11-16 23:55:17'),
(51, '704.211.371-34', 'BOLADAOasda', 'BIELA', 2, 10.00, 20.00, 'pix', 1, 1, 1, '2024-11-16 23:55:17'),
(52, '704.211.371-29', 'dasda', 'PNEU1', 6, 50.00, 300.00, 'cartao_credito', 1, 1, 0, '2024-11-16 23:55:41'),
(53, '', '', 'PNEU1', 1, 50.00, 50.00, 'pix', 1, 1, 0, '2024-11-24 16:11:09'),
(54, '999.888.777-66', 'Carlos', 'PNEU1', 1, 50.00, 50.00, 'pix', 1, 1, 1, '2024-11-29 21:26:50'),
(55, '704.211.371-34', 'BOLADAOasda', 'Mangueira de Arrefecimento', 1, 50.00, 50.00, 'dinheiro', 1, 1, 1, '2024-11-30 14:58:21'),
(56, '704.211.371-34', 'BOLADAOasda', 'Pneu 175/65R14', 1, 400.00, 400.00, 'dinheiro', 1, 1, 1, '2024-11-30 14:58:21'),
(57, '704.211.371-34', 'BOLADAOasda', 'Filtro de Óleo', 1, 60.00, 60.00, 'dinheiro', 1, 0, 0, '2024-11-30 14:58:21'),
(58, '', '', 'Filtro de Ar', 3, 30.00, 90.00, 'dinheiro', 1, 0, 0, '2024-11-30 18:05:08'),
(59, '704.211.371-34', 'BOLADAOasda', 'Pneu 175/65R14', 1, 400.00, 400.00, 'pix', 1, 0, 0, '2024-11-30 22:12:03'),
(60, '704.211.371-34', 'BOLADAOasda', 'Disco de Freio', 3, 120.00, 360.00, 'pix', 1, 0, 0, '2024-11-30 22:12:03'),
(61, '704.211.371-34', 'BOLADAOasda', 'Pneu 175/65R14', 3, 400.00, 1200.00, 'dinheiro', 1, 0, 0, '2024-11-30 22:14:17'),
(62, '', '', 'Motor de Partida', 1, 850.00, 850.00, 'dinheiro', 1, 0, 0, '2024-11-30 22:35:37'),
(63, '', '', 'Correia Dentada', 1, 45.00, 45.00, 'dinheiro', 1, 0, 0, '2024-11-30 22:35:37'),
(64, '', '', 'Velas de Ignição', 1, 25.00, 25.00, 'dinheiro', 1, 0, 0, '2024-11-30 22:35:37'),
(65, '', '', 'Bomba de Combustível', 1, 450.00, 450.00, 'dinheiro', 1, 0, 0, '2024-11-30 22:35:37'),
(66, '704.211.371-34', 'BOLADAOasda', 'Pneu 175/65R14', 2, 400.00, 800.00, 'dinheiro', 1, 0, 0, '2024-12-01 19:30:29'),
(67, '111.111.222-22', 'Miguel', 'Pneu 175/65R14', 1, 400.00, 400.00, 'cartao_credito', 1, 0, 0, '2024-12-01 19:31:12'),
(68, '111.111.222-22', 'Miguel', 'Bateria Automotiva', 1, 300.00, 300.00, 'cartao_credito', 1, 0, 0, '2024-12-01 19:31:12'),
(69, '111.111.222-22', 'Miguel', 'Filtro de Combustível', 1, 35.00, 35.00, 'cartao_credito', 1, 0, 0, '2024-12-01 19:31:12'),
(70, '111.111.222-22', 'Miguel', 'Espelho Retrovisor', 1, 250.00, 250.00, 'cartao_credito', 1, 0, 0, '2024-12-01 19:31:12');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_dadosbanco`
--

CREATE TABLE `tb_dadosbanco` (
  `id` int(11) NOT NULL,
  `pix_key` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `merchant_name` varchar(255) NOT NULL,
  `merchant_city` varchar(255) NOT NULL,
  `txid` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_dadosbanco`
--

INSERT INTO `tb_dadosbanco` (`id`, `pix_key`, `description`, `merchant_name`, `merchant_city`, `txid`, `created_at`) VALUES
(1, 'leonardo.amorim2011@gmail.com', 'Pagamento de Compra', 'Guardian Control', 'Brasilia', 'PAGGUARDIAN', '2024-11-14 21:21:52');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_email`
--

CREATE TABLE `tb_email` (
  `id` int(11) NOT NULL,
  `host` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `smtp_secure` enum('TLS','SSL') NOT NULL,
  `port` int(11) NOT NULL,
  `from_email` varchar(255) NOT NULL,
  `from_name` varchar(255) NOT NULL,
  `smtp_debug` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_email`
--

INSERT INTO `tb_email` (`id`, `host`, `username`, `password`, `smtp_secure`, `port`, `from_email`, `from_name`, `smtp_debug`, `created_at`) VALUES
(1, 'lrn.nextpoint.com.br', 'guardian@lrn.nextpoint.com.br', 'Guardian2024!', 'TLS', 587, 'guardian@lrn.nextpoint.com.br', 'Guardian', 0, '2024-11-15 00:04:22');

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
  `nivel` varchar(100) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `fornecedor` varchar(255) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_estoque`
--

INSERT INTO `tb_estoque` (`id`, `codigo_peca`, `localizacao`, `corredor`, `posicao`, `nivel`, `quantidade`, `fornecedor`, `data_cadastro`) VALUES
(1, 'A1B2C3', 'Estoque A', 'Corredor B', 'GAVETA 1', 'A20', 30, 'COFAP', '2024-11-06 03:28:52'),
(2, '123ABC', 'Estoque B', 'Corredor A', 'GAVETA 2', 'A10', 10, 'COFAP', '2024-11-06 03:40:40'),
(3, 'PCA12500', 'Armazém 1', 'Corredor DO', 'Posição 119', 'Nível 2', 75, 'COFAP', '2024-11-11 14:30:00'),
(4, 'PCA12501', 'Armazém 2', 'Corredor DP', 'Posição 120', 'Nível 3', 90, 'COFAP', '2024-11-11 15:00:00'),
(5, 'PCA12502', 'Armazém 3', 'Corredor DQ', 'Posição 121', 'Nível 1', 110, 'COFAP', '2024-11-11 15:30:00'),
(6, 'PCA12503', 'Armazém 4', 'Corredor DR', 'Posição 122', 'Nível 2', 85, 'COFAP', '2024-11-11 16:00:00'),
(7, 'PCA12504', 'Armazém 1', 'Corredor DS', 'Posição 123', 'Nível 3', 100, 'COFAP', '2024-11-11 16:30:00'),
(8, 'PCA12505', 'Armazém 2', 'Corredor DT', 'Posição 124', 'Nível 1', 120, 'COFAP', '2024-11-11 17:00:00'),
(9, 'PCA12506', 'Armazém 3', 'Corredor DU', 'Posição 125', 'Nível 2', 130, 'COFAP', '2024-11-11 17:30:00'),
(10, 'PCA12507', 'Armazém 4', 'Corredor DV', 'Posição 126', 'Nível 3', 150, 'COFAP', '2024-11-11 18:00:00'),
(11, 'PCA12508', 'Armazém 1', 'Corredor DW', 'Posição 127', 'Nível 1', 160, 'COFAP', '2024-11-11 18:30:00'),
(12, 'PCA12509', 'Armazém 2', 'Corredor DX', 'Posição 128', 'Nível 2', 180, 'COFAP', '2024-11-11 19:00:00'),
(13, 'PCA12510', 'Armazém 3', 'Corredor DY', 'Posição 129', 'Nível 3', 110, 'COFAP', '2024-11-11 19:30:00'),
(14, 'PCA12511', 'Armazém 4', 'Corredor DZ', 'Posição 130', 'Nível 1', 90, 'COFAP', '2024-11-11 20:00:00'),
(15, 'PCA12512', 'Armazém 1', 'Corredor EA', 'Posição 131', 'Nível 2', 95, 'COFAP', '2024-11-11 20:30:00'),
(16, 'PCA12513', 'Armazém 2', 'Corredor EB', 'Posição 132', 'Nível 3', 100, 'COFAP', '2024-11-11 21:00:00'),
(17, 'PCA12514', 'Armazém 3', 'Corredor EC', 'Posição 133', 'Nível 1', 120, 'COFAP', '2024-11-11 21:30:00'),
(18, 'PCA12515', 'Armazém 4', 'Corredor ED', 'Posição 134', 'Nível 2', 130, 'COFAP', '2024-11-11 22:00:00'),
(19, 'PCA12516', 'Armazém 1', 'Corredor EE', 'Posição 135', 'Nível 3', 150, 'COFAP', '2024-11-11 22:30:00'),
(20, 'PCA12517', 'Armazém 2', 'Corredor EF', 'Posição 136', 'Nível 1', 160, 'COFAP', '2024-11-11 23:00:00'),
(21, 'PCA12518', 'Armazém 3', 'Corredor EG', 'Posição 137', 'Nível 2', 170, 'COFAP', '2024-11-11 23:30:00'),
(22, 'PCA12519', 'Armazém 4', 'Corredor EH', 'Posição 138', 'Nível 3', 180, 'COFAP', '2024-11-12 00:00:00'),
(23, 'PCA12520', 'Armazém 1', 'Corredor EI', 'Posição 139', 'Nível 1', 200, 'COFAP', '2024-11-12 00:30:00'),
(24, 'PCA12521', 'Armazém 2', 'Corredor EJ', 'Posição 140', 'Nível 2', 220, 'COFAP', '2024-11-12 01:00:00'),
(25, 'PCA12522', 'Armazém 3', 'Corredor EK', 'Posição 141', 'Nível 3', 240, 'COFAP', '2024-11-12 01:30:00'),
(26, 'PCA12523', 'Armazém 4', 'Corredor EL', 'Posição 142', 'Nível 1', 260, 'COFAP', '2024-11-12 02:00:00'),
(27, 'PCA12524', 'Armazém 1', 'Corredor EM', 'Posição 143', 'Nível 2', 280, 'COFAP', '2024-11-12 02:30:00'),
(28, 'PCA12525', 'Armazém 2', 'Corredor EN', 'Posição 144', 'Nível 3', 300, 'COFAP', '2024-11-12 03:00:00'),
(29, 'PCA12526', 'Armazém 3', 'Corredor EO', 'Posição 145', 'Nível 1', 320, 'COFAP', '2024-11-12 03:30:00'),
(30, 'PCA12527', 'Armazém 4', 'Corredor EP', 'Posição 146', 'Nível 2', 340, 'COFAP', '2024-11-12 04:00:00'),
(31, 'PCA12528', 'Armazém 1', 'Corredor EQ', 'Posição 147', 'Nível 3', 360, 'COFAP', '2024-11-12 04:30:00'),
(32, 'PCA12529', 'Armazém 2', 'Corredor ER', 'Posição 148', 'Nível 1', 380, 'COFAP', '2024-11-12 05:00:00'),
(33, 'PCA12530', 'Armazém 3', 'Corredor ES', 'Posição 149', 'Nível 2', 400, 'COFAP', '2024-11-12 05:30:00'),
(34, 'PCA12531', 'Armazém 4', 'Corredor ET', 'Posição 150', 'Nível 3', 420, 'COFAP', '2024-11-12 05:59:00'),
(35, 'PCA12532', 'Armazém 1', 'Corredor EU', 'Posição 151', 'Nível 1', 440, 'COFAP', '2024-11-12 06:30:00'),
(36, 'PCA12533', 'Armazém 2', 'Corredor EV', 'Posição 152', 'Nível 2', 460, 'COFAP', '2024-11-12 07:00:00'),
(37, 'PCA12534', 'Armazém 3', 'Corredor EW', 'Posição 153', 'Nível 3', 480, 'COFAP', '2024-11-12 07:30:00'),
(38, 'PCA12535', 'Armazém 4', 'Corredor EX', 'Posição 154', 'Nível 1', 500, 'COFAP', '2024-11-12 08:00:00'),
(39, 'PCA12536', 'Armazém 1', 'Corredor EY', 'Posição 155', 'Nível 2', 520, 'COFAP', '2024-11-12 08:30:00'),
(40, 'PCA12700', 'Armazém 1', 'Corredor DO', 'Posição 119', 'Nível 2', 75, 'COFAP', '2024-11-11 14:30:00'),
(41, 'PCA12501', 'Armazém 2', 'Corredor DP', 'Posição 120', 'Nível 3', 90, 'COFAP', '2024-11-11 15:00:00'),
(42, 'PCA12502', 'Armazém 3', 'Corredor DQ', 'Posição 121', 'Nível 1', 110, 'COFAP', '2024-11-11 15:30:00'),
(43, 'PCA12503', 'Armazém 4', 'Corredor DR', 'Posição 122', 'Nível 2', 85, 'COFAP', '2024-11-11 16:00:00'),
(44, 'PCA12504', 'Armazém 1', 'Corredor DS', 'Posição 123', 'Nível 3', 100, 'COFAP', '2024-11-11 16:30:00'),
(45, 'PCA12505', 'Armazém 2', 'Corredor DT', 'Posição 124', 'Nível 1', 120, 'COFAP', '2024-11-11 17:00:00'),
(46, 'PCA12506', 'Armazém 1', 'Corredor DU', 'Posição 125', 'Nível 2', 95, 'COFAP', '2024-11-11 17:30:00'),
(47, 'PCA12507', 'Armazém 2', 'Corredor DV', 'Posição 126', 'Nível 1', 80, 'COFAP', '2024-11-11 18:00:00'),
(48, 'PCA12508', 'Armazém 3', 'Corredor DW', 'Posição 127', 'Nível 3', 110, 'COFAP', '2024-11-11 18:30:00'),
(49, 'PCA12509', 'Armazém 4', 'Corredor DX', 'Posição 128', 'Nível 2', 120, 'COFAP', '2024-11-11 19:00:00'),
(50, 'PCA12510', 'Armazém 1', 'Corredor DY', 'Posição 129', 'Nível 1', 130, 'COFAP', '2024-11-11 19:30:00'),
(51, 'PCA12511', 'Armazém 2', 'Corredor DZ', 'Posição 130', 'Nível 3', 140, 'COFAP', '2024-11-11 20:00:00'),
(52, 'PCA12512', 'Armazém 3', 'Corredor DA', 'Posição 131', 'Nível 2', 150, 'COFAP', '2024-11-11 20:30:00'),
(53, 'PCA12513', 'Armazém 4', 'Corredor DB', 'Posição 132', 'Nível 1', 160, 'COFAP', '2024-11-11 21:00:00'),
(54, 'PCA12514', 'Armazém 1', 'Corredor DC', 'Posição 133', 'Nível 3', 170, 'COFAP', '2024-11-11 21:30:00'),
(55, 'PCA12515', 'Armazém 2', 'Corredor DD', 'Posição 134', 'Nível 2', 180, 'COFAP', '2024-11-11 22:00:00'),
(56, 'PCA12516', 'Armazém 3', 'Corredor DE', 'Posição 135', 'Nível 1', 190, 'COFAP', '2024-11-11 22:30:00'),
(57, 'PCA12517', 'Armazém 4', 'Corredor DF', 'Posição 136', 'Nível 3', 200, 'COFAP', '2024-11-11 23:00:00'),
(58, 'PCA12518', 'Armazém 1', 'Corredor DG', 'Posição 137', 'Nível 2', 210, 'COFAP', '2024-11-11 23:30:00'),
(59, 'PCA12519', 'Armazém 2', 'Corredor DH', 'Posição 138', 'Nível 1', 220, 'COFAP', '2024-11-12 00:00:00'),
(60, 'PCA12520', 'Armazém 3', 'Corredor DI', 'Posição 139', 'Nível 3', 230, 'COFAP', '2024-11-12 00:30:00'),
(61, 'PCA12521', 'Armazém 4', 'Corredor DJ', 'Posição 140', 'Nível 2', 240, 'COFAP', '2024-11-12 01:00:00'),
(62, 'PCA12522', 'Armazém 1', 'Corredor DK', 'Posição 141', 'Nível 1', 250, 'COFAP', '2024-11-12 01:30:00'),
(63, 'PCA12523', 'Armazém 2', 'Corredor DL', 'Posição 142', 'Nível 3', 260, 'COFAP', '2024-11-12 02:00:00'),
(64, 'PCA12524', 'Armazém 3', 'Corredor DM', 'Posição 143', 'Nível 2', 270, 'COFAP', '2024-11-12 02:30:00'),
(65, 'PCA12525', 'Armazém 4', 'Corredor DN', 'Posição 144', 'Nível 1', 280, 'COFAP', '2024-11-12 03:00:00'),
(66, 'PCA12526', 'Armazém 1', 'Corredor DO', 'Posição 145', 'Nível 3', 290, 'COFAP', '2024-11-12 03:30:00'),
(67, 'PCA12527', 'Armazém 2', 'Corredor DP', 'Posição 146', 'Nível 2', 300, 'COFAP', '2024-11-12 04:00:00'),
(68, 'PCA12528', 'Armazém 3', 'Corredor DQ', 'Posição 147', 'Nível 1', 310, 'COFAP', '2024-11-12 04:30:00'),
(69, 'PCA12529', 'Armazém 4', 'Corredor DR', 'Posição 148', 'Nível 3', 320, 'COFAP', '2024-11-12 05:00:00'),
(70, 'PCA12530', 'Armazém 1', 'Corredor DS', 'Posição 149', 'Nível 2', 330, 'COFAP', '2024-11-12 05:30:00'),
(71, 'PCA12531', 'Armazém 2', 'Corredor DT', 'Posição 150', 'Nível 1', 340, 'COFAP', '2024-11-12 06:00:00'),
(72, 'PCA12532', 'Armazém 3', 'Corredor DU', 'Posição 151', 'Nível 3', 350, 'COFAP', '2024-11-12 06:30:00'),
(73, 'PCA12533', 'Armazém 4', 'Corredor DV', 'Posição 152', 'Nível 2', 360, 'COFAP', '2024-11-12 07:00:00'),
(74, 'PCA12534', 'Armazém 1', 'Corredor DW', 'Posição 153', 'Nível 1', 370, 'COFAP', '2024-11-12 07:30:00'),
(75, 'PCA12535', 'Armazém 2', 'Corredor DX', 'Posição 154', 'Nível 3', 380, 'COFAP', '2024-11-12 08:00:00'),
(76, 'PCA12536', 'Armazém 3', 'Corredor DY', 'Posição 155', 'Nível 2', 390, 'COFAP', '2024-11-12 08:30:00'),
(77, 'PCA12537', 'Armazém 4', 'Corredor DZ', 'Posição 156', 'Nível 1', 400, 'COFAP', '2024-11-12 09:00:00'),
(78, 'PCA12538', 'Armazém 1', 'Corredor EA', 'Posição 157', 'Nível 3', 410, 'COFAP', '2024-11-12 09:30:00'),
(79, 'PCA12539', 'Armazém 2', 'Corredor EB', 'Posição 158', 'Nível 2', 420, 'COFAP', '2024-11-12 10:00:00'),
(80, 'PCA12540', 'Armazém 3', 'Corredor EC', 'Posição 159', 'Nível 1', 430, 'COFAP', '2024-11-12 10:30:00'),
(81, 'PCA12541', 'Armazém 4', 'Corredor ED', 'Posição 160', 'Nível 2', 440, 'COFAP', '2024-11-12 11:00:00'),
(82, 'PCA12542', 'Armazém 1', 'Corredor EE', 'Posição 161', 'Nível 1', 450, 'COFAP', '2024-11-12 11:30:00'),
(83, 'PCA12543', 'Armazém 2', 'Corredor EF', 'Posição 162', 'Nível 3', 460, 'COFAP', '2024-11-12 12:00:00'),
(84, 'PCA12544', 'Armazém 3', 'Corredor EG', 'Posição 163', 'Nível 2', 470, 'COFAP', '2024-11-12 12:30:00'),
(85, 'PCA12545', 'Armazém 4', 'Corredor EH', 'Posição 164', 'Nível 1', 480, 'COFAP', '2024-11-12 13:00:00'),
(86, 'PCA12546', 'Armazém 1', 'Corredor EI', 'Posição 165', 'Nível 3', 490, 'COFAP', '2024-11-12 13:30:00'),
(87, 'PCA12547', 'Armazém 2', 'Corredor EJ', 'Posição 166', 'Nível 2', 500, 'COFAP', '2024-11-12 14:00:00'),
(88, 'PCA12548', 'Armazém 3', 'Corredor EK', 'Posição 167', 'Nível 1', 510, 'COFAP', '2024-11-12 14:30:00'),
(89, 'PCA12549', 'Armazém 4', 'Corredor EL', 'Posição 168', 'Nível 3', 520, 'COFAP', '2024-11-12 15:00:00'),
(90, 'PCA12550', 'Armazém 1', 'Corredor EM', 'Posição 169', 'Nível 2', 530, 'COFAP', '2024-11-12 15:30:00'),
(91, 'PCA12551', 'Armazém 2', 'Corredor EN', 'Posição 170', 'Nível 1', 540, 'COFAP', '2024-11-12 16:00:00'),
(92, 'PCA12552', 'Armazém 3', 'Corredor EO', 'Posição 171', 'Nível 3', 550, 'COFAP', '2024-11-12 16:30:00'),
(93, 'PCA12553', 'Armazém 4', 'Corredor EP', 'Posição 172', 'Nível 2', 560, 'COFAP', '2024-11-12 17:00:00'),
(94, 'PCA12554', 'Armazém 1', 'Corredor EQ', 'Posição 173', 'Nível 1', 570, 'COFAP', '2024-11-12 17:30:00'),
(95, 'PCA12555', 'Armazém 2', 'Corredor ER', 'Posição 174', 'Nível 3', 580, 'COFAP', '2024-11-12 18:00:00'),
(96, 'PCA12556', 'Armazém 3', 'Corredor ES', 'Posição 175', 'Nível 2', 590, 'COFAP', '2024-11-12 18:30:00'),
(97, 'PCA12557', 'Armazém 4', 'Corredor ET', 'Posição 176', 'Nível 1', 600, 'COFAP', '2024-11-12 19:00:00'),
(98, 'PCA12558', 'Armazém 1', 'Corredor EU', 'Posição 177', 'Nível 3', 610, 'COFAP', '2024-11-12 19:30:00'),
(99, 'PCA12559', 'Armazém 2', 'Corredor EV', 'Posição 178', 'Nível 2', 620, 'COFAP', '2024-11-12 20:00:00'),
(100, 'PCA12560', 'Armazém 3', 'Corredor EW', 'Posição 179', 'Nível 1', 630, 'COFAP', '2024-11-12 20:30:00'),
(101, 'PCA12561', 'Armazém 4', 'Corredor EX', 'Posição 180', 'Nível 3', 640, 'COFAP', '2024-11-12 21:00:00'),
(102, 'PCA12562', 'Armazém 1', 'Corredor EY', 'Posição 181', 'Nível 2', 650, 'COFAP', '2024-11-12 21:30:00'),
(103, 'PCA12563', 'Armazém 2', 'Corredor EZ', 'Posição 182', 'Nível 1', 660, 'COFAP', '2024-11-12 22:00:00'),
(104, 'PCA12564', 'Armazém 3', 'Corredor FA', 'Posição 183', 'Nível 3', 670, 'COFAP', '2024-11-12 22:30:00'),
(105, 'PCA12565', 'Armazém 4', 'Corredor FB', 'Posição 184', 'Nível 2', 680, 'COFAP', '2024-11-12 23:00:00'),
(106, 'PCA12566', 'Armazém 1', 'Corredor FC', 'Posição 185', 'Nível 1', 690, 'COFAP', '2024-11-12 23:30:00'),
(107, 'PCA12567', 'Armazém 2', 'Corredor FD', 'Posição 186', 'Nível 3', 700, 'COFAP', '2024-11-13 00:00:00'),
(108, 'PCA12568', 'Armazém 3', 'Corredor FE', 'Posição 187', 'Nível 2', 710, 'COFAP', '2024-11-13 00:30:00'),
(109, 'PCA12569', 'Armazém 4', 'Corredor FF', 'Posição 188', 'Nível 1', 720, 'COFAP', '2024-11-13 01:00:00'),
(110, 'PCA12570', 'Armazém 1', 'Corredor FG', 'Posição 189', 'Nível 3', 730, 'COFAP', '2024-11-13 01:30:00'),
(111, 'PCA12571', 'Armazém 2', 'Corredor FH', 'Posição 190', 'Nível 2', 740, 'COFAP', '2024-11-13 02:00:00'),
(112, 'PCA12572', 'Armazém 3', 'Corredor FI', 'Posição 191', 'Nível 1', 750, 'COFAP', '2024-11-13 02:30:00'),
(113, 'PCA12573', 'Armazém 4', 'Corredor FJ', 'Posição 192', 'Nível 3', 760, 'COFAP', '2024-11-13 03:00:00'),
(114, 'PCA12574', 'Armazém 1', 'Corredor FK', 'Posição 193', 'Nível 2', 770, 'COFAP', '2024-11-13 03:30:00'),
(115, 'PCA12575', 'Armazém 2', 'Corredor FL', 'Posição 194', 'Nível 1', 780, 'COFAP', '2024-11-13 04:00:00'),
(116, 'PCA12576', 'Armazém 3', 'Corredor FM', 'Posição 195', 'Nível 3', 790, 'COFAP', '2024-11-13 04:30:00'),
(117, 'PCA12577', 'Armazém 4', 'Corredor FN', 'Posição 196', 'Nível 2', 800, 'COFAP', '2024-11-13 05:00:00'),
(118, 'PCA12578', 'Armazém 1', 'Corredor FO', 'Posição 197', 'Nível 1', 810, 'COFAP', '2024-11-13 05:30:00'),
(119, 'PCA12579', 'Armazém 2', 'Corredor FP', 'Posição 198', 'Nível 3', 820, 'COFAP', '2024-11-13 06:00:00'),
(120, 'PCA12580', 'Armazém 3', 'Corredor FQ', 'Posição 199', 'Nível 2', 830, 'COFAP', '2024-11-13 06:30:00'),
(121, 'PCA12581', 'Armazém 4', 'Corredor FR', 'Posição 200', 'Nível 1', 840, 'COFAP', '2024-11-13 07:00:00'),
(122, 'PCA12582', 'Armazém 1', 'Corredor FS', 'Posição 201', 'Nível 3', 850, 'COFAP', '2024-11-13 07:30:00'),
(123, 'PCA12583', 'Armazém 2', 'Corredor FT', 'Posição 202', 'Nível 2', 860, 'COFAP', '2024-11-13 08:00:00'),
(124, 'PCA12584', 'Armazém 3', 'Corredor FU', 'Posição 203', 'Nível 1', 870, 'COFAP', '2024-11-13 08:30:00'),
(125, 'PCA12585', 'Armazém 4', 'Corredor FV', 'Posição 204', 'Nível 3', 880, 'COFAP', '2024-11-13 09:00:00'),
(126, 'PCA12586', 'Armazém 1', 'Corredor FW', 'Posição 205', 'Nível 2', 890, 'COFAP', '2024-11-13 09:30:00'),
(127, 'PCA12587', 'Armazém 2', 'Corredor FX', 'Posição 206', 'Nível 1', 900, 'COFAP', '2024-11-13 10:00:00'),
(128, 'PCA12588', 'Armazém 3', 'Corredor FY', 'Posição 207', 'Nível 3', 910, 'COFAP', '2024-11-13 10:30:00'),
(129, 'PCA12589', 'Armazém 4', 'Corredor FZ', 'Posição 208', 'Nível 2', 920, 'COFAP', '2024-11-13 11:00:00'),
(130, 'PCA12590', 'Armazém 1', 'Corredor GA', 'Posição 209', 'Nível 1', 930, 'COFAP', '2024-11-13 11:30:00'),
(131, 'PCA12591', 'Armazém 2', 'Corredor GB', 'Posição 210', 'Nível 3', 940, 'COFAP', '2024-11-13 12:00:00'),
(132, 'PCA12592', 'Armazém 3', 'Corredor GC', 'Posição 211', 'Nível 2', 950, 'COFAP', '2024-11-13 12:30:00'),
(133, 'PCA12593', 'Armazém 4', 'Corredor GD', 'Posição 212', 'Nível 1', 960, 'COFAP', '2024-11-13 13:00:00'),
(134, 'PCA12594', 'Armazém 1', 'Corredor GE', 'Posição 213', 'Nível 3', 970, 'COFAP', '2024-11-13 13:30:00'),
(135, 'PCA12595', 'Armazém 2', 'Corredor GF', 'Posição 214', 'Nível 2', 980, 'COFAP', '2024-11-13 14:00:00'),
(136, 'PCA12596', 'Armazém 3', 'Corredor GG', 'Posição 215', 'Nível 1', 990, 'COFAP', '2024-11-13 14:30:00'),
(137, 'PCA12597', 'Armazém 4', 'Corredor GH', 'Posição 216', 'Nível 3', 1000, 'COFAP', '2024-11-13 15:00:00'),
(138, 'PCA12598', 'Armazém 1', 'Corredor GI', 'Posição 217', 'Nível 2', 1010, 'COFAP', '2024-11-13 15:30:00'),
(139, 'PCA12599', 'Armazém 2', 'Corredor GJ', 'Posição 218', 'Nível 1', 1020, 'COFAP', '2024-11-13 16:00:00'),
(140, 'PCA12600', 'Armazém 3', 'Corredor GK', 'Posição 219', 'Nível 3', 1030, 'COFAP', '2024-11-13 16:30:00'),
(141, 'PCA12601', 'Armazém 4', 'Corredor GL', 'Posição 220', 'Nível 2', 1040, 'COFAP', '2024-11-13 17:00:00'),
(142, 'PCA12602', 'Armazém 1', 'Corredor GM', 'Posição 221', 'Nível 1', 1050, 'COFAP', '2024-11-13 17:30:00'),
(143, 'PCA12603', 'Armazém 2', 'Corredor GN', 'Posição 222', 'Nível 3', 1060, 'COFAP', '2024-11-13 18:00:00'),
(144, 'A1B2C3', 'Estoque A', 'Corredor B', 'GAVETA 1', 'Nível 3', 30, 'SKF ', '2024-11-30 21:58:09');

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
(1, 'Volkswagen', 'Volkswagen do Brasil Ltda.', '60.746.122/0001-96', '1234567890', 'Avenida das Indústrias, 123', 'Bairro Industrial', '(11) 3456-7890', 'São Bernardo do Campo', 'SP', 'Ativa', 'contato@vw.com.br', '2024-11-13 16:00:00'),
(2, 'GM', 'General Motors do Brasil Ltda.', '33.347.277/0001-42', '9876543210', 'Rua General Motors, 456', 'Bairro Industrial', '(11) 9876-5432', 'São Caetano do Sul', 'SP', 'Ativa', 'contato@gm.com.br', '2024-11-13 16:30:00'),
(3, 'Fiat', 'Fiat Automóveis S.A.', '60.746.121/0001-97', '1234567891', 'Avenida Fiat, 123', 'Bairro Fiat', '(11) 1234-5678', 'Betim', 'MG', 'Ativa', 'contato@fiat.com.br', '2024-11-13 17:00:00'),
(4, 'Ford', 'Ford Motor Company Brasil Ltda.', '32.456.000/0001-99', '6543219870', 'Rua Ford, 789', 'Bairro Industrial', '(11) 4321-8765', 'Camaçari', 'BA', 'Ativa', 'contato@ford.com.br', '2024-11-13 17:30:00'),
(5, 'Honda', 'Honda Automóveis do Brasil Ltda.', '40.564.232/0001-60', '1029384756', 'Avenida Honda, 101', 'Bairro Honda', '(11) 9876-5432', 'Sumaré', 'SP', 'Ativa', 'contato@honda.com.br', '2024-11-13 18:00:00'),
(6, 'COFAP', '123456789', '12.123.123/0001-42', '', 'rua do doido', 'barracao', '61-98765432', 'brasolia', 'Di', 'Ativa', 'cofap@cofap.com', '2024-11-06 03:27:18'),
(7, 'TRW', 'TRW Automotive Ltda', '60857371000109', '', 'Q 310 CONJ 9C LOTE 32', 'Singelo', '0800721000', 'Piracanjuba', 'SP', 'Ativa', 'www.trw.com.br@gmail', '2024-11-15 17:34:53'),
(8, 'NTN ROLAMENTOS DO BRASIL', 'NTN', '8905432000122', '', 'R 04 CHC 65 LOTE 01', 'VICENTE PRES', '0800342001', 'NOVO HORIZONTE', 'SP', 'Ativa', 'WWW.NTN.COM.BR@GMAIL.COM', '2024-11-15 17:40:50'),
(9, 'NTN ROLAMENTOS DO BRASIL2', 'NTN', '8905432000100', '', 'R 04 CHC 65 LOTE 01', 'VICENTE PRES', '0800342001', 'NOVO HORIZONTE', 'SP', 'Ativa', 'WWW.NTN.COM.BR@GMAIL.COM', '2024-11-15 17:41:31'),
(10, 'MTE THOMSON', 'MTE', '000152000172', '', 'SHN AE 54 LOTE 23 GALPÃO 01', 'SERGIPANO', '0800332001', 'PALMAS', 'TO', 'Ativa', 'WWW.MTETHOMSON@GMAIL.COM', '2024-11-15 17:52:26'),
(11, 'MARELLI', 'MAGNETTI MARELLI LTDA', '000152000170', '', 'SHN AE 57 LOTE 20', 'AGRIPINO', '0800332009', 'ARGUARINA', 'TO', 'Ativa', 'WWW.MARELLI@GMAIL.COM', '2024-11-15 17:56:24'),
(12, 'HIPER FREIOS', 'HIPER FREIO LTDA', '002675001553', '', 'AV PIO 6 R 73 LOTE 01', 'VARZEA', '0800342078', 'RIBEIRÃO PRETO', 'SP', 'Ativa', 'WWW.HIPERFREIO.COM.BR@GMAIL.COM', '2024-11-15 18:02:00'),
(13, 'METAL LEVE', 'METAL LEVE IND', '000152000120', '', 'AV CONTORNO LOTE 1031', 'INDUSTRIAL', '0800721011', 'BRAGANÇA', 'SP', 'Ativa', 'WWW.METALEVE@GMAI.COM', '2024-11-15 18:10:24'),
(14, 'SKF ', 'SKF DA BRASIL LTDA', '000152000165', '', 'AV PRINCIPAL LOTE O67A', 'SAUDADE', '0800721020', 'ARARQUARA', 'SP', 'Ativa', 'WWW.SKFIND@GMAIL.COM', '2024-11-15 18:15:29'),
(15, 'TEC FIL', 'TEC FILTROS AUTOMOTIVOS', '000152000137', '', 'AV CONTORNO LOTE 73', 'PAVUNA', '0800721033', 'RIBEIRÇ', 'SP', 'Ativa', 'WWW.SKFIND@GMAIL.COM', '2024-11-15 18:18:01'),
(16, 'SABO ', 'SABO IND AUTOMOTIVA', '0001520001OO', '', 'SETOR NOBRE LOTE 74', 'PRIMAVERA', '0800721071', 'RIBEIRÃO ', 'SP', 'Ativa', 'WWW.SABOIND@GMAIL.COM', '2024-11-15 18:22:29'),
(17, 'NAKATA', 'NAKATA  IND AUTOMOTIVA', '000453900098', '', 'SETOR O LOTE 74', 'CEILANDIA', '0800721023', 'JARDINS', 'SP', 'Ativa', 'WWW.NAKATAIND@GMAIL.COM', '2024-11-15 18:28:49'),
(31, 'SKF2', 'Volkswagen do Brasil Ltda.', '12.123.123/0001-35', '', 'Rua Via Coletora B', 'Nossa Senhora das Graças', '(61) 99666-5656', 'Santo Antônio de Jesus', 'Di', 'Ativa', 'skf@cofap.com', '2024-11-30 22:01:17');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_funcionario`
--

CREATE TABLE `tb_funcionario` (
  `id` int(11) NOT NULL,
  `ativo` int(1) NOT NULL,
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

INSERT INTO `tb_funcionario` (`id`, `ativo`, `nome`, `email`, `genero`, `data_nascimento`, `matricula`, `cargo`, `nivel_acesso`, `telefone`, `foto`, `data_cadastro`) VALUES
(18, 1, 'gerente', 'gerente@teste.com', 'Masculino', '2000-10-10', '15151', 'Gerente', 'Gerente', '(11) 99999-8888', 'uploads/perfil_15151.png', '2024-11-13 22:15:58'),
(19, 1, 'caixa', 'caixa@caixa.com', 'Masculino', '2000-10-10', '40401', 'Caixa', 'Caixa', '(61) 99666-5656', '../uploads/manutencao.png', '2024-11-13 22:16:45'),
(20, 1, 'vendedor', 'vendedor@teste.com', 'Masculino', '2000-10-10', '20201', 'Vendedor', 'Vendedor', '(61) 99666-5652', '../uploads/manutencao.png', '2024-11-13 22:17:17'),
(21, 1, 'estoquista', 'estoquista@teste.com.br', 'Masculino', '2000-10-10', '30301', 'Estoquista', 'Estoquista', '(61) 98765-432', '../uploads/manutencao.png', '2024-11-13 22:17:46'),
(22, 1, 'separador', 'separador@teste.com.br', 'Masculino', '2000-10-10', '50501', 'Separador', 'Separador', '(61) 98765-4322', '../uploads/manutencao.png', '2024-11-13 22:19:29'),
(23, 1, 'Administrador', 'jonasf.f.martinsjf@gmail.com', 'Masculino', '1010-10-10', '60601', 'Administrador', 'Gerente', '(61) 61616-1616', 'uploads/manutencao.png', '2024-11-13 22:43:28'),
(24, 1, 'simulado', 'analucia.famorim@gmail.com', 'Masculino', '1010-10-10', '70701', 'Separador', 'Caixa', '(61) 99666-5656', '../uploads/manutencao.png', '2024-11-15 15:28:37');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_login`
--

CREATE TABLE `tb_login` (
  `id` int(11) NOT NULL,
  `matricula` varchar(8) NOT NULL,
  `password` varchar(200) NOT NULL,
  `permissao` varchar(50) NOT NULL,
  `ativo` int(1) NOT NULL,
  `tentativas_falhas` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_login`
--

INSERT INTO `tb_login` (`id`, `matricula`, `password`, `permissao`, `ativo`, `tentativas_falhas`) VALUES
(18, '15151', '$2y$10$jRSuhvVyCwWqKUqiHIa2M.XBT1mZd6Uxv4j534FQ/don4P2cVzwwC', 'Gerente', 1, 0),
(19, '40401', '$2y$10$8/yOMIFaSmnmCZ2PMJuHnO67lrVyHXnMDvR4JToKPmZXnMq1IMBYa', 'Caixa', 1, 0),
(20, '20201', '$2y$10$4Jf9s/zS2qfSPDgjgIDmneXY3z6KtKVddQR4BOVGNOnRGGoomPqGq', 'Vendedor', 1, 0),
(23, '60601', '$2y$10$/LGmG7TXANKsOhIEcMLabOwHk7r4zKRA8QP8G4KqJxoGxCgaEwsXK', 'Administrador', 1, 0),
(25, '30301', '$2y$10$3V0IzpT0ZkyrPcH8nS8NQuiCo3drVHkLgeEjk4D1QDpvd3uOeco0O', 'Estoquista', 1, 0),
(26, '50501', '$2y$10$ylMRgoqyU4ENUYYctG0oleDDBl.AG.3/9D2CgzkpVTsLO0O/BoeOS', 'Separador', 1, 0),
(28, '70701', '$2y$10$T0UfbrCp8nAxIM2cScOXr.lxudLkbIrqo21fsJiXOw/vktg992jJK', 'Caixa', 1, 0);

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
(3, 'PCA12503', 'COFAP', 'Disco de Freio', 2.50, 120.00, 'Palio 1.4 ELX', 'FIAT', 'Disco de freio ventilado traseiro', '2024-11-06 09:20:00'),
(4, 'PCA12504', 'COFAP', 'Correia Dentada', 0.40, 45.00, 'Palio 1.4 ELX', 'FIAT', 'Correia dentada para motor Fire 1.0 e 1.4', '2024-11-06 09:30:00'),
(5, 'PCA12505', 'COFAP', 'Velas de Ignição', 0.30, 25.00, 'Palio 1.4 ELX', 'FIAT', 'Jogo de velas para ignição eficiente', '2024-11-06 09:40:00'),
(6, 'PCA12506', 'COFAP', 'Bateria Automotiva', 12.00, 300.00, 'Palio 1.4 ELX', 'FIAT', 'Bateria de 60Ah com alta durabilidade', '2024-11-06 09:50:00'),
(7, 'PCA12507', 'COFAP', 'Radiador', 3.00, 400.00, 'Palio 1.4 ELX', 'GM', 'Radiador de alumínio para motor 2.0', '2024-11-06 10:00:00'),
(8, 'PCA12508', 'COFAP', 'Sensor de Temperatura', 0.15, 80.00, 'Palio 1.4 ELX', 'FIAT', 'Sensor de temperatura para sistema de arrefecimento', '2024-11-06 10:10:00'),
(9, 'PCA12509', 'GM', 'Kit de Embreagem', 4.00, 600.00, 'Argo 1.3 Drive', 'FIAT', 'Kit completo com platô, disco e rolamento', '2024-11-06 10:20:00'),
(10, 'PCA12510', 'GM', 'Amortecedor Traseiro', 2.50, 220.00, 'Argo 1.3 Drive', 'GM', 'Amortecedor traseiro para maior conforto', '2024-11-06 10:30:00'),
(11, 'PCA12511', 'GM', 'Filtro de Combustível', 0.60, 35.00, 'Prisma 1.4 LTZ', 'GM', 'Filtro de combustível para sistemas de injeção', '2024-11-06 10:40:00'),
(12, 'PCA12512', 'GM', 'Sensor de Estacionamento', 0.20, 150.00, 'Palio 1.4 ELX', 'GM', 'Sensor de estacionamento com alta precisão', '2024-11-06 10:50:00'),
(15, 'PCA12515', 'GM', 'Retentor de Óleo', 0.10, 20.00, 'Argo 1.3 Drive', 'FIAT', 'Retentor de óleo para câmbio e motor', '2024-11-06 11:20:00'),
(16, 'PCA12516', 'GM', 'Alternador', 5.00, 700.00, 'Palio 1.4 ELX', 'FIAT', 'Alternador para sistema elétrico 12V', '2024-11-06 11:30:00'),
(17, 'PCA12517', 'GM', 'Compressor de Ar Condicionado', 7.00, 1500.00, 'Palio 1.4 ELX', 'GM', 'Compressor para sistema de climatização', '2024-11-06 11:40:00'),
(18, 'PCA12518', 'GM', 'Mola Espiral', 2.20, 250.00, 'Palio 1.4 ELX', 'FIAT', 'Mola para suspensão dianteira', '2024-11-06 11:50:00'),
(19, 'PCA12519', 'COFAP', 'Parachoque Traseiro', 8.00, 800.00, 'Palio 1.4 ELX', 'FIAT', 'Parachoque traseiro na cor preta', '2024-11-06 12:00:00'),
(20, 'PCA12530', 'COFAP', 'Lanterna Traseira', 1.80, 300.00, 'Palio 1.4 ELX', 'FIAT', 'Lanterna traseira com acabamento cristal', '2024-11-06 12:10:00'),
(21, 'PCA12531', 'COFAP', 'Espelho Retrovisor', 1.20, 250.00, 'Palio 1.4 ELX', 'FIAT', 'Espelho retrovisor com ajuste elétrico', '2024-11-06 12:20:00'),
(22, 'PCA12532', 'COFAP', 'Pneu 175/65R14', 7.50, 400.00, 'Argo 1.3 Drive', 'GM', 'Pneu radial com alta durabilidade', '2024-11-06 12:30:00'),
(23, 'PCA12533', 'COFAP', 'Jogo de Tapetes', 2.00, 120.00, 'Palio 1.4 ELX', 'GM', 'Jogo de tapetes de borracha', '2024-11-06 12:40:00'),
(24, 'PCA12534', 'COFAP', 'Bomba de Combustível', 3.00, 450.00, 'Palio 1.4 ELX', 'FIAT', 'Bomba de combustível elétrica', '2024-11-06 12:50:00'),
(25, 'PCA12535', 'COFAP', 'Macaco Hidráulico', 10.00, 600.00, 'Argo 1.3 Drive', 'FIAT', 'Macaco hidráulico de 2 toneladas', '2024-11-06 13:00:00'),
(26, 'PCA12536', 'COFAP', 'Mangueira de Arrefecimento', 0.70, 50.00, 'Palio 1.4 ELX', 'FIAT', 'Mangueira para sistema de arrefecimento', '2024-11-06 13:10:00'),
(27, 'PCA12537', 'COFAP', 'Interruptor de Luz de Freio', 0.20, 40.00, 'Prisma 1.4 LTZ', 'FIAT', 'Interruptor para luz de freio traseira', '2024-11-06 13:20:00'),
(28, 'PCA12538', 'COFAP', 'Modulo de Injeção Eletrônica', 3.00, 2500.00, 'Palio 1.4 ELX', 'FIAT', 'Módulo de injeção eletrônica programável', '2024-11-06 13:30:00'),
(29, 'PCA12539', 'COFAP', 'Reservatório de Água', 0.80, 80.00, 'Argo 1.3 Drive', 'FIAT', 'Reservatório de água para radiador', '2024-11-06 13:40:00'),
(30, 'PCA12540', 'COFAP', 'Capa de Banco', 1.80, 220.00, 'Prisma 1.4 LTZ', 'GM', 'Capa de banco em couro sintético', '2024-11-06 13:50:00'),
(31, 'PCA12541', 'COFAP', 'Cilindro Mestre de Freio', 1.50, 300.00, 'Palio 1.4 ELX', 'FIAT', 'Cilindro mestre para sistema de freio hidráulico', '2024-11-06 14:00:00'),
(32, 'PCA12542', 'COFAP', 'Caixa de Direção', 10.00, 1800.00, 'Palio 1.4 ELX', 'GM', 'Caixa de direção hidráulica para maior conforto', '2024-11-06 14:10:00'),
(33, 'PCA12543', 'COFAP', 'Catalisador', 5.50, 1200.00, 'Palio 1.4 ELX', 'FIAT', 'Catalisador para redução de emissões', '2024-11-06 14:20:00'),
(34, 'PCA12544', 'FIAT', 'Sensor de Velocidade', 0.25, 150.00, 'Argo 1.3 Drive', 'FIAT', 'Sensor de velocidade para painel digital', '2024-11-06 14:30:00'),
(35, 'PCA12545', 'Honda', 'Cabo de Velocímetro', 0.40, 90.00, 'Palio 1.4 ELX', 'FIAT', 'Cabo de velocímetro reforçado', '2024-11-06 14:40:00'),
(36, 'PCA12546', 'Honda', 'Farol Dianteiro', 3.00, 600.00, 'Palio 1.4 ELX', 'GM', 'Farol dianteiro com lâmpada halógena', '2024-11-06 14:50:00'),
(37, 'PCA12547', 'Honda', 'Kit de Distribuição', 4.00, 900.00, 'Palio 1.4 ELX', 'FIAT', 'Kit de distribuição completo com correia e polias', '2024-11-06 15:00:00'),
(38, 'PCA12548', 'Honda', 'Palheta do Limpador', 0.50, 35.00, 'Argo 1.3 Drive', 'GM', 'Palheta para limpador de para-brisa', '2024-11-06 15:10:00'),
(39, 'PCA12549', 'Honda', 'Tampa de Combustível', 0.30, 50.00, 'Prisma 1.4 LTZ', 'GM', 'Tampa de combustível com chave de segurança', '2024-11-06 15:20:00'),
(40, 'PCA12550', 'Honda', 'Antena Automotiva', 0.25, 40.00, 'Palio 1.4 ELX', 'GM', 'Antena automotiva de longo alcance', '2024-11-06 15:30:00'),
(41, 'PCA12551', 'Honda', 'Volante Esportivo', 3.00, 800.00, 'Palio 1.4 ELX', 'FIAT', 'Volante esportivo com acabamento em couro', '2024-11-06 15:40:00'),
(42, 'PCA12552', 'Honda', 'Tubo de Escape', 5.00, 700.00, 'Palio 1.4 ELX', 'FIAT', 'Tubo de escape em aço inoxidável', '2024-11-06 15:50:00'),
(43, 'PCA12553', 'Honda', 'Central Multimídia', 2.50, 2500.00, 'Argo 1.3 Drive', 'GM', 'Central multimídia com GPS e Bluetooth', '2024-11-06 16:00:00'),
(44, 'PCA12554', 'Honda', 'Sensor de Oxigênio', 0.15, 120.00, 'Argo 1.3 Drive', 'FIAT', 'Sensor de oxigênio para controle de emissões', '2024-11-06 16:10:00'),
(45, 'PCA12555', 'Honda', 'Cabo de Bateria', 1.00, 80.00, 'Palio 1.4 ELX', 'GM', 'Cabo de bateria resistente à oxidação', '2024-11-06 16:20:00'),
(46, 'PCA12556', 'Honda', 'Filtro de Partículas', 1.80, 200.00, 'Palio 1.4 ELX', 'GM', 'Filtro de partículas para motores diesel', '2024-11-06 16:30:00'),
(47, 'PCA12557', 'Honda', 'Protetor de Cárter', 3.50, 450.00, 'Palio 1.4 ELX', 'GM', 'Protetor de cárter em aço reforçado', '2024-11-06 16:40:00'),
(48, 'PCA12558', 'Honda', 'Cinto de Segurança', 1.20, 300.00, 'Palio 1.4 ELX', 'GM', 'Cinto de segurança retrátil para maior proteção', '2024-11-06 16:50:00'),
(49, 'PCA12559', 'Honda', 'Reservatório de Óleo', 0.80, 100.00, 'Palio 1.4 ELX', 'FIAT', 'Reservatório de óleo para motor', '2024-11-06 17:00:00'),
(50, 'PCA12560', 'Honda', 'Roda de Liga Leve', 8.00, 1200.00, 'Palio 1.4 ELX', 'GM', 'Roda de liga leve aro 16', '2024-11-06 17:10:00'),
(51, 'PCA12561', 'Honda', 'Alarme Automotivo', 1.00, 350.00, 'Prisma 1.4 LTZ', 'GM', 'Sistema de alarme com sensor de presença', '2024-11-06 17:20:00'),
(52, 'PCA12562', 'Honda', 'Kit de Ferramentas', 5.00, 200.00, 'Argo 1.3 Drive', 'GM', 'Kit de ferramentas automotivas básicas', '2024-11-06 17:30:00'),
(53, 'PCA12563', 'Honda', 'Disco de Embreagem', 1.50, 600.00, 'Prisma 1.4 LTZ', 'FIAT', 'Disco de embreagem com material de alta durabilidade', '2024-11-06 17:40:00'),
(54, 'PCA12564', 'COFAP', 'Junta Homocinética', 2.00, 800.00, 'Palio 1.4 ELX', 'FIAT', 'Junta homocinética para eixo traseiro', '2024-11-06 17:50:00'),
(55, 'PCA12565', 'COFAP', 'Módulo de Controle de Freio ABS', 3.00, 3000.00, 'Palio 1.4 ELX', 'FIAT', 'Módulo de controle eletrônico de freios ABS', '2024-11-06 18:00:00'),
(56, 'PCA12566', 'COFAP', 'Escapamento Esportivo', 7.00, 1500.00, 'Palio 1.4 ELX', 'GM', 'Escapamento esportivo com saída dupla', '2024-11-06 18:10:00'),
(57, 'PCA12567', 'COFAP', 'Parafuso de Roda', 0.10, 10.00, 'Palio 1.4 ELX', 'GM', 'Parafuso de roda com acabamento cromado', '2024-11-06 18:20:00'),
(58, 'PCA12568', 'COFAP', 'Moldura do Painel', 2.00, 500.00, 'Palio 1.4 ELX', 'GM', 'Moldura do painel central com acabamento premium', '2024-11-06 18:30:00'),
(59, 'PCA12569', 'COFAP', 'Tampa do Porta-Malas', 10.00, 1500.00, 'Palio 1.4 ELX', 'FIAT', 'Tampa do porta-malas em aço reforçado', '2024-11-06 18:40:00'),
(60, 'PCA12570', 'COFAP', 'Suporte do Para-Choque', 0.80, 150.00, 'Argo 1.3 Drive', 'GM', 'Suporte para fixação do para-choque dianteiro', '2024-11-06 18:50:00'),
(61, 'PCA12571', 'COFAP', 'Lanterna Traseira', 2.50, 550.00, 'Prisma 1.4 LTZ', 'GM', 'Lanterna traseira com iluminação LED', '2024-11-06 19:00:00'),
(62, 'PCA12572', 'COFAP', 'Radiador', 4.00, 1000.00, 'Palio 1.4 ELX', 'GM', 'Radiador de alumínio com alta eficiência térmica', '2024-11-06 19:10:00'),
(63, 'PCA12573', 'COFAP', 'Filtro de Ar', 0.70, 120.00, 'Argo 1.3 Drive', 'FIAT', 'Filtro de ar para maior desempenho do motor', '2024-11-06 19:20:00'),
(64, 'PCA12574', 'COFAP', 'Velas de Ignição', 0.15, 70.00, 'Palio 1.4 ELX', 'FIAT', 'Velas de ignição de irídio para maior durabilidade', '2024-11-06 19:30:00'),
(65, 'PCA12575', 'COFAP', 'Retrovisor Externo', 2.00, 450.00, 'Palio 1.4 ELX', 'FIAT', 'Retrovisor com ajuste elétrico e pisca integrado', '2024-11-06 19:40:00'),
(66, 'PCA12576', 'COFAP', 'Capô Dianteiro', 12.00, 2000.00, 'Palio 1.4 ELX', 'FIAT', 'Capô dianteiro com pintura anti-corrosiva', '2024-11-06 19:50:00'),
(67, 'PCA12577', 'COFAP', 'Bomba de Combustível', 1.20, 850.00, 'Palio 1.4 ELX', 'FIAT', 'Bomba de combustível de alta pressão', '2024-11-06 20:00:00'),
(68, 'PCA12578', 'COFAP', 'Alavanca de Câmbio', 0.80, 350.00, 'Palio 1.4 ELX', 'GM', 'Alavanca de câmbio com acabamento em couro', '2024-11-06 20:10:00'),
(69, 'PCA12579', 'COFAP', 'Para-lama Dianteiro', 5.00, 950.00, 'Argo 1.3 Drive', 'GM', 'Para-lama dianteiro com material resistente', '2024-11-06 20:20:00'),
(70, 'PCA12580', 'COFAP', 'Sensor de Estacionamento', 0.25, 300.00, 'Palio 1.4 ELX', 'FIAT', 'Sensor de estacionamento com alerta sonoro', '2024-11-06 20:30:00'),
(71, 'PCA12581', 'COFAP', 'Cilindro de Roda', 1.00, 400.00, 'Palio 1.4 ELX', 'FIAT', 'Cilindro de roda traseira para sistema de freio', '2024-11-06 20:40:00'),
(72, 'PCA12582', 'COFAP', 'Correia Dentada', 0.50, 250.00, 'Prisma 1.4 LTZ', 'GM', 'Correia dentada reforçada para maior durabilidade', '2024-11-06 20:50:00'),
(73, 'PCA12583', 'COFAP', 'Mola a Gás', 1.50, 500.00, 'Argo 1.3 Drive', 'FIAT', 'Mola a gás para porta-malas', '2024-11-06 21:00:00'),
(74, 'PCA12584', 'COFAP', 'Filtro de Óleo', 0.60, 60.00, 'Palio 1.4 ELX', 'GM', 'Filtro de óleo para maior proteção do motor', '2024-11-06 21:10:00'),
(75, 'PCA12585', 'COFAP', 'Buzina', 0.75, 120.00, 'Palio 1.4 ELX', 'FIAT', 'Buzina eletrônica de alta potência', '2024-11-06 21:20:00'),
(76, 'PCA12586', 'COFAP', 'Parachoque Dianteiro', 6.00, 1200.00, 'Palio 1.4 ELX', 'FIAT', 'Parachoque dianteiro com suporte para farol de neblina', '2024-11-06 21:30:00'),
(77, 'PCA12587', 'COFAP', 'Painel de Instrumentos', 3.50, 2200.00, 'Argo 1.3 Drive', 'GM', 'Painel de instrumentos digital com computador de bordo', '2024-11-06 21:40:00'),
(78, 'PCA12588', 'COFAP', 'Motor de Partida', 3.00, 850.00, 'Palio 1.4 ELX', 'FIAT', 'Motor de partida reforçado para maior durabilidade', '2024-11-06 21:50:00'),
(79, 'PCA12589', 'COFAP', 'Luz de Freio', 0.90, 70.00, 'Palio 1.4 ELX', 'GM', 'Luz de freio traseira de alta visibilidade', '2024-11-06 22:00:00'),
(80, 'PCA12590', 'COFAP', 'Interruptor de Luz', 0.20, 40.00, 'Palio 1.4 ELX', 'FIAT', 'Interruptor de luz para controle de faróis', '2024-11-06 22:10:00'),
(81, 'PCA12591', 'COFAP', 'Jogo de Porcas de Roda', 0.50, 90.00, 'Palio 1.4 ELX', 'FIAT', 'Jogo de porcas de roda com chave de segurança', '2024-11-06 22:20:00'),
(82, 'PCA12592', 'COFAP', 'Aro de Roda', 5.00, 1600.00, 'Prisma 1.4 LTZ', 'GM', 'Aro de roda de liga leve com design esportivo', '2024-11-06 22:30:00'),
(83, 'PCA12593', 'COFAP', 'Fluido de Freio', 1.00, 50.00, 'Argo 1.3 Drive', 'FIAT', 'Fluido de freio DOT 4 para sistemas ABS', '2024-11-06 22:40:00'),
(84, 'PCA12594', 'COFAP', 'Kit de Reparo de Freio', 1.50, 250.00, 'Palio 1.4 ELX', 'GM', 'Kit de reparo para freios traseiros', '2024-11-06 22:50:00'),
(85, 'PCA12595', 'COFAP', 'Braço de Suspensão', 3.00, 1100.00, 'Palio 1.4 ELX', 'FIAT', 'Braço de suspensão dianteiro em aço reforçado', '2024-11-06 23:00:00'),
(86, 'PCA12596', 'COFAP', 'Suporte do Motor', 2.00, 800.00, 'Palio 1.4 ELX', 'FIAT', 'Suporte do motor com material de alta resistência', '2024-11-06 23:10:00'),
(87, 'PCA12597', 'COFAP', 'Válvula Termostática', 0.50, 220.00, 'Palio 1.4 ELX', 'FIAT', 'Válvula termostática para controle da temperatura do motor', '2024-11-06 23:20:00'),
(88, 'PCA12598', 'COFAP', 'Kit de Embreagem', 4.00, 1300.00, 'Palio 1.4 ELX', 'GM', 'Kit de embreagem para maior desempenho', '2024-11-06 23:30:00'),
(89, 'PCA12599', 'COFAP', 'Coxim do Motor', 2.50, 600.00, 'Argo 1.3 Drive', 'GM', 'Coxim do motor com redução de vibrações', '2024-11-06 23:40:00'),
(90, 'PCA12600', 'COFAP', 'Disco de Freio', 2.00, 900.00, 'Palio 1.4 ELX', 'FIAT', 'Disco de freio ventilado para maior eficiência', '2024-11-06 23:50:00'),
(91, 'PCA12601', 'COFAP', 'Rolamento de Roda', 1.50, 450.00, 'Prisma 1.4 LTZ', 'GM', 'Rolamento de roda com alta durabilidade', '2024-11-07 00:00:00'),
(92, 'PCA12602', 'COFAP', 'Filtro de Combustível', 0.70, 90.00, 'Argo 1.3 Drive', 'FIAT', 'Filtro de combustível de alto desempenho', '2024-11-07 00:10:00'),
(93, 'PCA12603', 'COFAP', 'Chave de Seta', 1.00, 300.00, 'Palio 1.4 ELX', 'GM', 'Chave de seta com ajuste para limpadores', '2024-11-07 00:20:00'),
(94, 'PCA12604', 'COFAP', 'Tampa do Reservatório', 0.30, 70.00, 'Palio 1.4 ELX', 'GM', 'Tampa do reservatório de expansão', '2024-11-07 00:30:00'),
(95, 'PCA12605', 'COFAP', 'Cabo de Vela', 0.50, 200.00, 'Palio 1.4 ELX', 'FIAT', 'Cabo de vela com proteção contra interferência', '2024-11-07 00:40:00'),
(96, 'PCA12606', 'COFAP', 'Interruptor de Pressão', 0.30, 120.00, 'Palio 1.4 ELX', 'FIAT', 'Interruptor de pressão para sistema de ar-condicionado', '2024-11-07 00:50:00'),
(97, 'PCA12607', 'COFAP', 'Jogo de Palhetas', 0.40, 80.00, 'Palio 1.4 ELX', 'GM', 'Jogo de palhetas de limpador de para-brisa', '2024-11-07 01:00:00'),
(98, 'PCA12608', 'COFAP', 'Bateria Automotiva', 15.00, 700.00, 'Argo 1.3 Drive', 'GM', 'Bateria automotiva de alta performance', '2024-11-07 01:10:00'),
(99, 'PCA12609', 'COFAP', 'Filtro de Cabine', 0.80, 100.00, 'Palio 1.4 ELX', 'FIAT', 'Filtro de cabine para purificação do ar', '2024-11-07 01:20:00'),
(100, 'PCA12610', 'COFAP', 'Parafuso de Roda', 0.10, 20.00, 'Prisma 1.4 LTZ', 'GM', 'Parafuso de roda em aço galvanizado', '2024-11-07 01:30:00'),
(140, 'PCA12610', 'SKF ', 'BIELA', 1.00, 10.00, 'Palio 1.4 ELX', 'Fiat', 'Usado para motor a gasolina', '2024-11-30 21:59:10');

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
(1, 'Fiat', 'Fiat Uno', '1.0 Flex', '2015', '2024', 'Uno 1.0 Attractive', 'Ar condicionado, direção hidráulica'),
(2, 'Fiat', 'Fiat Palio', '1.4 Flex', '2009', '2020', 'Palio 1.4 ELX', 'Vidros elétricos, alarme'),
(3, 'Fiat', 'Fiat Argo', '1.3 Flex', '2017', '2024', 'Argo 1.3 Drive', 'Rodas de liga leve, central multimídia'),
(4, 'Fiat', 'Fiat Mobi', '1.0 Flex', '2016', '2024', 'Mobi 1.0 Easy', 'Bluetooth, direção elétrica'),
(5, 'Fiat', 'Fiat Strada', '1.4 Flex', '1998', '2024', 'Strada 1.4 Working', 'Câmbio manual, vidros manuais'),
(6, 'Fiat', 'Fiat Toro', '2.0 Diesel', '2016', '2024', 'Toro 2.0 Freedom', 'Câmera de ré, faróis de neblina'),
(7, 'Fiat', 'Fiat 500', '1.4 Flex', '2007', '2024', '500 1.4 Sport', 'Teto solar, banco de couro'),
(8, 'Fiat', 'Fiat Tipo', '1.8 Flex', '2016', '2024', 'Tipo 1.8 Essence', 'Sensor de estacionamento, volante multifuncional'),
(15, 'FIAT', 'SIENA', '1', '2000', '2020', 'SEDAN', 'ABS'),
(16, 'Ford', 'Ford Fiesta', '1.0 Flex', '2010', '2020', 'Fiesta 1.0 SE', 'Rodas de liga leve, faróis de neblina'),
(17, 'Ford', 'Ford Focus', '2.0 Flex', '2012', '2024', 'Focus 2.0 Titanium', 'Volante multifuncional, sensor de estacionamento'),
(18, 'Ford', 'Ford Ka', '1.0 Flex', '2014', '2024', 'Ka 1.0 SE', 'Ar condicionado, direção elétrica'),
(19, 'Ford', 'Ford EcoSport', '1.6 Flex', '2003', '2024', 'EcoSport 1.6 Freestyle', 'Teto solar, câmera de ré'),
(20, 'Ford', 'Ford Ranger', '2.5 Diesel', '1998', '2024', 'Ranger 2.5 XLS', 'Tração 4x4, banco de couro'),
(21, 'Ford', 'Ford Mustang', '5.0 V8', '2015', '2024', 'Mustang GT 5.0', 'Suspensão esportiva, sistema de som premium'),
(22, 'Ford', 'Ford Fusion', '2.5 Flex', '2005', '2024', 'Fusion 2.5 Titanium', 'Assistência de estacionamento, bancos elétricos'),
(23, 'Ford', 'Ford Explorer', '3.5 V6', '2000', '2024', 'Explorer 3.5 XLT', 'Teto panorâmico, sistema de navegação'),
(24, 'GM', 'Chevrolet Onix', '1.0 Flex', '2012', '2024', 'Onix 1.0 LT', 'Ar condicionado, direção elétrica'),
(25, 'GM', 'Chevrolet Prisma', '1.4 Flex', '2006', '2024', 'Prisma 1.4 LTZ', 'Rodas de liga leve, sensor de estacionamento'),
(26, 'GM', 'Chevrolet Tracker', '1.2 Turbo', '2020', '2024', 'Tracker 1.2 Premier', 'Teto solar, câmera de ré'),
(27, 'GM', 'Chevrolet S10', '2.8 Diesel', '1995', '2024', 'S10 2.8 High Country', 'Faróis de neblina, bancos de couro'),
(28, 'GM', 'Chevrolet Equinox', '2.0 Turbo', '2017', '2024', 'Equinox 2.0 Premier', 'Controle de tração, faróis em LED'),
(29, 'GM', 'Chevrolet Cruze', '1.4 Turbo', '2009', '2024', 'Cruze 1.4 Turbo LTZ', 'Câmera de ré, faróis de LED'),
(30, 'GM', 'Chevrolet Spin', '1.8 Flex', '2011', '2024', 'Spin 1.8 LT', 'Ar condicionado, sistema de entretenimento'),
(31, 'GM', 'Chevrolet Malibu', '2.5 Flex', '2015', '2024', 'Malibu 2.5 LTZ', 'Sistema de som premium, volante multifuncional'),
(32, 'FIATO', 'SIENA', '1', '2000', '2022', 'SEDAN', 'ABSistem');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aceita_documento`
--
ALTER TABLE `aceita_documento`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `mensagens`
--
ALTER TABLE `mensagens`
  ADD PRIMARY KEY (`id`);

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
-- Índices de tabela `tb_dadosbanco`
--
ALTER TABLE `tb_dadosbanco`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_email`
--
ALTER TABLE `tb_email`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tb_estoque`
--
ALTER TABLE `tb_estoque`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fornecedor` (`fornecedor`);

--
-- Índices de tabela `tb_fornecedor`
--
ALTER TABLE `tb_fornecedor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cnpj` (`cnpj`),
  ADD UNIQUE KEY `fornecedor_2` (`fornecedor`),
  ADD KEY `fornecedor` (`fornecedor`);

--
-- Índices de tabela `tb_funcionario`
--
ALTER TABLE `tb_funcionario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nivel_acesso` (`nivel_acesso`),
  ADD KEY `matricula` (`matricula`),
  ADD KEY `ativo` (`ativo`);

--
-- Índices de tabela `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_login` (`permissao`),
  ADD KEY `matricula` (`matricula`),
  ADD KEY `fk_ativo` (`ativo`);

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
-- AUTO_INCREMENT de tabela `aceita_documento`
--
ALTER TABLE `aceita_documento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de tabela `mensagens`
--
ALTER TABLE `mensagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `tb_cargos`
--
ALTER TABLE `tb_cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tb_cliente`
--
ALTER TABLE `tb_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT de tabela `tb_compra`
--
ALTER TABLE `tb_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de tabela `tb_dadosbanco`
--
ALTER TABLE `tb_dadosbanco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_email`
--
ALTER TABLE `tb_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tb_estoque`
--
ALTER TABLE `tb_estoque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT de tabela `tb_fornecedor`
--
ALTER TABLE `tb_fornecedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `tb_funcionario`
--
ALTER TABLE `tb_funcionario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `tb_produto`
--
ALTER TABLE `tb_produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT de tabela `tb_veiculo`
--
ALTER TABLE `tb_veiculo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Restrições para tabelas despejadas
--

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
