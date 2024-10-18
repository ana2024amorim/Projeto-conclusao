<?php
require_once "conector_db.php"; // Certifique-se de que o caminho está correto

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo_produto = $_POST['codigo_produto'] ?? null;

    if (!$codigo_produto) {
        echo json_encode(['success' => false, 'message' => 'Código do produto não fornecido.']);
        exit;
    }

    if (!is_string($codigo_produto)) {
        echo json_encode(['success' => false, 'message' => 'Código do produto inválido.']);
        exit;
    }

    $stmt = $conn->prepare("DELETE FROM tb_produto WHERE codigo_produto = ?");
    $stmt->bind_param("s", $codigo_produto); // Aqui vinculamos o código do produto corretamente

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Produto excluído com sucesso.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao excluir produto: ' . $stmt->error]);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
}

$conn->close();
?>
