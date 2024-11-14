<?php
require_once "conector_db.php";

// Verifica se os dados foram enviados corretamente
if (isset($_POST['id']) && isset($_POST['cargo'])) {
    $id = $_POST['id'];
    $cargo = $_POST['cargo'];

    // Prepara a consulta para atualizar tanto o nivel_acesso quanto o cargo
    $stmt = $conn->prepare("UPDATE tb_funcionario SET nivel_acesso = ?, cargo = ? WHERE id = ?");
    
    if ($stmt === false) {
        // Exibe erro de preparação
        echo json_encode(['sucesso' => false, 'erro' => 'Erro na preparação da consulta: ' . $conn->error]);
        exit;
    }

    // Associa os parâmetros: "si" significa string e integer
    $stmt->bind_param("ssi", $cargo, $cargo, $id); 

    // Executa a consulta
    if ($stmt->execute()) {
        // Atualiza tb_login
        $stmt2 = $conn->prepare("UPDATE tb_login SET permissao = ? WHERE id = ?");
        
        if ($stmt2 === false) {
            echo json_encode(['sucesso' => false, 'erro' => 'Erro na preparação da consulta tb_login: ' . $conn->error]);
            exit;
        }
        
        // Associa os parâmetros: "si" significa string e integer
        $stmt2->bind_param("si", $cargo, $id); 
        
        if ($stmt2->execute()) {
            echo json_encode(['sucesso' => true]);
        } else {
            echo json_encode(['sucesso' => false, 'erro' => 'Erro ao atualizar permissão na tb_login']);
        }

        $stmt2->close();
    } else {
        echo json_encode(['sucesso' => false, 'erro' => 'Erro ao atualizar nivel_acesso e cargo']);
    }

    $stmt->close();
} else {
    echo json_encode(['sucesso' => false, 'erro' => 'Dados incompletos']);
}

$conn->close();
?>
