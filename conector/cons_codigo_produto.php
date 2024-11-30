<?php
// Conexão com o banco de dados
require_once "conector_db.php";

// Consulta SQL para obter os códigos de produto únicos
$sql = "SELECT DISTINCT codigo_produto FROM tb_produto";
$result = $conn->query($sql);

$codigo_produto = []; // Nome da variável corrigido

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $codigo_produto[] = $row['codigo_produto']; // Nome da variável corrigido
    }
}

// Retorna os códigos de produto como JSON
echo json_encode($codigo_produto); // Nome da variável corrigido

$conn->close();
?>
