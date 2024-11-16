<?php

require_once "conector_db.php"; // Inclua seu arquivo de conexão

// Obtendo a data do filtro ou a data atual
$data_filtro = isset($_POST['data_filtro']) ? $_POST['data_filtro'] : date('Y-m-d');

// Preparando a consulta
$sql = "
    SELECT 
        forma_pagamento,
        SUM(valor_total) AS valor_total,
        COUNT(DISTINCT cliente_cpfcnpj) AS quantidade_vendas
    FROM 
        tb_compra
    WHERE 
        finalizado = 1 AND DATE(data_compra) = ?
    GROUP BY 
        forma_pagamento
";

// Preparar a declaração
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die(json_encode(["sucesso" => false, "mensagem" => "Erro ao preparar a consulta: " . $conn->error]));
}

// Bind dos parâmetros
$stmt->bind_param("s", $data_filtro);

// Executa a consulta
$stmt->execute();

// Obtendo os resultados
$result = $stmt->get_result();

$response = []; // Array para armazenar os resultados

// Inicializando valores por forma de pagamento com 0
$forma_pagamento_totals = [
    'cartao_credito' => 0,
    'pix' => 0,
    'Cartão de Débito' => 0,
    'Boleto' => 0,
    'dinheiro' => 0
];

$total_vendas = 0; // Inicializa a quantidade total de vendas
$total_pago = 0;   // Inicializa o valor total pago

if ($result->num_rows > 0) {
    // Processando os resultados
    while ($row = $result->fetch_assoc()) {
        // Atribuindo o valor de forma de pagamento específica
        if (array_key_exists($row['forma_pagamento'], $forma_pagamento_totals)) {
            $forma_pagamento_totals[$row['forma_pagamento']] = number_format($row['valor_total'], 2, ',', '.');
        }
        // Somando a quantidade total de vendas
        $total_vendas += $row['quantidade_vendas'];
        // Somando o valor total pago
        $total_pago += $row['valor_total'];
    }

    // Preenchendo o array de resposta
    $response = [
        'qtdVendas' => $total_vendas,
        'valorTotal' => number_format($total_pago, 2, ',', '.'),
        'cartaoCredito' => $forma_pagamento_totals['cartao_credito'],
        'pix' => $forma_pagamento_totals['pix'],
        'cartaoDebito' => $forma_pagamento_totals['Cartão de Débito'],
        'boleto' => $forma_pagamento_totals['Boleto'],
        'dinheiro' => $forma_pagamento_totals['dinheiro']
    ];

    // Retornando os dados como JSON
    echo json_encode(["sucesso" => true, "resultados" => $response]);
} else {
    // Retornando a mensagem de erro caso não haja resultados
    echo json_encode(["sucesso" => false, "mensagem" => "Nenhum dado encontrado para a data " . $data_filtro]);
}

// Fechando a conexão
$stmt->close();
$conn->close();
?>
