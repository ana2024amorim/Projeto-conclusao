<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    /* Custom styles for a larger and more pleasant modal */
    .modal-content {
        border-radius: 15px;
        padding: 30px;
    }

    .modal-header {
        border-bottom: none;
    }

    .modal-title {
        font-size: 1.75rem;
        font-weight: bold;
        color: #4CAF50;
        text-align: center; /* Centraliza o texto */
        width: 100%; /* Garante que o título ocupe toda a largura do modal */
    }

    .form-label {
        font-weight: bold;
    }

    .btn-primary {
        background-color: #4CAF50;
        border-color: #4CAF50;
    }

    .btn-primary:hover {
        background-color: #45a049;
        border-color: #45a049;
    }

    .close-btn {
        background-color: #f44336;
        border: none;
    }

    .close-btn:hover {
        background-color: #e53935;
    }
</style>
<body>
    <!-- Modal -->
    <div class="modal fade" id="recuperarSenhaModal" tabindex="-1" aria-labelledby="recuperarSenhaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="recuperarSenhaLabel">Recuperar Senha</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="select_recuperar_senha.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                        <button type="button" class="btn close-btn" data-bs-dismiss="modal">Fechar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script to open the modal automatically -->
    <script>
        window.onload = function () {
            var recuperarSenhaModal = new bootstrap.Modal(document.getElementById('recuperarSenhaModal'));
            recuperarSenhaModal.show();
        };
    </script>
</body>
</html>
