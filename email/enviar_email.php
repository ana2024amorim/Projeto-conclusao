<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Certifique-se de que o caminho para autoload está correto

// Inclui o arquivo de configuração
$config = require '../email/config_smtp.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $emailDestinatario = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $assunto = trim($_POST['assunto']);
    $mensagem = trim($_POST['mensagem']);

    if (!$emailDestinatario) {
        echo 'E-mail inválido!';
        exit;
    }

    // Cria uma nova instância do PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host = $config['host'];
        $mail->SMTPAuth = true;
        $mail->Username = $config['username'];
        $mail->Password = $config['password'];
        $mail->SMTPSecure = $config['smtp_secure'];
        $mail->Port = $config['port'];

        // Configurações do e-mail
        $mail->setFrom($config['from_email'], $config['from_name']);
        $mail->addAddress($emailDestinatario);
        $mail->Subject = $assunto;
        $mail->Body = $mensagem;
        $mail->isHTML(true); // Define o formato do e-mail para HTML

        // Ativar depuração, se necessário
        $mail->SMTPDebug = $config['smtp_debug'];

        // Envia o e-mail
        if ($mail->send()) {
            echo 'E-mail enviado com sucesso!';
        } else {
            echo 'Falha ao enviar e-mail: ' . $mail->ErrorInfo;
        }

    } catch (Exception $e) {
        echo "Erro ao enviar e-mail: {$mail->ErrorInfo}";
    }
}
?>
