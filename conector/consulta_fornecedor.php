<?php
require_once "../conector/conector_db.php"; // Inclua seu arquivo de conexão ao banco de dados

// Defina quantos itens você quer por página
$itens_por_pagina = 10;

// Obtenha o número total de registros na tabela
$total_resultados = $conn->query("SELECT COUNT(*) AS total FROM tb_fornecedor")->fetch_assoc()['total'];

// Calcule o total de páginas
$total_paginas = ceil($total_resultados / $itens_por_pagina);

// Obtenha a página atual, se não estiver definida, defina como 1
$pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_atual - 1) * $itens_por_pagina;

// SQL para obter os fornecedores com limite e offset
$sql = "SELECT fornecedor, razao_social, cnpj, endereco, telefone, cidade, situacao, email, data_cadastro 
        FROM tb_fornecedor 
        LIMIT $itens_por_pagina OFFSET $offset";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table'>";
    echo "<thead>
            <tr>
                <th>Fornecedor</th>
                <th>Razão Social</th>
                <th>CNPJ</th>
                <th>Endereço</th>
                <th>Telefone</th>
                <th>Cidade</th>
                <th>Situação</th>
                <th>Email</th>
                <th>Data de Cadastro</th>
                <th>Ações</th>
            </tr>
          </thead>
          <tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row["fornecedor"]) . "</td>
                <td>" . htmlspecialchars($row["razao_social"]) . "</td>
                <td>" . htmlspecialchars($row["cnpj"]) . "</td>
                <td>" . htmlspecialchars($row["endereco"]) . "</td>
                <td>" . htmlspecialchars($row["telefone"]) . "</td>
                <td>" . htmlspecialchars($row["cidade"]) . "</td>
                <td>" . htmlspecialchars($row["situacao"]) . "</td>
                <td>" . htmlspecialchars($row["email"]) . "</td>
                <td>" . htmlspecialchars($row["data_cadastro"]) . "</td>
                <td>
                    <button class='btn btn-warning' onclick='editFornecedor(\"" . htmlspecialchars($row["cnpj"]) . "\")'>✏️</button>
                    <button class='btn btn-danger' onclick='deleteFornecedor(\"" . htmlspecialchars($row["cnpj"]) . "\")'>🗑️</button>
                </td>
              </tr>";
    }
    echo "</tbody></table>";

    // Exibir a paginação
    echo '<nav aria-label="Page navigation">';
    echo '<ul class="pagination">';
    for ($i = 1; $i <= $total_paginas; $i++) {
        echo "<li class='page-item'><a class='page-link' href='#' onclick='loadFornecedorPage($i); return false;'>$i</a></li>";
    }
    echo '</ul>';
    echo '</nav>';
} else {
    echo "<div>Nenhum fornecedor encontrado.</div>";
}

$conn->close();
?>
<script>
    function editFornecedor(cnpj) {
        console.log("Editando fornecedor com CNPJ:", cnpj);
        // Aqui você pode implementar a lógica para editar o fornecedor
    }

    function deleteFornecedor(cnpj) {
        console.log("Excluindo fornecedor com CNPJ:", cnpj);
        // Aqui você pode implementar a lógica para excluir o fornecedor
    }

    // Função para carregar a página via AJAX
    function loadFornecedorPage(pagina) {
        $.ajax({
            url: 'busca_fornecedor.php',
            type: 'GET',
            data: { pagina: pagina },
            success: function(data) {
                // Atualizar o conteúdo do modal com os novos dados
                $('#consulta-list').html(data);
            },
            error: function() {
                console.log("Erro ao carregar os dados.");
            }
        });
    }

    // Função para abrir o modal e carregar a primeira página dos dados
    function openFornecedorModal() {
        $('#consultaModal').modal('show'); // Abre o modal
        loadFornecedorPage(1); // Carrega a primeira página dos dados
    }
</script>
