<?php
require_once "conector_db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cnpj = $_POST['cnpj'];

    // Consulta para buscar os dados do fornecedor
    $stmt = $conn->prepare("SELECT fornecedor, razao_social, cnpj, endereco, telefone, cidade, situacao, email, data_cadastro 
                            FROM tb_fornecedor WHERE cnpj = ?");
    $stmt->bind_param("s", $cnpj);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fornecedor encontrado, retorna os dados
        $fornecedor = $result->fetch_assoc();
        echo json_encode($fornecedor);
    } else {
        // Fornecedor não encontrado, retorna erro
        echo json_encode(["erro" => "Fornecedor não encontrado."]);
    }

    $stmt->close();
    $conn->close();
}
?>
