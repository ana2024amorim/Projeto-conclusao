<?php
require_once "conector_db.php"; // Inclua seu arquivo de conexão ao banco de dados

// Define quantos itens você quer por página
$itens_por_pagina = 10;

// Obtenha o número total de registros na tabela
$total_resultados = $conn->query("SELECT COUNT(*) AS total FROM tb_estoque")->fetch_assoc()['total'];

// Calcule o total de páginas
$total_paginas = ceil($total_resultados / $itens_por_pagina);

// Obtenha a página atual, se não estiver definida, defina como 1
$pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_atual - 1) * $itens_por_pagina;

// SQL para obter os itens de estoque com limite e offset
$sql = "SELECT codigo_peca, localizacao, corredor, posicao, nivel, quantidade, fornecedor 
        FROM tb_estoque 
        LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $itens_por_pagina, $offset);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<table class='table'>";
    echo "<thead>
            <tr>
                <th>Código da Peça</th>
                <th>Localização</th>
                <th>Corredor</th>
                <th>Posição</th>
                <th>Nível</th>
                <th>Quantidade</th>
                <th>Fornecedor</th>
                <th>Ações</th>
            </tr>
          </thead>
          <tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row["codigo_peca"]) . "</td>
                <td>" . htmlspecialchars($row["localizacao"]) . "</td>
                <td>" . htmlspecialchars($row["corredor"]) . "</td>
                <td>" . htmlspecialchars($row["posicao"]) . "</td>
                <td>" . htmlspecialchars($row["nivel"]) . "</td>
                <td>" . htmlspecialchars($row["quantidade"]) . "</td>
                <td>" . htmlspecialchars($row["fornecedor"]) . "</td>
                <td>
                    <button class='btn btn-warning' onclick='openEditEstoqueModal(\"" . htmlspecialchars($row["codigo_peca"]) . "\")'>✏️</button>
                    <button class='btn btn-danger' onclick='openDeleteEstoqueModal(\"" . htmlspecialchars($row["codigo_peca"]) . "\")'>🗑️</button>
                </td>
              </tr>";
    }
    echo "</tbody></table>";

    // Exibir a paginação
    echo '<nav aria-label="Page navigation">';
    echo '<ul class="pagination">';
    for ($i = 1; $i <= $total_paginas; $i++) {
        echo "<li class='page-item'><a class='page-link' href='#' onclick='loadEstoquePage($i); return false;'>$i</a></li>";
    }
    echo '</ul>';
    echo '</nav>';
} else {
    echo "<div>Nenhum item de estoque encontrado.</div>";
}

$stmt->close();
$conn->close();
?>

<script>
    function editEstoque(codigo) {
        console.log("Editando item de estoque com código:", codigo);
        // Aqui você pode implementar a lógica para editar o item de estoque
    }

    function deleteEstoque(codigo) {
        console.log("Excluindo item de estoque com código:", codigo);
        // Aqui você pode implementar a lógica para excluir o item de estoque
    }

    // Função para carregar a página via AJAX
    function loadEstoquePage(pagina) {
        $.ajax({
            url: 'consulta_estoque.php',
            type: 'GET',
            data: { pagina: pagina },
            success: function(data) {
                // Atualizar o conteúdo do modal com os novos dados
                $('#estoque-list').html(data);
            },
            error: function() {
                console.log("Erro ao carregar os dados.");
            }
        });
    }

    // Função para abrir o modal e carregar a primeira página dos dados
    function openEstoqueModal() {
        $('#estoqueModal').modal('show'); // Abre o modal
        loadEstoquePage(1); // Carrega a primeira página dos dados
    }
</script>
