<?php
session_start();
include('../conector/conector_db.php'); // Conexão com o banco de dados

// Supondo que a matrícula do usuário seja armazenada na sessão
$matricula = $_SESSION['matricula'];

// Consulta para buscar o caminho da foto do usuário
$query = "SELECT foto FROM tb_funcionario WHERE matricula = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $matricula);
$stmt->execute();
$stmt->bind_result($foto);

// Obtém o resultado da consulta
$stmt->fetch();

// Armazena o caminho da foto na sessão
if ($foto) {
    $_SESSION['foto'] = $foto;  // Salva o caminho da foto na sessão
} else {
    $_SESSION['foto'] = 'uploads/profile.png';  // Caminho padrão caso não tenha foto
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Vendedor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .navbar { background-color: #FFA726; }
        #frame-container { height: 80vh; margin-top: 20px; }
        iframe { width: 100%; height: 100%; border: none; }
        .nav-link { color: white; font-size: larger;}
        .nav-link:hover { color: #ffe0b2; }
        .dropdown-toggle { padding: 0; border: none; background: transparent; }
        .dropdown-toggle img { border-radius: 50%; object-fit: cover; }
        .dropdown-menu { min-width: 150px; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand"><img src="../images/LOGO1.PNG" alt="Logo" width="45" height="48" class="d-inline-block align-text-top"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item mx-4"><a class="nav-link" href="#" onclick="loadPage('../pdv/pdv.php')">Venda</a></li>
                <li class="nav-item mx-4"><a class="nav-link" href="#" onclick="loadPage('../frame_cons_estoque.php')">Consulta Peças</a></li>
                <li class="nav-item mx-4"><a class="nav-link" href="#" onclick="loadPage('../cadastro_cliente.php')">Cadastro Cliente</a></li>
            </ul>
        </div>
        <div class="dropdown">
            <button class="btn dropdown-toggle d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <!-- Alteração para mostrar a foto bola.png caso não haja foto na sessão -->
                <img src="../uploads/<?php echo isset($_SESSION['foto']) && !empty($_SESSION['foto']) ? $_SESSION['foto'] : 'images/auto3.png'; ?>" alt="Perfil" width="45" height="45">
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="#" onclick="alterarCadastro()">Alterar Cadastro</a></li>
                <li><a class="dropdown-item" href="#" onclick="sair()">Sair</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid" id="frame-container">
    <iframe id="content-frame" src="../pdv/pdv.php"></iframe>
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
                        <img id="fotoPerfil" src="../uploads/bola.png" alt="Foto de Perfil" class="rounded-circle" width="100" height="100">
                        <div><a href="#" onclick="document.getElementById('novaFoto').click()">Trocar Imagem</a></div>
                        <input type="file" class="form-control" id="novaFoto" name="novaFoto" style="display: none;">
                    </div>
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" required disabled>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" required disabled>
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
    function loadPage(url) {
        document.getElementById('content-frame').src = url;
    }

    function sair() {
        window.location.assign('../index.php');
    }

    function alterarCadastro() {
        const matricula = "<?php echo $_SESSION['matricula']; ?>";
        fetch('../conector/busca_funcionario.php?matricula=' + matricula)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('nome').value = data.funcionario.nome;
                    document.getElementById('email').value = data.funcionario.email;
                    
                    // Verifica se há uma foto de perfil, caso contrário, usa a imagem padrão
                    const fotoPerfil = data.funcionario.foto && data.funcionario.foto.trim() !== '' 
                        ? data.funcionario.foto 
                        : '../uploads/bola.png'; // Usa bola.png se a foto não for encontrada
                    document.getElementById('fotoPerfil').src = fotoPerfil;
                } else {
                    alert('Erro ao buscar dados: ' + data.message);
                }
            })
            .catch(error => {
                alert('Erro ao buscar dados: ' + error);
            });

        const modal = new bootstrap.Modal(document.getElementById('alterarCadastroModal'));
        modal.show();
    }

    document.getElementById('alterarCadastroForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData();
        formData.append('email', document.getElementById('email').value);
        formData.append('novaFoto', document.getElementById('novaFoto').files[0]);

        fetch('../conector/altera_user_cadastro.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Cadastro alterado com sucesso!");
            } else {
                alert("Erro ao atualizar cadastro: " + data.message);
            }
        })
        .catch(error => {
            alert("Erro ao atualizar cadastro: " + error);
        });

        const senha = document.getElementById('senha').value;
        const confirmarSenha = document.getElementById('confirmarSenha').value;

        if (senha && senha === confirmarSenha) {
            const senhaFormData = new FormData();
            senhaFormData.append('senha', senha);

            fetch('../conector/altera_user_password.php', {
                method: 'POST',
                body: senhaFormData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Senha alterada com sucesso!");
                } else {
                    alert("Erro ao alterar senha: " + data.message);
                }
            })
            .catch(error => {
                alert("Erro ao alterar senha: " + error);
            });
        } else if (senha && senha !== confirmarSenha) {
            alert("As senhas não coincidem.");
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
