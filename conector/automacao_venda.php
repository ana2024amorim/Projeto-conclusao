<?php
// Conexão com o banco de dados
require_once "conector_db.php"; // Ajuste o caminho conforme necessário

// 1. Consultar a tabela tb_compra para obter nome_produto, quantidade e campo update onde finalizado = 1 e update = 0
$sql_compra = "SELECT id, produto_nome, quantidade FROM tb_compra WHERE finalizado = 1 AND `update` = 0";
$result_compra = $conn->query($sql_compra);

if ($result_compra->num_rows > 0) {
    // 2. Processar cada item da compra
    while ($row_compra = $result_compra->fetch_assoc()) {
        $compra_id = $row_compra['id']; // Armazenar o ID da compra
        $produto_nome = $row_compra['produto_nome'];
        $quantidade_vendida = $row_compra['quantidade'];

        // 3. Consultar a tabela tb_produto para obter o codigo_produto com base no nome_produto
        $sql_produto = "SELECT codigo_produto FROM tb_produto WHERE nome_peca = ?";
        $stmt_produto = $conn->prepare($sql_produto);

        // Verifique se a preparação da consulta foi bem-sucedida
        if ($stmt_produto === false) {
            die('Erro na preparação da consulta SQL: ' . $conn->error);
        }

        $stmt_produto->bind_param("s", $produto_nome); // "s" para string (nome_produto)
        $stmt_produto->execute();
        $result_produto = $stmt_produto->get_result();

        if ($result_produto->num_rows > 0) {
            // 4. Obter o codigo_produto da tabela tb_produto
            $row_produto = $result_produto->fetch_assoc();
            $codigo_produto = $row_produto['codigo_produto'];

            // 5. Atualizar a quantidade na tabela tb_estoque, diminuindo a quantidade vendida
            $sql_estoque = "UPDATE tb_estoque SET quantidade = quantidade - ? WHERE codigo_peca = ?";
            $stmt_estoque = $conn->prepare($sql_estoque);

            // Verifique se a preparação da consulta de update foi bem-sucedida
            if ($stmt_estoque === false) {
                die('Erro na preparação da consulta SQL de update: ' . $conn->error);
            }

            $stmt_estoque->bind_param("is", $quantidade_vendida, $codigo_produto); // "i" para inteiro (quantidade) e "s" para string (codigo_produto)
            if ($stmt_estoque->execute()) {
                echo "Estoque atualizado com sucesso para o produto: $produto_nome<br>";

                // 6. Após atualizar o estoque, marcar o campo `update` na tabela tb_compra como 1
                $sql_update_compra = "UPDATE tb_compra SET `update` = 1 WHERE id = ?";
                $stmt_update_compra = $conn->prepare($sql_update_compra);

                // Verifique se a preparação da consulta de update foi bem-sucedida
                if ($stmt_update_compra === false) {
                    die('Erro na preparação da consulta SQL de update do campo `update` na tabela tb_compra: ' . $conn->error);
                }

                $stmt_update_compra->bind_param("i", $compra_id); // "i" para inteiro (ID da compra)
                if ($stmt_update_compra->execute()) {
                    echo "Campo `update` atualizado para 1 na tabela tb_compra para a compra ID: $compra_id<br>";
                } else {
                    echo "Erro ao atualizar campo `update` na tabela tb_compra para a compra ID: $compra_id<br>";
                }

            } else {
                echo "Erro ao atualizar estoque para o produto: $produto_nome<br>";
            }
        } else {
            echo "Produto não encontrado na tabela tb_produto: $produto_nome<br>";
        }
    }
} else {
    echo "Nenhuma compra finalizada encontrada ou que necessite de atualização.";
}

$conn->close();
?>
