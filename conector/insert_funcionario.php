<?php
require_once "conector_db.php";
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $genero = $_POST['genero'];
    $data_nascimento = $_POST['data_nascimento'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $matricula = $_POST['matricula'];
    $cargo = $_POST['cargo'];
    $nivel_acesso = $_POST['nivel_acesso'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Hash da senha

    // Verifica se uma foto foi enviada
    $foto = null;
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $foto = $_FILES['foto']['name'];
        $upload_dir = 'uploads/'; // Diretório onde a foto será salva
        $upload_file = $upload_dir . basename($foto);

        // Move o arquivo para o diretório de upload
        if (!move_uploaded_file($_FILES['foto']['tmp_name'], $upload_file)) {
            die("Falha ao enviar a foto.");
        }
    }

    // Prepara a consulta SQL
    $sql = "INSERT INTO funcionarios (nome, genero, data_nascimento, telefone, email, matricula, cargo, nivel_acesso, foto, senha)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepara a declaração
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Erro na preparação da consulta: " . $conn->error);
    }

    // Liga os parâmetros e executa a declaração
    $stmt->bind_param("ssssssssss", $nome, $genero, $data_nascimento, $telefone, $email, $matricula, $cargo, $nivel_acesso, $foto, $senha);
    if ($stmt->execute()) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao realizar o cadastro: " . $stmt->error;
    }

    // Fecha a declaração e a conexão
    $stmt->close();
    $conn->close();
}
