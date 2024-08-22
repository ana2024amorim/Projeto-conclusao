<?php

require_once "conector_db.php";

if (empty($_POST['matricula']) || empty($_POST['password'])) {
    header('Location: ../pagina_inicial.html');
    exit();
}

$matricula = mysqli_real_escape_string($conn, $_POST['matricula']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$query = "SELECT * from tb_login where name = '{$matricula}' and password = '{$password}'";

$result = mysqli_query($conn, $query);

$row = mysqli_num_rows($result);

if($row == 1) {
    $_SESSION['matricula'] = $matricula;
    header('Location: index.html');
}else {
    header('Location: index.html');
    exit();
}