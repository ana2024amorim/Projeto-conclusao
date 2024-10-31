<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página com Iframe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Cor de fundo clara */
        }
        .navbar {
            background-color: #007bff; /* Cor da barra de navegação */
        }
        #frame-container {
            height: 80vh; /* Altura do iframe */
            margin-top: 20px; /* Espaçamento acima do iframe */
        }
        iframe {
            width: 100%; /* Largura do iframe */
            height: 100%; /* Altura do iframe */
            border: none; /* Sem borda no iframe */
        }
    </style>
</head>
<body>

    <!-- Barra de Navegação -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">Meu Site</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#" onclick="loadPage('http://localhost/projeto-conclusao/PDV/teste.php')">Página Externa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#" onclick="loadPage('https://www.outroexemplo.com')">Outra Página</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Container do Iframe -->
    <div class="container-fluid" id="frame-container">
        <iframe id="content-frame" src="" title="Conteúdo"></iframe>
    </div>

    <script>
        function loadPage(url) {
            const iframe = document.getElementById('content-frame');
            iframe.src = url; // Define a URL do iframe
        }

        // Carregar uma página padrão ao abrir
        window.onload = function() {
            loadPage('https://www.example.com'); // Substitua pela URL padrão que deseja carregar
        };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
