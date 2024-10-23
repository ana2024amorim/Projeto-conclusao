<?php
require_once "conector_db.php"; // Inclua seu arquivo de conexão ao banco de dados

header('Content-Type: application/json; charset=utf-8'); // Define o cabeçalho para JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lê o corpo da requisição JSON
    $data = json_decode(file_get_contents("php://input"), true);
    $codigo_peca = $data['codigo_peca'] ?? null;

    // Verifica se o código da peça foi fornecido
    if (!$codigo_peca) {
        echo json_encode(['success' => false, 'message' => 'Código da peça não fornecido.']);
        exit;
    }

    // Prepara a consulta de deleção
    $stmt = $conn->prepare("DELETE FROM tb_estoque WHERE codigo_peca = ?");
    $stmt->bind_param("s", $codigo_peca); // Vincula o código da peça

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Item de estoque excluído com sucesso.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao excluir item: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
}

$conn->close();
?>
