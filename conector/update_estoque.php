<?php
require_once "conector_db.php"; // Inclua seu arquivo de conexão ao banco de dados

header('Content-Type: application/json; charset=utf-8'); // Define o cabeçalho para JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lê o corpo da requisição JSON
    $data = json_decode(file_get_contents("php://input"), true);

    // Verifica se todos os dados necessários estão presentes
    if (isset($data['codigo_peca'], $data['localizacao'], $data['corredor'], $data['posicao'], $data['nivel'], $data['quantidade'], $data['fornecedor'])) {
        
        // Extrai os dados
        $codigo_peca = $data['codigo_peca'];
        $localizacao = $data['localizacao'];
        $corredor = $data['corredor'];
        $posicao = $data['posicao'];
        $nivel = $data['nivel'];
        $quantidade = $data['quantidade'];
        $fornecedor = $data['fornecedor'];

        // Prepara a consulta de atualização
        $stmt = $conn->prepare("UPDATE tb_estoque SET localizacao=?, corredor=?, posicao=?, nivel=?, quantidade=?, fornecedor=? WHERE codigo_peca=?");
        $stmt->bind_param("sssisds", $localizacao, $corredor, $posicao, $nivel, $quantidade, $fornecedor, $codigo_peca); // Vincula os parâmetros

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Estoque atualizado com sucesso.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao atualizar estoque: ' . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Dados do formulário não estão completos.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
}

$conn->close();
?>
