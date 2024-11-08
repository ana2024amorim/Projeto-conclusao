<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDV - Cadastro de Clientes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Fonte para ícones -->
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
        .top-bar img {
            height: 40px;
            max-width: 100%; /* Garante que a imagem não ultrapasse a largura da barra */
        }

        .top-bar h1 {
            margin: 0;
            font-size: 24px;
            flex-grow: 1; /* Permite que o h1 ocupe o espaço disponível */
            text-align: center; /* Centraliza o texto dentro do h1 */
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

        /* Estilo da Tabela */
        .table-container {
            margin-top: 30px;
            max-width: 800px;
            margin: 20px auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            background-color: #f9f9f9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #FF8C00;
            color: white;
        }

        /* Estilização do botão de Sair */
        .btn-sair {
            display: flex;
            align-items: center;
            background-color: #dc3545; /* Cor vermelha para sair */
            color: white;
            padding: 8px 16px;
            font-size: 16px;
            border-radius: 4px;
            text-decoration: none; /* Remove sublinhado do link */
            transition: background-color 0.3s;
        }

        .btn-sair:hover {
            background-color: #c82333; /* Tom mais escuro ao passar o mouse */
        }

        .btn-sair i {
            margin-right: 8px; /* Espaçamento entre ícone e texto */
        }
    </style>
</head>
<body>

    <!-- Barra Superior -->
    <div class="top-bar">
        <img src="../images/LOGO1.png" alt="Logo da Empresa" style="height: 60px; margin-right: 10px;">
        <h1>PDV - Sistema</h1>
        

        <!-- Botão de Sair com ícone -->
        <a href="../index.php" class="btn-sair">
            <i class="fas fa-sign-out-alt"></i> Sair
        </a>
    </div>

    <!-- Tabela para exibir os dados -->
    <div class="table-container">
        <h2>Clientes Cadastrados</h2>
        <table id="clientTable">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Valor</th>
                    <th>Forma de Pagamento</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <!-- As linhas dos clientes serão inseridas aqui -->
            </tbody>
        </table>
    </div>

    <script>
        // Função para buscar os dados do PHP e preencher a tabela
        function carregarClientes() {
            fetch('../conector/consulta_venda.php')  // Faz uma requisição para o arquivo PHP
                .then(response => response.json())  // Converte a resposta para JSON
                .then(data => {
                    const tableBody = document.querySelector('#clientTable tbody');
                    tableBody.innerHTML = '';  // Limpa a tabela antes de adicionar novos dados

                    data.forEach(cliente => {  // Itera sobre os dados recebidos
                        const row = document.createElement('tr');

                        // Construção da URL para caixa.php com todos os dados
                        const url = new URL("../projeto-conclusao/PDV/caixa.php", window.location.origin);
                        url.searchParams.append("cliente_nome", cliente.cliente_nome);
                        url.searchParams.append("valor_total", cliente.valor_total);
                        url.searchParams.append("forma_pagamento", cliente.forma_pagamento);
                        url.searchParams.append("nomeproduto", cliente.nomeproduto); // Adiciona produtos
                        url.searchParams.append("quantidade", cliente.quantidade);   // Adiciona quantidades
                        url.searchParams.append("valor_unitario", cliente.valor_unitario); // Adiciona valores unitários
                        url.searchParams.append("cliente_cpfcnpj", cliente.cliente_cpfcnpj); // Adiciona valores unitários

                        row.innerHTML = `
                            <td>${cliente.cliente_nome}</td>
                            <td>${cliente.valor_total}</td>
                            <td>${cliente.forma_pagamento}</td>
                            <td>
                                <a href="${url.toString()}" title="Ir para Pagamento">
                                    <img src="../images/carrinho-de-compras.png" alt="Ícone de Pagamento" style="width:20px; cursor:pointer;">
                                </a>
                            </td>
                        `;
                        tableBody.appendChild(row);  // Adiciona a linha à tabela
                    });
                })
                .catch(error => console.error('Erro ao carregar clientes:', error));
        }

        // Carrega os clientes quando a página é carregada
        window.onload = carregarClientes;
    </script>

</body>
</html>
