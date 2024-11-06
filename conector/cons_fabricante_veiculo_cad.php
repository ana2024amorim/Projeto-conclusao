<?php
// Conexão com o banco de dados
require_once "conector_db.php";

// Consulta SQL para obter os fabricantes dos veículos
$sql = "SELECT fabricante FROM tb_veiculo WHERE 1";
$result = $conn->query($sql);

$fabricantes = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $fabricantes[] = $row['fabricante'];
    }
}

echo json_encode($fabricantes);

$conn->close();
?>
