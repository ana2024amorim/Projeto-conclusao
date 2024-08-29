<?php
// Suponha que você tenha uma variável $photoUrl com a URL da foto do banco de dados
$photoUrl = 'images/template.png'; // Substitua com a URL real da foto
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cadastro_funcionario.css">
    <title>Cadastro de Funcionário</title>
</head>
<body>
    <div class="container">
        <!-- Visualização da foto de perfil -->
        <div class="photo-preview-container">
            <img id="photo-preview" src="<?php echo $photoUrl; ?>" alt="Foto de Perfil">
        </div>

        <h1>Cadastro de Funcionário</h1>

        <form id="user-form" enctype="multipart/form-data">
            <div class="column">
                <label for="username">Nome:</label>
                <input type="text" id="username" name="username" value="Usuário">
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="usuario@example.com">
                
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" placeholder="Nova senha">
            </div>

            <div class="column">
                <label for="gender">Gênero:</label>
                <select id="gender" name="gender">
                    <option value="male">Masculino</option>
                    <option value="female">Feminino</option>
                    <option value="other">Outro</option>
                </select>
                
                <label for="dob">Data de Nascimento:</label>
                <input type="date" id="dob" name="dob">
                
                <label for="photo">Foto de Perfil:</label>
                <input type="file" id="photo" name="photo">
            </div>

            <div class="column">
                <label for="employee-id">Número de Matrícula:</label>
                <input type="text" id="employee-id" name="employee-id" value="1234" readonly>
                
                <label for="position">Cargo:</label>
                <input type="text" id="position" name="position">
                
                <label for="access-level">Nível de Acesso:</label>
                <input type="text" id="access-level" name="access-level">
            </div>

            <!-- Contêiner para os botões -->
            <div class="button-container">
                <a href="pagina_venda.php" class="back-button">Voltar</a>
                <button type="submit">Salvar Alterações</button>
            </div>
        </form>
    </div>
    <script src="js/cadastro_funcionario.js"></script>
</body>
</html>
