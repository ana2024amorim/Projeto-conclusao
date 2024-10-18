<?php
require_once "../conector/conector_db.php"; // Inclua seu arquivo de conexão ao banco de dados

$itens_por_pagina = 10; // Itens por página

// Contar o total de produtos
$total_resultados = $conn->query("SELECT COUNT(*) AS total FROM tb_produto")->fetch_assoc()['total'];
$total_paginas = ceil($total_resultados / $itens_por_pagina);

$pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_atual - 1) * $itens_por_pagina;

// Consulta os produtos
$sql = "SELECT codigo_produto, fornecedor, nome_peca, peso, valor_varejo, modelo_carro, marca_fabricante, descricao_peca 
        FROM tb_produto 
        LIMIT $itens_por_pagina OFFSET $offset";

$result = $conn->query($sql);

if (!$result) {
    die("Erro na consulta SQL: " . $conn->error);
}

if ($result->num_rows > 0) {
    echo "<table class='table'>";
    echo "<thead>
            <tr>
                <th>Código</th>
                <th>Fornecedor</th>
                <th>Nome</th>
                <th>Peso (kg)</th>
                <th>Valor</th>
                <th>Modelo</th>
                <th>Marca</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
          </thead>
          <tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row["codigo_produto"]) . "</td>
                <td>" . htmlspecialchars($row["fornecedor"]) . "</td>
                <td>" . htmlspecialchars($row["nome_peca"]) . "</td>
                <td>" . htmlspecialchars($row["peso"]) . "</td>
                <td>" . number_format($row["valor_varejo"], 2, ',', '.') . "</td>
                <td>" . htmlspecialchars($row["modelo_carro"]) . "</td>
                <td>" . htmlspecialchars($row["marca_fabricante"]) . "</td>
                <td>" . htmlspecialchars($row["descricao_peca"]) . "</td>
                <td>
                    <button class='btn btn-warning' onclick='openEditModal(\"" . htmlspecialchars($row["codigo_produto"]) . "\")'>✏️</button>
                    <button class='btn btn-danger' onclick='openDeleteModal(\"" . htmlspecialchars($row["codigo_produto"]) . "\")'>🗑️</button>
                </td>
              </tr>";
    }
    echo "</tbody></table>";

    echo '<nav aria-label="Page navigation">';
    echo '<ul class="pagination">';
    for ($i = 1; $i <= $total_paginas; $i++) {
        echo "<li class='page-item'><a class='page-link' href='#' onclick='loadPage($i); return false;'>$i</a></li>";
    }
    echo '</ul></nav>';
} else {
    echo "<div>Nenhum produto encontrado.</div>";
}

$conn->close();
?>
