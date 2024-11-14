<?php
// Conexão com o banco de dados
require_once "conector_db.php";

// Função para consultar o número de funcionários
function contar_funcionarios($conn) {
    $query = "SELECT COUNT(*) AS total_funcionario FROM tb_funcionario";
    $result = $conn->query($query);
    if ($result) {
        $row = $result->fetch_assoc();
        return $row['total_funcionario']; // Retorna o número total de funcionários
    }
    return 0; // Se falhar, retorna 0
}

// Função para consultar o número de clientes
function contar_clientes($conn) {
    $query = "SELECT COUNT(*) AS total_clientes FROM tb_cliente";
    $result = $conn->query($query);
    if ($result) {
        $row = $result->fetch_assoc();
        return $row['total_clientes']; // Retorna o número total de clientes
    }
    return 0; // Se falhar, retorna 0
}
// Funcao para consulta qtd de pecas vendidas
function contar_pecasVendidas($conn) {
    // Consulta para contar o número total de peças vendidas
    $query = "SELECT SUM(quantidade) AS total_pecas_vendidas
              FROM tb_compra
              WHERE finalizado = 1";  // Considera apenas compras finalizadas

    $result = $conn->query($query);

    if ($result) {
        $row = $result->fetch_assoc();
        return $row['total_pecas_vendidas']; // Retorna a quantidade total de peças vendidas
    } else {
        return 0; // Se não houver resultados ou erro, retorna 0
    }
}

// Funcao para consulta total vendido
function getTotalVendido($conn) {
    // Consulta para somar o valor total das compras finalizadas
    $query = "SELECT SUM(valor_total) AS total_vendido
              FROM tb_compra
              WHERE finalizado = 1";  // Considera apenas compras finalizadas

    // Executar a consulta
    $result = $conn->query($query);

    // Verificar se a consulta retornou resultados
    if ($result) {
        $row = $result->fetch_assoc();
        return $row['total_vendido'];  // Retorna o valor total vendido
    } else {
        return 0;  // Se não houver vendas, retorna 0
    }
}


// Consultar o número total de funcionários
$total_funcionario = contar_funcionarios($conn);

// Consultar o número total de clientes
$total_clientes = contar_clientes($conn);

// Consultar o número total de pecas
$total_pecas_vendidas = contar_pecasVendidas($conn);

// Consultar o número total de pecas
$total_vendido = getTotalVendido($conn);

// Fechar a conexão
$conn->close();
?>