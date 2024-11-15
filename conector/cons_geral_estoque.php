<?php
// Conexão com o banco de dados
require_once "conector_db.php";

// Definir o número de itens por página (5 ou 10)
$itens_por_pagina = 10;  // Alterar para 5 se preferir 5 itens por página

// Pegar o número da página via parâmetro GET, se não definido, define como 1
$pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

// Calcular o OFFSET (posição de início para a consulta)
$offset = ($pagina_atual - 1) * $itens_por_pagina;

// Consulta SQL para obter os dados de tb_estoque e tb_produto com LIMIT e OFFSET para paginação
$sql = "
    SELECT 
        e.codigo_peca, 
        e.localizacao, 
        e.fornecedor, 
        e.quantidade,
        p.nome_peca,
        p.valor_varejo
    FROM 
        tb_estoque e
    INNER JOIN 
        tb_produto p ON e.codigo_peca = p.codigo_produto
    LIMIT $itens_por_pagina OFFSET $offset
";

$result = $conn->query($sql);

// Inicializa um array para armazenar os resultados
$estoque = [];

// Verifica se há resultados e adiciona ao array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $estoque[] = $row; // Adiciona cada linha ao array
    }
    
    // Consulta para contar o total de registros (para calcular as páginas)
    $sql_total = "
        SELECT COUNT(*) AS total_registros
        FROM 
            tb_estoque e
        INNER JOIN 
            tb_produto p ON e.codigo_peca = p.codigo_produto
    ";
    $total_result = $conn->query($sql_total);
    $total_registros = $total_result->fetch_assoc()['total_registros'];

    // Calcular o total de páginas
    $total_paginas = ceil($total_registros / $itens_por_pagina);

    // Adiciona os dados de paginação ao resultado
    $response = [
        'dados' => $estoque,
        'pagina_atual' => $pagina_atual,
        'total_paginas' => $total_paginas,
        'total_registros' => $total_registros
    ];

    // Define o cabeçalho de resposta para JSON e exibe os dados codificados
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Se nenhum registro encontrado, retorna um JSON vazio
    header('Content-Type: application/json');
    echo json_encode([]);
}

// Fecha a conexão
$conn->close();
?>
