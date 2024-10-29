<?php
require_once "conector_db.php"; // Inclua seu arquivo de conexão ao banco de dados

// Verifica conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Coleta os dados do POST
$clienteCnpj = $_POST['cliente_cpfcnpj'];
$clienteNome = $_POST['cliente_nome'];
$formaPagamento = $_POST['forma_pagamento'];
$produtos = $_POST['produtos'];

// Insere os produtos na tabela
foreach ($produtos as $produto) {
    $nomeProduto = $produto['nome'];
    $quantidade = $produto['quantidade'];
    $valorUnitario = $produto['valor_unitario'];
    $valorTotal = $produto['valor_total'];

    $sql = "INSERT INTO tb_compra (cliente_cpfcnpj, cliente_nome, produto_nome, quantidade, valor_unitario, valor_total, forma_pagamento)
            VALUES ('$clienteCnpj', '$clienteNome', '$nomeProduto', $quantidade, $valorUnitario, $valorTotal, '$formaPagamento')";

    if (!$conn->query($sql)) {
        echo "Erro ao inserir dados: " . $conn->error;
    }
}

echo "Compra finalizada com sucesso";

$conn->close();
?>
