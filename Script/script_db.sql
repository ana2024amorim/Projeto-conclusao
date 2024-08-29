
--Scrpt de criação do banco de dados e dados do modelo
-- Banco de dados: `db_guardian`

-- Estrutura para tabela `tb_login`
--

-- Criando o database

CREATE DATABASE db_guardian;

--criando usuario e senha de acesso ao banco
CREATE USER 'user_guardian'@'localhost' IDENTIFIED BY '123456';
GRANT ALL PRIVILEGES ON db_guardian.* TO 'user_guardian'@'localhost';
FLUSH PRIVILEGES;


-- criando a tabela tb_login

CREATE TABLE `tb_login` (
  `id` int(11) NOT NULL,
  `matricula` varchar(8) NOT NULL,
  `password` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--inserindo dado de acesso do 1 usuario para login

INSERT INTO `tb_login` (`id`, `matricula`, `password`) VALUES
(1, '15151', '123456');

--criando a tabela cadastro cliente
CREATE TABLE tb_cliente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cpf_cnpj VARCHAR(20) NOT NULL,
    razao_nome VARCHAR(100) NOT NULL,
    cep VARCHAR(10) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    endereco VARCHAR(150) NOT NULL,
    complemento VARCHAR(10) NOT NULL,
    bairro VARCHAR(100) NOT NULL,
    uf VARCHAR(10) NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    email VARCHAR(100) NOT NULL
);
