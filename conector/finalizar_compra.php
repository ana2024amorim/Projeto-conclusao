
<?php
require_once "conector_db.php"; // Inclua seu arquivo de conexão ao banco de dados

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Coleta os dados do POST
$clienteCnpj = $_POST['cliente_cpfcnpj'];
$clienteNome = $_POST['cliente_nome'];
$formaPagamento = $_POST['forma_pagamento'];
$produtos = $_POST['produtos'];

// Define o valor de "finalizado" com base no método de pagamento
$finalizado = ($formaPagamento === 'pix') ? 1 : 0;

// Insere os produtos na tabela usando prepared statements
$stmt = $conn->prepare("INSERT INTO tb_compra (cliente_cpfcnpj, cliente_nome, produto_nome, quantidade, valor_unitario, valor_total, forma_pagamento, finalizado) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

foreach ($produtos as $produto) {
    $nomeProduto = $produto['nome'];
    $quantidade = $produto['quantidade'];
    $valorUnitario = $produto['valor_unitario'];
    $valorTotal = $produto['valor_total'];

    // Vincula os parâmetros
    $stmt->bind_param("sssiddsi", $clienteCnpj, $clienteNome, $nomeProduto, $quantidade, $valorUnitario, $valorTotal, $formaPagamento, $finalizado);

    // Executa a consulta e verifica se ocorreu algum erro
    if (!$stmt->execute()) {
        echo "Erro ao inserir dados: " . $stmt->error;
        exit(); // Sai do loop se houver erro
    }
}

echo "Compra finalizada com sucesso";

// Fecha a declaração e a conexão
$stmt->close();
$conn->close();
?>
