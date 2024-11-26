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
        <button type="submit">Confirmar Aceite</button>
    </form>
</body>
</html>
