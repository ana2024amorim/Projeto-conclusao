<?php
require_once 'conector_db.php'; // Conexão com o banco de dados

// Verifica se os dados foram recebidos via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe o corpo da requisição como JSON
    $data = json_decode(file_get_contents('php://input'), true);

    // Verifica se os dados necessários estão presentes
    if (isset($data['id'], $data['pixKey'], $data['description'], $data['merchantName'], $data['merchantCity'], $data['txid'])) {
        $id = $data['id'];
        $pixKey = $data['pixKey'];
        $description = $data['description'];
        $merchantName = $data['merchantName'];
        $merchantCity = $data['merchantCity'];
        $txid = $data['txid'];

        // Consulta SQL para atualizar os dados na tabela usando o ID
        $sql = "UPDATE tb_dadosbanco 
                SET pix_key = ?, description = ?, merchant_name = ?, merchant_city = ?, txid = ? 
                WHERE id = ?";  

        if ($stmt = $conn->prepare($sql)) {
            // Liga os parâmetros à consulta preparada
            $stmt->bind_param("sssssi", $pixKey, $description, $merchantName, $merchantCity, $txid, $id);

            // Executa a consulta
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    echo json_encode(['success' => true, 'message' => 'Dados atualizados com sucesso!']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Nenhuma linha foi afetada.']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Erro ao atualizar os dados: ' . $stmt->error]);
            }

            // Fecha a consulta
            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao preparar a consulta: ' . $conn->error]);
        }

        // Fecha a conexão
        $conn->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Dados incompletos ou inválidos.']);
    }
}
?>
