// js/cadastro_funcionario.js

document.addEventListener('DOMContentLoaded', () => {
    const photoInput = document.getElementById('photo');
    const photoPreview = document.getElementById('photo-preview');

    // Atualiza a visualização da foto de perfil quando o usuário seleciona um arquivo
    photoInput.addEventListener('change', () => {
        const file = photoInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                photoPreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Carregar a foto de perfil existente (se disponível)
    const existingPhotoUrl = photoPreview.getAttribute('data-photo-url');
    if (existingPhotoUrl) {
        photoPreview.src = existingPhotoUrl;
    }
});

