<?php
require_once "../conector/conector_db.php";

// Verifica se a requisição é do tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o campo 'aceite' foi enviado e contém o valor '1'
    if (isset($_POST['aceite']) && $_POST['aceite'] == '1') {
        // Substitua pelo ID real do usuário logado
        $usuario_id = 123; 

        // Prepara a consulta para inserir o registro no banco
        $sql = "INSERT INTO aceita_documento (usuario_id, data_aceite) VALUES (?, NOW())";

        // Usa prepared statements para evitar injeção de SQL
        if ($stmt = $conn->prepare($sql)) {
            // Vincula o parâmetro à consulta
            $stmt->bind_param("i", $usuario_id);

            // Executa a consulta
            if ($stmt->execute()) {
                echo "Aceite registrado com sucesso!";
            } else {
                echo "Erro ao registrar o aceite: " . $stmt->error;
            }

            // Fecha o statement
            $stmt->close();
        } else {
            echo "Erro ao preparar a consulta: " . $conn->error;
        }
    } else {
        echo "Você precisa aceitar os termos para continuar.";
    }
} else {
    echo "Requisição inválida.";
}
?>

