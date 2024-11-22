<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensagens</title>

    <!-- Incluir o CKEditor 5 a partir do CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
</head>
<body>
    <h2>Escreva uma Mensagem</h2>
    
    <!-- Formulário para digitar e salvar a mensagem -->
    <form action="salvar_mensagem.php" method="POST">
        <!-- Usando o CKEditor no campo de mensagem -->
        <textarea name="mensagem" id="mensagem" placeholder="Digite sua mensagem aqui..."></textarea><br><br>
        <input type="submit" value="Salvar Mensagem">
    </form>

    <script>
        // Inicializa o CKEditor no campo de texto com o id 'mensagem' (versão 5)
        ClassicEditor
            .create(document.querySelector('#mensagem'))
            .catch(error => {
                console.error(error);
            });
    </script>

</body>
</html>
