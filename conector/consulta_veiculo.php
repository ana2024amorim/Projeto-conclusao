<?php
require_once "conector_db.php"; // Inclua seu arquivo de conexão ao banco de dados

// Defina quantos itens você quer por página
$itens_por_pagina = 10;

// Obtenha o número total de registros na tabela de veículos
$total_resultados = $conn->query("SELECT COUNT(*) AS total FROM tb_veiculo")->fetch_assoc()['total'];

// Calcule o total de páginas
$total_paginas = ceil($total_resultados / $itens_por_pagina);

// Obtenha a página atual, se não estiver definida, defina como 1
$pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_atual - 1) * $itens_por_pagina;

// SQL para obter os veículos com limite e offset
$sql = "SELECT fabricante, veiculo, tipo_motor, ano_lancamento, ano_encerramento, modelo, item_agregado 
        FROM tb_veiculo 
        LIMIT $itens_por_pagina OFFSET $offset";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table'>";
    echo "<thead>
            <tr>
                <th>Fabricante</th>
                <th>Veículo</th>
                <th>Tipo de Motor</th>
                <th>Ano de Lançamento</th>
                <th>Ano de Encerramento</th>
                <th>Modelo</th>
                <th>Item Agregado</th>
                <th>Ações</th>
            </tr>
          </thead>
          <tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row["fabricante"]) . "</td>
                <td>" . htmlspecialchars($row["veiculo"]) . "</td>
                <td>" . htmlspecialchars($row["tipo_motor"]) . "</td>
                <td>" . htmlspecialchars($row["ano_lancamento"]) . "</td>
                <td>" . htmlspecialchars($row["ano_encerramento"]) . "</td>
                <td>" . htmlspecialchars($row["modelo"]) . "</td>
                <td>" . htmlspecialchars($row["item_agregado"]) . "</td>
                <td>
                    <button class='btn btn-warning' onclick='editVeiculo(\"" . htmlspecialchars($row["veiculo"]) . "\")'>✏️</button>
                    <button class='btn btn-danger' onclick='deleteVeiculo(\"" . htmlspecialchars($row["veiculo"]) . "\")'>🗑️</button>
                </td>
              </tr>";
    }
    echo "</tbody></table>";

    // Exibir a paginação
    echo '<nav aria-label="Page navigation">';
    echo '<ul class="pagination">';
    for ($i = 1; $i <= $total_paginas; $i++) {
        echo "<li class='page-item'><a class='page-link' href='#' onclick='loadVeiculoPage($i); return false;'>$i</a></li>";
    }
    echo '</ul>';
    echo '</nav>';
} else {
    echo "<div>Nenhum veículo encontrado.</div>";
}

$conn->close();
?>

<script>
    function editVeiculo(veiculo) {
        console.log("Editando veículo:", veiculo);
        // Aqui você pode implementar a lógica para editar o veículo
    }

    function deleteVeiculo(veiculo) {
        console.log("Excluindo veículo:", veiculo);
        // Aqui você pode implementar a lógica para excluir o veículo
    }

    // Função para carregar a página de veículos via AJAX
    function loadVeiculoPage(pagina) {
        $.ajax({
            url: 'consulta_veiculo.php',
            type: 'GET',
            data: { pagina: pagina },
            success: function(data) {
                // Atualizar o conteúdo do modal com os novos dados
                $('#veiculo-list').html(data);
            },
            error: function() {
                console.log("Erro ao carregar os dados.");
            }
        });
    }

    // Função para abrir o modal e carregar a primeira página dos dados
    function openVeiculoModal() {
        $('#veiculoModal').modal('show'); // Abre o modal
        loadVeiculoPage(1); // Carrega a primeira página dos dados
    }
</script>
