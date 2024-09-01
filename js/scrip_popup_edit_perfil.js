document.addEventListener('DOMContentLoaded', (event) => {
    // Obtém o popup e os botões de controle
    var popup = document.getElementById('popup');
    var openPopupBtn = document.getElementById('open-popup-btn');
    var closeBtn;

    // Função para carregar o conteúdo do popup
    function loadPopupContent() {
        fetch('popup_edit_perfil.php')
            .then(response => response.text())
            .then(html => {
                popup.innerHTML = html;
                closeBtn = document.querySelector('.close-btn');

                // Configura os eventos após o conteúdo ter sido carregado
                if (closeBtn) {
                    closeBtn.onclick = function() {
                        popup.style.display = 'none';
                    };
                }
                window.onclick = function(event) {
                    if (event.target === popup) {
                        popup.style.display = 'none';
                    }
                };
            })
            .catch(error => console.error('Erro ao carregar o conteúdo do popup:', error));
    }

    // Abre o popup quando o botão é clicado
    openPopupBtn.onclick = function() {
        loadPopupContent(); // Carrega o conteúdo e exibe o popup
        popup.style.display = 'block';
    };
});
