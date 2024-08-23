<?php
session_start();  // Inicia a sessão

require_once "conector_db.php";

if (empty($_POST['matricula']) || empty($_POST['password'])) {
    header('Location: ../index.html');
    exit();
}

$matricula = mysqli_real_escape_string($conn, $_POST['matricula']);
$password = $_POST['password']; 

// Preparar a consulta
$query = "SELECT * FROM tb_login WHERE name = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $matricula);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se um usuário foi encontrado
if ($user = $result->fetch_assoc()) {
    // Verifica se a senha corresponde
    if (password_verify($password, $user['password'])) {
        $_SESSION['matricula'] = $matricula;
        header('Location: ../pagina_inicial.html');
        exit();
    } else {
        // Senha incorreta
        header('Location: ../index.html');
        exit();
    }
} else {
    // Usuário não encontrado
    header('Location: ../index.html');
    exit();
}

