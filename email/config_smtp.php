<?php
require_once "../conector/conector_db.php";

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
    // Caso não encontre as configurações no banco, use valores padrão ou lance um erro
    die("Configuração de e-mail não encontrada.");
}

// Fecha a conexão com o banco de dados
$conn->close();

// Retorna o array de configurações para o servidor SMTP
return [
    'host' => $host,
    'username' => $username,
    'password' => $password,
    'smtp_secure' => $smtp_secure,
    'port' => $port,
    'from_email' => $from_email,
    'from_name' => $from_name,
    'smtp_debug' => $smtp_debug,
];
?>

