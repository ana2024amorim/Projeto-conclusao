<?php
session_start();
require_once "conector_db.php";// Inclua seu arquivo de conexão

$response = ["success" => false, "message" => "Erro ao atualizar cadastro"];

// Verifica se o usuário está logado
if (!isset($_SESSION['matricula'])) {
    $response["message"] = "Usuário não está logado";
    echo json_encode($response);
    exit;
}

$matricula = $_SESSION['matricula'];

// Verifica se o email foi enviado
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $foto = '';

    // Verifica se há uma nova foto
    if (isset($_FILES['novaFoto']) && $_FILES['novaFoto']['error'] === 0) {
        $foto = '../uploads/' . basename($_FILES['novaFoto']['name']);
        move_uploaded_file($_FILES['novaFoto']['tmp_name'], $foto);
    }

    // Atualiza email e foto na tabela tb_funcionario
    $stmt = $conn->prepare("UPDATE tb_funcionario SET email = ?, foto = IF(? != '', ?, foto) WHERE matricula = ?");
    $stmt->bind_param("ssss", $email, $foto, $foto, $matricula);

    if ($stmt->execute()) {
        $response["success"] = true;
        $response["message"] = "Cadastro atualizado com sucesso";
    } else {
        $response["message"] = "Erro ao atualizar cadastro";
    }

    $stmt->close();
    $conn->close();
}

echo json_encode($response);
?>
