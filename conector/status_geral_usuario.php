<?php
// Inicia a sessão (se necessário)
// session_start();

// Conexão com o banco de dados
require_once "conector_db.php";

// Obtém os dados do corpo da requisição (assumindo que a requisição seja JSON)
$data = json_decode(file_get_contents('php://input'), true);

// Verifica se os parâmetros 'id' e 'ativo' foram enviados
if (isset($data['id']) && isset($data['ativo'])) {
    $id = $data['id'];
    $ativo = $data['ativo'];

    // Valida se o valor de 'ativo' é 0 ou 1
    if ($ativo == 0 || $ativo == 1) {
        // Verifica se o id existe no banco
        $query_check = "SELECT COUNT(*) FROM tb_funcionario WHERE id = ?";
        if ($stmt_check = $conn->prepare($query_check)) {
            $stmt_check->bind_param("i", $id);
            $stmt_check->execute();
            $stmt_check->bind_result($count);
            $stmt_check->fetch();
            $stmt_check->close();

            if ($count == 0) {
                echo json_encode(['sucesso' => false, 'erro' => 'Usuário não encontrado']);
                $conn->close();
                exit;
            }
        } else {
            echo json_encode(['sucesso' => false, 'erro' => 'Erro ao verificar o usuário']);
            $conn->close();
            exit;
        }

        // Inicia uma transação
        $conn->begin_transaction();

        try {
            // Prepara a consulta para atualizar o status na tabela tb_funcionario
            $query_funcionario = "UPDATE tb_funcionario SET ativo = ? WHERE id = ?";
            if ($stmt_funcionario = $conn->prepare($query_funcionario)) {
                $stmt_funcionario->bind_param("ii", $ativo, $id);
                if (!$stmt_funcionario->execute()) {
                    throw new Exception("Erro ao atualizar o status na tb_funcionario");
                }
                $stmt_funcionario->close();
            }

            // Prepara a consulta para atualizar o status na tabela tb_login
            $query_login = "UPDATE tb_login SET ativo = ? WHERE id = ?";
            if ($stmt_login = $conn->prepare($query_login)) {
                $stmt_login->bind_param("ii", $ativo, $id);
                if (!$stmt_login->execute()) {
                    throw new Exception("Erro ao atualizar o status na tb_login");
                }
                $stmt_login->close();
            }

            // Commit da transação
            $conn->commit();

            // Retorna uma resposta de sucesso
            echo json_encode(['sucesso' => true]);
        } catch (Exception $e) {
            // Caso ocorra um erro, faz o rollback
            $conn->rollback();

            // Retorna uma mensagem de erro
            echo json_encode(['sucesso' => false, 'erro' => $e->getMessage()]);
        }

    } else {
        echo json_encode(['sucesso' => false, 'erro' => 'Valor de "ativo" inválido']);
    }
} else {
    echo json_encode(['sucesso' => false, 'erro' => 'ID ou status de ativação não fornecido']);
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
