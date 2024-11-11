<?php
// Ativa o relatório de erros do MySQLi para melhor depuração
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Inicia a conexão com o banco de dados
require_once "conector_db.php";
$mensagem = ''; // Variável para armazenar a mensagem

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Coleta os dados do formulário com proteção contra SQL Injection
    $cpf_cnpj = mysqli_real_escape_string($conn, $_POST['cpf_cnpj']);
    $razao_nome = mysqli_real_escape_string($conn, $_POST['razao_nome']);
    $cep = mysqli_real_escape_string($conn, $_POST['cep']);
    $cidade = mysqli_real_escape_string($conn, $_POST['cidade']);
    $endereco = mysqli_real_escape_string($conn, $_POST['endereco']);
    $complemento = mysqli_real_escape_string($conn, $_POST['complemento']);
    $bairro = mysqli_real_escape_string($conn, $_POST['bairro']);
    $uf = mysqli_real_escape_string($conn, $_POST['uf']);
    $telefone = mysqli_real_escape_string($conn, $_POST['telefone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $rginscricao = mysqli_real_escape_string($conn, $_POST['rginscricao']);
    $sitcad = mysqli_real_escape_string($conn, $_POST['sitcad']);

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
    
    // Retorna a mensagem como JSON para o JavaScript
    echo json_encode(['mensagem' => $mensagem]);
}
?>
