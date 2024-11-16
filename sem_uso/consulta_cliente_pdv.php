<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 20px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 10px; /* Reduzir o espaço entre os campos */
        }

        .btn-consultar {
            margin-top: 10px; /* Reduzir o espaço acima do botão */
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Consulta de Clientes</h2>

        <form id="client-consultation-form">
            <div class="form-group">
                <label for="razao-social" class="form-label">Razão Social:</label>
                <input type="text" id="razao-social" class="form-control" placeholder="Digite a razão social">
            </div>
            <div class="form-group">
                <label for="cep" class="form-label">CEP:</label>
                <input type="text" id="cep" class="form-control" placeholder="Digite o CEP">
            </div>
            <div class="form-group">
                <label for="email" class="form-label">E-mail:</label>
                <input type="email" id="email" class="form-control" placeholder="Digite o e-mail">
            </div>
            <div class="form-group">
                <label for="bairro" class="form-label">Bairro:</label>
                <input type="text" id="bairro" class="form-control" placeholder="Digite o bairro">
            </div>
            <div class="form-group">
                <label for="cnpj" class="form-label">CNPJ:</label>
                <input type="text" id="cnpj" class="form-control" placeholder="Digite o CNPJ">
            </div>
            <div class="form-group">
                <label for="situacao-cadastro" class="form-label">Situação do Cadastro:</label>
                <select id="situacao-cadastro" class="form-select">
                    <option value="">Selecione a situação</option>
                    <option value="ativo">Ativo</option>
                    <option value="inativo">Inativo</option>
                    <option value="bloqueado">Bloqueado</option>
                </select>
            </div>
            <button type="button" class="btn btn-primary btn-consultar" onclick="consultClient()">Consultar</button>
        </form>

        <div id="result" class="mt-4">
            <h4>Resultado da Consulta:</h4>
            <form id="result-form" style="display: none;">
                <div class="form-group">
                    <label for="result-razao-social" class="form-label">Razão Social:</label>
                    <input type="text" id="result-razao-social" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="result-cep" class="form-label">CEP:</label>
                    <input type="text" id="result-cep" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="result-email" class="form-label">E-mail:</label>
                    <input type="email" id="result-email" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="result-bairro" class="form-label">Bairro:</label>
                    <input type="text" id="result-bairro" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="result-cnpj" class="form-label">CNPJ:</label>
                    <input type="text" id="result-cnpj" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="result-situacao-cadastro" class="form-label">Situação do Cadastro:</label>
                    <input type="text" id="result-situacao-cadastro" class="form-control" readonly>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Função para simular a consulta de cliente
        function consultClient() {
            const razaoSocial = document.getElementById('razao-social').value;
            const cep = document.getElementById('cep').value;
            const email = document.getElementById('email').value;
            const bairro = document.getElementById('bairro').value;
            const cnpj = document.getElementById('cnpj').value;
            const situacaoCadastro = document.getElementById('situacao-cadastro').value;

            // Preenchendo o formulário de resultados
            document.getElementById('result-razao-social').value = razaoSocial;
            document.getElementById('result-cep').value = cep;
            document.getElementById('result-email').value = email;
            document.getElementById('result-bairro').value = bairro;
            document.getElementById('result-cnpj').value = cnpj;
            document.getElementById('result-situacao-cadastro').value = situacaoCadastro;

            // Exibindo o formulário de resultados
            document.getElementById('result-form').style.display = 'block';
        }
    </script>
</body>

</html>
