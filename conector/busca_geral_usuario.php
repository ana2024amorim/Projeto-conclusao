<?php
require_once "conector_db.php";

// Verifica se o parâmetro "id" foi enviado
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta SQL para buscar dados do funcionário pelo id
    $stmt = $conn->prepare("SELECT id, ativo, nome, cargo, genero, email FROM tb_funcionario WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $funcionario = $result->fetch_assoc();
        echo json_encode($funcionario);
    } else {
        echo json_encode(["erro" => "Funcionário não encontrado."]);
    }

    $stmt->close();
}
$conn->close();
?>
