<?php
// Inicia a conexão com o banco de dados
require_once "conector_db.php";

// Ativa a exibição de erros para depuração
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json'); // Define o tipo de resposta como JSON

$response = array('success' => false, 'message' => '');

// Captura e sanitiza os campos obrigatórios
$username = !empty($_POST['username']) ? mysqli_real_escape_string($conn, $_POST['username']) : null;
$email = !empty($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : null;
$password = !empty($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : null;

if (empty($username) || empty($email) || empty($password)) {
    $response['message'] = "Nome, email e senha são obrigatórios!";
    echo json_encode($response);
    exit();
}

// Verifica se o usuário ou email já existem
$sql_check = "SELECT COUNT(*) FROM tb_funcionario WHERE nome = ? OR email = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("ss", $username, $email);
$stmt_check->execute();
$stmt_check->bind_result($count);
$stmt_check->fetch();
$stmt_check->close();

if ($count > 0) {
    $response['message'] = "Usuário ou email já estão cadastrados!";
    echo json_encode($response);
    exit();
}

// Função para gerar matrícula única
function generateUniqueMatricula($conn) {
    do {
        // Gera um número aleatório de matrícula
        $matricula = str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
        
        // Inicializa a contagem
        $count = 0;

        // Verifica se já existe essa matrícula no banco de dados
        $sql_check = "SELECT COUNT(*) FROM tb_login WHERE matricula = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("s", $matricula);
        $stmt_check->execute();
        $stmt_check->bind_result($count);
        $stmt_check->fetch();
        $stmt_check->close();
    } while ($count > 0); // Repete até que encontre uma matrícula única

    return $matricula; // Retorna a matrícula única
}

// Captura e sanitiza os campos opcionais
$gender = !empty($_POST['gender']) ? mysqli_real_escape_string($conn, $_POST['gender']) : null;
$dob = !empty($_POST['dob']) ? mysqli_real_escape_string($conn, $_POST['dob']) : null;
$position = !empty($_POST['position']) ? mysqli_real_escape_string($conn, $_POST['position']) : null;
$access_level = !empty($_POST['access-level']) ? mysqli_real_escape_string($conn, $_POST['access-level']) : null;
$telefone = !empty($_POST['telefone']) ? mysqli_real_escape_string($conn, $_POST['telefone']) : null;

// Verifica se o arquivo de foto foi enviado
if (empty($_FILES['foto']['name']) || $_FILES['foto']['error'] != UPLOAD_ERR_OK) {
    $response['message'] = 'Erro ao fazer upload da foto.';
    echo json_encode($response);
    exit();
}

// Define o diretório para armazenar as fotos
$target_dir = "../uploads/"; // Certifique-se de que essa pasta exista e tenha permissões de escrita
$target_file = $target_dir . basename($_FILES['foto']['name']);
$uploadOk = 1;

// Verifica se o arquivo é uma imagem
$check = getimagesize($_FILES['foto']['tmp_name']);
if ($check === false) {
    $response['message'] = 'O arquivo não é uma imagem.';
    echo json_encode($response);
    exit();
}

// Tenta mover o arquivo para o diretório desejado
if (!move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
    $response['message'] = 'Erro ao mover o arquivo para o diretório.';
    echo json_encode($response);
    exit();
}

// Hash da senha
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Gera uma matrícula única
$matricula = generateUniqueMatricula($conn);

// Query de inserção na tabela tb_login
$sql_login = "INSERT INTO tb_login (matricula, password, permissao) VALUES (?, ?, ?)";
$stmt_login = $conn->prepare($sql_login);

if (!$stmt_login) {
    $response['message'] = "Erro na preparação da consulta de login: " . $conn->error;
    echo json_encode($response);
    exit();
}

// Bind os parâmetros para a tabela de login
$stmt_login->bind_param("sss", $matricula, $hashed_password, $access_level); 

// Executa a inserção na tabela tb_login
if ($stmt_login->execute()) {
    // Agora insira o funcionário na tabela tb_funcionario
    $sql_funcionario = "INSERT INTO tb_funcionario (matricula, nome, email, genero, data_nascimento, cargo, nivel_acesso, telefone, foto) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt_funcionario = $conn->prepare($sql_funcionario);

    if (!$stmt_funcionario) {
        $response['message'] = "Erro na preparação da consulta: " . $conn->error;
        echo json_encode($response);
        exit();
    }

    // Bind os parâmetros, incluindo o caminho da foto
    $stmt_funcionario->bind_param("sssssssss", $matricula, $username, $email, $gender, $dob, $position, $access_level, $telefone, $target_file);

    // Executa a inserção na tabela tb_funcionario
    if ($stmt_funcionario->execute()) {
        $response['success'] = true;
        $response['message'] = 'Funcionário cadastrado com sucesso!';
    } else {
        $response['message'] = 'Erro ao cadastrar funcionário: ' . $stmt_funcionario->error;
    }

    $stmt_funcionario->close();
} else {
    $response['message'] = 'Erro ao cadastrar no login: ' . $stmt_login->error;
}

$stmt_login->close();
echo json_encode($response);
$conn->close();
?>
