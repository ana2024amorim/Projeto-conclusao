<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controle de Estoque</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
    }
    .container {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      padding: 30px;
      margin-top: 50px;
    }
    h2 {
      color: #000;
      font-size: 1.8rem;
      font-weight: bold;
    }
    #buscaForm {
      margin-bottom: 20px;
    }
    #buscaInput {
      border-radius: 4px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .table th {
      background-color: #007bff;
      color: #fff;
    }
    .table td {
      background-color: #f9f9f9;
      border-bottom: 1px solid #ddd;
    }
    #paginacao button {
      margin-right: 5px;
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
          <!-- Dados de estoque serão inseridos aqui -->
        </tbody>
      </table>
    </div>

    <div id="paginacao" class="d-flex justify-content-center mt-3">
      <!-- Botões de paginação serão gerados aqui -->
    </div>
  </div>

  <script>
    let paginaAtual = 1; // Página inicial
    let totalPaginas = 1; // Total de páginas (ajustado dinamicamente)

    // Função para buscar dados de estoque e preencher a tabela
    function buscarPeca() {
      const termoBusca = document.getElementById('buscaInput').value.trim(); // Termo de busca
      fetch(`conector/cons_geral_estoque.php?pagina=${paginaAtual}&termo=${termoBusca}`)
        .then(response => response.json())
        .then(dados => {
          const tabelaEstoque = document.getElementById('tabelaEstoque');
          tabelaEstoque.innerHTML = ''; // Limpa a tabela antes de inserir os novos dados
          
          // Atualiza o total de páginas
          totalPaginas = dados.total_paginas;

          if (dados.dados.length > 0) {
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
          } else {
            const row = document.createElement('tr');
            row.innerHTML = `<td colspan="5" class="text-center">Nenhuma peça encontrada.</td>`;
            tabelaEstoque.appendChild(row);
          }

          // Atualiza os botões de paginação
          atualizarPaginacao();
        })
        .catch(error => console.error('Erro ao buscar dados:', error));
    }

    // Função para atualizar os botões de paginação
    function atualizarPaginacao() {
      const paginacao = document.getElementById('paginacao');
      paginacao.innerHTML = ''; // Limpa a navegação anterior

      // Botão para página anterior
      if (paginaAtual > 1) {
        const btnAnterior = document.createElement('button');
        btnAnterior.className = 'btn btn-primary';
        btnAnterior.innerText = 'Anterior';
        btnAnterior.onclick = () => {
          paginaAtual--;
          buscarPeca();
        };
        paginacao.appendChild(btnAnterior);
      }

      // Botão para próxima página
      if (paginaAtual < totalPaginas) {
        const btnProxima = document.createElement('button');
        btnProxima.className = 'btn btn-primary';
        btnProxima.innerText = 'Próxima';
        btnProxima.onclick = () => {
          paginaAtual++;
          buscarPeca();
        };
        paginacao.appendChild(btnProxima);
      }
    }

    // Chama a função ao carregar a página
    window.onload = buscarPeca;
  </script>
</body>
</html>
