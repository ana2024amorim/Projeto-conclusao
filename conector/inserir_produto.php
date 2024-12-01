<?php
require_once "conector_db.php"; // Conexão com o banco de dados

header('Content-Type: application/json'); // Definir resposta como JSON

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo_produto = $_POST['codigo_produto'];
    $fornecedor = $_POST['fornecedor1'];
    $nome_peca = $_POST['nome_peca'];
    $peso = $_POST['peso'];
    $valor_varejo = $_POST['valor_varejo'];
    $modelo_carro = $_POST['modelo_carro'];
    $marca_fabricante = $_POST['marca-fabricante'];
    $descricao_peca = $_POST['descricao_peca'];

    $sql = "INSERT INTO tb_produto (codigo_produto, fornecedor, nome_peca, peso, valor_varejo, modelo_carro, marca_fabricante, descricao_peca) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $codigo_produto, $fornecedor, $nome_peca, $peso, $valor_varejo, $modelo_carro, $marca_fabricante, $descricao_peca);

    if ($stmt->execute()) {
        echo json_encode(["sucesso" => true, "mensagem" => "Produto cadastrado com sucesso!"]);
    } else {
        echo json_encode(["sucesso" => false, "mensagem" => "Erro ao cadastrar produto: " . $stmt->error]);
    }

    $stmt->close();
}

$conn->close();
?>
