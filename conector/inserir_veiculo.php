<?php

require_once "conector_db.php"; // Conexão com o banco de dados

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obter os dados do formulário
$veiculo = $_POST['veiculo'];
$marca = $_POST['marca'];
$ano = $_POST['ano'];
$modelo = $_POST['modelo'];
$fabricante = $_POST['fabricante'];

// Preparar e vincular
$stmt = $conn->prepare("INSERT INTO veiculos (veiculo, marca, ano, modelo, fabricante) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssiss", $veiculo, $marca, $ano, $modelo, $fabricante);

// Executar a instrução
if ($stmt->execute()) {
    echo "Novo registro criado com sucesso";
} else {
    echo "Erro: " . $stmt->error;
}

// Fechar a conexão
$stmt->close();
$conn->close();
?>
