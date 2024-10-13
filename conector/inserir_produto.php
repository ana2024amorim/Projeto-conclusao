<?php
require_once "conector_db.php"; // Conexão com o banco de dados

// Verifica se a requisição foi feita via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $codigo_produto = $_POST['codigo_produto'];
    $fornecedor = $_POST['fornecedor'];
    $nome_peca = $_POST['nome_peca'];
    $peso = $_POST['peso'];
    $valor_varejo = $_POST['valor_varejo'];
    $modelo_carro = $_POST['modelo_carro'];
    $marca_fabricante = $_POST['marca_fabricante'];
    $descricao_peca = $_POST['descricao_peca'];

    // Prepara e executa a consulta de inserção
    $sql = "INSERT INTO tb_produto (codigo_produto, fornecedor, nome_peca, peso, valor_varejo, modelo_carro, marca_fabricante, descricao_peca) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $codigo_produto, $fornecedor, $nome_peca, $peso, $valor_varejo, $modelo_carro, $marca_fabricante, $descricao_peca);

    if ($stmt->execute()) {
        echo "Produto cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar produto: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
