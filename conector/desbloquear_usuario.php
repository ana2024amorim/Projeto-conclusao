<?php
// Conecte-se ao banco de dados (ajuste as credenciais conforme necessário)
require_once "conector_db.php";

// Recebe o ID do usuário através de uma requisição POST
$data = json_decode(file_get_contents("php://input"));

if (isset($data->id)) {
    $id = $data->id;

    // Verifica se o usuário existe
    $sql = "SELECT * FROM tb_login WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Inicia uma transação para garantir que as duas operações ocorram de forma atômica
        $conn->begin_transaction();

        try {
            // Atualiza o status do usuário para "ativo" (desbloqueando)
            $updateStatusSql = "UPDATE tb_login SET ativo = 1 WHERE id = ?";
            $updateStatusStmt = $conn->prepare($updateStatusSql);
            $updateStatusStmt->bind_param("i", $id);
            $updateStatusStmt->execute();

            // Atualiza o campo tentativas_falhas para 0 (resetando as tentativas)
            $updateTentativasSql = "UPDATE tb_login SET tentativas_falhas = 0 WHERE id = ?";
            $updateTentativasStmt = $conn->prepare($updateTentativasSql);
            $updateTentativasStmt->bind_param("i", $id);
            $updateTentativasStmt->execute();

            // Se tudo deu certo, comita a transação
            $conn->commit();

            echo json_encode(["sucesso" => true, "mensagem" => "Usuário desbloqueado com sucesso!"]);
        } catch (Exception $e) {
            // Se ocorrer um erro, faz rollback na transação
            $conn->rollback();
            echo json_encode(["sucesso" => false, "mensagem" => "Erro ao desbloquear o usuário."]);
        }
    } else {
        echo json_encode(["sucesso" => false, "mensagem" => "Usuário não encontrado."]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["sucesso" => false, "mensagem" => "ID não fornecido."]);
}
?>
