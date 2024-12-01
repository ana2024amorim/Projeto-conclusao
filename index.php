<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css" />
    
    <style>
        /* Estilos para o modal */
/* Estilos do Modal */
.modal {
    display: none;
    position: fixed;
    z-index: 9999; /* Garantindo que o modal fique na frente */
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4); /* Fundo com opacidade para cobrir a tela */
    overflow: auto;
    padding-top: 60px;
}

.modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 40px;
    border: 1px solid #888;
    width: 60%;
    max-width: 800px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    font-size: 18px; /* Aumentando o tamanho da fonte do texto */
    text-align: center; /* Centraliza o conteúdo dentro do modal */
}

/* Estilos para o botão de fechar */
.close {
    color: #aaa;
    float: right;
    font-size: 36px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

/* Estilos para o título do modal */
h2 {
    font-size: 34px; /* Tamanho do título */
    font-weight: bold;
    margin-bottom: 40px; /* Espaçamento abaixo do título */
    color: #e74c3c; /* Cor vermelha para destaque */
}

/* Estilos para a imagem de alerta */
.alert {
    display: flex;
    flex-direction: column; /* Organiza a imagem e a mensagem verticalmente */
    align-items: center; /* Centraliza a imagem e a mensagem */
    margin-top: 20px; /* Espaçamento acima da imagem */
}

.alert-img {
    width: 50px; /* Tamanho da imagem */
    height: 50px;
    margin-bottom: 20px; /* Espaçamento abaixo da imagem */
}
.alert2 {
    display: flex;
    flex-direction: column; /* Organiza a imagem e a mensagem verticalmente */
    align-items: center; /* Centraliza a imagem e a mensagem */
    margin-top: 20px; /* Espaçamento acima da imagem */
}
.alert2-img {
    width: 50px; /* Tamanho da imagem */
    height: 50px;
    margin-bottom: 20px; /* Espaçamento abaixo da imagem */
}

/* Estilos para a mensagem de alerta */
.alert-message {
    font-size: 28px; /* Tamanho da fonte da mensagem */
    font-weight: bold;
    color: #333; /* Cor preta para o texto */
    line-height: 1.5; /* Melhor espaçamento entre as linhas */
}
.alert2-message {
    font-size: 28px; /* Tamanho da fonte da mensagem */
    font-weight: bold;
    color: #333; /* Cor preta para o texto */
    line-height: 1.5; /* Melhor espaçamento entre as linhas */
}


    </style>
</head>

<body>  
    <div class="wave-blue"></div>
    
    <form method="POST" action="conector/acesso.php" onsubmit="return validarFormulario()">
        <div class="titulo">
            <h1>Faça o seu login</h1>
            <div class="barra-horizontal"></div>
        </div>
        <div class="campo-input">
            <label for="matricula">Sua matrícula*</label>
            <input type="number" id="matricula" name="matricula" required />
        </div>
        <div class="campo-input">
            <label for="password">Sua senha*</label>
            <input type="password" id="password" name="password" required />
        </div>  
        
        <button type="submit">Entrar</button>
        <p class="esqueceu-senha">
            Esqueceu sua senha?
            <a href="recuperar_senha.php" target="_blank">Clique aqui!</a>
        </p>
    </form>

    <!-- Modal de bloqueio após 3 tentativas -->
    <div id="popupTentativas" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('popupTentativas')">&times;</span>
            <h2>Aviso</h2>
            
            <!-- Imagem de alerta -->
            <div class="alert">
                <img src="images/alerta.png" alt="Alerta" class="alert-img"> <!-- Imagem de alerta -->
                <p class="alert-message">Usuário será bloqueado após 3 tentativas de login incorretas.</p>
            </div>
        </div>
    </div>


    <!-- Modal de conta bloqueada -->
    <div id="popupBloqueado" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('popupBloqueado')">&times;</span>
            <h2>Conta Bloqueada</h2>

            <!-- Imagem de alerta -->
            <div class="alert2">
                <img src="images/deny.png" alt="Alerta" class="alert2-img"> <!-- Imagem de alerta -->
                <p class="alert2-message">Usuário foi bloqueado após 3 tentativas de login incorretas!</p>
                <p class="alert2-message">Entre em contato com o Gerente.</p>
            </div>
        </div>
    </div>


    <script>
        function validarFormulario() {
            const matricula = document.getElementById('matricula').value;
            const password = document.getElementById('password').value;

            // Você pode adicionar validações aqui, se necessário
            return true; // Permite o envio do formulário
        }

        // Verifica se há mensagens de erro na URL
        const urlParams = new URLSearchParams(window.location.search);
        
        if (urlParams.has('error')) {
            const error = urlParams.get('error');
            
            if (error === 'warning_attempts') {
                openModal('popupTentativas');
            } else if (error === 'account_locked') {
                openModal('popupBloqueado');
            } else {
                alert('Usuário ou senha não encontrados.');
            }
        }

        // Função para abrir o modal
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = "block";
        }

        // Função para fechar o modal
        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = "none";
        }

        // Fecha o modal se o usuário clicar fora dele
        window.onclick = function(event) {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            });
        }
    </script>
</body>
</html>
