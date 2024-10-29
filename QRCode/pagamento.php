<?php
require __DIR__.'/vendor/autoload.php';

use \App\Pix\Payload;
use Mpdf\QrCode\QrCode;
use Mpdf\QrCode\Output;

// Verifica se o valor do pagamento foi enviado
if (isset($_GET['pagamento_pix'])) {
    $pagamento_pix = $_GET['pagamento_pix'];

    // Converte para float para garantir que seja um número
    $pagamento_pix = floatval($pagamento_pix);

    // Cria a instância do Payload
    $obPayload = (new Payload)
        ->setPixKey('sua-chave-pix-aqui') // Coloque a chave do Pix válida
        ->setDescription('Pagamento do pedido 123456')
        ->setMerchantName('Nome da empresa')
        ->setMerchantCity('Brasilia')
        ->setAmount($pagamento_pix) // Usa o valor do Pix recebido
        ->setTxid('PAGGUARDIAN'); // Código de transação

    $payloadQrCode = $obPayload->getPayload();

    // Saída do QRcode
    $obQrCode = new QrCode($payloadQrCode);
    
    // Gerador do QRcode
    $image = (new Output\Png)->output($obQrCode, 400);

    // Salva a imagem em um arquivo
    $qrcodePath = __DIR__ . '/../QRCode/qrcode.png'; // Caminho no servidor
    file_put_contents($qrcodePath, $image);

    // URL para acessar a imagem no navegador
    $qrcodeUrl = 'qrcode.png'; // Ajuste conforme necessário

    // HTML para exibir o QR Code e o contador
    echo '
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>Escaneie para realizar o Pagamento</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script>
            let countdown = 30; // 30 segundos
            window.onload = function() {
                const countdownElement = document.getElementById("countdown");
                const timer = setInterval(() => {
                    countdown--;
                    countdownElement.textContent = countdown;

                    if (countdown <= 0) {
                        clearInterval(timer);
                        // Redireciona para a tela de pagamento após 30 segundos
                        window.location.href = "../PDV/pdv.php"; // Ajuste o caminho para a tela de pagamento
                    }
                }, 1000); // Atualiza a cada segundo
            };
        </script>
    </head>
    <body>
        <div class="container text-center">
            <h2>QR Code Gerado!</h2>
            <img src="'.$qrcodeUrl.'" alt="QR Code" />
            <p>Seu Pagamento será encerrado em <span id="countdown">60</span> segundos.</p>
        </div>
    </body>
    </html>
    ';

    exit; // Termine o script após a geração do HTML
} else {
    echo "Nenhum valor de pagamento foi fornecido.";
}
