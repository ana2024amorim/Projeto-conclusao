<?php
// Inicia a sessão
session_start();

// Declara as classes corretas para gerar o QR Code
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\Writer\PngWriter;

// Inclui o autoloader do Composer
require __DIR__ . '/vendor/autoload.php';

// Verifica se o nome está armazenado na sessão
if (isset($_SESSION['nome'])) {
    $nome = $_SESSION['nome'];

    // Exibe o PDF correspondente ao nome armazenado na sessão
    echo '<iframe src="documento_' . urlencode($nome) . '.pdf" width="100%" height="600px"></iframe>';

    // Gera o URL do QR Code
    $url = "http://localhost/projeto-conclusao/PDF/?nome=" . urlencode($nome);

    // Configuração do QR Code
    $writer = new PngWriter();
    $qrCode = QrCode::create($url)
        ->setEncoding(new Encoding('UTF-8'))
        ->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh());

    // Gera a imagem do QR Code em base64
    $result = $writer->write($qrCode);
    $image = $result->getString(); // Obtém a string binária da imagem PNG

    // Exibe o QR Code no navegador
    echo '<h2>Escaneie o QR Code para acessar o documento:</h2>';
    echo '<img src="data:image/png;base64,' . base64_encode($image) . '" alt="QR Code"/>';
} else {
    echo "Erro: Nome não encontrado na sessão.";
}
?>
