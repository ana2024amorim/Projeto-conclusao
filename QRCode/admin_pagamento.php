<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração do Pagamento - Pix</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery para facilitar o AJAX -->
<style>
    /* Resetando alguns estilos padrões do navegador */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Estilo geral da página */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    color: #333;
    padding: 20px;
}

/* Título principal */
h2 {
    color: #000;
    font-weight: 600;
    text-align: center;
    margin-bottom: 20px;
}

/* Container do formulário */
.container {
    max-width: 800px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;  /* Reduzido o padding para aproximar os campos */
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

/* Estilo dos campos de input */
.form-label {
    font-weight: bold;
    color: #555;
    margin-bottom: 5px; /* Menos espaço entre o label e o input */
}

.form-control {
    border-radius: 5px;
    border: 1px solid #ccc;
    padding: 8px; /* Reduzido o padding para diminuir a altura do campo */
    margin-bottom: 10px; /* Menos espaçamento entre os campos */
    width: 100%;
    font-size: 14px;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

/* Estilo dos botões */
button {
    font-size: 16px;
    padding: 8px 16px; /* Menos padding para os botões */
    border-radius: 5px;
    border: none;
    cursor: pointer;
}

/* Botão de Editar */
#editButton {
    background-color: #f0ad4e;
    color: #fff;
}

#editButton:hover {
    background-color: #ec971f;
}

/* Botão de Atualizar Dados */
#submitButton {
    background-color: #007bff;
    color: #fff;
    display: none; /* Inicialmente invisível */
}

#submitButton:hover {
    background-color: #0056b3;
}

/* Responsividade */
@media (max-width: 767px) {
    .container {
        padding: 15px; /* Ajustado para telas pequenas */
    }

    h2 {
        font-size: 18px;
    }

    .form-control {
        font-size: 14px;
    }

    button {
        font-size: 14px; /* Ajustado o tamanho da fonte para botões em telas pequenas */
    }
}

</style>

</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Administração do Pagamento - Pix</h2>

    <form id="paymentForm" action="../conector/atualiza_dados_banco.php" method="POST">

        <div class="mb-3">
            <label for="pixKey" class="form-label">Chave Pix</label>
            <input type="text" class="form-control" id="pixKey" name="pixKey" required readonly>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <input type="text" class="form-control" id="description" name="description" required readonly>
        </div>
        <div class="mb-3">
            <label for="merchantName" class="form-label">Nome do Comerciante</label>
            <input type="text" class="form-control" id="merchantName" name="merchantName" required readonly>
        </div>
        <div class="mb-3">
            <label for="merchantCity" class="form-label">Cidade do Comerciante</label>
            <input type="text" class="form-control" id="merchantCity" name="merchantCity" required readonly>
        </div>
      
        <div class="mb-3">
            <label for="txid" class="form-label">TXID</label>
            <input type="text" class="form-control" id="txid" name="txid" required readonly>
        </div>

        <button type="button" id="editButton" class="btn btn-warning">Editar</button>
        <button type="submit" id="submitButton" class="btn btn-primary" style="display: none;">Atualizar Dados</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        // Carrega os dados do banco e preenche o formulário
        $.ajax({
            url: '../conector/dados_banco_pagamento.php', // Caminho do arquivo PHP que retorna os dados em JSON
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.error) {
                    alert(data.error); // Caso ocorra algum erro
                } else {
                    // Preenche os campos com os dados retornados
                    $('#pixKey').val(data.pixKey);
                    $('#description').val(data.description);
                    $('#merchantName').val(data.merchantName);
                    $('#merchantCity').val(data.merchantCity);
                    $('#txid').val(data.txid);
                }
            },
            error: function() {
                alert('Erro ao carregar os dados.');
            }
        });

        // Função para ativar os campos de edição ao clicar no botão "Editar"
        $('#editButton').click(function() {
            $('#pixKey').prop('readonly', false);
            $('#description').prop('readonly', false);
            $('#merchantName').prop('readonly', false);
            $('#merchantCity').prop('readonly', false);
            $('#txid').prop('readonly', false);

            $('#submitButton').show(); // Exibe o botão de "Atualizar Dados"
            $(this).hide(); // Esconde o botão de "Editar"
        });

        // Enviar os dados do formulário via AJAX no formato JSON
        $('#paymentForm').submit(function(e) {
            e.preventDefault(); // Impede o envio tradicional do formulário

            // Cria o objeto JSON com os dados do formulário
            var formData = {
                id: 1, // O id será sempre 1 como padrão
                pixKey: $('#pixKey').val(),
                description: $('#description').val(),
                merchantName: $('#merchantName').val(),
                merchantCity: $('#merchantCity').val(),
                txid: $('#txid').val()
            };

            // Envia os dados via AJAX no formato JSON
            $.ajax({
                url: '../conector/atualiza_dados_banco.php', // Arquivo PHP para processar a atualização
                type: 'POST',
                contentType: 'application/json', // Define que o conteúdo será JSON
                data: JSON.stringify(formData), // Converte o objeto formData em JSON
                success: function(response) {
                    alert('Dados atualizados com sucesso!');
                    location.reload(); // Recarrega a página para exibir os novos dados
                },
                error: function() {
                    alert('Erro ao atualizar os dados.');
                }
            });
        });
    });
</script>

</body>
</html>
