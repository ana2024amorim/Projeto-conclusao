<?php
require_once "conector_db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lê o código do produto da requisição
    $codigo_produto = json_decode(file_get_contents("php://input"))->codigo_produto;

    // Debug: Verifique o valor de $codigo_produto
    error_log("Código do Produto: " . $codigo_produto); // Registra o código do produto no log

    // Prepara a consulta SQL
    $stmt = $conn->prepare("SELECT * FROM tb_produto WHERE codigo_produto = ?");
    $stmt->bind_param("s", $codigo_produto); // Altera de "i" para "s" para tratar como string
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Se o produto for encontrado, retorna os dados
        $produto = $result->fetch_assoc();
        echo json_encode($produto);
    } else {
        // Se o produto não for encontrado, retorna uma mensagem de erro
        echo json_encode(['success' => false, 'message' => 'Produto não encontrado.']);
    }
    $stmt->close();
}

$conn->close();
?>

