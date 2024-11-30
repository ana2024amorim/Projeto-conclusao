<?php
header('Content-Type: application/json');

require_once "conector_db.php"; // Inclua seu arquivo de conexão

// Verificar conexão
if ($conn->connect_error) {
    echo json_encode(["error" => "Falha na conexão com o banco de dados: " . $conn->connect_error]);
    exit;
}

// Receber os dados JSON enviados
$input = json_decode(file_get_contents('php://input'), true);

// Verificar e extrair o parâmetro ids_concatenados
if (!isset($input['ids_concatenados']) || empty($input['ids_concatenados'])) {
    echo json_encode(["error" => "Por favor, forneça o parâmetro 'ids_concatenados'."]);
    exit;
}

// Converter ids_concatenados em um array de IDs
$ids = array_map('intval', explode(',', $input['ids_concatenados'])); // Garantir que os valores sejam inteiros

// Validar entrada
if (empty($ids)) {
    echo json_encode(["error" => "Por favor, forneça pelo menos um ID válido."]);
    exit;
}

// Construir consulta SQL com parâmetros (usando IN para múltiplos IDs)
$placeholders = implode(',', array_fill(0, count($ids), '?'));
$sql = "SELECT id, cliente_cpfcnpj, cliente_nome, produto_nome, quantidade, valor_unitario, valor_total, forma_pagamento, finalizado, `update`, entrega, data_compra 
        FROM tb_compra 
        WHERE id IN ($placeholders)";

$stmt = $conn->prepare($sql);

// Bind dos parâmetros para os placeholders
$stmt->bind_param(str_repeat('i', count($ids)), ...$ids); // Assume que os IDs são inteiros

// Executar consulta
$stmt->execute();
$result = $stmt->get_result();

// Extrair os resultados
$vendas = [];
while ($row = $result->fetch_assoc()) {
    // Organize the data for the response
    $vendas[] = [
        'id' => $row['id'],
        'cliente_nome' => $row['cliente_nome'],
        'cliente_cpfcnpj' => $row['cliente_cpfcnpj'],
        'data_compra' => $row['data_compra'],
        'valor_total' => $row['valor_total'],
        'forma_pagamento' => $row['forma_pagamento'],
        'produtos' => [
            [
                'produto_nome' => $row['produto_nome'],
                'quantidade' => $row['quantidade'],
                'valor_unitario' => $row['valor_unitario'],
            ]
        ]
    ];
}

// Enviar a resposta
echo json_encode($vendas);

// Fechar conexão
$stmt->close();
$conn->close();
?>
