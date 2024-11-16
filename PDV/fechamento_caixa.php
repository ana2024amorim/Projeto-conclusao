<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fechamento de Caixa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f7f7;  /* Cor de fundo cinza claro */
        }
        /* Estilo para o botão "Sair" */
        #exitButton {
            position: fixed;
            bottom: 20px;   /* Distância da parte inferior da tela */
            right: 20px;    /* Distância da parte direita da tela */
            z-index: 1000;  /* Garante que o botão ficará acima de outros elementos */
            padding: 8px 25px;  /* Tamanho do botão */
            border-radius: 5px;  /* Bordas arredondadas */
            font-size: 23px;  /* Tamanho da fonte */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Fechamento de Caixa</h1>
        
        <!-- Filtro -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Filtrar Dados</h5>
                <form id="filterForm" class="row g-3">
                    <div class="col-md-6">
                        <label for="dateFilter" class="form-label">Filtrar por Data</label>
                        <input type="date" id="dateFilter" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="monthFilter" class="form-label">Filtrar por Mês</label>
                        <input type="month" id="monthFilter" class="form-control">
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-primary" id="applyFilter">Aplicar Filtro</button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Resultados -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Resultados</h5>
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Qtd de Vendas (Dia)</th>
                            <th>Valor Total</th>
                            <th>Cartão de Crédito</th>
                            <th>Pix</th>
                            <th>Cartão de Débito</th>
                            <th>Boleto</th>
                            <th>Dinheiro</th> <!-- Adicionada a coluna Dinheiro -->
                        </tr>
                    </thead>
                    <tbody id="resultsTableBody">
                        <!-- Os dados filtrados serão exibidos aqui -->
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Botão Sair -->
        <button id="exitButton" class="btn btn-danger">Sair</button>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Script para manipular filtro -->
    <script>
        // Função para carregar os dados do dia atual
        function loadDefaultData() {
            const today = new Date();
            const formattedDate = today.toISOString().split('T')[0];
            document.getElementById('dateFilter').value = formattedDate;

            fetchData(formattedDate, ''); // Chama fetchData passando a data atual e sem mês
        }

        // Função para preencher a tabela com dados
        function populateTable(data) {
            const tableBody = document.getElementById('resultsTableBody');
            tableBody.innerHTML = ''; // Limpa a tabela

            // Preenche a tabela com os dados recebidos
            const row = `
                <tr>
                    <td>${data.qtdVendas || 0}</td>
                    <td>${data.valorTotal || "R$ 0,00"}</td>
                    <td>${data.cartaoCredito || "R$ 0,00"}</td>
                    <td>${data.pix || "R$ 0,00"}</td>
                    <td>${data.cartaoDebito || "R$ 0,00"}</td>
                    <td>${data.boleto || "R$ 0,00"}</td>
                    <td>${data.dinheiro || "R$ 0,00"}</td> <!-- Adicionada a célula Dinheiro -->
                </tr>
            `;
            tableBody.innerHTML = row;
        }

        // Função para buscar dados via AJAX
        function fetchData(date, month) {
            const formData = new FormData();
            if (month) {
                formData.append('mes_filtro', month); // Envia o mês se o campo mês for preenchido
            } else if (date) {
                formData.append('data_filtro', date); // Envia a data se o campo data for preenchido
            }

            fetch('../conector/cons_fechamento_caixa.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);  // Verifique o que está sendo retornado
                if (data.sucesso) {
                    populateTable(data.resultados);
                } else {
                    alert(data.mensagem || 'Erro ao carregar os dados.');
                }
            })
            .catch(error => console.error('Erro:', error));
        }

        // Evento para aplicar o filtro
        document.getElementById('applyFilter').addEventListener('click', function () {
            const dateFilter = document.getElementById('dateFilter').value;
            const monthFilter = document.getElementById('monthFilter').value;

            if (monthFilter) {
                fetchData('', monthFilter); // Se o mês foi selecionado, usamos apenas o mês
            } else {
                fetchData(dateFilter, ''); // Se a data foi selecionada, usamos apenas a data
            }
        });

        // Carregar dados padrão ao carregar a página
        window.onload = loadDefaultData;

        // Redirecionamento ao clicar no botão "Sair"
        document.getElementById('exitButton').addEventListener('click', function() {
            window.location.href = 'caixa1.php';  // Redireciona para a página caixa1.php
        });
    </script>
</body>
</html>
