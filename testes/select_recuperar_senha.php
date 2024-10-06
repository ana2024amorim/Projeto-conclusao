<?php
require_once "../conector/conector_db.php"; // Ajuste o caminho conforme necessário
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../src/PHPMailer.php'; // Ajuste o caminho conforme necessário
require '../src/SMTP.php';
require '../src/Exception.php';
$config = require '../email/config_smtp.php'; // Inclua o arquivo de configuração

// Função para gerar uma senha aleatória
function gerarSenhaProvisoria($tamanho = 8) {
    return bin2hex(random_bytes($tamanho / 2)); // Gera uma senha hexadecimal aleatória
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']); // Obtém o email do formulário

    // Prepara a consulta SQL
    $sql = "SELECT * FROM tb_funcionario WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // O usuário existe
        $usuario = $result->fetch_assoc();
        
        // Gerar nova senha provisória
        $novaSenha = gerarSenhaProvisoria();
        
        // Atribuir o hash da senha a uma variável antes de passar para o bind_param
        $senhaHashed = password_hash($novaSenha, PASSWORD_DEFAULT);
        
        // Atualizar a senha no banco de dados
        $sqlUpdate = "UPDATE tb_funcionario SET senha = ? WHERE email = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("ss", $senhaHashed, $email);
        $stmtUpdate->execute();

        // Enviar email com a nova senha usando PHPMailer
        $mail = new PHPMailer(true);
        
        try {
            // Configurações do servidor SMTP
            $mail->isSMTP();
            $mail->Host = $config['host'];
            $mail->SMTPAuth = true;
            $mail->Username = $config['username'];
            $mail->Password = $config['password'];
            $mail->SMTPSecure = $config['smtp_secure'] === 'TLS' ? PHPMailer::ENCRYPTION_STARTTLS : PHPMailer::ENCRYPTION_SMTPS; // Ajuste a segurança
            $mail->Port = $config['port'];

            // Configurações do e-mail
            $mail->setFrom($config['from_email'], $config['from_name']); // Remetente
            $mail->addAddress($email); // Destinatário
            
            // Conteúdo do e-mail
            $mail->Subject = "Nova Senha Provisória";
            $mail->CharSet = 'UTF-8'; // Define a codificação para UTF-8
            $mail->isHTML(true); // Se você deseja enviar HTML
            $mail->Body = '
                <html>
                <head>
                    <meta charset="UTF-8"> <!-- Define o charset para UTF-8 -->
                    <style>
                        .container {
                            background-color: #e0f7fa; /* Azul claro */
                            border: 1px solid #b2ebf2; /* Borda azul mais escura */
                            border-radius: 8px;
                            padding: 20px;
                            font-family: Arial, sans-serif;
                            text-align: center;
                        }
                        h1 {
                            color: #00796b; /* Cor do texto */
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <h1>Troca de Senha!</h1>
                        <p>Sua nova senha provisória é: <strong>' . $novaSenha . '</strong></p>
                    </div>
                </body>
                </html>';
            
            // Ativar depuração, se necessário
            $mail->SMTPDebug = $config['smtp_debug'];

            // Envia o e-mail
            $mail->send();
            echo "Uma nova senha provisória foi enviada para seu email.";
        } catch (Exception $e) {
            echo "Erro ao enviar o email: {$mail->ErrorInfo}";
        }
    } else {
        // O usuário não existe
        echo "Email não encontrado!";
    }

    // Fecha a declaração e a conexão
    $stmt->close();
    $conn->close();
}
?>
