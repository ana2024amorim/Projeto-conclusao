<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consulta de Funcionários</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h2 class="mb-4">Consulta de Funcionários</h2>
    <form id="consultaForm">
      <div class="input-group mb-3">
        <input type="text" class="form-control" id="search" placeholder="Digite o nome do funcionário" aria-label="Buscar">
        <button class="btn btn-primary" type="button" onclick="consultarFuncionario()">Buscar</button>
      </div>
    </form>
    <div id="resultados" class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Cargo</th>
            <th>Gênero</th>
            <th>Email</th>
            <th>Status</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody id="tabelaResultados">
          <!-- Dados da consulta serão inseridos aqui -->
        </tbody>
      </table>
      <!-- Paginação -->
      <nav aria-label="Navegação de página">
        <ul class="pagination justify-content-center">
          <li class="page-item">
            <button class="page-link" onclick="alterarPagina(-1)">Anterior</button>
          </li>
          <li class="page-item">
            <button class="page-link" onclick="alterarPagina(1)">Próximo</button>
          </li>
        </ul>
      </nav>
    </div>
  </div>

  <!-- Modal para edição -->
<div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editarModalLabel">Editar Funcionário</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editarForm">
          <input type="hidden" id="funcionarioId">
          <div class="mb-3">
            <label for="editarNome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="editarNome" required>
          </div>
          <div class="mb-3">
            <label for="editarCargo" class="form-label">Cargo</label>
            <select class="form-control" id="editarCargo" required>
              <option value="Separador">Separador</option>
              <option value="Gerente">Gerente</option>
              <option value="Vendedor">Vendedor</option>
              <option value="Estoquista">Estoquista</option>
              <option value="Caixa">Caixa</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="editarGenero" class="form-label">Gênero</label>
            <input type="text" class="form-control" id="editarGenero" required>
          </div>
          <div class="mb-3">
            <label for="editarEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="editarEmail" required>
          </div>
          <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>
      </div>
    </div>
  </div>
</div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    let paginaAtual = 1; // Página inicial
    const limitePorPagina = 5;

    // Função para realizar a consulta e exibir resultados
    function consultarFuncionario() {
      const nome = document.getElementById('search').value;

      // Requisição AJAX para buscar dados com paginação
      fetch(`conector/cons_geral_usuario.php?nome=${nome}&page=${paginaAtual}&limit=${limitePorPagina}`)
        .then(response => {
          if (!response.ok) {
            throw new Error('Erro na resposta da API: ' + response.status);
          }
          return response.json(); // Tenta analisar o JSON
        })
        .then(data => {
          const tabela = document.getElementById('tabelaResultados');
          tabela.innerHTML = '';

          if (data.length === 0) {
            tabela.innerHTML = '<tr><td colspan="6">Nenhum funcionário encontrado.</td></tr>';
            return;
          }

          data.forEach(funcionario => {
            const status = funcionario.ativo === 1 ? 'Ativo' : 'Desativado';
            const corStatus = funcionario.ativo === 1 ? 'text-success' : 'text-danger';
            tabela.innerHTML += `
              <tr>
                <td>${funcionario.nome}</td>
                <td>${funcionario.cargo}</td>
                <td>${funcionario.genero}</td>
                <td>${funcionario.email}</td>
                <td class="${corStatus}">${status}</td>
                <td>
                  <button class="btn btn-sm btn-warning" onclick="abrirEditarModal(${funcionario.id})">Editar</button>
                  <button class="btn btn-sm ${funcionario.ativo === 1 ? 'btn-danger' : 'btn-success'}" onclick="toggleAtivacao(${funcionario.id}, ${funcionario.ativo})">
                    ${funcionario.ativo === 1 ? 'Desativar' : 'Ativar'}
                  </button>
                </td>
              </tr>
            `;
          });
        })
        .catch(error => {
          console.error('Erro ao buscar funcionários:', error);
          alert('Houve um erro ao buscar os dados. Verifique a API.');
        });
    }

    // Função para alternar entre Ativado e Desativado
    function toggleAtivacao(id, ativo) {
      const novaAtivacao = ativo === 1 ? 0 : 1;

      console.log(`ID: ${id}, Ativo: ${ativo}, Nova Ativação: ${novaAtivacao}`);

      fetch('conector/status_geral_usuario.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id, ativo: novaAtivacao })
      })
      .then(response => response.json())
      .then(data => {
        if (data.sucesso) {
          consultarFuncionario(); // Atualiza a lista após a mudança
        } else {
          alert('Erro ao atualizar o status do funcionário.');
        }
      })
      .catch(error => console.error('Erro:', error));
    }

    // Função para alterar a página atual e consultar novamente
    function alterarPagina(direcao) {
      if (paginaAtual + direcao > 0) {
        paginaAtual += direcao;
        consultarFuncionario();
      }
    }

    
        // Função para abrir o modal de edição com dados do funcionário
    function abrirEditarModal(id) {
    fetch(`conector/busca_geral_usuario.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
        if (data.erro) {
            alert(data.erro);
        } else {
            // Popula o modal com os dados do funcionário
            document.getElementById('funcionarioId').value = data.id;
            document.getElementById('editarNome').value = data.nome;
            document.getElementById('editarCargo').value = data.cargo;
            document.getElementById('editarGenero').value = data.genero;
            document.getElementById('editarEmail').value = data.email;

            // Bloqueia os campos Nome, Gênero e Email para edição
            document.getElementById('editarNome').disabled = true;
            document.getElementById('editarGenero').disabled = true;
            document.getElementById('editarEmail').disabled = true;

            // Abre o modal
            new bootstrap.Modal(document.getElementById('editarModal')).show();
        }
        })
        .catch(error => console.error('Erro:', error));
    }

    // funcao para enviar os dados de update para o cargo 
    // Função para enviar os dados de atualização
    document.getElementById('editarForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita o envio padrão do formulário

    const funcionarioId = document.getElementById('funcionarioId').value;
    const cargo = document.getElementById('editarCargo').value;

  // Envia os dados via AJAX
    fetch('conector/update_geral_funcionario.php', {
        method: 'POST',
        headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `id=${funcionarioId}&cargo=${cargo}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.sucesso) {
        alert('Cargo atualizado com sucesso!');
        // Fechar o modal após a atualização
        bootstrap.Modal.getInstance(document.getElementById('editarModal')).hide();
        } else {
        alert('Erro ao atualizar o cargo.');
        }
    })
    .catch(error => console.error('Erro:', error));
    });

    // Inicializa a consulta ao carregar a página
    consultarFuncionario();
  </script>
</body>
</html>
