<?php
require_once "conector_db.php";

// Verifica se a requisição foi feita via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário, sanitizando-os para evitar injeções
    $fornecedor = htmlspecialchars(strip_tags($_POST['fornecedor']));
    $razao_social = htmlspecialchars(strip_tags($_POST['razao_social']));
    $cnpj = htmlspecialchars(strip_tags($_POST['cnpj']));
    $insc_estadual = htmlspecialchars(strip_tags($_POST['insc-estadual']));
    $endereco = htmlspecialchars(strip_tags($_POST['endereco']));
    $bairro = htmlspecialchars(strip_tags($_POST['bairro']));
    $telefone = htmlspecialchars(strip_tags($_POST['telefone']));
    $cidade = htmlspecialchars(strip_tags($_POST['cidade']));
    $estado = htmlspecialchars(strip_tags($_POST['estado']));
    $situacao = htmlspecialchars(strip_tags($_POST['situacao']));
    $email = htmlspecialchars(strip_tags($_POST['email']));

    // Prepara e executa a consulta de inserção com parâmetros
    $sql = "INSERT INTO tb_fornecedor (fornecedor, razao_social, cnpj, insc_estadual, endereco, bairro, telefone, cidade, estado, situacao, email) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssss", $fornecedor, $razao_social, $cnpj, $insc_estadual, $endereco, $bairro, $telefone, $cidade, $estado, $situacao, $email);

    if ($stmt->execute()) {
        // Usa o POST-REDIRECT-GET para evitar o reenvio do formulário ao pressionar F5
        header("Location: ../vendas/venda1.php?status=success");
        exit();
    } else {
        // Caso haja erro, exibe uma mensagem de erro
        echo "Erro ao cadastrar fornecedor: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
