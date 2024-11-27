<?php
// Ativa o relatório de erros do MySQLi para melhor depuração
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Inicia a conexão com o banco de dados
require_once "conector_db.php";
$mensagem = ''; // Variável para armazenar a mensagem
$sucesso = false; // Flag para indicar se o cadastro foi bem-sucedido

// Verifica se o corpo da requisição é JSON
$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    // Coleta os dados do JSON
    $cpf_cnpj = mysqli_real_escape_string($conn, $data['cpf_cnpj']);
    $razao_nome = mysqli_real_escape_string($conn, $data['razao_nome']);
    $cep = mysqli_real_escape_string($conn, $data['cep']);
    $cidade = mysqli_real_escape_string($conn, $data['cidade']);
    $endereco = mysqli_real_escape_string($conn, $data['endereco']);
    $complemento = mysqli_real_escape_string($conn, $data['complemento']);
    $bairro = mysqli_real_escape_string($conn, $data['bairro']);
    $uf = mysqli_real_escape_string($conn, $data['uf']);
    $telefone = mysqli_real_escape_string($conn, $data['telefone']);
    $email = mysqli_real_escape_string($conn, $data['email']);
    $rginscricao = mysqli_real_escape_string($conn, $data['rginscricao']);
    $sitcad = mysqli_real_escape_string($conn, $data['sitcad']);

    // Verifica se o CPF/CNPJ já existe no banco de dados
    $check_query = "SELECT cpf_cnpj FROM tb_cliente WHERE cpf_cnpj = ?";
    if ($stmt = $conn->prepare($check_query)) {
        // Associa o parâmetro
        $stmt->bind_param("s", $cpf_cnpj);

        // Executa a query
        $stmt->execute();
        $stmt->store_result();

        // Verifica se o CPF/CNPJ já está cadastrado
        if ($stmt->num_rows > 0) {
            $mensagem = "Cliente já cadastrado com esse CPF/CNPJ!";
        } else {
            // Prepara a instrução de inserção
            $query = "INSERT INTO tb_cliente (cpf_cnpj, razao_nome, cep, cidade, endereco, complemento, bairro, uf, telefone, email, rginscricao, sitcad)
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            // Prepara a instrução SQL de inserção
            if ($stmt_insert = $conn->prepare($query)) {
                // Associa os parâmetros
                $stmt_insert->bind_param("ssssssssssss", $cpf_cnpj, $razao_nome, $cep, $cidade, $endereco, $complemento, $bairro, $uf, $telefone, $email, $rginscricao, $sitcad);

                // Executa a query de inserção
                if ($stmt_insert->execute()) {
                    $mensagem = "Cadastro realizado com sucesso!";
                    $sucesso = true; // Define a flag de sucesso para true
                } else {
                    $mensagem = "Erro ao cadastrar: " . $stmt_insert->error;
                }

                // Fecha a consulta de inserção
                $stmt_insert->close();
            } else {
                $mensagem = "Erro na preparação da consulta de inserção: " . $conn->error;
            }
        }

        // Fecha a consulta de verificação
        $stmt->close();
    } else {
        $mensagem = "Erro na preparação da consulta de verificação: " . $conn->error;
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
    
    // Retorna a mensagem e o status como JSON para o JavaScript
    echo json_encode(['mensagem' => $mensagem, 'sucesso' => $sucesso]);
} else {
    // Se os dados não forem encontrados ou forem inválidos
    echo json_encode(['mensagem' => 'Dados inválidos!', 'sucesso' => false]);
}
?>
