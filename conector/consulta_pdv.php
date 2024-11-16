<?php
require_once "conector_db.php"; // Inclua seu arquivo de conexão ao banco de dados

function formatarCpfCnpj($numero) {
    if (strlen($numero) == 11) {
        // Formatar como CPF: 999.999.999-99
        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "$1.$2.$3-$4", $numero);
    } elseif (strlen($numero) == 14) {
        // Formatar como CNPJ: 99.999.999/9999-99
        return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "$1.$2.$3/$4-$5", $numero);
    }
    return $numero; // Retorna como está se não corresponder
}

if (isset($_GET['cnpj']) || isset($_GET['cpf'])) {
    $identificador = isset($_GET['cnpj']) ? $_GET['cnpj'] : $_GET['cpf'];
    $identificador = $conn->real_escape_string($identificador);
    $identificadorFormatado = formatarCpfCnpj($identificador);

    // Consulta com o CPF/CNPJ formatado
    $sql = "SELECT razao_nome FROM tb_cliente WHERE cpf_cnpj = '$identificadorFormatado'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $cliente = $result->fetch_assoc();
        echo json_encode(['nome' => $cliente['razao_nome']]);
    } else {
        echo json_encode(['nome' => null]);
    }
}

$conn->close();
?>