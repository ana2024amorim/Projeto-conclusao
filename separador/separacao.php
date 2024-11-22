<?php
// Conexão com o banco de dados
require_once "../conector/conector_db.php"; // Ajuste o caminho conforme necessário

// Consultar a tabela tb_compra com os critérios: entrega = 0 e finalizado = 1
$sql = "SELECT cliente_cpfcnpj, cliente_nome, produto_nome, quantidade 
        FROM tb_compra 
        WHERE entrega = 0 AND finalizado = 1";  // Ajuste 'entrega' se necessário

// Executar a consulta SQL
$result = $conn->query($sql);

// Verificar se a consulta foi executada com sucesso
if ($result === false) {
    die('Erro na consulta SQL: ' . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conferente de Produtos</title>
    <!-- Inclusão do Bootstrap para estilizar a tabela -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Conferente de Produtos</h2>
        
        <?php
        // Verificar se há resultados na consulta
        if ($result->num_rows > 0) {
            // Exibir os dados em uma tabela
            echo "<table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th>CPF/CNPJ do Cliente</th>
                            <th>Nome do Cliente</th>
                            <th>Produto</th>
                            <th>Quantidade</th>
                        </tr>
                    </thead>
                    <tbody>";

            // Iterar sobre os resultados e exibir cada linha
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['cliente_cpfcnpj']) . "</td>
                        <td>" . htmlspecialchars($row['cliente_nome']) . "</td>
                        <td>" . htmlspecialchars($row['produto_nome']) . "</td>
                        <td>" . htmlspecialchars($row['quantidade']) . "</td>
                      </tr>";
            }

            echo "</tbody></table>";
        } else {
            // Caso não haja resultados
            echo "<div class='alert alert-warning' role='alert'>
                    Nenhuma compra encontrada para conferência.
                  </div>";
        }
        ?>

    </div>

    <!-- Inclusão do JS do Bootstrap para funcionalidade -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Fechar a conexão com o banco de dados
$conn->close();
?>
