<?php
require_once "conector_db.php"; // Inclua seu arquivo de conexão ao banco de dados

header('Content-Type: application/json; charset=utf-8'); // Define o cabeçalho para JSON

// Garantir que a conexão use UTF-8
mysqli_set_charset($conn, "utf8");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lê o corpo da requisição JSON
    $data = json_decode(file_get_contents("php://input"), true);

    // Verifica se os dados necessários estão presentes
    if (isset($data['codigo_peca'], $data['localizacao'], $data['corredor'], $data['posicao'], $data['nivel'], $data['quantidade'], $data['fornecedor'])) {
        // Extrai e limpa os dados recebidos
        $codigo_peca = trim($data['codigo_peca']);
        $localizacao = trim($data['localizacao']);
        $corredor = trim($data['corredor']);
        $posicao = trim($data['posicao']);
        $nivel = trim($data['nivel']);
        $quantidade = trim($data['quantidade']);
        $fornecedor = trim($data['fornecedor']); // Não converti para maiúsculas, pois não é necessário

        // Verifica se o código da peça existe na tabela tb_estoque
        $peca_check = $conn->prepare("SELECT codigo_peca FROM tb_estoque WHERE codigo_peca = ?");
        if ($peca_check === false) {
            echo json_encode(['success' => false, 'message' => 'Erro ao preparar a consulta de verificação da peça: ' . $conn->error]);
            exit;
        }

        $peca_check->bind_param("s", $codigo_peca);
        $peca_check->execute();
        $result = $peca_check->get_result();

        if ($result->num_rows == 0) {
            echo json_encode(['success' => false, 'message' => 'Código de peça não encontrado.']);
            $peca_check->close();
            exit;
        }

        $peca_check->close();

        // Prepara a consulta de atualização
        $stmt = $conn->prepare("UPDATE tb_estoque SET localizacao=?, corredor=?, posicao=?, nivel=?, quantidade=?, fornecedor=? WHERE codigo_peca=?");
        if ($stmt === false) {
            echo json_encode(['success' => false, 'message' => 'Erro ao preparar a consulta de atualização: ' . $conn->error]);
            exit;
        }

        // Vincula os parâmetros na ordem correta
        // A chave 'fornecedor' deve ser passada como string, com 's' para a instrução bind_param
        $stmt->bind_param("sssssss", $localizacao, $corredor, $posicao, $nivel, $quantidade, $fornecedor, $codigo_peca);

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
