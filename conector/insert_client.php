<?php
// Inicia a conexão com o banco de dados
require_once "conector_db.php";

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Coleta os dados do formulário
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

    // Monta a query SQL para inserção dos dados
    $query = "INSERT INTO tb_cliente (cpf_cnpj, razao_nome, cep, cidade, endereco, complemento, bairro, uf, telefone, email)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepara a instrução SQL
    if ($stmt = $conn->prepare($query)) {
        // Associa os parâmetros
        $stmt->bind_param("ssssssssss", $cpf_cnpj, $razao_nome, $cep, $cidade, $endereco, $complemento, $bairro, $uf, $telefone, $email);

        // Executa a query
        if ($stmt->execute()) {
            // Redireciona para uma página de sucesso ou exibe uma mensagem de sucesso
            echo "Cadastro realizado com sucesso!";
        } else {
            // Exibe uma mensagem de erro caso a inserção falhe
            echo "Erro ao cadastrar: " . $stmt->error;
        }

        // Fecha a conexao
        $stmt->close();
    } else {
        // Exibe uma mensagem de erro caso a preparação da query falhe
        echo "Erro na preparação da consulta: " . $conn->error;
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}
?>
