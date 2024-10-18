<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Cadastro</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    
    <style>
            body {
                font-family: 'Tahoma', sans-serif;
                background-color: #C0C0C0;
                margin: 0;
                padding: 0;
            }
            .container {
                width: 80%; /* Aumenta a largura da tela */
                margin: 50px auto;
                padding: 20px;
                border: 2px solid #000;
                background-color: #E0E0E0;
                position: relative;
            }
            h2 {
                text-align: center;
                margin-bottom: 20px;
            }
            /* Botão fechar estilo janela do Windows */
            .close-btn {
                position: absolute;
                top: 10px;
                right: 10px;
                width: 25px;
                height: 25px;
                background-color: #ff5c5c;
                border: 1px solid #000;
                border-radius: 50%;
                cursor: pointer;
                text-align: center;
                line-height: 25px;
                font-weight: bold;
                color: #fff;
                font-family: Arial, sans-serif;
            }
            .close-btn:hover {
                background-color: #ff4c4c;
            }
            .form-group-small {
                width: 30%; /* Largura para 3 colunas */
                display: inline-block;
                vertical-align: top;
                margin-bottom: 10px;
                padding-right: 15px;
            }
            .form-group-small label {
                display: block;
                margin-bottom: 5px;
            }
            .form-group-small input {
                width: 100%;
                padding: 5px;
                border: 1px solid #000;
                background-color: #FFF;
            }
            .tabs {
                display: flex;
                justify-content: space-between;
            }
            .tab {
                width: 32%;
                padding: 10px;
                text-align: center;
                border: 1px solid #000;
                background-color: #D3D3D3;
                cursor: pointer;
                border-radius: 10px 10px 0 0; /* Borda arredondada nas pontas superiores */
                margin-right: 5px; /* Espaço entre as abas */
            }
            .tab.active {
                background-color: #FFF;
                border-bottom: none;
            }
            .form-section {
                display: none;
                padding: 20px;
                border: 1px solid #000;
                border-radius: 0 10px 10px 10px; /* Borda arredondada nas pontas inferiores */
                background-color: #FFF;
            }
            .form-section.active {
                display: block;
            }
            /* Formato das colunas dentro das abas */
            .form-group {
                width: 30%;
                display: inline-block;
                margin-bottom: 10px;
                padding-right: 15px;
            }
            .form-group label {
                display: block;
                margin-bottom: 5px;
            }
            .form-group input {
                width: 100%;
                padding: 5px;
                border: 1px solid #000;
                background-color: #FFF;
            }
            .button-group {
                margin-top: 20px;
                text-align: center;
            }
            button {
                padding: 10px 20px;
                background-color: #808080;
                border: 1px solid #000;
                cursor: pointer;
            }
            button:hover {
                background-color: #A9A9A9;
            }
            /* Ajuste do campo Marca do Carro para ter aparência padrão */
            #fabricante-carro {
                width: 100%; /* Largura total igual às caixas de texto */
                padding: 5px; /* Espaçamento interno */
                border: 1px solid #000; /* Borda padrão */
                background-color: #FFF; /* Cor de fundo branco */
                font-size: 14px; /* Tamanho da fonte igual às outras caixas */
            }
            #modelo-carro {
                width: 100%; /* Largura total igual às caixas de texto */
                padding: 5px; /* Espaçamento interno */
                border: 1px solid #000; /* Borda padrão */
                background-color: #FFF; /* Cor de fundo branco */
                font-size: 14px; /* Tamanho da fonte igual às outras caixas */
            }
            #situacao {
                width: 100%; /* Largura total igual às caixas de texto */
                padding: 5px; /* Espaçamento interno */
                border: 1px solid #000; /* Borda padrão */
                background-color: #FFF; /* Cor de fundo branco */
                font-size: 14px; /* Tamanho da fonte igual às outras caixas */
            }
            
                            /* Estilo para o modal */
                            /* Para garantir que a tabela e as imagens sigam a ordem desejada */
                            #consulta-list img {
                                max-width: 100%; /* Garante que as imagens não ultrapassem o tamanho do contêiner */
                                height: auto; /* Mantém a proporção da imagem */
                                display: block; /* Garante que a imagem se comporte como um bloco */
                                margin: 10px auto; /* Centraliza as imagens */
                            }

                            /* Ajustando o layout da tabela */
                            .table {
                                width: 100%; /* Aumenta a largura da tabela */
                                border-collapse: collapse; /* Remove o espaço entre as bordas das células */
                            }

                            .table th, .table td {
                                border: 1px solid #dee2e6; /* Borda da tabela */
                                padding: 10px; /* Espaçamento interno */
                                text-align: left; /* Alinhamento do texto */
                            }

                            .table th {
                                background-color: #f8f9fa; /* Cor de fundo do cabeçalho da tabela */
                            }

                            /* Estilo para a imagem em colunas */
                            .form-group img {
                                width: 100%; /* Ajusta a largura da imagem para caber no contêiner */
                                height: auto; /* Mantém a proporção da imagem */
                                margin-top: 10px; /* Espaçamento entre as imagens e os elementos acima */
                            }
                            .modal-dialog {
                                max-width: 80%; /* Aumenta a largura máxima da modal */
                            }

                            .modal-body {
                                padding: 20px; /* Aumenta o preenchimento dentro da modal */
                            }

                            /* Se a tabela dentro da modal ainda estiver pequena, adicione esta regra */
                            .table {
                                width: 100%; /* Certifique-se de que a tabela ocupa toda a largura disponível */
                                table-layout: auto; /* Ajusta a largura da tabela para caber em todas as colunas */
                            }
                            .pagination {
                                justify-content: center; /* Centraliza a paginação */
                            }

                            .pagination .page-item {
                                margin: 0 5px; /* Margem entre os itens da página */
                            }

                            .pagination .page-link {
                                padding: 10px 15px; /* Padding dos links */
                                border: 1px solid #ccc; /* Borda dos links */
                                border-radius: 5px; /* Borda arredondada */
                            }

                            .pagination .page-item.active .page-link {
                                background-color: #007bff; /* Cor de fundo quando ativo */
                                color: white; /* Cor do texto quando ativo */
                            }

                            .pagination .page-link:hover {
                                background-color: #0056b3; /* Cor de fundo ao passar o mouse */
                                color: white; /* Cor do texto ao passar o mouse */
                            }


    </style>
