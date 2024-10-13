<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 50px;
            max-width: 500px;
        }

        .btn-primary {
            background-color: #4CAF50;
            border-color: #4CAF50;
        }

        .btn-primary:hover {
            background-color: #45a049;
            border-color: #45a049;
        }

        .alert {
            display: none; /* Oculta a mensagem de alerta por padrão */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Recuperar Senha</h2>
        <form id="resetForm">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email" required>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        
        <div id="alert-message" class="alert alert-success mt-3" role="alert"></div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('resetForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Impede o envio do formulário

            const email = event.target.email.value;

            fetch('email/select_recuperar_senha.php', { // Ajuste o caminho do seu script
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({ email })
            })
            .then(response => response.json())
            .then(data => {
                const alertMessage = document.getElementById('alert-message');
                alertMessage.textContent = data.message;
                alertMessage.classList.remove('alert-success', 'alert-danger');

                if (data.success) {
                    alertMessage.classList.add('alert-success');
                } else {
                    alertMessage.classList.add('alert-danger');
                }

                alertMessage.style.display = 'block'; // Exibe a mensagem de alerta
            })
            .catch(error => {
                console.error('Erro:', error);
                const alertMessage = document.getElementById('alert-message');
                alertMessage.textContent = 'Ocorreu um erro ao processar a solicitação.';
                alertMessage.classList.remove('alert-success');
                alertMessage.classList.add('alert-danger');
                alertMessage.style.display = 'block'; // Exibe a mensagem de alerta
            });
        });
    </script>
</body>
</html>
s