<?php
session_start();
require_once "conector_db.php";

if (!isset($_GET['matricula']) || empty($_SESSION['matricula'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
    exit();
}

$matricula = $_SESSION['matricula'];

// Consulta SQL para buscar dados do funcionário
$query = "SELECT nome, email, foto FROM tb_funcionario WHERE matricula = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $matricula);
$stmt->execute();
$result = $stmt->get_result();

if ($funcionario = $result->fetch_assoc()) {
    echo json_encode(['success' => true, 'funcionario' => $funcionario]);
} else {
    echo json_encode(['success' => false, 'message' => 'Dados do funcionário não encontrados']);
}
?>
