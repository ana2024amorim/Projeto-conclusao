<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/pagina_venda.css">
    <title>Bem-vindo</title>
</head>
<body>
    <header>
        <nav class="ven-bar">
            <div class="logo">
                <h1>LOGO</h1>
            </div>
            <div class="colaborador">
                <h1>Olá, <span class="user-name">Usuário</span></h1>
            </div>
            <div class="user-profile">
                <img src="images/avatar-default.png" alt="User Icon" class="user-icon">
                <div class="dropdown">
                    <button class="dropbtn">Perfil</button>
                    <div class="dropdown-content">
                        <a href="#" id="open-popup-btn">Modificar Dados</a>
                        <a href="index.php">Logout</a>
                    </div>
                </div>
            </div>
        </nav>
          
        
    
    </header>

    <!-- Popup -->
    <div id="popup" class="popup" style="display: none;">
        <!-- O conteúdo do popup será carregado aqui via JavaScript -->
    </div>

    <div class="list">
        <ul>
            <li class="vendedor"><a href="cadastro_cliente.php" class="link">CADASTRO CLIENTE</a></li>
            <li class="vendedor"><a href="#" class="link">NOVA VENDA</a></li>
            <li class="vendedor"><a href="vendas/gestao_produtos.php" class="link">PRODUTO</a></li>
            <!--<li class="vendedor"><a href="cadastro_funcionario.php" class="link">CADASTRO FUNCIONARIO</a></li> -->
        </ul>
    </div>

    <script src="../js/scrip_popup_edit_perfil.js"></script>
</body>
</html>
