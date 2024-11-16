<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDV - Cadastro de Clientes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Fonte para ícones -->
    <link rel="stylesheet" href="../css/caixa1.css">
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
<!-- Botão Caixa (Laranja Claro) -->
<button class="btn btn-warning btn-caixa ms-3" onclick="window.location.href='fechamento_caixa.php';">Fechamento Caixa</button>


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
