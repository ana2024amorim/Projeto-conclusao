<?php
require_once "../conector/conector_db.php";

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Definir a quantidade de produtos por página
$produtos_por_pagina = 5;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina - 1) * $produtos_por_pagina;

// Selecionar produtos em ordem alfabética com limite de produtos por página
$sql = "SELECT codigo_produto, nome_peca, valor_varejo, peso, fornecedor, modelo_carro 
        FROM tb_produto 
        ORDER BY nome_peca ASC 
        LIMIT $offset, $produtos_por_pagina";
$result = $conn->query($sql);

// Montar a tabela com os produtos
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["codigo_produto"] . "</td>
                <td>" . $row["nome_peca"] . "</td>
                <td>" . number_format($row["valor_varejo"], 2, ',', '.') . "</td>
                <td>" . $row["peso"] . " kg</td>
                <td>" . $row["fornecedor"] . "</td> <!-- Fornecedor -->
                <td>" . $row["modelo_carro"] . "</td> <!-- Modelo do Carro -->
                <td><span class='edit-icon' onclick='editProduct(\"" . $row["codigo_produto"] . "\")'>✏️</span></td> <!-- Icone de editar -->
              </tr>";
    }
} else {
    echo "<tr><td colspan='7'>Nenhum produto encontrado</td></tr>"; // Alterado para 7 colunas
}

// Contar o total de produtos para calcular o número de páginas
$sql_total = "SELECT COUNT(*) as total FROM tb_produto";
$result_total = $conn->query($sql_total);
$total_row = $result_total->fetch_assoc();
$total_produtos = $total_row['total'];
$total_paginas = ceil($total_produtos / $produtos_por_pagina);

// Exibir a navegação de páginas
echo '<tr><td colspan="7">'; // Alterado para 7 colunas
for ($i = 1; $i <= $total_paginas; $i++) {
    echo '<a href="?pagina=' . $i . '" style="margin: 0 5px;">' . $i . '</a>';
}
echo '</td></tr>';

$conn->close();
?>

<script>
    function editProduct(codigo) {
        // Lógica para lidar com a edição do produto
        console.log("Editando produto com código:", codigo);
        // Você pode redirecionar para uma página de edição ou abrir um modal
        // window.location.href = 'editar_produto.php?codigo=' + codigo;
    }
</script>
