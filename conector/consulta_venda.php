<?php
// Conexão com o banco de dados
require_once "conector_db.php"; // Inclua seu arquivo de conexão

// Consulta SQL para buscar dados agrupados por cliente e calcular o total das compras
$sql = "SELECT cliente_nome, SUM(valor_total) AS valor_total, forma_pagamento,
               GROUP_CONCAT(produto_nome) AS nomeproduto,
               GROUP_CONCAT(quantidade) AS quantidade,
               GROUP_CONCAT(valor_unitario) AS valor_unitario
        FROM tb_compra 
        WHERE finalizado = 0 
        GROUP BY cliente_nome";

$result = $conn->query($sql);

// Cria um array para armazenar os resultados
$clientes = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $clientes[] = $row;
    }
}

// Retorna os dados em formato JSON
header('Content-Type: application/json');
echo json_encode($clientes);

// Fecha a conexão
$conn->close();
?>
