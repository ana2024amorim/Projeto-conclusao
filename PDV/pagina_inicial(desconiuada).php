<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Recursiva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    
    body {
              
        background-color: #f8d7a1; /* Laranja claro */
    }

    #main-content {
        text-align: center; /* Centraliza o texto dentro do div */
        background-color: white; /* Cor de fundo para destaque */
        padding: 20px; /* Espaçamento interno */
        border-radius: 8px; /* Bordas arredondadas */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
    }

    .navbar {
        background-color: #ffa366; /* Tom mais claro de laranja */
    }

    .navbar-nav {
        display: flex; /* Usa flexbox para os itens da navbar */
        width: 100%; /* Garante que a navbar ocupe toda a largura disponível */
    }

    .navbar-nav .nav-link {
        color: white; /* Cor do texto */
        padding: 10px; /* Espaçamento uniforme */
        width: 120px; /* Define uma largura fixa para cada item */
        text-align: center; /* Centraliza o texto dos links */
        border-radius: 5px; /* Bordas arredondadas */
        transition: background-color 0.3s ease, border-radius 0.3s ease; /* Transição suave */
    }

    .navbar-nav .nav-link:hover {
        background-color: #ff7849; /* Tom mais escuro ao passar o mouse */
        border-radius: 15px; /* Bordas mais arredondadas ao passar o mouse */
    }

    /* Ajusta o dropdown do usuário */
    .user-dropdown .dropdown-menu {
        right: 0;
        left: auto;
    }

    .user-icon {
        border-radius: 50%;
        width: 40px;
        height: 40px;
        object-fit: cover;
    }

    .navbar-brand img {
        height: 50px; /* Tamanho do logo */
    }
</style>

</head>
<body>

    <!-- Barra de Navegação -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <!-- Logo da empresa -->
            <a class="navbar-brand" href="#">
                <img src="logo.png" alt="Logo da Empresa"> <!-- Substitua por seu logo -->
            </a>

            <!--<a class="navbar-brand text-white" href="#">Sistema</a> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCadastro" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Consulta
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownCadastro">
                            <li><a class="dropdown-item" href="#" onclick="loadContent('pecas')">Peças</a></li>
                            <li><a class="dropdown-item" href="#" onclick="loadContent('cliente')">Cliente</a></li>
                        </ul>
                    </li>
              <!-- <li class="nav-item">
                        <a class="nav-link" href="#" onclick="loadContent('suprimento')">Suprimento</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="loadContent('venda')">Venda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="loadContent('servico')">Serviço</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="loadContent('contabilidade')">Contabilidade</a>
                    </li>
                </ul>
                <!-- Ícone de usuário com dropdown -->
                <div class="dropdown user-dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="user-icon.png" alt="Usuário" class="user-icon"> <!-- Substitua por uma imagem de usuário -->
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#">Alterar senha</a></li>
                        <li><a class="dropdown-item" href="#">Meus dados</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Sair</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <div class="container-fluid">
        <div id="main-content">
            <h2>Bem-vindo!</h2>
            <p>Selecione uma opção no menu acima para continuar.</p>
        </div>
    </div>

    <script>
        function loadContent(page) {
    let contentDiv = document.getElementById('main-content');

    // Define o caminho do arquivo a ser carregado
    let pageUrl = '';
    switch(page) {
        case 'pecas':
            pageUrl = 'consulta_peca_pdv.php'; // Suponha que você tenha páginas para peças
            break;
        case 'cliente':
            pageUrl = 'consulta_cliente_pdv.php'; // Suponha que você tenha páginas para usuários
            break;
        case 'suprimento':
            contentDiv.innerHTML = '<h2>Suprimento</h2><p>Gerencie o suprimento do estoque.</p>';
            return; // Exemplo de conteúdo estático
        case 'venda':
            pageUrl = 'http://localhost/projeto-conclusao/PDV/teste.php'; // Chama a página PDV (venda)
            break;
        case 'servico':
            contentDiv.innerHTML = '<h2>Serviço</h2><p>Gerencie os serviços prestados.</p>';
            return;
        case 'contabilidade':
            contentDiv.innerHTML = '<h2>Contabilidade</h2><p>Acompanhe e gerencie as contas.</p>';
            return;
        default:
            contentDiv.innerHTML = '<h2>Bem-vindo!</h2><p>Selecione uma opção no menu acima para continuar.</p>';
            return;
    }

    // Se houver uma URL, faz a requisição AJAX
    if (pageUrl) {
        fetch(pageUrl)
            .then(response => response.text())
            .then(data => {
                contentDiv.innerHTML = data;
            })
            .catch(error => {
                contentDiv.innerHTML = '<p>Erro ao carregar a página.</p>';
                console.error('Erro ao carregar a página:', error);
            });
    }
}

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
