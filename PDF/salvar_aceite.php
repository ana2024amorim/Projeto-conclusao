<?php
require_once "../conector/conector_db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['aceite']) && $_POST['aceite'] == '1') {
        if (isset($_POST['nome_usuario'])) {
            // Sanitiza o nome recebido para evitar XSS
            $nome_usuario = htmlspecialchars(trim($_POST['nome_usuario']), ENT_QUOTES, 'UTF-8');

            // Prepara a consulta para inserir o registro no banco
            $sql = "INSERT INTO aceita_documento (nome_usuario, data_aceite) VALUES (?, NOW())";

            // Usa prepared statements para evitar injeção de SQL
            if ($stmt = $conn->prepare($sql)) {
                // Vincula o parâmetro à consulta
                $stmt->bind_param("s", $nome_usuario);

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
            echo "Nome do usuário não fornecido.";
        }
    } else {
        echo "Você precisa aceitar os termos para continuar.";
    }
} else {
    echo "Requisição inválida.";
}
?>
