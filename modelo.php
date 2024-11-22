<?php
session_start();
include('conector/conector_db.php'); // Conexão com o banco de dados

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/modelo.css">

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

    <!-- Modal de cadastro do funcionário -->
<div class="modal fade" id="alterarCadastroModal" tabindex="-1" aria-labelledby="alterarCadastroModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alterarCadastroModalLabel">Alterar Cadastro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form id="alterarCadastroForm" enctype="multipart/form-data" method="POST" >
                    <div class="form-group text-center">
                        <img id="fotoPerfil" src="uploads/profile.png" alt="Foto de Perfil" class="img-fluid rounded-circle" width="100" height="100">
                        <div class="mt-2">
                            <span id="trocarImagem" class="trocar-imagem" onclick="document.getElementById('inputImagem').click()">&#43;</span>
                        </div>
                        <input type="file" id="inputImagem" style="display: none;" accept="image/*" onchange="previewImagem(event)">
                        
                    </div>

                    <div class="mt-4">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" disabled>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="mb-3">
                            <label for="novaSenha" class="form-label">Nova Senha</label>
                            <input type="password" class="form-control" id="novaSenha" name="novaSenha" placeholder="Digite a nova senha">
                        </div>
                        <div class="mb-3">
                            <label for="confirmaSenha" class="form-label">Confirmar Nova Senha</label>
                            <input type="password" class="form-control" id="confirmaSenha" name="confirmaSenha" placeholder="Confirme a nova senha">
                        </div>
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" onclick="salvarAlteracoes()">Salvar Alterações</button>
            </div>
        </div>
    </div>
</div>


    <!-- Sidebar -->
    <aside id="sidebar">
        <ul>
            <li>
                <a href="#"><span class="icon material-icons">person_add</span>Cadastro</a>
                <ul class="submenu">
                    <li><a href="cadastro_funcionario.php" target="content-frame">Funcionario</a></li>
                    <li><a href="cadastro_cliente.php" target="content-frame">Cliente</a></li>
                    <li><a href="consulta_delete_cliente.php" target="content-frame">Adm Cliente</a></li>
                </ul>
            </li>
            <li><a href="frame_admin.php" target="content-frame"><span class="icon material-icons">account_balance</span>Financeiro</a></li>
            <li><a href="frame_cons_usuario.php" target="content-frame"><span class="icon material-icons">people</span>Usuários</a></li>
            <li><a href="frame_cons_estoque.php" target="content-frame"><span class="icon material-icons">inventory</span>Estoque</a></li>
            <li><a href="mensagem/editor_mensagem.php" target="content-frame"><span class="icon material-icons">chat</span>Mensagem</a></li>
            <li>
                <a href="#"><span class="icon material-icons">build</span>Configurações</a>
                <ul class="submenu">
                    <li><a href="QRCode/admin_pagamento.php" target="content-frame">Pagamento</a></li>
                    <li><a href="email/admin_email.php" target="content-frame">Email</a></li>
                </ul>
            </li>
        </ul>
    </aside>

    <!-- Conteúdo Principal -->
    <div class="content" id="main-content">
        <iframe src="mensagem/visualizar_mensagem.php" name="content-frame" frameborder="0"></iframe>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('expanded');
            document.getElementById('main-content').classList.toggle('expanded');
        }

        function sair() {
            window.location.assign('index.php');
        }

        // Função de buscar dados do perfil
        function alterarCadastro() {
            const matricula = "<?php echo $_SESSION['matricula']; ?>";
            fetch('conector/busca_funcionario.php?matricula=' + matricula)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('nome').value = data.funcionario.nome;
                        document.getElementById('email').value = data.funcionario.email;
                        document.getElementById('fotoPerfil').src = data.funcionario.foto || 'uploads/profile.png';
                    } else {
                        alert('Erro ao buscar dados: ' + data.message);
                    }
                })
                .catch(error => alert('Erro ao buscar dados: ' + error));

            new bootstrap.Modal(document.getElementById('alterarCadastroModal')).show();
        }

        function salvarAlteracoes() {
    var form = document.getElementById('alterarCadastroForm');
    var formData = new FormData(form); // Cria um FormData para enviar os dados do formulário

    // Adiciona o ID do usuário à requisição
    var usuarioId = "<?php echo $_SESSION['matricula']; ?>"; // Obtém a matrícula do usuário da sessão
    
    if (!usuarioId) {
        alert('Usuário não autenticado.');
        return;
    }

    formData.append('matricula', usuarioId); // Adiciona a matrícula ao FormData

    // Envia o formulário via AJAX para o arquivo PHP
    fetch('conector/update_pass_foto.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json()) // Converte a resposta para JSON
    .then(data => {
        if (data.sucesso) {
            alert(data.mensagem); // Exibe mensagem de sucesso
            window.location.reload(); // Recarrega a página para mostrar as alterações
        } else {
            alert(data.mensagem); // Exibe mensagem de erro
        }
    })
    .catch(error => {
        alert('Erro ao salvar as alterações. Tente novamente.'); // Exibe erro se algo falhar
    });
}

// Função que mostra a pré-visualização da imagem
function previewImagem(event) {
    var imagem = event.target.files[0];  // Acessa o arquivo da imagem
    var reader = new FileReader();  // Cria um objeto FileReader para ler a imagem

    // Quando a imagem for carregada, atualiza o elemento de imagem no HTML
    reader.onload = function() {
        var preview = document.getElementById('fotoPerfil');
        preview.src = reader.result;  // Atribui o resultado da leitura (imagem) ao src
    };

    // Lê o arquivo como uma URL de dados (base64)
    reader.readAsDataURL(imagem);
}

    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