</head>
<body>

<div class="container">
    <h2>Cadastro de Produtos</h2>

    <!-- Botão de Fechar -->
    <div class="close-btn" onclick="closeWindow()">X</div>

    <div class="form-group-small">
        <label for="codigo-int-produto">Código interno Produto:</label>
        <input type="text" id="codigo-int-produto">
    </div>
    <div class="form-group-small">
        <label for="fornecedor">Fornecedor:</label>
        <input type="text" id="fornecedor">
    </div>
    <div class="form-group-small">
        <label for="produto">Produto:</label>
        <input type="text" id="produto">
    </div>
    <div class="form-group-small">
        <label for="unidade">Unidade:</label>
        <input type="text" id="unidade">
    </div>
    <div class="form-group-small">
        <label for="fabricante">Fabricante:</label>
        <input type="text" id="fabricante">
    </div>

    <!-- Tabs -->
    <div class="tabs">
        <div class="tab active" data-tab="tab1">Cadastro de Produto</div>
        <div class="tab" data-tab="tab2">Consulta Veículo</div>
        <div class="tab" data-tab="tab3">Fornecedor</div>
        <div class="tab" data-tab="tab4">Veiculos</div>
    </div>

    <!-- Tab 1: Cadastro de Produto -->
    <div class="form-section active" id="tab1">
        <form action="../conector/inserir_produto.php" method="POST">
            <div class="form-group">
                <label for="codigo-produto">Código Produto:</label>
                <input type="text" id="codigo-produto" name="codigo_produto" required>
            </div>

            <div class="form-group">
                <label for="nome-peca">Nome do Produto:</label>
                <input type="text" id="nome-peca" name="nome_peca" required>
            </div>

            <div class="form-group">
                <label for="fornecedor">Fornecedor:</label>
                <input type="text" id="fornecedor" name="fornecedor" required>
            </div>

            <div class="form-group">
                <label for="peso">Peso:</label>
                <input type="text" id="peso" name="peso" required>
            </div>

            <div class="form-group">
                <label for="valor-varejo">Valor Varejo:</label>
                <input type="text" id="valor-varejo" name="valor_varejo" required>
            </div>

            <div class="form-group">
                <label for="fabricante-carro">Marca Carro:</label>
                <select id="fabricante-carro" name="fabricante_carro" required>
                    <option value="">Selecione a Marca</option>
                    <!-- As marcas serão carregadas aqui via AJAX -->
                </select>
            </div>

            <div class="form-group">
                <label for="modelo-carro">Modelo Carro:</label>
                <select id="modelo-carro" name="modelo_carro" required>
                    <option value="">Selecione o Modelo</option>
                    <!-- Os modelos serão carregados aqui via AJAX -->
                </select>
            </div>

            <div class="form-group">
                <label for="marca-fabricante">Marca do Fabricante:</label>
                <input type="text" id="marca-fabricante" name="marca_fabricante" required>
            </div>

            <div class="form-group">
                <label for="descricao-peca">Descrição da Peça:</label>
                <input type="text" id="descricao-peca" name="descricao_peca" required>
            </div>

            <div class="button-group">
                <button type="submit">Cadastrar</button>
                <button type="button" id="btn-consultar">Consultar</button>
            </div>
        </form>

        <!-- Modal de Consulta -->
        <div class="modal fade" id="consultaModal" tabindex="-1" role="dialog" aria-labelledby="consultaModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="consultaModalLabel">Consulta de Produtos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="consulta-list">
                            <!-- Os dados dos produtos serão carregados aqui via AJAX -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Edição -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Editar Produto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="edit-form">
                            <!-- Campo oculto para o código do produto -->
                            <input type="hidden" id="codigo-produto-edit" name="codigo_produto">

                            <!-- Demais campos do formulário de edição -->
                            <div class="form-group">
                                <label for="nome-peca-edit">Nome do Produto:</label>
                                <input type="text" class="form-control" id="nome-peca-edit" name="nome_peca" required>
                            </div>
                            <div class="form-group">
                                <label for="fornecedor-edit">Fornecedor:</label>
                                <input type="text" class="form-control" id="fornecedor-edit" name="fornecedor" required>
                            </div>
                            <div class="form-group">
                                <label for="peso-edit">Peso:</label>
                                <input type="text" class="form-control" id="peso-edit" name="peso" required>
                            </div>
                            <div class="form-group">
                                <label for="valor-varejo-edit">Valor Varejo:</label>
                                <input type="text" class="form-control" id="valor-varejo-edit" name="valor_varejo" required>
                            </div>
                            <div class="form-group">
                                <label for="marca-fabricante-edit">Marca do Fabricante:</label>
                                <input type="text" class="form-control" id="marca-fabricante-edit" name="marca_fabricante" required>
                            </div>
                            <div class="form-group">
                                <label for="descricao-peca-edit">Descrição da Peça:</label>
                                <input type="text" class="form-control" id="descricao-peca-edit" name="descricao_peca" required>
                            </div>
                            
                            <!-- Botão para enviar o formulário -->
                            <button type="button" class="btn btn-primary" onclick="submitEditForm()">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Confirmação de Exclusão -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirmar Exclusão</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Tem certeza que deseja excluir este produto?</p>
                        <input type="hidden" id="codigo-produto-delete">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" onclick="confirmDelete()">Excluir</button>
                    </div>
                </div>
            </div>
        </div>


        <script>
                // Função para carregar dados via AJAX
                async function loadPage(pageNumber = 1) {
                    try {
                        const response = await fetch(`consulta_produtos.php?pagina=${pageNumber}`);
                        if (!response.ok) {
                            throw new Error('Erro na resposta do servidor: ' + response.status);
                        }
                        const html = await response.text();
                        document.getElementById('consulta-list').innerHTML = html;
                        $('#consultaModal').modal('show'); // Mostra o modal após carregar os dados
                    } catch (error) {
                        console.error('Erro ao carregar produtos:', error);
                        document.getElementById('consulta-list').innerHTML = '<div>Erro ao carregar os produtos.</div>';
                    }
                }

                // Evento para abrir a modal de consulta
                document.getElementById('btn-consultar').addEventListener('click', () => loadPage());

                //funcao para chamar dados de edicao
                async function openEditModal(codigo) {
                    try {
                        const response = await fetch('../conector/get_produto.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ codigo_produto: codigo }),
                        });

                        if (!response.ok) {
                            throw new Error('Erro na resposta do servidor: ' + response.status);
                        }

                        const produto = await response.json();
                        
                        // Preenchendo os campos do formulário
                        document.getElementById('codigo-produto-edit').value = produto.codigo_produto || '';
                        document.getElementById('nome-peca-edit').value = produto.nome_peca || '';
                        document.getElementById('fornecedor-edit').value = produto.fornecedor || '';
                        document.getElementById('peso-edit').value = produto.peso || '';
                        document.getElementById('valor-varejo-edit').value = produto.valor_varejo || '';
                        document.getElementById('marca-fabricante-edit').value = produto.marca_fabricante || '';
                        document.getElementById('descricao-peca-edit').value = produto.descricao_peca || '';

                        // Mostrando o modal de edição
                        $('#editModal').modal('show');
                    } catch (error) {
                        console.error('Erro ao abrir o modal de edição:', error);
                    }
                }

                // Função para enviar o formulário de edição
                async function submitEditForm() {
                    const formData = new FormData(document.getElementById('edit-form'));
                    try {
                        const response = await fetch('../conector/update_produto.php', {
                            method: 'POST',
                            body: formData,
                        });

                        if (response.ok) {
                            alert('Produto atualizado com sucesso!');
                            $('#editModal').modal('hide'); // Esconde o modal após atualização
                            loadPage(); // Recarrega a lista de produtos
                        } else {
                            alert('Erro ao atualizar o produto.');
                        }
                    } catch (error) {
                        console.error('Erro ao atualizar produto:', error);
                    }
                }


                //funcao de delete
                // Função para abrir o modal de exclusão
                function openDeleteModal(codigo) {
                    document.getElementById('codigo-produto-delete').value = codigo;
                    $('#deleteModal').modal('show');
                }


                // Função para confirmar a exclusão do produto
                function confirmDelete() {
                    const codigoProduto = document.getElementById("codigo-produto-delete").value;

                    fetch("../conector/delete_produto.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                        },
                        body: new URLSearchParams({
                            codigo_produto: codigoProduto
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data); // Para depuração
                        if (data.success) {
                            alert("Produto excluído com sucesso!");

                            // Limpa o código
                            document.getElementById('codigo-produto-delete').value = ''; 
                            
                            // Fecha o modal de exclusão
                            $('#deleteModal').modal('hide'); 

                            // Carrega produtos novamente
                            loadProduto(); 

                            // Exibe o modal de consulta
                            $('#consultaModal').modal('show'); 

                            // Recarrega os dados da consulta
                            loadPage(); // Adicionada chamada para recarregar os dados
                        } else {
                            alert("Erro: " + data.message);
                        }
                    })
                    .catch(error => {
                        console.error("Erro ao excluir produto:", error);
                        alert("Erro ao excluir produto.");
                    });
                }

                // Função para carregar produtos
                function loadProduto() {
                    fetch("../conector/load_produto.php") // Verifique o caminho do arquivo
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const tableBody = document.getElementById('product-table-body');
                                tableBody.innerHTML = ''; // Limpa a tabela

                                data.products.forEach(product => {
                                    const row = document.createElement('tr');
                                    row.innerHTML = `
                                        <td>${product.codigo_produto}</td>
                                        <td>${product.nome}</td>
                                        <td>${product.preco}</td>
                                        <td>
                                            <button onclick="openDeleteModal('${product.codigo_produto}')">Excluir</button>
                                        </td>
                                    `;
                                    tableBody.appendChild(row);
                                });
                            } else {
                                console.error("Erro ao carregar produtos:", data.message);
                            }
                        })
                        .catch(error => console.error("Erro ao fazer requisição:", error));
                }

                // Carregue produtos ao inicializar a página
                document.addEventListener("DOMContentLoaded", loadProduto);

        </script>
    </div>

    <!-- Tab 2: Posicao estoque -->
    <div class="form-section" id="tab2">
        <form id="form-peca" action="../conector/inserir_estoque.php" method="POST"> <!-- Ação para o script PHP -->
            <div class="form-group">
                <label for="codigo-peca">Código da Peça:</label>
                <input type="text" id="codigo-peca" name="codigo_peca" required>
            </div>

            <div class="form-group">
                <label for="localizacao">Localização:</label>
                <input type="text" id="localizacao" name="localizacao" required>
            </div>

            <div class="form-group">
                <label for="corredor">Corredor:</label>
                <input type="text" id="corredor" name="corredor" required>
            </div>

            <div class="form-group">
                <label for="posicao">Posição:</label>
                <input type="text" id="posicao" name="posicao" required>
            </div>

            <div class="form-group">
                <label for="nivel">Nível:</label>
                <input type="text" id="nivel" name="nivel" required>
            </div>

            <div class="form-group">
                <label for="quantidade">Quantidade:</label>
                <input type="number" id="quantidade" name="quantidade" required>
            </div>

            <div class="form-group">
                <label for="fornecedor">Fornecedor:</label>
                <input type="text" id="fornecedor" name="fornecedor" required>
            </div>

            <div class="button-group">
                <button type="submit">Salvar</button>
                    <!-- Botão para abrir o modal de consulta de estoque -->
                <button type="button" onclick="openEstoqueModal()">
                    Consultar Estoque
                </button>
            </div>
        </form>

            <!-- Modal de Consulta -->
            <div class="modal fade" id="estoqueModal" tabindex="-1" role="dialog" aria-labelledby="estoqueModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="estoqueModalLabel">Consulta de Estoque</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="estoque-list">
                                <!-- Os dados do estoque serão carregados aqui via AJAX -->
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Função para carregar a página de estoque via AJAX
                function loadEstoquePage(pageNumber) {
                    fetch('../conector/consulta_estoque.php?pagina=' + pageNumber)
                        .then(response => response.text())
                        .then(html => {
                            document.getElementById('estoque-list').innerHTML = html;
                            $('#estoqueModal').modal('show'); // Abre o modal
                        })
                        .catch(error => {
                            console.error('Erro ao carregar a página de estoque:', error);
                            document.getElementById('estoque-list').innerHTML = '<div>Erro ao carregar estoque.</div>';
                        });
                }

                // Função para abrir o modal e carregar a primeira página dos dados
                function openEstoqueModal() {
                    loadEstoquePage(1); // Carrega a primeira página dos dados
                }
            </script>

        


            <!-- Popup de sucesso -->
            <div id="popup-success" class="popup1" style="display: none;">
                <p>Estoque cadastrado com sucesso!</p> <!-- Mensagem ajustada para cadastro de estoque -->
                <button id="popup-close1" class="popup-close1">Fechar</button>
            </div>

            <style>
                .popup1 {
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    padding: 20px;
                    background-color: white;
                    border: 2px solid black;
                    z-index: 1000;
                    text-align: center;
                }
                .popup-close1 {
                    margin-top: 10px;
                    padding: 5px 10px;
                    background-color: grey;
                    color: white;
                    border: none;
                    cursor: pointer;
                }
                .popup-close1:hover {
                    background-color: darkgrey;
                }
            </style>

            <script>
                document.getElementById("form-peca").addEventListener("submit", function(event) {
                    event.preventDefault(); // Impede o envio padrão do formulário

                    // Cria um objeto FormData para enviar os dados do formulário
                    var formData = new FormData(this);

                    fetch('../conector/inserir_estoque.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        // Verifica se a resposta é válida e contém JSON
                        if (!response.ok) {
                            throw new Error('Erro na resposta do servidor');
                        }
                        return response.json(); // Tenta parsear a resposta como JSON
                    })
                    .then(data => {
                        if (data.status === "success") {
                            // Exibe o popup de sucesso e atualiza a mensagem
                            showSuccessPopup(data.message); 
                        } else {
                            // Exibe a mensagem de erro no popup
                            showSuccessPopup(data.message);
                        }
                    })
                    .catch(error => {
                        console.error("Erro ao enviar dados:", error);
                        showSuccessPopup("Erro ao tentar cadastrar o estoque.");
                    });
                });

                // Função para exibir o popup
                function showSuccessPopup(message) {
                    document.getElementById("popup-success").style.display = "block";
                    document.getElementById("popup-success").children[0].innerText = message; // Atualiza a mensagem no popup
                }

                // Fecha o popup ao clicar no botão
                document.getElementById("popup-close1").addEventListener("click", function() {
                    document.getElementById("popup-success").style.display = "none";
                    document.getElementById("form-peca").reset(); // Limpa o formulário após fechar o popup
                });
            </script>
    </div>

    <!-- Tab 3: Fornecedor -->
    <div class="form-section" id="tab3">
        <form action="../conector/inserir_fornecedor.php" method="POST"> <!-- Ação para o script PHP -->
            <div class="form-group">
                <label for="fornecedor">Fornecedor:</label>
                <input type="text" id="fornecedor" name="fornecedor" required>
            </div>
            <div class="form-group">
                <label for="razao-social">Razão Social:</label>
                <input type="text" id="razao-social" name="razao_social" required>
            </div>
            <div class="form-group">
                <label for="cnpj">CNPJ:</label>
                <input type="text" id="cnpj" name="cnpj" required>
            </div>
            <div class="form-group">
                <label for="insc-estadual">Insc. Estadual:</label>
                <input type="text" id="insc-estadual" name="insc_estadual" required> <!-- Corrigido aqui -->
            </div>
            <div class="form-group">
                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco" required>
            </div>
            <div class="form-group">
                <label for="bairro">Bairro:</label>
                <input type="text" id="bairro" name="bairro" required>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" required>
            </div>
            <div class="form-group">
                <label for="cidade">Cidade:</label>
                <input type="text" id="cidade" name="cidade" required>
            </div>
            <div class="form-group">
                <label for="estado">Estado:</label>
                <input type="text" id="estado" name="estado" required>
            </div>
            <div class="form-group">
                <label for="situacao">Situação:</label>
                <select id="situacao" name="situacao" required>
                    <option value="" disabled selected>Selecione uma situação</option>
                    <option value="Ativa">Ativa</option>
                    <option value="Desativada">Desativada</option>
                    <option value="Bloqueada">Bloqueada</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="button-group">
                <button type="submit">Salvar</button>
                    <button type="button" onclick="openFornecedorModal()">
                    Consultar Fornecedores
                    </button>
            </div>
        </form>
                
        <!-- Modal de Consulta -->
                <div class="modal fade" id="fornecedorModal" tabindex="-1" role="dialog" aria-labelledby="fornecedorModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="fornecedorModalLabel">Consulta de Fornecedores</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="fornecedor-list">
                                    <!-- Os dados dos fornecedores serão carregados aqui via AJAX -->
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>

            <script>
                // Função para carregar a página de fornecedores via AJAX
                function loadFornecedorPage(pageNumber) {
                    fetch('../conector/consulta_fornecedor.php?pagina=' + pageNumber)
                        .then(response => response.text())
                        .then(html => {
                            document.getElementById('fornecedor-list').innerHTML = html;
                            $('#fornecedorModal').modal('show'); // Reabre o modal se necessário
                        })
                        .catch(error => {
                            console.error('Erro ao carregar a página de fornecedores:', error);
                            document.getElementById('fornecedor-list').innerHTML = '<div>Erro ao carregar fornecedores.</div>';
                        });
                }

                // Função para abrir o modal e carregar a primeira página dos dados
                function openFornecedorModal() {
                    loadFornecedorPage(1); // Carrega a primeira página dos dados
                    $('#fornecedorModal').modal('show'); // Abre o modal
                }
            </script>

            <!-- Popup de sucesso -->
            <div id="popup-success" class="popup" style="display: none;">
                <p>Fornecedor inserido com sucesso!</p>
                <button id="popup-close" class="popup-close">Fechar</button>
            </div>

            <style>
                .popup {
                    position: fixed;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    padding: 20px;
                    background-color: white;
                    border: 2px solid black;
                    z-index: 1000;
                }
                .popup-close {
                    padding: 5px 10px;
                    background-color: grey;
                    cursor: pointer;
                }
            </style>
    </div>

    <!-- Tab 4: Cadastro Veículo -->
    <div class="form-section" id="tab4">
        <form id="form-veiculo" action="../conector/inserir_veiculo.php" method="POST"> <!-- Ação para o script PHP -->
            <div class="form-group">
                <label for="fabricante">Fabricante:</label>
                <input type="text" id="fabricante" name="fabricante" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="veiculo">Veículo:</label>
                <input type="text" id="veiculo" name="veiculo" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="tipo-motor">Tipo Motor:</label>
                <input type="text" id="tipo-motor" name="tipo_motor" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="ano-lancamento">Ano Lançamento:</label>
                <input type="text" id="ano-lancamento" name="ano_lancamento" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="ano-encerramento">Ano Encerramento:</label>
                <input type="text" id="ano-encerramento" name="ano_encerramento" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="modelo">Modelo:</label>
                <input type="text" id="modelo" name="modelo" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="item-agregado">Item Agregado:</label>
                <input type="text" id="item-agregado" name="item_agregado" class="form-control" required>
            </div>
            
            <div class="button-group">
                <button type="submit">Salvar</button>
                <button type="button" onclick="openVeiculoModal()">Consultar Veículos</button>
            </div>
        </form>

        <!-- Modal de Consulta de Veículos -->
        <div class="modal fade" id="veiculoModal" tabindex="-1" role="dialog" aria-labelledby="veiculoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="veiculoModalLabel">Consulta de Veículos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="veiculo-list">
                            <!-- Os dados dos veículos serão carregados aqui via AJAX -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Função para carregar a página de veículos via AJAX
            function loadVeiculoPage(pageNumber) {
                fetch('../conector/consulta_veiculo.php?pagina=' + pageNumber)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('veiculo-list').innerHTML = html;
                        $('#veiculoModal').modal('show'); // Reabre o modal se necessário
                    })
                    .catch(error => {
                        console.error('Erro ao carregar a página de veículos:', error);
                        document.getElementById('veiculo-list').innerHTML = '<div>Erro ao carregar veículos.</div>';
                    });
            }

            // Função para abrir o modal e carregar a primeira página dos dados
            function openVeiculoModal() {
                loadVeiculoPage(1); // Carrega a primeira página dos dados
                $('#veiculoModal').modal('show'); // Abre o modal
            }
        </script>



                <!-- Popup de sucesso -->
                <div id="popup-success4" class="popup4" style="display: none;">
                    <p></p> <!-- Mensagem do popup -->
                    <button id="popup-close4" class="popup-close4">Fechar</button>
                </div>

                <style>
                    .popup4 {
                        position: fixed;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        padding: 20px;
                        background-color: white;
                        border: 2px solid black;
                        z-index: 1000;
                    }
                    .popup-close4 {
                        padding: 5px 10px;
                        background-color: grey;
                        cursor: pointer;
                    }
                </style>

                <script>
                    document.getElementById("form-veiculo").addEventListener("submit", function(event) {
                        event.preventDefault(); // Impede o envio padrão do formulário

                        // Cria um objeto FormData para enviar os dados do formulário
                        var formData = new FormData(this);

                        fetch('../conector/inserir_veiculo.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === "success") {
                                document.getElementById("popup-success4").style.display = "block";
                                var messageElement = document.getElementById("popup-success4").querySelector("p");
                                messageElement.innerText = data.message; // Atualiza a mensagem do popup
                            } else {
                                alert(data.message); // Exibe uma mensagem de erro
                            }
                        })
                        .catch(error => {
                            console.error("Erro ao enviar dados:", error);
                        });
                    });

                    // Fecha o popup ao clicar no botão e limpa o formulário
                    document.getElementById("popup-close4").addEventListener("click", function() {
                        document.getElementById("popup-success4").style.display = "none";
                        // Limpa os campos do formulário
                        document.getElementById("form-veiculo").reset();
                    });
                </script>
    </div>
