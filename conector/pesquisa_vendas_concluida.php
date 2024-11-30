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

// Extrair os parâmetros
$nome = isset($input['cliente_nome']) ? trim($input['cliente_nome']) : '';
$cpfCnpj = isset($input['cliente_cpfcnpj']) ? trim($input['cliente_cpfcnpj']) : '';

// Validar entrada
if (empty($nome) && empty($cpfCnpj)) {
    echo json_encode(["error" => "Por favor, forneça pelo menos um dos filtros: nome ou CPF/CNPJ."]);
    exit;
}

// Construir consulta SQL com parâmetros
$sql = "SELECT id, cliente_cpfcnpj, cliente_nome, data_compra 
        FROM tb_compra 
        WHERE finalizado = 1 AND `update` = 1 AND entrega = 1";

if (!empty($nome)) {
    $sql .= " AND cliente_nome LIKE ?";
}

if (!empty($cpfCnpj)) {
    $sql .= " AND cliente_cpfcnpj LIKE ?";
}

$sql .= " ORDER BY data_compra"; // Ordenação por data

$stmt = $conn->prepare($sql);

if (!empty($nome) && !empty($cpfCnpj)) {
    $stmt->bind_param('ss', $nomeLike, $cpfCnpjLike);
    $nomeLike = "%" . $nome . "%";
    $cpfCnpjLike = "%" . $cpfCnpj . "%";
} elseif (!empty($nome)) {
    $stmt->bind_param('s', $nomeLike);
    $nomeLike = "%" . $nome . "%";
} elseif (!empty($cpfCnpj)) {
    $stmt->bind_param('s', $cpfCnpjLike);
    $cpfCnpjLike = "%" . $cpfCnpj . "%";
}

// Executar consulta
$stmt->execute();
$result = $stmt->get_result();

// Agrupar os resultados por data
$vendasPorData = [];

while ($row = $result->fetch_assoc()) {
    $dataCompra = $row['data_compra'];

    // Se a data ainda não está no array, inicializa
    if (!isset($vendasPorData[$dataCompra])) {
        $vendasPorData[$dataCompra] = [
            'cliente_nome' => $row['cliente_nome'],
            'cliente_cpfcnpj' => $row['cliente_cpfcnpj'],
            'data_compra' => $dataCompra,
            'ids_concatenados' => []
        ];
    }

    // Adiciona o ID à lista de IDs dessa data
    $vendasPorData[$dataCompra]['ids_concatenados'][] = $row['id'];
}

// Transformar os dados agrupados para o formato final
$response = [];
foreach ($vendasPorData as $data => $venda) {
    $response[] = [
        'cliente_nome' => $venda['cliente_nome'],
        'cliente_cpfcnpj' => $venda['cliente_cpfcnpj'],
        'data_compra' => $venda['data_compra'],
        'ids_concatenados' => implode(", ", $venda['ids_concatenados']) // Concatena os IDs
    ];
}

// Retorna a resposta em formato JSON
echo json_encode($response);

// Fechar conexão
$stmt->close();
$conn->close();
?>
