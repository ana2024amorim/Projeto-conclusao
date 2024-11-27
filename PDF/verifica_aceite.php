<?php
require_once "../conector/conector_db.php";

if (isset($_GET['nome_usuario'])) {
    $nome_usuario = htmlspecialchars($_GET['nome_usuario'], ENT_QUOTES, 'UTF-8');

    // Consulta ao banco para verificar o aceite (usuario_id = 0)
    $sql = "SELECT usuario_id FROM aceita_documento WHERE nome_usuario = ? AND usuario_id = 0";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $nome_usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verifica se o nome de usuário foi encontrado com usuario_id = 0
        if ($result->num_rows > 0) {
            echo json_encode(['status' => 'confirmed']); // Usuário encontrado com usuario_id = 0
        } else {
            echo json_encode(['status' => 'pending']); // Usuário não encontrado ou usuario_id != 0
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Nome do usuário não fornecido.']);
}
?>
