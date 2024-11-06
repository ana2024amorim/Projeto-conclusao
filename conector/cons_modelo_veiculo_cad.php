<?php
// Conexão com o banco de dados
require_once "conector_db.php";

// Consulta SQL para obter os modelos dos veículos
$sql = "SELECT modelo FROM tb_veiculo WHERE 1";
$result = $conn->query($sql);

$modelos = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $modelos[] = $row['modelo'];
    }
}

echo json_encode($modelos);

$conn->close();
?>
