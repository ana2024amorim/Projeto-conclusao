<?php
require_once "conector_db.php";
header('Content-Type: application/json');

// Verifica se a conexão existe
if (!isset($conn)) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Conexão com o banco de dados não encontrada.']);
    exit;
}

try {
    // Pega os parâmetros da requisição (se existirem)
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Página atual, padrão é 1
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 8; // Limite de itens por página, padrão é 10
    $search = isset($_GET['search']) ? $_GET['search'] : ''; // Termo de pesquisa

    // Calcula o OFFSET para a consulta
    $offset = ($page - 1) * $limit;

    // Consulta SQL com pesquisa por nome (se houver)
    $sql = "SELECT id, cpf_cnpj, razao_nome, cidade, uf, telefone, email
            FROM tb_cliente
            WHERE razao_nome LIKE ? OR cpf_cnpj LIKE ?
            LIMIT ? OFFSET ?";
    
    // Prepara a consulta
    $stmt = $conn->prepare($sql);
    $searchTerm = "%$search%"; // Envolve o termo de busca com '%'
    $stmt->bind_param('ssii', $searchTerm, $searchTerm, $limit, $offset);
    $stmt->execute();

    // Obtém o resultado
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $clientes = [];
        while ($row = $result->fetch_assoc()) {
            $clientes[] = $row;
        }

        // Conta o total de registros para calcular o número de páginas
        $countSql = "SELECT COUNT(*) AS total FROM tb_cliente WHERE razao_nome LIKE ? OR cpf_cnpj LIKE ?";
        $countStmt = $conn->prepare($countSql);
        $countStmt->bind_param('ss', $searchTerm, $searchTerm);
        $countStmt->execute();
        $countResult = $countStmt->get_result();
        $totalRows = $countResult->fetch_assoc()['total'];
        $totalPages = ceil($totalRows / $limit);

        echo json_encode([
            'sucesso' => true,
            'clientes' => $clientes,
            'totalPages' => $totalPages
        ]);
    } else {
        echo json_encode(['sucesso' => false, 'mensagem' => 'Nenhum cliente encontrado.']);
    }
} catch (Exception $e) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Erro ao buscar clientes: ' . $e->getMessage()]);
}
?>
