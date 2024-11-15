<?php
// Inclui o arquivo do conector para carregar as configurações
include_once "../conector/cons_email.php";

// Verificar se a operação de edição foi realizada com sucesso
if (isset($message)): ?>
    <script>
        window.onload = function() {
            var myModal = new bootstrap.Modal(document.getElementById('modalSucesso'), {
                keyboard: false
            });
            myModal.show();
        }
    </script>
    <?php unset($message); // Limpar a mensagem de sucesso após exibição ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações de E-mail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  
    <style>
 /* Adicionando borda ao redor do formulário */
.container {
    max-width: 900px;
    padding: 20px;
    border: 2px solid #ccc; /* Borda cinza */
    border-radius: 10px; /* Cantos arredondados */
    background-color: #f8f9fa; /* Cor de fundo suave */
    margin-top: 30px; /* Espaçamento superior */
}

/* Centralizando o título */
h2 {
    text-align: center; /* Centralizar o título */
    color: #000; /* Título em preto */
    margin-bottom: 20px; /* Espaçamento inferior */
}

/* Utilizando o grid do Bootstrap para duas colunas */
.form-row {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
}

.form-row .col {
    flex: 1 1 45%;
}

.mb-3 {
    margin-bottom: 15px !important;
}

#btnSalvar {
    margin-top: 10px;
}

.form-control, .form-select {
    margin-bottom: 5px;
}

input.form-control, select.form-select {
    height: calc(1.5em + .75rem + 2px);
}

.modal-body {
    padding: 20px;
}

.modal-header, .modal-footer {
    padding: 10px 15px;
}

    </style> 
</head>
<body>
    <div class="container mt-5">
        <h2>Configurações de E-mail</h2>

        <!-- Formulário de consulta com dados desabilitados -->
        <form action="admin_email.php" method="POST">
            <div class="form-row">
                <div class="col">
                    <div class="mb-3">
                        <label for="host" class="form-label">Host</label>
                        <input type="text" class="form-control" id="host" name="host" value="<?php echo htmlspecialchars($host); ?>" disabled>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="email" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" disabled>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($password); ?>" disabled>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="smtp_secure" class="form-label">SMTP Secure</label>
                        <select class="form-select" id="smtp_secure" name="smtp_secure" disabled>
                            <option value="TLS" <?php echo ($smtp_secure == 'TLS') ? 'selected' : ''; ?>>TLS</option>
                            <option value="SSL" <?php echo ($smtp_secure == 'SSL') ? 'selected' : ''; ?>>SSL</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="mb-3">
                        <label for="port" class="form-label">Port</label>
                        <input type="number" class="form-control" id="port" name="port" value="<?php echo htmlspecialchars($port); ?>" disabled>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="from_email" class="form-label">From Email</label>
                        <input type="email" class="form-control" id="from_email" name="from_email" value="<?php echo htmlspecialchars($from_email); ?>" disabled>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="mb-3">
                        <label for="from_name" class="form-label">From Name</label>
                        <input type="text" class="form-control" id="from_name" name="from_name" value="<?php echo htmlspecialchars($from_name); ?>" disabled>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="smtp_debug" class="form-label">SMTP Debug</label>
                        <select class="form-select" id="smtp_debug" name="smtp_debug" disabled>
                            <option value="0" <?php echo ($smtp_debug == '0') ? 'selected' : ''; ?>>Sem Debug</option>
                            <option value="1" <?php echo ($smtp_debug == '1') ? 'selected' : ''; ?>>Debug Básico</option>
                            <option value="2" <?php echo ($smtp_debug == '2') ? 'selected' : ''; ?>>Debug Detalhado</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Botões de ação -->
            <button type="button" class="btn btn-secondary" id="btnEditar" onclick="habilitarEdicao()">Editar</button>
            <button type="submit" class="btn btn-primary" id="btnSalvar" style="display:none;">Salvar Alterações</button>
        </form>
    </div>

    <!-- Modal de Sucesso -->
    <?php if (isset($message)): ?>
    <div class="modal fade" id="modalSucesso" tabindex="-1" aria-labelledby="modalSucessoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSucessoLabel">Sucesso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo $message; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <?php unset($message); ?>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Função para habilitar os campos de edição
        function habilitarEdicao() {
            document.getElementById('host').disabled = false;
            document.getElementById('username').disabled = false;
            document.getElementById('password').disabled = false;
            document.getElementById('smtp_secure').disabled = false;
            document.getElementById('port').disabled = false;
            document.getElementById('from_email').disabled = false;
            document.getElementById('from_name').disabled = false;
            document.getElementById('smtp_debug').disabled = false;
            document.getElementById('btnSalvar').style.display = 'block'; // Mostrar botão salvar
            document.getElementById('btnEditar').style.display = 'none'; // Esconder botão editar
        }
    </script>
</body>
</html>
