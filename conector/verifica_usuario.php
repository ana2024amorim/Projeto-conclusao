<?php
// Incluir a conexão com o banco
require_once "conector_db.php";

// Iniciar a sessão para verificar o login do usuário (caso necessário)
//session_start();

// Verificar se a variável de sessão com o ID do usuário está definida
if (isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id'];

    // Consulta para verificar se o usuario_id é igual a 123
    $sql = "SELECT * FROM aceita_documento WHERE usuario_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        // Vincular o parâmetro
        $stmt->bind_param("i", $usuario_id);

        // Executar a consulta
        $stmt->execute();

        // Obter o resultado
        $result = $stmt->get_result();

        // Verificar se o usuário existe e se o id corresponde a 123
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['usuario_id'] == 123) {
                echo '123'; // Retorna 123 se o usuário tiver permissão
            } else {
                echo 'não autorizado'; // Caso contrário, retorna 'não autorizado'
            }
        } else {
            echo 'não encontrado'; // Caso o usuário não tenha sido encontrado na tabela
        }

        // Fechar o statement
        $stmt->close();
    } else {
        echo 'erro na consulta';
    }
} else {
    echo 'usuário não logado'; // Caso não haja usuário logado
}

// Fechar a conexão com o banco
$conn->close();
?>
