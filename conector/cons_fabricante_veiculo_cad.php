<?php
// Conexão com o banco de dados
require_once "conector_db.php";

// Consulta SQL para obter os fabricantes únicos dos veículos
$sql = "SELECT DISTINCT fabricante FROM tb_veiculo";
$result = $conn->query($sql);

$fabricantes = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $fabricantes[] = $row['fabricante'];
    }
}

// Retorna os fabricantes como JSON
echo json_encode($fabricantes);

$conn->close();
?>
