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
    // Verifica se o usuário está bloqueado devido a tentativas falhadas
    if ($user['tentativas_falhas'] >= 3) {
        header('Location: ../index.php?error=account_locked');
        exit();
    }

    // Verifica a senha
    if (password_verify($password, $user['password'])) {
        // Se a senha estiver correta, resetar o contador de tentativas falhadas
        $query = "UPDATE tb_login SET tentativas_falhas = 0 WHERE matricula = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $matricula);
        $stmt->execute();

        // Sessão de login bem-sucedido
        $_SESSION['matricula'] = $matricula;
        $_SESSION['permissao'] = $user['permissao'];
        $_SESSION['foto'] = $user['foto']; // Armazena a foto do perfil na sessão

        // Redireciona baseado na permissão do usuário
        switch ($user['permissao']) {
            case 'Gerente':
                header('Location: ../modelo.php');
                break;
            case 'Administrador':
                header('Location: ../modelo_adm.php');
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
            default:
                header('Location: ../index.php?error=permission_denied');
                break;
        }
        exit();
    } else {
        // Se a senha estiver incorreta, incrementa as tentativas falhadas
        $tentativas_falhas = $user['tentativas_falhas'] + 1;

        // Se atingir 2 tentativas falhadas, mostra um aviso
        if ($tentativas_falhas == 2) {
            // Atualiza o número de tentativas falhadas no banco de dados
            $query = "UPDATE tb_login SET tentativas_falhas = ? WHERE matricula = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("is", $tentativas_falhas, $matricula);
            $stmt->execute();

            // Redireciona com o erro de aviso de bloqueio
            header('Location: ../index.php?error=warning_attempts');
            exit();
        } elseif ($tentativas_falhas >= 3) {
            // Se atingir 3 tentativas falhadas, bloqueia o usuário
            $query = "UPDATE tb_login SET tentativas_falhas = 3 WHERE matricula = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $matricula);
            $stmt->execute();
            header('Location: ../index.php?error=account_locked');
            exit();
        } else {
            // Atualiza o número de tentativas falhadas
            $query = "UPDATE tb_login SET tentativas_falhas = ? WHERE matricula = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("is", $tentativas_falhas, $matricula);
            $stmt->execute();
            header('Location: ../index.php?error=incorrect_password');
            exit();
        }
    }
} else {
    header('Location: ../index.php?error=user_not_found');
    exit();
}
?>
