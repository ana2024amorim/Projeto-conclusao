<?php
require_once "conector_db.php"; // Inclua seu arquivo de conexão ao banco de dados



if (isset($_GET['cnpj'])) {
    $cnpj = $conn->real_escape_string($_GET['cnpj']);
    
    $sql = "SELECT razao_nome FROM tb_cliente WHERE cpf_cnpj = '$cnpj'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $cliente = $result->fetch_assoc();
        echo json_encode(['nome' => $cliente['razao_nome']]);
    } else {
        echo json_encode(['nome' => null]);
    }
} elseif (isset($_GET['cpf'])) {
    $cpf = $conn->real_escape_string($_GET['cpf']);
    
    $sql = "SELECT razao_nome FROM tb_cliente WHERE cpf_cnpj = '$cpf'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $cliente = $result->fetch_assoc();
        echo json_encode(['nome' => $cliente['razao_nome']]);
    } else {
        echo json_encode(['nome' => null]);
    }
}

$conn->close();
?>
