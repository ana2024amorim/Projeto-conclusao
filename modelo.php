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
        body {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }
        /* Barra Superior */
        header {
            background-color: #FFA726; /* Laranja clara */
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
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
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
            background-color: #FFA726; /* Laranja clara */
            width: 44px;
            transition: width 0.3s;
            position: fixed;
            top: 60px;
            left: 0;
            height: calc(100% - 60px);
            overflow: hidden;
            z-index: 99;
            box-shadow: 2px 0px 5px rgba(0, 0, 0, 0.2);
        }
        aside.expanded {
            width: 150px;
        }
        aside ul {
            list-style-type: none;
            padding: 0;
        }
        aside ul li {
            padding: 20px 10px;
            display: flex;
            align-items: center;
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
            <!-- Insere a imagem do logo diretamente no local da logo -->
            <div class="logo">
                <img src="images/LOGO1.png" alt="Logo da Empresa" width="45" height="auto">
                <div class="logo">Guardian Control System</div>
              
            </div>
          <!--  <div class="profile">
                <img src="uploads/profile.png" alt="Foto de perfil" onclick="alterarCadastro()">
                <span><?php echo $_SESSION['matricula']; ?></span>
                <span class="material-icons" onclick="sair()">exit_to_app</span>
            </div> -->
            <div class="profile">
                <img src="<?php echo isset($_SESSION['foto']) ? $_SESSION['foto'] : 'uploads/profile.png'; ?>" 
                    alt="Foto de perfil" 
                    onclick="alterarCadastro()">                           
                <span><?php echo isset($_SESSION['matricula']) ? $_SESSION['matricula'] : 'Usuário'; ?></span>
                <span class="material-icons" onclick="sair()">exit_to_app</span>
            </div>


        </header>


     <!-- Sidebar -->
    <aside id="sidebar">
        <ul>
            <li><a href="https://app.powerbi.com/reportEmbed?reportId=5d9bfe45-5a31-4d91-a030-965a04048684&autoAuth=true&ctid=04d26bbd-19cc-49c0-80cb-1a005bce5689" target="content-frame"><span class="icon material-icons">person_add</span>Cadastro</a></li>
            <li><a href="financeiro.html" target="content-frame"><span class="icon material-icons">account_balance</span>Financeiro</a></li>
            <li><a href="usuarios.html" target="content-frame"><span class="icon material-icons">people</span>Usuários</a></li>
            <li><a href="estoque.html" target="content-frame"><span class="icon material-icons">inventory</span>Estoque</a></li>
            <li><a href="pecas.html" target="content-frame"><span class="icon material-icons">build</span>Peças</a></li>
        </ul>
    </aside>

    <!-- Conteúdo Principal -->
    <div class="content" id="main-content">
        <iframe src="inicio.html" name="content-frame"></iframe>
        
    </div>

    <!-- Modal de Alteração de Cadastro -->
    <div class="modal fade" id="alterarCadastroModal" tabindex="-1" aria-labelledby="alterarCadastroModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alterarCadastroModalLabel">Alterar Cadastro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="alterarCadastroForm" enctype="multipart/form-data">
                        <div class="mb-3 text-center">
                            <img id="fotoPerfil" src="uploads/profile.png" class="rounded-circle" width="100" height="100">
                            <div><a href="#" onclick="document.getElementById('novaFoto').click()">Trocar Imagem</a></div>
                            <input type="file" id="novaFoto" name="novaFoto" style="display: none;">
                        </div>
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="senha" class="form-label">Nova Senha</label>
                            <input type="password" class="form-control" id="senha">
                        </div>
                        <div class="mb-3">
                            <label for="confirmarSenha" class="form-label">Confirmar Senha</label>
                            <input type="password" class="form-control" id="confirmarSenha">
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
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

        document.getElementById('alterarCadastroForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            formData.append('matricula', "<?php echo $_SESSION['matricula']; ?>");

            fetch('../conector/altera_user_cadastro.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                alert(data.success ? "Cadastro alterado com sucesso!" : "Erro ao atualizar cadastro: " + data.message);
            })
            .catch(error => alert("Erro ao atualizar cadastro: " + error));

            if (document.getElementById('senha').value === document.getElementById('confirmarSenha').value) {
                const senhaFormData = new FormData();
                senhaFormData.append('senha', document.getElementById('senha').value);

                fetch('../conector/altera_user_password.php', {
                    method: 'POST',
                    body: senhaFormData
                })
                .then(response => response.json())
                .then(data => alert(data.success ? "Senha alterada com sucesso!" : "Erro ao alterar senha: " + data.message))
                .catch(error => alert("Erro ao alterar senha: " + error));
            } else {
                alert("As senhas não coincidem.");
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
