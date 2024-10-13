<?php
require_once "conector_db.php";

// Verifica se a requisição foi feita via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $fornecedor = $_POST['fornecedor'];
    $razao_social = $_POST['razao_social'];
    $endereco = $_POST['endereco'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $email = $_POST['email'];
    $situacao = $_POST['situacao'];
    $estado = $_POST['estado'];

    // Prepara e executa a consulta de inserção
    $sql = "INSERT INTO tb_fornecedor (fornecedor, razao_social, endereco, bairro, cidade, email, situacao, estado) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $fornecedor, $razao_social, $endereco, $bairro, $cidade, $email, $situacao, $estado);

    if ($stmt->execute()) {
        echo "Fornecedor cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar fornecedor: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
