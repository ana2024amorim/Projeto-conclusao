<?php
require_once "../conector/conector_db.php"; // Conexão com o banco de dados

// Buscar a última mensagem salva
$sql = "SELECT conteudo FROM mensagens ORDER BY id DESC LIMIT 1"; // Pegando apenas a última mensagem
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Exibe a mensagem
    $row = $result->fetch_assoc();

    // Limpar o conteúdo removendo as tags <p> e substituindo-as por quebras de linha
    $conteudo = $row['conteudo'];

    // Substitui as tags <p> por quebras de linha
    $conteudo = preg_replace('/<p[^>]*>(.*?)<\/p>/is', '$1', $conteudo);

    // Exibe o título centralizado
    echo "<h2 class='centralizado'>Notícias</h2>";

    // Exibe o conteúdo, cada item em uma nova linha
    echo "<div class='conteudo-centralizado'>" . nl2br($conteudo) . "</div>";
} else {
    echo "Nenhuma mensagem encontrada.";
}
?>

<!-- CSS para centralizar o título e adicionar fundo -->
<style>
    /* Definir fundo cinza claro para a página e altura total */
    body {
        background-color: #f0f0f0; /* Cor de fundo cinza claro */
        font-family: Arial, sans-serif; /* Definir fonte mais legível */
        margin: 0;
        padding: 0;
        height: 100vh; /* A altura da janela de visualização */
        display: flex;
        flex-direction: column;
        justify-content: center; /* Centraliza o conteúdo verticalmente */
        align-items: center; /* Centraliza o conteúdo horizontalmente */
        overflow: hidden; /* Remove a barra de rolagem */
    }

    /* Centralizar o título h2 */
    .centralizado {
        text-align: center; /* Centraliza o texto */
        font-size: 2em; /* Ajuste o tamanho da fonte conforme necessário */
        margin-top: 20px; /* Espaço acima do título */
        color: #333333; /* Cor do título */
        margin-bottom: 20px; /* Espaço abaixo do título */
    }

    /* Centralizar o conteúdo e ajustar a largura */
    .conteudo-centralizado {
        font-size: 1.2em; /* Tamanho de fonte do conteúdo */
        text-align: center; /* Centralizar o conteúdo */
        margin-top: 20px;
        color: #555555; /* Cor do texto */
        line-height: 1.6; /* Aumenta o espaçamento entre as linhas */
        max-width: 90%; /* Limita a largura do conteúdo */
    }
</style>
