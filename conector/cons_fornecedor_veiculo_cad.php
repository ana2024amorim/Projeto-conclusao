<?php
// Conexão com o banco de dados
require_once "conector_db.php";


// Consulta SQL para obter os fornecedores
$sql = "SELECT fornecedor FROM tb_fornecedor WHERE 1";
$result = $conn->query($sql);

$fornecedores = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $fornecedores[] = $row['fornecedor'];
    }
}

echo json_encode($fornecedores);

$conn->close();
?>
