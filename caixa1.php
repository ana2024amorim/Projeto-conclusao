<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDV - Cadastro de Clientes</title>
    <style>
        /* Estilo da barra superior */
        .top-bar {
            background-color: #FF8C00; /* Cor laranja clara */
            color: white;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        .top-bar h1 {
            margin: 0;
            font-size: 24px;
        }

        .top-bar button {
            background-color: #333;
            color: white;
            border: none;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
        }

        /* Estilo do formulário */
        .form-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
        }

        .form-container form {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .form-group {
            flex: 1 1 45%; /* Controla a largura das colunas */
        }

        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Estilo do botão de envio */
        .submit-button {
            background-color: #FF8C00;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            margin-top: 15px;
        }

        .submit-button:hover {
            background-color: #e07b00;
        }

        .add-button {
            background-color: #007BFF; /* Cor do botão de adicionar */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        .add-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <!-- Barra Superior -->
    <div class="top-bar">
        <h1>PDV - Sistema</h1>
        <button onclick="alert('Pausa para Almoço iniciada')">Pausa para Almoço</button>
    </div>

    <!-- Formulário de Dados do Cliente -->
    <div class="form-container">
        <form id="clientForm" action="#" method="POST">
            <div id="formFields">
                <!-- Campos de Cliente Dinâmicos -->
                <div class="form-group">
                    <label for="cliente1">Nome do Cliente</label>
                    <input type="text" id="cliente1" name="cliente1[]" placeholder="Nome do Cliente" required>
                </div>
                <div class="form-group">
                    <label for="valor1">Valor</label>
                    <input type="number" id="valor1" name="valor1[]" placeholder="Valor" required>
                </div>
            </div>
            <button type="button" class="add-button" onclick="addFields()">Adicionar Novo Cliente</button>
            <button type="submit" class="submit-button">Enviar</button>
        </form>
    </div>

    <script>
        let clientCount = 1;

        function addFields() {
            clientCount++;
            const formFields = document.getElementById('formFields');

            // Criar novos campos
            const newFields = document.createElement('div');
            newFields.innerHTML = `
                <div class="form-group">
                    <label for="cliente${clientCount}">Nome do Cliente</label>
                    <input type="text" id="cliente${clientCount}" name="cliente1[]" placeholder="Nome do Cliente" required>
                </div>
                <div class="form-group">
                    <label for="valor${clientCount}">Valor</label>
                    <input type="number" id="valor${clientCount}" name="valor1[]" placeholder="Valor" required>
                </div>
            `;
            formFields.appendChild(newFields);
        }
    </script>

</body>
</html>
