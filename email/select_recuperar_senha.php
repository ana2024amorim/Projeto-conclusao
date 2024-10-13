<?php
require_once "../conector/conector_db.php"; // Ajuste o caminho conforme necessário
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../src/PHPMailer.php'; // Ajuste o caminho conforme necessário
require '../src/SMTP.php';
require '../src/Exception.php';
$config = require 'config_smtp.php'; // Inclua o arquivo de configuração

function gerarSenhaProvisoria($tamanho = 8) {
    return bin2hex(random_bytes($tamanho / 2);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    
    $sql = "
        SELECT f.*, l.password 
        FROM tb_funcionario f 
        JOIN tb_login l ON f.matricula = l.matricula 
        WHERE f.email = ?
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        $novaSenha = gerarSenhaProvisoria();
        $senhaHashed = password_hash($novaSenha, PASSWORD_DEFAULT);
        
        $sqlUpdate = "UPDATE tb_login SET password = ? WHERE matricula = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("ss", $senhaHashed, $usuario['matricula']);
        $stmtUpdate->execute();

        $mail = new PHPMailer(true);
        try {
            // Configurações do servidor SMTP
            $mail->isSMTP();
            $mail->Host = $config['host'];
            $mail->SMTPAuth = true;
            $mail->Username = $config['username'];
            $mail->Password = $config['password'];
            $mail->SMTPSecure = $config['smtp_secure'] === 'TLS' ? PHPMailer::ENCRYPTION_STARTTLS : PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = $config['port'];

            $mail->setFrom($config['from_email'], $config['from_name']);
            $mail->addAddress($email);
            $mail->Subject = "Nova Senha Provisória";
            $mail->CharSet = 'UTF-8';
            $mail->isHTML(true);
            $mail->Body = '
                <html>
                <head>
                    <meta charset="UTF-8">
                </head>
                <body>
                    <h1>Troca de Senha!</h1>
                    <p>Sua nova senha provisória é: <strong>' . $novaSenha . '</strong></p>
                </body>
                </html>';

            $mail->send();
            echo json_encode(['success' => true, 'message' => 'Uma nova senha provisória foi enviada para seu email.']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => "Erro ao enviar o email: {$mail->ErrorInfo}"]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => "Email não encontrado!"]);
    }

    $stmt->close();
    $conn->close();
}
?>
