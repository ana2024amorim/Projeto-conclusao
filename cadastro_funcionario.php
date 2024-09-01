<?php
// Suponha que você tenha uma variável $photoUrl com a URL da foto do banco de dados
// $photoUrl = 'images/template.png'; // Substitua com a URL real da foto
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cadastro_funcionario.css">
    <!-- Inclua o CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.2.3/elegant/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome -->

    <title>Cadastro de Funcionário</title>
</head>
<body>
<div class="container">
        <h1>Cadastro de Funcionário</h1>

        <form id="user-form" action="conector/insert_funcionario.php" method="POST" enctype="multipart/form-data">
            <div class="column">
                <label for="username" class="required">Nome:</label>
                <input type="text" id="username" name="username" placeholder="Usuário" required>
                
                <label for="email" class="required">Email:</label>
                <input type="email" id="email" name="email" placeholder="usuario@example.com" required>
                
                <label for="password" class="required">Senha:</label>
                <input type="password" id="password" name="password" placeholder="Nova senha" required>
            </div>

            <div class="column">
                <label for="gender">Gênero:</label>
                <select id="gender" name="gender">
                    <option value="Masculino">Masculino</option>
                    <option value="Feminino">Feminino</option>
                    <option value="Outro">Outro</option>
                </select>
                
                <label for="dob">Data de Nascimento:</label>
                <input type="date" id="dob" name="dob">
                
                <label for="foto">Foto de Perfil:</label>
                <input type="file" id="foto" name="foto">
            </div>

            <div class="column">
                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" placeholder="(xx)9999-9999">
                
                <label for="position">Cargo:</label>
                <select id="position" name="position">
                    <option value="Administrador">Administrador</option>
                    <option value="vendedor">Vendedor</option>
                    <option value="Caixa">Caixa</option>
                </select>
                
                <label for="access-level">Nível de Acesso:</label>
                <select id="access-level" name="access-level">
                    <option value="Gerente">Gerente</option>
                    <option value="Vendedor">Vendedor</option>
                </select>
            </div>

           

            <!-- Contêiner para os botões -->
            <div class="button-container">
                <a href="pagina_venda.php" class="back-button">Voltar</a>
                <button type="submit">Salvar Alterações</button>
            </div>
        </form>
    </div>

    <!-- Popup de Bootstrap -->
    <div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resultModalLabel">Resultado</h5>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i> <!-- Ícone de fechar do Font Awesome -->
                    </button>
                </div>
                <div class="modal-body" id="resultMessage">
                    <!-- Ícone de sucesso e mensagem -->
                    <i class="fas fa-check-circle icon-success"></i> <!-- Ícone de sucesso do Font Awesome -->
                    <div class="message">
                        <p>Operação realizada com sucesso!</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Inclua o jQuery e o JavaScript do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js"></script>
    <script src="js/cadastro_funcionario.js"></script>
</body>
</html>
