<?php
//session_start();  // Inicia a sessão
require_once "conector_db.php";

// Verifica se os campos de matrícula e senha foram preenchidos
if (empty($_POST['matricula']) || empty($_POST['password'])) {
    header('Location: ../index.html?error=missing_fields');
    exit();
}

$matricula = $_POST['matricula'];
$password = $_POST['password']; 

// Preparar a consulta utilizando prepared statement
$query = "SELECT * FROM tb_login WHERE matricula = ?";
$stmt = $conn->prepare($query);

if ($stmt === false) {
    // Exibe o erro de SQL para debug
    die('Erro na preparação da consulta: ' . htmlspecialchars($conn->error));
}

$stmt->bind_param("s", $matricula);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se um usuário foi encontrado
if ($user = $result->fetch_assoc()) {
    // Verifica se a senha corresponde usando hash no password_verify
    if (password_verify($password, $user['password'])) {
        $_SESSION['matricula'] = $matricula;
        header('Location: ../pagina_venda.html');
        exit();
    } else {
        // Senha incorreta
        header('Location: ../index.html?error=incorrect_password');
        exit();
    }
} else {
    // Usuário não encontrado
    header('Location: ../index.html?error=user_not_found');
    exit();
}
?>