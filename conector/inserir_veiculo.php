<?php
require_once "conector_db.php";

// Define o cabeçalho para JSON
header('Content-Type: application/json');

// Verifica se a requisição foi feita via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário, garantindo que não estão vazios
    $fabricante = isset($_POST['fabricante']) ? htmlspecialchars(strip_tags($_POST['fabricante'])) : null;
    $veiculo = isset($_POST['veiculo']) ? htmlspecialchars(strip_tags($_POST['veiculo'])) : null;
    $tipo_motor = isset($_POST['tipo_motor']) ? htmlspecialchars(strip_tags($_POST['tipo_motor'])) : null;
    $ano_lancamento = isset($_POST['ano_lancamento']) ? htmlspecialchars(strip_tags($_POST['ano_lancamento'])) : null;
    $ano_encerramento = isset($_POST['ano_encerramento']) ? htmlspecialchars(strip_tags($_POST['ano_encerramento'])) : null;
    $modelo = isset($_POST['modelo']) ? htmlspecialchars(strip_tags($_POST['modelo'])) : null;
    $item_agregado = isset($_POST['item_agregado']) ? htmlspecialchars(strip_tags($_POST['item_agregado'])) : null;

    // Verifica se todos os dados obrigatórios foram recebidos
    if ($fabricante && $veiculo && $tipo_motor && $ano_lancamento && $ano_encerramento && $modelo && $item_agregado) {
        // Prepara e executa a consulta de inserção com parâmetros
        $sql = "INSERT INTO tb_veiculo (fabricante, veiculo, tipo_motor, ano_lancamento, ano_encerramento, modelo, item_agregado) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param("ssiiiss", $fabricante, $veiculo, $tipo_motor, $ano_lancamento, $ano_encerramento, $modelo, $item_agregado);
            
            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Novo veículo cadastrado com sucesso!"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Erro ao cadastrar veículo: " . $stmt->error]);
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
