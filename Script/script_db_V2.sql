CREATE TABLE tb_funcionario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    genero ENUM('masculino', 'feminino', 'outro') NOT NULL,
    data_nascimento DATE NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    matricula VARCHAR(4) NOT NULL UNIQUE,
    cargo VARCHAR(255) NOT NULL,
    nivel_acesso INT NOT NULL CHECK (nivel_acesso BETWEEN 1 AND 3),
    foto VARCHAR(255),
    senha VARCHAR(255) NOT NULL
);
