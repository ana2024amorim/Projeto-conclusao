<?php
session_start(); // Inicia a sessão

require_once "conector_db.php";

// Verifica se os campos de matrícula e senha foram preenchidos
if (empty($_POST['matricula']) || empty($_POST['password'])) {
    header('Location: ../index.php?error=missing_fields');
    exit();
}

$matricula = $_POST['matricula'];
$password = $_POST['password']; 

// Preparar a consulta utilizando prepared statement
$query = "SELECT * FROM tb_login WHERE matricula = ?";
$stmt = $conn->prepare($query);

if ($stmt === false) {
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
        $_SESSION['permissao'] = $user['permissao'];
        $_SESSION['foto'] = $user['foto']; // Armazena a foto do perfil na sessão

        // Redireciona baseado na permissão do usuário
        switch ($user['permissao']) {
            case 'Gerente':
                header('Location: ../modelo.php');
                break;
            case 'Vendedor':
                header('Location: ../pdv/vendedor.php');
                break;
            case 'Estoquista':
                header('Location: ../vendas/gestao_produtos.php');
                break;
            case 'Caixa':
                header('Location: ../PDV/caixa1.php');
                break;
            case 'Caixa':
                header('Location: ../PDV/separado.php');
                break;
            default:
                header('Location: ../index.php?error=permission_denied');
                break;
        }
        exit();
    } else {
        header('Location: ../index.php?error=incorrect_password');
        exit();
    }
} else {
    header('Location: ../index.php?error=user_not_found');
    exit();
}
?>
