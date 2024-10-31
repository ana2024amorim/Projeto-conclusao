-- Criar o banco de dados
CREATE DATABASE db_guardian;

-- Usar o banco de dados
USE db_guardian;

-- criando usuario e senha de acesso ao banco
CREATE USER 'user_guardian'@'localhost' IDENTIFIED BY '123456';
GRANT ALL PRIVILEGES ON db_guardian.* TO 'user_guardian'@'localhost';
FLUSH PRIVILEGES;


-- criando a tabela cadastro cliente


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
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `tb_cliente` (`id`, `cpf_cnpj`, `razao_nome`, `cep`, `cidade`, `endereco`, `complemento`, `bairro`, `uf`, `telefone`, `email`, `rginscricao`, `sitcad`) VALUES
(1, '70421137134', 'NOME DA CASA', '72241-624', 'Brasília', 'Quadra QNP 15 Conjunto Z', '', 'Ceilândia Norte (Ceilândia)', 'DF', '(61)99674-', 'casa@casa.com.br', '', ''),
(2, '70421137134', 'NOME DA CASA', '72241-624', 'Brasília', 'Quadra QNP 15 Conjunto Z', 'casa 14', 'Ceilândia Norte (Ceilândia)', 'DF', '(61)99674-', 'casa@casa.com.br', '', '');

--
-- Índices de tabela `tb_cliente`
--
ALTER TABLE `tb_cliente`
  ADD PRIMARY KEY (`id`);

-- AUTO_INCREMENT de tabela `tb_cliente`

ALTER TABLE `tb_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;


-- Estrutura para tabela `tb_funcionario`


CREATE TABLE `tb_funcionario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `genero` varchar(30) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `matricula` varchar(50) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `nivel_acesso` varchar(50) NOT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Despejando dados para a tabela `tb_funcionario`


INSERT INTO `tb_funcionario` (`id`, `nome`, `email`, `genero`, `data_nascimento`, `matricula`, `cargo`, `nivel_acesso`, `telefone`, `foto`, `data_cadastro`) VALUES
(1, 'dede', 'leonardo.amorim2011@gmail.com', 'Masculino', NULL, '2338', 'Administrador', 'Gerente', NULL, 'images/template.png', '2024-08-31 22:41:30'),
(2, 'dede', 'doido@doido.com.br', 'Feminino', NULL, '4373', 'Administrador', 'Gerente', NULL, 'images/template.png', '2024-08-31 22:41:38');

-- Índices de tabela `tb_funcionario`

ALTER TABLE `tb_funcionario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matricula` (`matricula`);

-- AUTO_INCREMENT de tabela `tb_funcionario`

