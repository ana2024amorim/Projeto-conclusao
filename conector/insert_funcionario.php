<?php
// Inicia a conexão com o banco de dados
require_once "conector_db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $employee_id = mysqli_real_escape_string($conn, $_POST['employee-id']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $access_level = mysqli_real_escape_string($conn, $_POST['access-level']);
    $telefone = mysqli_real_escape_string($conn, $_POST['telefone']);
    
    // Tratamento do upload da foto
    $photo = $_FILES['photo']['name'];
    $photo_tmp = $_FILES['photo']['tmp_name'];
    $photo_folder = "uploads/" . basename($photo);

    if (move_uploaded_file($photo_tmp, $photo_folder)) {
        // Query de inserção no banco de dados
        $sql = "INSERT INTO tb_funcionario (nome, email, senha, genero, data_nascimento, matricula, cargo, nivel_acesso, telefone, foto)
                VALUES ('$username', '$email', '$password', '$gender', '$dob', '$employee_id', '$position', '$access_level', '$telefone', '$photo_folder')";

        if (mysqli_query($conn, $sql)) {
            echo "Funcionário cadastrado com sucesso!";
        } else {
            echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Falha ao fazer o upload da foto.";
    }
}

// Fecha a conexão (opcional)
mysqli_close($conn);
?>
