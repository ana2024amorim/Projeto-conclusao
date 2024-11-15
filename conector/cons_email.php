<?php
require_once "conector_db.php";

// Variáveis iniciais para o formulário
$host = $username = $password = $smtp_secure = $port = $from_email = $from_name = $smtp_debug = "";
$message = "";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $host = $_POST['host'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $smtp_secure = $_POST['smtp_secure'];
    $port = $_POST['port'];
    $from_email = $_POST['from_email'];
    $from_name = $_POST['from_name'];
    $smtp_debug = $_POST['smtp_debug'];

    // Atualiza os dados no banco
    $sql_update = "UPDATE tb_email SET host = ?, username = ?, password = ?, smtp_secure = ?, port = ?, from_email = ?, from_name = ?, smtp_debug = ? WHERE id = 1";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("ssssisss", $host, $username, $password, $smtp_secure, $port, $from_email, $from_name, $smtp_debug);
    
    if ($stmt->execute()) {
        $message = "Configurações atualizadas com sucesso!";
    } else {
        $message = "Erro ao atualizar as configurações: " . $stmt->error;
    }
}

// Consulta para pegar as configurações de e-mail da tabela tb_email
$sql = "SELECT * FROM tb_email WHERE id = 1";  // Aqui você pode alterar o ID conforme necessário
$result = $conn->query($sql);

// Verifica se a consulta retornou algum dado
if ($result->num_rows > 0) {
    // Dados encontrados, pega o primeiro registro
    $row = $result->fetch_assoc();

    // Atribui os dados da consulta às variáveis
    $host = $row['host'];
    $username = $row['username'];
    $password = $row['password'];
    $smtp_secure = $row['smtp_secure'];
    $port = $row['port'];
    $from_email = $row['from_email'];
    $from_name = $row['from_name'];
    $smtp_debug = $row['smtp_debug'];
} else {
    // Caso não encontre as configurações no banco, exibe um erro
    $message = "Configuração de e-mail não encontrada.";
}

$conn->close();
?>
