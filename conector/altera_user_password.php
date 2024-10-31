<?php
session_start();
require_once "conector_db.php"; // Inclua seu arquivo de conexão

$response = ["success" => false, "message" => "Erro ao alterar senha"];

// Verifica se o usuário está logado
if (!isset($_SESSION['matricula'])) {
    $response["message"] = "Usuário não está logado";
    echo json_encode($response);
    exit;
}

$matricula = $_SESSION['matricula'];

// Verifica se a senha foi enviada
if (isset($_POST['senha'])) {
    $senhaHash = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    // Atualiza a senha na tabela tb_login
    $stmt = $conn->prepare("UPDATE tb_login SET password = ? WHERE matricula = ?");
    $stmt->bind_param("ss", $senhaHash, $matricula);

    if ($stmt->execute()) {
        $response["success"] = true;
        $response["message"] = "Senha alterada com sucesso";
    } else {
        $response["message"] = "Erro ao alterar senha";
    }

    $stmt->close();
} else {
    $response["message"] = "Senha não fornecida";
}

// Fecha a conexão
$conn->close();

echo json_encode($response);
?>
