<?php
// Inicia a sessão para acessar a variável $_SESSION
session_start();

// Verifica se o nome foi passado pela URL (GET) e armazena na sessão
if (isset($_GET['nome'])) {
    $nome = htmlspecialchars($_GET['nome']);
    $_SESSION['nome'] = $nome; // Armazena o nome na sessão
} else {
    echo "Nome não informado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code do Documento</title>

    <!-- Inclui o Bootstrap para o modal -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <?php
    // Inclui o autoloader do Composer
    require __DIR__ . '/vendor/autoload.php';

    // Declara as classes corretas para gerar o QR Code
    use Endroid\QrCode\QrCode;
    use Endroid\QrCode\Encoding\Encoding;
    use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
    use Endroid\QrCode\Writer\PngWriter;

    // Verifica se o nome está armazenado na sessão
    if (isset($_SESSION['nome'])) {
        $nome = $_SESSION['nome'];

        // Caminho do arquivo
        $caminhoArquivo = "http://localhost/projeto-conclusao/PDF/aceitar.php?arquivo=documento_" . urlencode($nome) . ".pdf";

        // Configuração do QR Code
        $writer = new PngWriter();
        $qrCode = QrCode::create($caminhoArquivo)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh());

        // Gera a imagem do QR Code em base64
        $result = $writer->write($qrCode);
        $image = $result->getString(); // Obtém a string binária da imagem PNG
        $qrCodeBase64 = base64_encode($image); // Codifica a imagem para base64
    } else {
        echo "Erro: Nome não encontrado na sessão.";
    }
    ?>

<!-- Modal do QR Code -->
<div class="modal fade" id="qrCodeModal" tabindex="-1" aria-labelledby="qrCodeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="qrCodeModalLabel">QR Code do Documento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Aqui é exibido o QR Code -->
                <?php if (isset($qrCodeBase64)): ?>
                    <img src="data:image/png;base64,<?php echo $qrCodeBase64; ?>" alt="QR Code" class="img-fluid" />
                <?php else: ?>
                    <p>Erro ao gerar o QR Code.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

    <!-- Inclusão do JavaScript do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <!-- Script para abrir automaticamente o modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const qrCodeModal = new bootstrap.Modal(document.getElementById('qrCodeModal'));
            qrCodeModal.show(); // Exibe o modal automaticamente
        });
    </script>
</body>
</html>
