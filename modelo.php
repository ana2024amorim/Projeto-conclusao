<?php 
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['matricula'])) {
    header('Location: ../index.php?error=not_logged_in');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        /* Estilo do corpo para ajustar altura e overflow */
        body {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Barra Superior */
        header {
            background-color: #FFA726; /* Cor laranja clara */
            color: #fff;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 100;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); /* Sombra da barra */
        }

        header .logo {
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        header .menu-toggle {
            cursor: pointer;
            margin-right: 20px;
        }

        header .profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        header .profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        header .profile span {
            font-size: 16px;
        }

        /* Sidebar */
        aside {
            background-color: #FFA726; /* Cor laranja clara */
            width: 44px; /* Largura inicial da sidebar */
            transition: width 0.3s; /* Animação de expansão */
            position: fixed;
            top: 60px;
            left: 0;
            height: calc(100% - 60px);
            overflow: hidden;
            z-index: 99;
            box-shadow: 2px 0px 5px rgba(0, 0, 0, 0.2);
        }

        aside.expanded {
            width: 200px; /* Largura da sidebar expandida */
        }

        aside ul {
            list-style-type: none;
            padding: 0;
        }

        aside ul li {
            padding: 15px 10px;
            display: flex;
            align-items: center;
            position: relative; /* Para posicionar o submenu */
        }

        aside ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            display: flex;
            align-items: center;
            white-space: nowrap;
            transition: color 0.2s;
        }

        aside ul li a:hover {
            color: #333;
        }

        aside ul li a .icon {
            margin-right: 10px;
            font-size: 24px;
        }

        /* Submenu */
        .submenu {
            display: none; /* Oculta o submenu inicialmente */
            position: absolute;
            left: 45px;
            top: 0;
            background-color: #FFB74D; /* Cor um pouco mais clara */
            padding: 10px;
            border-radius: 4px;
            z-index: 1;
            white-space: nowrap;
        }

        /* Sidebar */
        aside ul li {
            padding: 15px 10px;
            display: flex;
            align-items: center;
            position: relative;
        }

        /* Submenu - Estilo para exibir logo abaixo do item "Cadastro" */
        .submenu {
            display: none; /* Oculto inicialmente */
            background-color: #FFB74D; /* Cor do submenu */
            padding: 10px;
            border-radius: 4px;
            margin-top: 35px; /* Espaço entre o item e o submenu */
            margin-left: 15px; /* Indentação do submenu */
        }

        /* Exibe o submenu ao passar o mouse */
        aside ul li:hover .submenu {
            display: block; /* Mostra o submenu ao passar o mouse */
        }

        /* Estilos dos itens do submenu */
        .submenu a {
            display: block;
            color: #fff;
            font-size: 16px;
            text-decoration: none;
            padding: 5px 20px;
            transition: color 0.2s;
        }

        .submenu a:hover {
            color: #333;
        }


        /* Conteúdo principal */
        .content {
            margin-top: 60px;
            margin-left: 60px;
            width: calc(100% - 60px);
            height: calc(100% - 60px);
            transition: margin-left 0.3s, width 0.3s;
        }

        .content.expanded {
            margin-left: 200px;
            width: calc(100% - 200px);
        }

        /* Iframe */
        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            header .profile span {
                display: none;
            }
            aside.expanded {
                width: 150px;
            }
            .content.expanded {
                margin-left: 150px;
                width: calc(100% - 150px);
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="menu-toggle material-icons" onclick="toggleSidebar()">menu</div>
        <div class="logo">
            <img src="images/LOGO1.png" alt="Logo da Empresa" width="45" height="auto">
            <div>Guardian Control System</div>
        </div>
        <div class="profile">
            <img src="<?php echo isset($_SESSION['foto']) ? $_SESSION['foto'] : 'uploads/profile.png'; ?>" alt="Foto de perfil" onclick="alterarCadastro()">
            <span><?php echo isset($_SESSION['matricula']) ? $_SESSION['matricula'] : 'Usuário'; ?></span>
            <span class="material-icons" onclick="sair()">exit_to_app</span>
        </div>
    </header>

    <!-- Sidebar -->
    <aside id="sidebar">
        <ul>
            <li>
                <a href="#"><span class="icon material-icons">person_add</span>Cadastro</a>
                <ul class="submenu">
                    <li><a href="cadastro_funcionario.php" target="content-frame">Funcionario</a></li>
                    <li><a href="cadastro_cliente.php" target="content-frame">Cliente</a></li>
                </ul>
            </li>
            <li><a href="frame_admin.php" target="content-frame"><span class="icon material-icons">account_balance</span>Financeiro</a></li>
            <li><a href="frame_cons_usuario.php" target="content-frame"><span class="icon material-icons">people</span>Usuários</a></li>
            <li><a href="frame_cons_estoque.php" target="content-frame"><span class="icon material-icons">inventory</span>Estoque</a></li>
            <li>
                <a href="#"><span class="icon material-icons">build</span>Configurações</a>
                <ul class="submenu">
                    <li><a href="QRCode/admin_pagamento.php" target="content-frame">Pagamento</a></li>
                    <li><a href="email/admin_email.php" target="content-frame">Email</a></li>
                </ul>
            </li>
        </ul>
    </aside>

    <!-- Conteúdo Principal 
    <div class="content" id="main-content">
        <iframe src="inicio.html" name="content-frame"></iframe>
    </div> -->

    <div class="content" id="main-content">
        <iframe src="images/manutencao.png" name="content-frame" frameborder="0"></iframe>
    </div>


    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('expanded');
            document.getElementById('main-content').classList.toggle('expanded');
        }

        function sair() {
            window.location.assign('index.php');
        }

        function alterarCadastro() {
            const matricula = "<?php echo $_SESSION['matricula']; ?>";
            fetch('../conector/busca_funcionario.php?matricula=' + matricula)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('nome').value = data.funcionario.nome;
                        document.getElementById('email').value = data.funcionario.email;
                        document.getElementById('fotoPerfil').src = data.funcionario.foto || '../uploads/profile.png';
                    } else {
                        alert('Erro ao buscar dados: ' + data.message);
                    }
                })
                .catch(error => alert('Erro ao buscar dados: ' + error));

            new bootstrap.Modal(document.getElementById('alterarCadastroModal')).show();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
