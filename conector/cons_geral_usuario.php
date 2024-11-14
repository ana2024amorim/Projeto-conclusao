<?php
require_once "conector_db.php";

$nome = $_GET['nome'] ?? '';
$page = $_GET['page'] ?? 1;
$limit = $_GET['limit'] ?? 5;
$offset = ($page - 1) * $limit;

$stmt = $conn->prepare("SELECT id, ativo, nome, cargo, genero, email FROM tb_funcionario WHERE nome LIKE ? LIMIT ? OFFSET ?");
$nomeLike = "%$nome%";
$stmt->bind_param("sii", $nomeLike, $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();

$funcionarios = [];
while ($row = $result->fetch_assoc()) {
    $funcionarios[] = $row;
}

echo json_encode($funcionarios);
$stmt->close();
$conn->close();
?>
