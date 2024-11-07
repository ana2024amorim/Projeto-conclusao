<?php
// Conexão com o banco de dados
require_once "conector_db.php"; // Inclua seu arquivo de conexão

// Consulta SQL para buscar dados agrupados por cliente, incluindo o CPF ou CNPJ
$sql = "SELECT cliente_nome, cliente_cpfcnpj, SUM(valor_total) AS valor_total, forma_pagamento,
               GROUP_CONCAT(produto_nome) AS nomeproduto,
               GROUP_CONCAT(quantidade) AS quantidade,
               GROUP_CONCAT(valor_unitario) AS valor_unitario
        FROM tb_compra 
        WHERE finalizado = 0 
        GROUP BY cliente_nome, cliente_cpfcnpj"; // Adicionado cliente_cpfcnpj no GROUP BY

$result = $conn->query($sql);

// Cria um array para armazenar os resultados
$clientes = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $clientes[] = array(
            'cliente_nome' => $row['cliente_nome'],
            'cliente_cpfcnpj' => $row['cliente_cpfcnpj'],
            'valor_total' => $row['valor_total'],
            'forma_pagamento' => $row['forma_pagamento'],
            'nomeproduto' => explode(',', $row['nomeproduto']),
            'quantidade' => explode(',', $row['quantidade']),
            'valor_unitario' => explode(',', $row['valor_unitario'])
        );
    }
}

// Retorna os dados em formato JSON
header('Content-Type: application/json');
echo json_encode($clientes);

// Fecha a conexão
$conn->close();
?>
