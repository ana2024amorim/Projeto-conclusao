<?php

require_once "conector_db.php";


// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta para buscar as marcas
$sql = "SELECT id, marca FROM veiculos"; // Supondo que você tenha uma tabela chamada 'marcas'
$result = $conn->query($sql);

// Gera as opções para o select
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['nome']) . "</option>";
    }
} else {
    echo "<option disabled>Nenhuma marca encontrada</option>";
}

$conn->close();
?>
