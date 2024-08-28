// script.js

document.addEventListener('DOMContentLoaded', (event) => {
    // Obtém o popup e os botões de controle
    var popup = document.getElementById('popup');
    var openPopupBtn = document.getElementById('open-popup-btn');
    var closeBtn = document.querySelector('.close-btn');

    // Abre o popup quando o botão é clicado
    openPopupBtn.onclick = function() {
        popup.style.display = 'block';
    }

    // Fecha o popup quando o botão de fechar é clicado
    closeBtn.onclick = function() {
        popup.style.display = 'none';
    }

    // Fecha o popup quando o usuário clica fora do popup
    window.onclick = function(event) {
        if (event.target === popup) {
            popup.style.display = 'none';
        }
    }
});
