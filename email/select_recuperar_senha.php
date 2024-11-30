<?php
require_once "../conector/conector_db.php"; // Ajuste o caminho conforme necessário
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../src/PHPMailer.php'; // Ajuste o caminho conforme necessário
require '../src/SMTP.php';
require '../src/Exception.php';

function gerarSenhaProvisoria($tamanho = 8) {
    return bin2hex(random_bytes($tamanho / 2));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    
    // Verificando se a conexão está aberta
    if ($conn->ping()) {
        // A conexão está aberta
    } else {
        // Se não estiver aberta, reabre a conexão
        $conn = new mysqli($host, $usuario, $senha, $banco);
        if ($conn->connect_error) {
            die("Falha na conexão com o banco de dados: " . $conn->connect_error);
        }
    }

    // Consultando o banco de dados para obter as configurações de SMTP
    $sqlEmailConfig = "SELECT * FROM tb_email LIMIT 1"; // Supondo que haja apenas uma linha de configuração
    $resultEmailConfig = $conn->query($sqlEmailConfig);
    if ($resultEmailConfig->num_rows > 0) {
        $emailConfig = $resultEmailConfig->fetch_assoc();
    } else {
        echo json_encode(['success' => false, 'message' => 'Configuração de email não encontrada!']);
        exit;
    }

    // Consultando os dados do usuário
    $sql = "
        SELECT f.*, l.password 
        FROM tb_funcionario f 
        JOIN tb_login l ON f.matricula = l.matricula 
        WHERE f.email = ?
    ";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo json_encode(['success' => false, 'message' => 'Erro ao preparar a consulta.']);
        exit;
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        $novaSenha = gerarSenhaProvisoria();
        $senhaHashed = password_hash($novaSenha, PASSWORD_DEFAULT);
        
        // Atualizando a senha no banco de dados
        $sqlUpdate = "UPDATE tb_login SET password = ? WHERE matricula = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("ss", $senhaHashed, $usuario['matricula']);
        $stmtUpdate->execute();

        // Enviando o email com a nova senha
        $mail = new PHPMailer(true);
        try {
            // Configurações do servidor SMTP com dados recuperados do banco
            $mail->isSMTP();
            $mail->Host = $emailConfig['host'];
            $mail->SMTPAuth = true;
            $mail->Username = $emailConfig['username'];
            $mail->Password = $emailConfig['password'];
            $mail->SMTPSecure = $emailConfig['smtp_secure'] === 'TLS' ? PHPMailer::ENCRYPTION_STARTTLS : PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = $emailConfig['port'];

            $mail->setFrom($emailConfig['from_email'], $emailConfig['from_name']);
            $mail->addAddress($email);
            $mail->Subject = "Nova Senha Provisória";
            $mail->CharSet = 'UTF-8';
            $mail->isHTML(true);
            $mail->Body = '
                <html>
                <head>
                    <meta charset="UTF-8">
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f7f7f7;
                        margin: 0;
                        padding: 0;
                        color: #333;
                    }
                    .container {
                        width: 100%;
                        max-width: 800px; /* Aumentando a largura máxima */
                        margin: 40px auto;
                        background-color: #ffffff;
                        padding: 40px; /* Aumentando o espaçamento interno */
                        border-radius: 12px; /* Bordas mais arredondadas */
                        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15); /* Sombra mais destacada */
                    }
                    .header {
                        text-align: center;
                        color: #0044cc;
                    }
                    .content {
                        font-size: 18px; /* Aumentando o tamanho da fonte */
                        line-height: 1.8; /* Maior espaçamento entre linhas */
                    }
                    .content p {
                        margin: 20px 0; /* Aumentando o espaçamento entre parágrafos */
                    }
                    .footer {
                        text-align: center;
                        font-size: 14px;
                        color: #888;
                        margin-top: 30px; /* Maior espaçamento antes do rodapé */
                    }
                    .footer a {
                        color: #0044cc;
                        text-decoration: none;
                    }
                    .button {
                        display: inline-block;
                        background-color: #0044cc; /* Cor de fundo do botão */
                        color: #FFFFFF; /* Cor da fonte (branca) */
                        padding: 15px 30px; /* Aumentando o tamanho do botão */
                        border-radius: 6px; /* Bordas arredondadas */
                        text-decoration: none; /* Removendo sublinhado */
                        font-weight: bold; /* Fonte em negrito */
                        font-size: 16px; /* Aumentando o tamanho da fonte do botão */
                    }

                    }
                    .button:hover {
                        background-color: #0033aa;
                    }
                </style>    
                </head>
                <body>
                    <div class="container">
                        <div class="header">
                            <h1>Troca de Senha</h1>
                        </div>
                        <div class="content">
                            <p>Olá,</p>
                            <p>Este é um aviso da Guardian Control System. Sua senha foi alterada com sucesso e você pode acessar sua conta utilizando a nova senha provisória abaixo:</p>
                            <p><strong>Sua nova senha provisória é: <span style="font-size: 18px; color: #0044cc;">' .$novaSenha. '</span></strong></p>
                            <p>Por favor, utilize essa senha para realizar o login em sua conta. Após o primeiro acesso, recomendamos que você altere sua senha para algo de sua preferência.</p>
                            <p>Se você não solicitou essa alteração, por favor, entre em contato conosco imediatamente.</p>
                            <p><a href="http://localhost/projeto-conclusao/index.php" class="button">Acessar Minha Conta</a></p>
                        </div>
                        <div class="footer">
                            <p>Atenciosamente,</p>
                            <p><strong>Guardian Control System</strong></p>
                            <p><a href="mailto:http://localhost/projeto-conclusao/index.php">suporte@guardiansystem.com</a></p>
                            <p>Se você tiver algum problema ou dúvida, não hesite em nos contactar!</p>
                        </div>
                    </div>
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

    // Fechar a conexão após todos os comandos
    $stmt->close();
    $conn->close();
}
?>
