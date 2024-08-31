document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('user-form');
    const resultModal = new bootstrap.Modal(document.getElementById('resultModal'));
    const resultMessage = document.getElementById('resultMessage');
    const photoPreview = document.getElementById('photo-preview');
    const phoneInput = document.getElementById('telefone');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(form);

        fetch('conector/insert_funcionario.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Verificar se a resposta indica sucesso (ajuste de acordo com a sua API)
            const isSuccessful = data.success === true || data.status === 'success'; // Adapte essa condição

            const resultIcon = document.querySelector('.icon-success, .icon-error');
            const messageText = resultMessage.querySelector('.message p');

            resultIcon.className = isSuccessful ? 'fas fa-check-circle icon-success' : 'fas fa-times-circle icon-error';
            messageText.textContent = data.message || 'Ocorreu um erro inesperado.'; // Mensagem padrão em caso de erro

            resultModal.show();
        })
        .catch(error => {
            console.error('Erro:', error);
            const resultIcon = document.querySelector('.icon-success, .icon-error');
            const messageText = resultMessage.querySelector('.message p');

            resultIcon.className = 'fas fa-times-circle icon-error';
            messageText.textContent = 'Ocorreu um erro ao processar a solicitação. Por favor, tente novamente mais tarde.';
            resultModal.show();
        });
    });

    // Atualizar a visualização da foto de perfil, se necessário
    if (photoPreview) {
        document.getElementById('foto').addEventListener('change', () => {
            const file = document.getElementById('foto').files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    photoPreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Limpar o formulário ao fechar o modal
    const modalElement = document.getElementById('resultModal');
    modalElement.addEventListener('hidden.bs.modal', () => {
        form.reset(); // Limpa todos os campos do formulário

        // Se você tiver uma pré-visualização de foto, também limpe
        if (photoPreview) {
            photoPreview.src = ''; // Limpa a imagem de pré-visualização
        }
    });

    // Função para aplicar a máscara de telefone
    function maskTelefone(value) {
        // Remove todos os caracteres não numéricos
        value = value.replace(/\D/g, '');
        
        // Limita o número de dígitos a 11 (para caber no formato (XX) 99999-9999)
        value = value.substring(0, 11);

        // Adiciona a máscara
        if (value.length <= 11) {
            return value.replace(/^(\d{2})(\d{0,5})(\d{0,4})$/, '($1) $2-$3');
        }
        return value;
    }

    // Aplica a máscara enquanto o usuário digita
    phoneInput.addEventListener('input', (event) => {
        event.target.value = maskTelefone(event.target.value);
    });
});