</div>
<!-- inicio script para popup do cadastro fornecedor-->
<script>
            // Script para exibir o popup após o cadastro do fornecedor e manter a aba ativa

        document.querySelector('#popup-close4').addEventListener('click', () => {
            document.getElementById('popup-success4').style.display = 'none';
        });

        // Script para exibir o popup e manter a aba ativa
        const urlParams = new URLSearchParams(window.location.search);

        // Verifica se o cadastro foi feito com sucesso
        if (urlParams.get('status') === 'success') {
            document.getElementById('popup-success4').style.display = 'block';
            
            // Ativa a aba "Fornecedor" novamente
            const fornecedorTab = document.querySelector('.tab[data-tab="tab3"]');
            const fornecedorSection = document.getElementById('tab3');

            // Desativa as outras abas
            document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.form-section').forEach(section => section.classList.remove('active'));

            // Ativa a aba "Fornecedor"
            fornecedorTab.classList.add('active');
            fornecedorSection.classList.add('active');
        }
            window.onload = function() {
                // Verifica se o parâmetro "status" está presente na URL
                const url = new URL(window.location.href);
                if (url.searchParams.has('status')) {
                    // Remove o parâmetro "status" da URL
                    url.searchParams.delete('status');
                    window.history.replaceState({}, document.title, url.pathname);
                }
            };
