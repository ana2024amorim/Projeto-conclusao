<?php
require_once "conector_db.php"; // Inclua seu arquivo de conexão ao banco de dados

header('Content-Type: application/json; charset=utf-8'); // Define o cabeçalho para JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lê o código da peça da requisição
    $codigo_peca = json_decode(file_get_contents("php://input"))->codigo_peca ?? null;

    // Verifica se o código da peça foi fornecido
    if (!$codigo_peca) {
        echo json_encode(['success' => false, 'message' => 'Código da peça não fornecido.']);
        exit;
    }

    // Prepara a consulta para carregar os detalhes do item
    $stmt = $conn->prepare("SELECT codigo_peca, localizacao, corredor, posicao, nivel, quantidade, fornecedor FROM tb_estoque WHERE codigo_peca = ?");
    $stmt->bind_param("s", $codigo_peca); // Vincula o código da peça

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Se o item for encontrado, retorna os dados
            $item = $result->fetch_assoc();
            echo json_encode(['success' => true, 'item' => $item]);
        } else {
            // Se o item não for encontrado, retorna uma mensagem de erro
            echo json_encode(['success' => false, 'message' => 'Item não encontrado.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao carregar item: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
}

$conn->close();
?>
