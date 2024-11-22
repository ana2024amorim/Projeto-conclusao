<?php
require_once "../conector/conector_db.php"; // Conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mensagem = trim($_POST['mensagem']);

    if (!empty($mensagem)) {
        // Preparar e executar a inserção no banco de dados
        $sql = "INSERT INTO mensagens (conteudo) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $mensagem); // "s" significa que é uma string
        if ($stmt->execute()) {
            // Exibe o popup de sucesso e redireciona para a página modelo.php
            echo "<script>
                    alert('Mensagem salva com sucesso!');
                    // Redireciona para modelo.php após a mensagem ser salva
                    window.location.href = 'visualizar_mensagem.php'; 
                    // Limpa o conteúdo do formulário e o CKEditor
                    document.querySelector('form').reset(); 
                    CKEDITOR.instances['mensagem'].setData('');
                  </script>";
        } else {
            echo "Erro ao salvar mensagem.";
        }
    } else {
        echo "A mensagem não pode estar vazia!";
    }
}
?>
