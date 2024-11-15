<?php
// Conexão com o banco de dados
require_once 'conector_db.php'; // Ajuste o caminho conforme necessário

// Variáveis de dados
$pixKey = $description = $merchantName = $merchantCity = $amount = $txid = '';

// Verifica se a conexão com o banco foi bem-sucedida
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Consulta para buscar os dados na tabela tb_dadosbanco
$sql = "SELECT Pix_key, description, merchant_name, merchant_city, txid FROM tb_dadosbanco LIMIT 1"; // Ajuste conforme necessário

// Executa a consulta
$result = $conn->query($sql);

// Verifica se houve erro na consulta
if (!$result) {
    die("Erro na consulta SQL: " . $conn->error);
}

// Verifica se encontrou algum dado
if ($result->num_rows > 0) {
    // Recupera os dados do banco
    $row = $result->fetch_assoc();
    
    // Preenche as variáveis com os dados
    $data = array(
        'pixKey' => $row['Pix_key'],
        'description' => $row['description'],
        'merchantName' => $row['merchant_name'],
        'merchantCity' => $row['merchant_city'],
        'txid' => $row['txid']
    );
    
    // Retorna os dados em formato JSON
    echo json_encode($data);
} else {
    // Retorna uma mensagem de erro em JSON
    echo json_encode(array('error' => 'Dados não encontrados.'));
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