</script>
<!-- FIM script para popup do cadastro fornecedor-->

<!-- inicio script de consulta marca veiculo -->
<script>
    // Função para carregar os fabricantes via AJAX
    function carregarFabricantes() {
        const selectFabricante = document.getElementById('fabricante-carro');

        // Fazer requisição para o PHP via AJAX
        fetch('../conector/consulta_fabricante.php')
            .then(response => response.json())
            .then(data => {
                // Limpar o campo antes de adicionar novas opções
                selectFabricante.innerHTML = '<option value="">Selecione o Fabricante</option>';

                // Preencher o select com os fabricantes vindos do banco de dados
                data.forEach(fabricante => {
                    const option = document.createElement('option');
                    option.value = fabricante.fabricante;
                    option.textContent = fabricante.fabricante;
                    selectFabricante.appendChild(option);
                });
            })
            .catch(error => console.error('Erro ao carregar fabricantes:', error));
        }

        // Carregar os fabricantes ao carregar a página
        document.addEventListener('DOMContentLoaded', carregarFabricantes);

        // Listener para tratar a seleção do fabricante
        document.getElementById('fabricante-carro').addEventListener('change', function() {
            const selectedFabricante = this.value;
            const modeloCarroInput = document.getElementById('modelo-carro');

            
        });
