<?php
require_once "conector_db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fornecedor = $_POST['fornecedor'];
    $razao_social = $_POST['razao_social'];
    $cnpj = $_POST['cnpj'];

    // Atualizar os dados no banco de dados
    $stmt = $conn->prepare("UPDATE tb_fornecedor SET fornecedor = ?, razao_social = ? WHERE cnpj = ?");
    $stmt->bind_param("sss", $fornecedor, $razao_social, $cnpj);

    if ($stmt->execute()) {
        echo "Fornecedor atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar o fornecedor.";
    }

    $stmt->close();
    $conn->close();
}
?>
