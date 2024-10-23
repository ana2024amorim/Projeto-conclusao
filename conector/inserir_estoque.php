<?php
require_once "conector_db.php";

// Define o cabeçalho para JSON antes de qualquer saída
header('Content-Type: application/json; charset=utf-8');

// Verifica se a requisição foi feita via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $codigo_peca = isset($_POST['codigo_peca']) ? htmlspecialchars(strip_tags($_POST['codigo_peca'])) : null;
    $localizacao = isset($_POST['localizacao']) ? htmlspecialchars(strip_tags($_POST['localizacao'])) : null;
    $corredor = isset($_POST['corredor']) ? htmlspecialchars(strip_tags($_POST['corredor'])) : null;
    $posicao = isset($_POST['posicao']) ? htmlspecialchars(strip_tags($_POST['posicao'])) : null;
    $nivel = isset($_POST['nivel']) ? htmlspecialchars(strip_tags($_POST['nivel'])) : null;
    $quantidade = isset($_POST['quantidade']) ? (int) $_POST['quantidade'] : null;
    $fornecedor = isset($_POST['fornecedor']) ? htmlspecialchars(strip_tags($_POST['fornecedor'])) : null;

    // Verifica se todos os dados obrigatórios foram recebidos
    if ($codigo_peca && $localizacao && $corredor && $posicao && $nivel && $quantidade !== null && $fornecedor) {
        // Prepara e executa a consulta de inserção com parâmetros
        $sql = "INSERT INTO tb_estoque (codigo_peca, localizacao, corredor, posicao, nivel, quantidade, fornecedor) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sssssis", $codigo_peca, $localizacao, $corredor, $posicao, $nivel, $quantidade, $fornecedor);
            
            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Peça cadastrada com sucesso!"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Erro ao cadastrar peça: " . $stmt->error]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Erro na preparação da consulta."]);
        }

        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Dados do formulário não estão completos."]);
    }
}

$conn->close();
?>
