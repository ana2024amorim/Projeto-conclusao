<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controle de Estoque</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
            /* Estilo para o corpo da página */
        body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        }

        /* Estilo para a container */
        .container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin-top: 50px;
        }

        /* Estilo para o título */
        h2 {
        color: #000;
        font-size: 1.8rem;
        font-weight: bold;
        }

        /* Estilo para o formulário de busca */
        #buscaForm {
        margin-bottom: 20px;
        }

        #buscaInput {
        border-radius: 4px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        /* Estilo para a tabela */
        .table {
        font-size: 1rem;
        border-collapse: collapse;
        }

        .table th, .table td {
        padding: 10px;
        text-align: center;
        }

        .table th {
        background-color: #007bff;
        color: #fff;
        border-radius: 0px;
        }

        .table td {
        background-color: #f9f9f9;
        border-bottom: 1px solid #ddd;
        }

        .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f2f2f2;
        }

        /* Estilo para a paginação */
        #paginacao {
        margin-top: 20px;
        }

        #paginacao button {
        border-radius: 4px;
        padding: 8px 12px;
        margin-right: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
        font-size: 1rem;
        }

        #paginacao button:hover {
        background-color: #0056b3;
        }

        #paginacao button:focus {
        outline: none;
        }

        #paginacao button.active {
        background-color: #0056b3;
        font-weight: bold;
        }

        /* Estilo para a tabela responsiva */
        .table-responsive {
        overflow-x: auto;
        }


</style>

</head>
<body>

  <div class="container mt-5">
    <h2 class="text-center mb-4">Controle de Estoque</h2>

    <form id="buscaForm" class="d-flex mb-4">
      <input type="text" class="form-control me-2" id="buscaInput" placeholder="Buscar peça por nome">
      <button class="btn btn-primary" type="button" onclick="buscarPeca()">Buscar</button>
    </form>

    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Código da Peça</th>
            <th>Nome da Peça</th>
            <th>Localização</th>
            <th>Fornecedor</th>
            <th>Quantidade</th>
          </tr>
        </thead>
        <tbody id="tabelaEstoque">
          <!-- Dados de estoque serão inseridos aqui dinamicamente -->
        </tbody>
      </table>
    </div>

    <div id="paginacao" class="d-flex justify-content-center">
      <!-- Links de paginação serão inseridos aqui -->
    </div>
  </div>

  <script>
    let paginaAtual = 1; // Página atual
    const itensPorPagina = 10; // Número de itens por página

    // Função para buscar dados de estoque e preencher a tabela
    function buscarPeca() {
      fetch(`conector/cons_geral_estoque.php?pagina=${paginaAtual}`)
        .then(response => response.json())
        .then(dados => {
          const tabelaEstoque = document.getElementById('tabelaEstoque');
          const paginacao = document.getElementById('paginacao');
          tabelaEstoque.innerHTML = ''; // Limpa a tabela antes de inserir os novos dados
          paginacao.innerHTML = ''; // Limpa os links de paginação

          // Preenche a tabela com os dados de estoque
          dados.dados.forEach(item => {
            const row = document.createElement('tr');
            row.innerHTML = `
              <td>${item.codigo_peca}</td>
              <td>${item.nome_peca}</td>
              <td>${item.localizacao}</td>
              <td>${item.fornecedor}</td>
              <td>${item.quantidade}</td>
            `;
            tabelaEstoque.appendChild(row);
          });

          // Cria a navegação de páginas
          for (let i = 1; i <= dados.total_paginas; i++) {
            const link = document.createElement('button');
            link.classList.add('btn', 'btn-outline-primary', 'me-2');
            link.innerText = i;
            link.onclick = () => {
              paginaAtual = i; // Atualiza a página atual
              buscarPeca(); // Faz a requisição novamente para a página selecionada
            };
            paginacao.appendChild(link);
          }
        })
        .catch(error => console.error('Erro ao buscar dados:', error));
    }

    // Chama a função ao carregar a página
    window.onload = buscarPeca;
  </script>

</body>
</html>
