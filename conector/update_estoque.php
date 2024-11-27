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
        $quantidade = (int)$data['quantidade']; // Garantir que quantidade seja um inteiro
        $fornecedor = strtoupper(trim($data['fornecedor'])); // Remover espaços e normalizar para maiúsculas

        // Verifique se a quantidade é um número válido
        if ($quantidade <= 0) {
            echo json_encode(['success' => false, 'message' => 'Quantidade inválida.']);
            exit;
        }

        // Verifica se o fornecedor existe na tabela tb_fornecedor
        $fornecedor_check = $conn->prepare("SELECT 1 FROM tb_fornecedor WHERE fornecedor = ?");
        $fornecedor_check->bind_param("s", $fornecedor);
        $fornecedor_check->execute();
        $fornecedor_check->store_result();

        // Se o fornecedor não for encontrado
        if ($fornecedor_check->num_rows == 0) {
            echo json_encode(['success' => false, 'message' => 'Fornecedor não encontrado.']);
            $fornecedor_check->close();
            exit;
        } else {
            echo json_encode(['success' => true, 'message' => 'Fornecedor encontrado.']);  // Mensagem de debug
        }
        $fornecedor_check->close();

        // Prepara a consulta de atualização
        $stmt = $conn->prepare("UPDATE tb_estoque SET localizacao=?, corredor=?, posicao=?, nivel=?, quantidade=?, fornecedor=? WHERE codigo_peca=?");
        if ($stmt === false) {
            echo json_encode(['success' => false, 'message' => 'Erro ao preparar a consulta: ' . $conn->error]);
            exit;
        }

        // Vincula os parâmetros na ordem correta
        $stmt->bind_param("sssisds", $localizacao, $corredor, $posicao, $nivel, $quantidade, $fornecedor, $codigo_peca);

        // Executa a consulta
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
