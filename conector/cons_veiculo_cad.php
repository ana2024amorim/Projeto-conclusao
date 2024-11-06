<?php
// Conexão com o banco de dados
require_once "conector_db.php";


// Consulta SQL para obter os nomes dos veículos
$sql = "SELECT veiculo FROM tb_veiculo WHERE 1";
$result = $conn->query($sql);

$veiculos = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $veiculos[] = $row['veiculo'];
    }
}

echo json_encode($veiculos);

$conn->close();
?>
