<?php

require_once "conector_db.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    if (is_numeric($id)) {
        // Exclusão do cliente
        $stmt = $conn->prepare("DELETE FROM tb_cliente WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(['sucesso' => true, 'mensagem' => 'Cliente excluído com sucesso.', 'id' => $id]);
        } else {
            echo json_encode(['sucesso' => false, 'mensagem' => 'Erro ao excluir o cliente.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['sucesso' => false, 'mensagem' => 'ID inválido.']);
    }
} else {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Requisição inválida.']);
}
