<?php

require_once "conector_db.php"; // Inclua seu arquivo de conexão ao banco de dados

header('Content-Type: application/json');

$nome = isset($_GET['nome']) ? $_GET['nome'] : '';

try {
    // Preparar a consulta SQL
    $query = "SELECT id, codigo_produto, nome_peca, modelo_carro, valor_varejo FROM tb_produto WHERE nome_peca LIKE ?";

    // Preparar a declaração
    $stmt = $conn->prepare($query);
    
    if ($stmt === false) {
        die(json_encode(['error' => 'Erro na preparação da consulta: ' . $conn->error]));
    }

    // Definir o valor do parâmetro
    $searchTerm = "%$nome%";
    $stmt->bind_param("s", $searchTerm); // "s" indica que o parâmetro é uma string

    // Executar a consulta
    $stmt->execute();

    // Buscar os resultados
    $result = $stmt->get_result();
    
    // Verifica se há resultados
    if ($result->num_rows > 0) {
        $produtos = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $produtos = []; // Retorna um array vazio se não houver produtos
    }

    // Retornar os resultados em formato JSON
    echo json_encode($produtos);

    // Fechar a declaração
    $stmt->close();
} catch (Exception $e) {
    // Se ocorrer um erro, retorne uma mensagem de erro
    echo json_encode(['error' => 'Erro ao buscar produtos: ' . $e->getMessage()]);
}

// Fechar a conexão
$conn->close();
?>