</script>
<!-- final script de consulta marca veiculo -->

<!-- inicio script de consulta modelo veiculo -->
<script>
    // Função para carregar os modelos via AJAX
    function carregarModelo() {
        const selectModelo = document.getElementById('modelo-carro');

        // Fazer requisição para o PHP via AJAX
        fetch('../conector/consulta_modelo.php')
            .then(response => response.json())
            .then(data => {
                // Limpar o campo antes de adicionar novas opções
                selectModelo.innerHTML = '<option value="">Selecione o Modelo</option>';

                // Preencher o select com os dados do modelo vindos do banco de dados
                data.forEach(modelo => {
                    const option = document.createElement('option');
                    option.value = modelo.modelo;  // Valor do modelo
                    option.textContent = modelo.modelo;  // Texto exibido
                    selectModelo.appendChild(option);  // Adiciona a opção ao select
                });
            })
            .catch(error => console.error('Erro ao carregar modelo:', error));
    }

    // Carregar os modelos ao carregar a página
    document.addEventListener('DOMContentLoaded', carregarModelo);

    // Listener para tratar a seleção do modelo
    document.getElementById('modelo-carro').addEventListener('change', function() {
        const selectedModelo = this.value;  // Modelo selecionado
        const modeloCarroInput = document.getElementById('modelo-carro');

        // Aqui você pode adicionar lógica adicional se necessário
        // Exemplo: atualizar um campo de texto ou exibir informações sobre o modelo selecionado
        console.log(`Modelo selecionado: ${selectedModelo}`); // Apenas para depuração
    });
