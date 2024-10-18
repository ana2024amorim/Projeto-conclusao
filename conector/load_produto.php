<?php
require_once "conector_db.php";

header('Content-Type: application/json');

$query = "SELECT codigo_produto, nome, preco FROM tb_produto"; // Altere conforme necessário
$result = $conn->query($query);

if ($result) {
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo json_encode(['success' => true, 'products' => $products]);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao carregar produtos.']);
}

$conn->close();
?>
