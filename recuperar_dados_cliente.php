<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salvar Cliente no Banco</title>

    <style>
        /* Estilização geral */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 28px; /* Ajustando o tamanho do título */
        }

        /* Formulário */
        form {
            background-color: #fff;
            padding: 30px 40px; /* Aumentando o espaço interno */
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1100px; /* Aumentando a largura máxima do formulário */
            box-sizing: border-box;
        }

        /* Estrutura de 3 colunas */
        .form-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 15px;
        }

        .form-group {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Campos de entrada */
        form label {
            font-weight: bold;
            margin-bottom: 8px;
            color: #555;
        }

        form input[type="text"],
        form input[type="tel"],
        form input[type="email"],
        form input[type="number"],
        form select {
            width: 100%;
            padding: 12px 14px; /* Aumentando o preenchimento dos campos */
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px; /* Fonte maior para os campos */
            transition: border-color 0.3s;
        }

        form input[type="text"]:focus,
        form input[type="tel"]:focus,
        form input[type="email"]:focus,
        form select:focus {
            border-color: #007bff;
            outline: none;
        }

        /* Botões */
        form .form-actions {
            text-align: right;
            margin-top: 20px;
        }

        form button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 12px 20px; /* Botão maior */
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        form button:hover {
            background-color: #0056b3;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .form-row {
                flex-wrap: wrap;
            }

            .form-group {
                flex: 1 1 100%; /* Cada campo ocupa toda a largura */
            }

            form {
                padding: 20px;
            }

            h1 {
                font-size: 22px; /* Ajustando o título em telas menores */
            }
        }
    </style>
</head>
<body>
    <h1>Cadastro de Cliente</h1>

    <form id="insert-form">
        <!-- Primeira linha -->
        <div class="form-row">
            <div class="form-group">
                <label for="cpf_cnpj">CPF/CNPJ:</label>
                <input type="text" id="cpf_cnpj" name="cpf_cnpj" required>
            </div>
            <div class="form-group">
                <label for="razao_nome">Razão Social/Nome:</label>
                <input type="text" id="razao_nome" name="razao_nome" required>
            </div>
            <div class="form-group">
                <label for="cep">CEP:</label>
                <input type="text" id="cep" name="cep" required>
            </div>
        </div>

        <!-- Segunda linha -->
        <div class="form-row">
            <div class="form-group">
                <label for="cidade">Cidade:</label>
                <input type="text" id="cidade" name="cidade" required>
            </div>
            <div class="form-group">
                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco" required>
            </div>
            <div class="form-group">
                <label for="complemento">Complemento:</label>
                <input type="text" id="complemento" name="complemento">
            </div>
        </div>

        <!-- Terceira linha -->
        <div class="form-row">
            <div class="form-group">
                <label for="bairro">Bairro:</label>
                <input type="text" id="bairro" name="bairro" required>
            </div>
            <div class="form-group">
                <label for="uf">UF:</label>
                <input type="text" id="uf" name="uf" required>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="telefone" required>
            </div>
        </div>

        <!-- Quarta linha -->
        <div class="form-row">
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="rginscricao">RG/Inscrição:</label>
                <input type="text" id="rginscricao" name="rginscricao" required>
            </div>
            <div class="form-group">
                <label for="sitcad">Situação:</label>
                <select id="sitcad" name="sitcad" required>
                    <option value="Ativo">Ativo</option>
                    <option value="Desativado">Desativado</option>
                </select>
            </div>
        </div>

        <!-- Botões -->
        <div class="form-actions">
            <button type="submit">Enviar</button>
        </div>
    </form>

    <script>
        // Recuperando os dados do LocalStorage
        const clientData = JSON.parse(localStorage.getItem('clientData'));

        if (clientData) {
            // Preenchendo os campos automaticamente
            document.getElementById('cpf_cnpj').value = clientData.cpf_cnpj || '';
            document.getElementById('razao_nome').value = clientData.razao_nome || '';
            document.getElementById('cep').value = clientData.cep || '';
            document.getElementById('cidade').value = clientData.cidade || '';
            document.getElementById('endereco').value = clientData.endereco || '';
            document.getElementById('complemento').value = clientData.complemento || '';
            document.getElementById('bairro').value = clientData.bairro || '';
            document.getElementById('uf').value = clientData.uf || '';
            document.getElementById('telefone').value = clientData.telefone || '';
            document.getElementById('email').value = clientData.email || '';
            document.getElementById('rginscricao').value = clientData.rginscricao || '';
            document.getElementById('sitcad').value = clientData.sitcad || '';
        }

        // Enviando os dados para o servidor
        document.getElementById('insert-form').addEventListener('submit', function (e) {
            e.preventDefault(); // Evita recarregar a página

            const formData = new FormData(e.target);

            fetch('salvar_cliente.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert('Cliente salvo com sucesso!');
                console.log(data);
            })
            .catch(error => {
                alert('Erro ao salvar o cliente!');
                console.error(error);
            });
        });
    </script>
</body>
</html>
