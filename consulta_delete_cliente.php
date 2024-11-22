<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        /* Estilos para o formulário */
        .container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2.text-center {
            color: #6c757d;
            font-weight: bold;
        }

        form {
            background-color: #f0f0f0;
            border-radius: 8px;
            padding: 20px;
            color: black;
        }

        form input, form select, form textarea {
            background-color: #e0e0e0;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 15px;
            width: 100%;
            color: black;
        }

        form button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        form button:hover {
            background-color: #0056b3;
        }

        .search-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        .search-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Clientes Cadastrados</h2>

        <!-- Campo de pesquisa e botão -->
        <div class="row mb-4">
            <div class="col-md-8">
                <input type="text" id="search-name" class="form-control" placeholder="Digite o nome do cliente">
            </div>
            <div class="col-md-4">
                <button id="search-btn" class="btn search-btn w-100">Buscar</button>
            </div>
        </div>

        <!-- Tabela de clientes -->
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>CPF/CNPJ</th>
                    <th>Nome/Razão Social</th>
                    <th>Cidade</th>
                    <th>UF</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="clientes-body">
                <!-- Dados serão preenchidos via JavaScript -->
            </tbody>
        </table>

        <!-- Navegação de página -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center" id="pagination">
                <!-- Botões de página serão inseridos aqui via JavaScript -->
            </ul>
        </nav>
    </div>

    <!-- Modal de mensagem -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">Mensagem</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="messageModalBody">
                    <!-- Mensagem será inserida dinamicamente -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            let currentPage = 1;
            const itemsPerPage = 8;

            // Função para buscar clientes com paginação
            function fetchClients(searchTerm = '') {
                $.ajax({
                    url: 'conector/cons_cliente.php', 
                    type: 'GET',
                    data: {
                        page: currentPage,
                        limit: itemsPerPage,
                        search: searchTerm
                    },
                    success: function (response) {
                        if (response.sucesso) {
                            let tbody = '';
                            response.clientes.forEach(cliente => {
                                tbody += `
                                    <tr>
                                        <td>${cliente.id}</td>
                                        <td>${cliente.cpf_cnpj}</td>
                                        <td>${cliente.razao_nome}</td>
                                        <td>${cliente.cidade}</td>
                                        <td>${cliente.uf}</td>
                                        <td>${cliente.telefone}</td>
                                        <td>${cliente.email}</td>
                                        <td>
                                            <button class="btn btn-danger btn-sm delete-btn" data-id="${cliente.id}">
                                                <i class="bi bi-trash"></i> Excluir
                                            </button>
                                        </td>
                                    </tr>
                                `;
                            });
                            $('#clientes-body').html(tbody);

                            // Atualizar a paginação
                            updatePagination(response.totalPages);
                        } else {
                            $('#clientes-body').html('<tr><td colspan="8" class="text-center">Nenhum cliente encontrado.</td></tr>');
                        }
                    },
                    error: function () {
                        showModal('Erro', 'Erro ao carregar os clientes.');
                    }
                });
            }

            // Função para atualizar a navegação de página
            function updatePagination(totalPages) {
                let paginationHtml = '';

                // Página anterior
                if (currentPage > 1) {
                    paginationHtml += `<li class="page-item"><a class="page-link" href="#" data-page="${currentPage - 1}">&laquo; Anterior</a></li>`;
                }

                // Páginas
                for (let i = 1; i <= totalPages; i++) {
                    paginationHtml += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                                        <a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
                }

                // Página seguinte
                if (currentPage < totalPages) {
                    paginationHtml += `<li class="page-item"><a class="page-link" href="#" data-page="${currentPage + 1}">Próxima &raquo;</a></li>`;
                }

                $('#pagination').html(paginationHtml);
            }

            // Inicializa a busca de clientes ao carregar a página
            fetchClients();

            // Evento para mudar de página
            $(document).on('click', '.page-link', function (e) {
                e.preventDefault();
                const page = $(this).data('page');
                currentPage = page;
                fetchClients($('#search-name').val());
            });

            // Evento para pesquisa
            $('#search-btn').click(function () {
                const searchTerm = $('#search-name').val();
                currentPage = 1; // Resetar para a primeira página
                fetchClients(searchTerm);
            });

            // Evento para deletar um cliente
            $(document).on('click', '.delete-btn', function () {
                const id = $(this).data('id');

                if (confirm('Tem certeza que deseja excluir este cliente?')) {
                    $.ajax({
                        url: 'conector/delete_cliente.php',
                        type: 'POST',
                        data: { id: id },
                        success: function (response) {
                            const res = JSON.parse(response);
                            if (res.sucesso) {
                                showModal('Sucesso', res.mensagem, true);
                            } else {
                                showModal('Erro', res.mensagem);
                            }
                        },
                        error: function () {
                            showModal('Erro', 'Erro ao excluir o cliente.');
                        }
                    });
                }
            });

            // Função para exibir o modal de mensagem
            function showModal(title, message, reload = false) {
                $('#messageModalLabel').text(title);
                $('#messageModalBody').text(message);
                const modal = new bootstrap.Modal('#messageModal');
                modal.show();

                if (reload) {
                    fetchClients($('#search-name').val());
                }
            }
        });
    </script>
</body>
</html>
