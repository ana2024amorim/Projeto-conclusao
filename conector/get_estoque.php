<?php
require_once "conector_db.php"; // Inclua seu arquivo de conexão ao banco de dados

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Recebe o JSON enviado pela requisição
$data = json_decode(file_get_contents("php://input"), true);

// Define o cabeçalho para JSON
header('Content-Type: application/json');

// Verifica se o código da peça foi enviado
if (isset($data['codigo_peca'])) {
    $codigo_peca = $data['codigo_peca'];

    // Prepara a consulta SQL para obter os dados do estoque
    $stmt = $conn->prepare("SELECT codigo_peca, localizacao, corredor, posicao, nivel, quantidade, fornecedor FROM tb_estoque WHERE codigo_peca = ?");
    $stmt->bind_param("s", $codigo_peca); // Supondo que o código da peça é uma string

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // Retorna os dados da peça em formato JSON
            echo json_encode($result->fetch_assoc());
        } else {
            // Retorna um erro caso a peça não seja encontrada
            echo json_encode(["error" => "Peça não encontrada."]);
        }
    } else {
        // Retorna um erro se a consulta falhar
        echo json_encode(["error" => "Erro na execução da consulta."]);
    }

    $stmt->close();
} else {
    // Retorna um erro caso o código da peça não seja enviado
    echo json_encode(["error" => "Código da peça não fornecido."]);
}

$conn->close();
?>
