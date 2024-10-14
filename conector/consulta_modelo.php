<?php
require_once "conector_db.php";

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta para buscar os modelos
$sql = "SELECT modelo FROM veiculos GROUP BY modelo ORDER BY modelo"; 
$result = $conn->query($sql);

// Gera um array para armazenar os modelos
$modelos = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $modelos[] = [
            'modelo' => $row['modelo'], // Nome do modelo
        ];
    }
    // Retorna o array de modelos em formato JSON
    echo json_encode($modelos);
} else {
    // Se não houver modelos, retorna um JSON vazio
    echo json_encode([]);
}

$conn->close();
?>