ALTER TABLE `tb_funcionario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

-- criando a tabela tb_login
CREATE TABLE `tb_login` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `matricula` VARCHAR(8) NOT NULL,
  `password` VARCHAR(200) NOT NULL,
  `permissao` VARCHAR(50) NOT NULL,  -- Certifique-se de que o tipo de dado seja compatível
  PRIMARY KEY (`id`),
  CONSTRAINT fk_permissao FOREIGN KEY (permissao) REFERENCES tb_cargos(permissao)  -- Relaciona permissao com tb_cargos
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `tb_login` (`id`, `matricula`, `password`, `permissao`) VALUES
(1, '15151', '$2y$10$k5gFgEh7GUhHCCuqD4p6q.sGpp0cQvx0mv0kuQsd3w//6BoDKnOAa', 'gerente'),
(2, '20201', '$2y$10$k5gFgEh7GUhHCCuqD4p6q.sGpp0cQvx0mv0kuQsd3w//6BoDKnOAa', 'vendedor'),
(3, '30301', '$2y$10$k5gFgEh7GUhHCCuqD4p6q.sGpp0cQvx0mv0kuQsd3w//6BoDKnOAa', 'estoquista');



-- TABELA CARGOS


CREATE TABLE `tb_cargos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,  -- Adiciona AUTO_INCREMENT ao id
  `cargo` ENUM('gerente', 'vendedor', 'estoquista', 'caixa') NOT NULL,
  `permissao` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`)  -- Define o id como chave primária
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insere os dados na tabela `tb_cargos`
INSERT INTO `tb_cargos` (`cargo`, `permissao`) VALUES
('gerente', 'gerente'),
('vendedor', 'vendedor'),
('estoquista', 'estoquista'),
('caixa', 'caixa');



-- TABELA PRODUTO
CREATE TABLE tb_produto (
    id INT AUTO_INCREMENT PRIMARY KEY,           -- Chave primária
    codigo_produto VARCHAR(50) NOT NULL,         -- Código do Produto
    fornecedor VARCHAR(100) NOT NULL,            -- Fornecedor
    nome_peca VARCHAR(150) NOT NULL,             -- Nome da Peça
    peso DECIMAL(10, 2),                         -- Peso (kg)
    valor_varejo DECIMAL(10, 2),                 -- Valor de Varejo (moeda)
    modelo_carro VARCHAR(100),                   -- Modelo do Carro
    marca_fabricante VARCHAR(100),               -- Marca do Fabricante
    descricao_peca TEXT,                         -- Descrição da Peça
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Data de cadastro
);

-- INSERT MODELOS

INSERT INTO tb_produto (codigo_produto, fornecedor, nome_peca, peso, valor_varejo, modelo_carro, marca_fabricante, descricao_peca) VALUES
('yQ432Nt', 'Fornecedor E', 'Pneu', 5.49, 454.99, 'Others 2011', 'Marca E', 'Make five fact anything traditional seat cause.'),
('tp621Gw', 'Fornecedor A', 'Bateria', 8.59, 500.09, 'Share 2007', 'Marca E', 'As set senior this focus.'),
('mQ723nc', 'Fornecedor D', 'Filtro de Ar', 5.76, 842.06, 'Parent 2022', 'Marca D', 'Measure give group.'),
('QN732Tn', 'Fornecedor D', 'Correia', 9.86, 838.47, 'Capital 2009', 'Marca A', 'Deep west consider.'),
('aT817xy', 'Fornecedor A', 'Amortecedor', 1.82, 797.00, 'Beyond 1993', 'Marca B', 'Care executive situation.'),
('yl875hE', 'Fornecedor B', 'Bico Injetor', 5.02, 947.39, 'Smile 2021', 'Marca C', 'Contain raise eight trip if back recently as.'),
('Tu285ks', 'Fornecedor A', 'Correia', 6.73, 140.60, 'Security 1995', 'Marca A', 'Moment sell reflect.'),
('Mi425WZ', 'Fornecedor B', 'Cabo de Acelerador', 3.42, 431.58, 'Consider 2004', 'Marca B', 'Around collection loss place natural.'),
('PU462Gm', 'Fornecedor B', 'Roda', 1.58, 137.65, 'Second 2015', 'Marca C', 'Surface evening not true.'),
('XA955GX', 'Fornecedor A', 'Suspensão', 7.46, 631.84, 'Reveal 1992', 'Marca D', 'None opportunity tonight.'),
('AU623WG', 'Fornecedor E', 'Pneu', 3.64, 690.03, 'Soon 2005', 'Marca E', 'Almost six join.'),
('lC855WL', 'Fornecedor E', 'Filtro de Óleo', 4.21, 250.91, 'Consider 2022', 'Marca D', 'Many near beat loss still we remain worker.'),
('SL985bs', 'Fornecedor B', 'Correia', 1.00, 783.77, 'State 1993', 'Marca C', 'There right serve teacher.'),
('AU636wh', 'Fornecedor C', 'Farol', 1.28, 427.77, 'Great 2005', 'Marca E', 'Scene baby others prove would customer.'),
('IB043bn', 'Fornecedor A', 'Raios de Roda', 6.05, 608.08, 'Behind 2001', 'Marca E', 'Soldier blue social matter material.'),
('bC467lI', 'Fornecedor E', 'Farol', 9.37, 227.10, 'Black 1991', 'Marca D', 'Figure first go north itself.'),
('hy513tj', 'Fornecedor A', 'Radiador', 1.89, 446.44, 'State 1999', 'Marca A', 'Lose such affect can.'),
('gf752lM', 'Fornecedor B', 'Filtro de Óleo', 0.82, 484.04, 'Central 2022', 'Marca B', 'Fund audience character oil receive pick argue would.'),
('NR444Pf', 'Fornecedor A', 'Raios de Roda', 5.57, 541.03, 'Particularly 2000', 'Marca B', 'Apply likely suggest they decide husband sort.'),
('Ld189sf', 'Fornecedor A', 'Coxim do Motor', 6.75, 606.43, 'Lot 2016', 'Marca E', 'Yet brother there too top street today.'),
('ti785yK', 'Fornecedor D', 'Pneu', 6.72, 617.74, 'Man 1996', 'Marca B', 'Knowledge rate camera dinner work weight.'),
('YR181an', 'Fornecedor E', 'Roda', 2.08, 164.13, 'Color 2016', 'Marca A', 'As hard too partner.'),
('Ox539zj', 'Fornecedor B', 'Farol', 1.84, 170.51, 'Left 2013', 'Marca D', 'Program majority significant painting will campaign entire.'),
('gC519eH', 'Fornecedor C', 'Pneu', 7.26, 364.33, 'Can 1990', 'Marca B', 'Finally everyone despite wide fill.'),
('Gx638Ng', 'Fornecedor B', 'Cabo de Freio', 3.64, 327.08, 'We 1996', 'Marca B', 'Low between gas.'),
('Si805Mu', 'Fornecedor B', 'Carter', 1.84, 883.05, 'Chance 2004', 'Marca D', 'Into personal consider wall pattern far million.'),
('Rc714CA', 'Fornecedor D', 'Transmissão', 1.73, 491.31, 'Offer 1991', 'Marca A', 'East ability yes would power daughter ok.'),
('Oj233Qh', 'Fornecedor B', 'Válvula', 8.42, 452.45, 'Increase 2003', 'Marca B', 'Society fine ready play.'),
('ov912UR', 'Fornecedor C', 'Motor', 3.12, 789.19, 'Degree 1995', 'Marca B', 'Various large knowledge game nearly crime morning.'),
('qW781pR', 'Fornecedor E', 'Parachoque', 2.81, 556.03, 'Service 2010', 'Marca A', 'Direction activity forget former.');

-- TABELA FORNECEDOR
CREATE TABLE tb_fornecedor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fornecedor VARCHAR(255) NOT NULL,
    razao_social VARCHAR(255) NOT NULL,
    cnpj VARCHAR(18) NOT NULL UNIQUE,
    insc_estadual VARCHAR(20) NOT NULL,
    endereco VARCHAR(255) NOT NULL,
    bairro VARCHAR(100) NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    estado CHAR(2) NOT NULL,
    situacao ENUM('Ativa', 'Desativada', 'Bloqueada') NOT NULL,
    email VARCHAR(255) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO tb_fornecedor (fornecedor, razao_social, cnpj, insc_estadual, endereco, bairro, telefone, cidade, estado, situacao, email)
VALUES
('Fornecedor A', 'Fornecedor A LTDA', '12.345.678/0001-01', '123456789', 'Rua A, 100', 'Bairro 1', '(11) 98765-4321', 'São Paulo', 'SP', 'Ativa', 'fornecedorA@example.com'),
('Fornecedor B', 'Fornecedor B LTDA', '98.765.432/0001-02', '987654321', 'Rua B, 200', 'Bairro 2', '(21) 91234-5678', 'Rio de Janeiro', 'RJ', 'Ativa', 'fornecedorB@example.com'),
('Fornecedor C', 'Fornecedor C ME', '56.123.789/0001-03', '567891234', 'Rua C, 300', 'Bairro 3', '(31) 99876-5432', 'Belo Horizonte', 'MG', 'Desativada', 'fornecedorC@example.com'),
('Fornecedor D', 'Fornecedor D LTDA', '78.456.123/0001-04', '789123456', 'Rua D, 400', 'Bairro 4', '(41) 92345-6789', 'Curitiba', 'PR', 'Bloqueada', 'fornecedorD@example.com'),
('Fornecedor E', 'Fornecedor E EIRELI', '34.567.890/0001-05', '345678901', 'Rua E, 500', 'Bairro 5', '(61) 93456-7890', 'Brasília', 'DF', 'Ativa', 'fornecedorE@example.com'),
('Fornecedor F', 'Fornecedor F LTDA', '23.678.901/0001-06', '236789012', 'Rua F, 600', 'Bairro 6', '(71) 94567-8901', 'Salvador', 'BA', 'Ativa', 'fornecedorF@example.com'),
('Fornecedor G', 'Fornecedor G ME', '89.012.345/0001-07', '890123456', 'Rua G, 700', 'Bairro 7', '(51) 95678-9012', 'Porto Alegre', 'RS', 'Desativada', 'fornecedorG@example.com');

-- TABELA VEICULOS

CREATE TABLE tb_veiculo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fabricante VARCHAR(255) NOT NULL,
    veiculo VARCHAR(255) NOT NULL,
    tipo_motor VARCHAR(100) NOT NULL,
    ano_lancamento YEAR NOT NULL,
    ano_encerramento YEAR NOT NULL,
    modelo VARCHAR(255) NOT NULL,
    item_agregado VARCHAR(255) NOT NULL
);
-- TABELA ESTOQUE
CREATE TABLE tb_estoque (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_peca VARCHAR(255) NOT NULL,
    localizacao VARCHAR(255) NOT NULL,
    corredor VARCHAR(100) NOT NULL,
    posicao VARCHAR(100) NOT NULL,
    nivel VARCHAR(50) NOT NULL,
    quantidade INT NOT NULL,
    fornecedor VARCHAR(255) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

--tb compra
CREATE TABLE `tb_compra` (
  `id` int(11) NOT NULL,
  `cliente_cpfcnpj` varchar(20) DEFAULT NULL,
  `cliente_nome` varchar(100) DEFAULT NULL,
  `produto_nome` varchar(100) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `valor_unitario` decimal(10,2) DEFAULT NULL,
  `valor_total` decimal(10,2) DEFAULT NULL,
  `forma_pagamento` varchar(50) DEFAULT NULL,
  `finalizado` TINYINT(1) NOT NULL CHECK (`finalizado` IN (0, 1)),
  `data_compra` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `tb_compra`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tb_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

ALTER TABLE `tb_compra`
  MODIFY `finalizado` TINYINT(1) NOT NULL DEFAULT 0 CHECK (`finalizado` IN (0, 1));
