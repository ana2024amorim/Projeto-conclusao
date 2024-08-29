<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- popup_content.html -->
<div class="popup-content">
    <span class="close-btn">&times;</span>
    <h2>Alterar Dados do Usuário</h2>
    <form id="user-form">
        <label for="username">Nome:</label>
        <input type="text" id="username" name="username" value="Usuário" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="usuario@example.com" required>

        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" placeholder="Nova senha" required>

        <button type="submit">Salvar Alterações</button>
    </form>
</div>

</body>
</html>