<?php
session_start();

// Verificar se o nome foi passado na URL (no formato documento_nome.pdf)
if (isset($_GET['arquivo'])) {
    // Capturar o nome do arquivo e sanitizar
    $arquivo = basename($_GET['arquivo']); // Pega o nome do arquivo
    $nomeUsuario = str_replace("documento_", "", $arquivo); // Remove "documento_" do nome
    $nomeUsuario = str_replace(".pdf", "", $nomeUsuario); // Remove a extensão ".pdf"

    // Armazenar o nome na sessão
    $_SESSION['nome_usuario'] = $nomeUsuario;
} else {
    // Caso não tenha nome, redirecionar ou exibir erro
    echo "Nome do usuário não fornecido na URL.";
    exit;
}

// Sanitização para prevenir espaços e caracteres especiais
$nomeSanitizado = strtolower(str_replace(' ', '_', $nomeUsuario));

// Gerar o caminho do arquivo PDF
$caminhoArquivo = "http://localhost/projeto-conclusao/PDF/documento_" . $nomeSanitizado . ".pdf";
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta charset="ISO-8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aceitar Documento</title>
</head>
<body>
    <h1>Visualize o Documento e Aceite</h1>
    
    <!-- Visualizar o PDF diretamente com iframe -->
    <iframe src="<?php echo $caminhoArquivo; ?>" width="100%" height="600px"></iframe>

    <!-- Formulário de aceite -->
    <form action="salvar_aceite.php" method="POST">
        <label>
            <input type="checkbox" name="aceite" value="1" required> Eu li e aceito os termos do documento.
        </label>
        <br><br>

        <!-- Campo oculto para passar o nome sanitizado -->
        <input type="hidden" name="nome_usuario" value="<?php echo $nomeSanitizado; ?>">

        <button type="submit">Confirmar Aceite</button>
    </form>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const qrCodeModal = new bootstrap.Modal(document.getElementById('qrCodeModal'));
        qrCodeModal.show(); // Exibe o modal automaticamente

        // Verifica periodicamente no servidor se o aceite foi registrado
        const nomeUsuario = "<?php echo $nome; ?>"; // Obtém o nome do usuário da sessão

        function verificarAceite() {
            fetch('verifica_aceite.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({ nome_usuario: nomeUsuario })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'found') {
                        window.location.href = 'dados_recuperados.php';
                    } else if (data.status === 'error') {
                        console.error("Erro:", data.message);
                    }
                })
                .catch(error => console.error('Erro ao verificar aceite:', error));
        }

        // Chama a função a cada 5 segundos
        setInterval(verificarAceite, 3000);
    });
</script>

</body>
</html>
