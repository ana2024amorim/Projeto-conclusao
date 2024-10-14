<?php

require_once "conector_db.php";

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta para buscar os fabricantes (marcas)
$sql = "SELECT DISTINCT fabricante FROM veiculos"; // Assumindo que 'veiculos' é a tabela
$result = $conn->query($sql);

$fabricantes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $fabricantes[] = [
            'fabricante' => $row['fabricante'] // Nome do fabricante
        ];
    }
}

// Retorna os fabricantes em formato JSON
echo json_encode($fabricantes);

$conn->close();
?>
