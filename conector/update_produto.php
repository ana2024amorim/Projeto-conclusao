<?php
require_once "conector_db.php"; // Inclua seu arquivo de conexão ao banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados enviados via POST
    $codigo_produto = $_POST['codigo_produto'] ?? null; // Obtém o código do produto
    $fornecedor = $_POST['fornecedor'] ?? null;         // Novo fornecedor
    $nome_peca = $_POST['nome_peca'] ?? null;           // Novo nome da peça
    $peso = $_POST['peso'] ?? null;                      // Novo peso
    $valor_varejo = $_POST['valor_varejo'] ?? null;    // Novo valor de varejo
    $modelo_carro = $_POST['modelo_carro'] ?? null;    // Novo modelo de carro
    $marca_fabricante = $_POST['marca_fabricante'] ?? null; // Nova marca do fabricante
    $descricao_peca = $_POST['descricao_peca'] ?? null; // Nova descrição da peça

    // Verifica se o código do produto foi fornecido
    if (empty($codigo_produto)) {
        echo json_encode(['success' => false, 'message' => 'Código do produto não fornecido.']);
        exit;
    }

    // Prepara a consulta de atualização
    $fields = [];
    $params = [];

    if (!is_null($fornecedor)) {
        $fields[] = "fornecedor = ?";
        $params[] = $fornecedor;
    }
    if (!is_null($nome_peca)) {
        $fields[] = "nome_peca = ?";
        $params[] = $nome_peca;
    }
    if (!is_null($peso)) {
        $fields[] = "peso = ?";
        $params[] = $peso;
    }
    if (!is_null($valor_varejo)) {
        $fields[] = "valor_varejo = ?";
        $params[] = $valor_varejo;
    }
    if (!is_null($modelo_carro)) {
        $fields[] = "modelo_carro = ?";
        $params[] = $modelo_carro;
    }
    if (!is_null($marca_fabricante)) {
        $fields[] = "marca_fabricante = ?";
        $params[] = $marca_fabricante;
    }
    if (!is_null($descricao_peca)) {
        $fields[] = "descricao_peca = ?";
        $params[] = $descricao_peca;
    }

    if (empty($fields)) {
        echo json_encode(['success' => false, 'message' => 'Nenhum dado a ser atualizado.']);
        exit;
    }

    // Monta a consulta
    $sql = "UPDATE tb_produto SET " . implode(", ", $fields) . " WHERE codigo_produto = ?";
    $params[] = $codigo_produto; // Adiciona o código do produto como último parâmetro
    $stmt = $conn->prepare($sql);

    // Monta os tipos dos parâmetros
    $types = str_repeat('s', count($params) - 1) . 's'; // 's' para strings, 'd' para decimal
    $stmt->bind_param($types, ...$params); // Usando o operador de espalhamento para passar os parâmetros

    // Executa a atualização
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Produto atualizado com sucesso!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao atualizar produto: ' . $stmt->error]);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
}

$conn->close();
?>
