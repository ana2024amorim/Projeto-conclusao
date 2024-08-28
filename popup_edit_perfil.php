<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/popup_edit_perfil.css">
    <title>Popup de Alteração de Dados</title>
</head>
<body>
    <!-- <header>
        <nav class="ven-bar">
            Outros elementos do cabeçalho
            <div class="user-profile">
                <button class="open-popup-btn">Alterar Dados</button>
            </div>
        </nav>
    </header> -->

    <!-- Popup -->
    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close-btn">&times;</span>
            <h2>Alterar Dados do Usuário</h2>
            <form id="user-form">
                <label for="username">Nome:</label>
                <input type="text" id="username" name="username" value="Usuário">

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="usuario@example.com">

                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" placeholder="Nova senha">

                <button type="submit">Salvar Alterações</button>
            </form>
        </div>
    </div>

    <script src="js/scrip_popup_edit_perfil.js"></script>
</body>
</html>
