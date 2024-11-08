<?php
// Conexão com o banco de dados
require_once "conector_db.php"; // Inclua seu arquivo de conexão

// Captura os dados enviados pelo AJAX
$produto_nome = isset($_POST['produtos']) ? $_POST['produtos'] : [];
$quantidades = isset($_POST['quantidades']) ? $_POST['quantidades'] : [];

// Verifica se os arrays de produtos e quantidades não estão vazios
if (empty($produto_nome) || empty($quantidades)) {
    echo "Erro: Dados de produtos ou quantidades não fornecidos.";
    exit; // Interrompe a execução do script caso os dados estejam faltando
}

// Verifica se o número de produtos é igual ao número de quantidades
if (count($produto_nome) !== count($quantidades)) {
    echo "Erro: O número de produtos não corresponde ao número de quantidades.";
    exit; // Interrompe a execução do script caso as quantidades não coincidam com os produtos
}

// Inicia a transação para garantir que todas as atualizações sejam feitas juntas
$conn->begin_transaction();

try {
    // Itera sobre os produtos e quantidades
    $produtos_atualizados = 0; // Contador para verificar quantos produtos foram atualizados
    for ($i = 0; $i < count($produto_nome); $i++) {
        $produto_nome_atual = $produto_nome[$i];
        $quantidade_atual = $quantidades[$i];

        // Verifica se a quantidade é válida (por exemplo, um número maior que 0)
        if ($quantidade_atual <= 0) {
            echo "Erro: Quantidade inválida para o produto " . htmlspecialchars($produto_nome_atual) . ".";
            exit; // Interrompe a execução se a quantidade for inválida
        }

        // Atualiza o campo 'finalizado' para 1 para cada produto específico com a quantidade correspondente
        $sql = "UPDATE tb_compra SET finalizado = 1 WHERE produto_nome = ? AND quantidade = ? AND finalizado = 0";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $produto_nome_atual, $quantidade_atual);
        $stmt->execute();

        // Verifica se a linha foi atualizada
        if ($stmt->affected_rows > 0) {
            $produtos_atualizados++;
        }
    }

    // Verifica se algum produto foi atualizado
    if ($produtos_atualizados > 0) {
        // Confirma a transação
        $conn->commit();
        echo "Pagamento registrado com sucesso para " . $produtos_atualizados . " produto(s).";
    } else {
        // Caso nenhum produto tenha sido atualizado
        echo "Erro: Nenhum produto foi atualizado (talvez já tenha sido finalizado ou não encontrado).";
    }
} catch (Exception $e) {
    // Desfaz a transação em caso de erro
    $conn->rollback();
    echo "Erro: " . $e->getMessage();
}

$stmt->close();
$conn->close();
?>