</script>

<!-- final script de consulta marca veiculo -->

<script>
    //script para limpar e voltar tela de cadastro de fornecedor

    function salvarFornecedor() {
    // Aqui você deve incluir o código para enviar os dados ao servidor.
    // Você pode usar fetch ou XMLHttpRequest para isso.

    // Exemplo simulado de sucesso
    const sucesso = true; // Altere isso para a lógica real de sucesso

    if (sucesso) {
        // Redireciona para a página principal
        window.location.href = "pagina_principal.php"; // Altere para o URL da sua página principal

        // Limpa o formulário
        document.getElementById("fornecedor-form").reset();
        return false; // Impede o envio padrão do formulário
    }

    // Se falhar, você pode mostrar uma mensagem de erro
    alert("Erro ao salvar os dados. Tente novamente.");
    return false; // Impede o envio padrão do formulário
 }

    // Script para alternar entre as abas
    const tabs = document.querySelectorAll('.tab');
    const sections = document.querySelectorAll('.form-section');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            sections.forEach(s => s.classList.remove('active'));

            tab.classList.add('active');
            document.getElementById(tab.dataset.tab).classList.add('active');

            // Verifica se a aba ativa é "Cadastro de Produto" e carrega os produtos
            if (tab.dataset.tab === 'tab4') {
                loadProducts();
            }
        });
    });

    //funcao da opcao de edicao

    function editProduct(codigo) {
        // Aqui você deve implementar a lógica para carregar os dados do produto com o código específico
        console.log("Editando produto com código:", codigo);
        // Por exemplo, você pode usar AJAX para buscar os detalhes do produto e preencher os campos de entrada.
    }

    // Função para o botão de fechar
    function closeWindow() {
        alert("Fechando a janela...");
        window.close();
    }
</script>

</body>
</html>
