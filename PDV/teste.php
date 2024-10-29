<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venda de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <style>
        .container {
            margin-top: 20px;
        }

        .product-list {
            max-height: 200px;
            overflow-y: auto;
            margin-bottom: 20px;
        }

        .cart-table {
            margin-bottom: 20px;
        }

        .total-section {
            text-align: right;
        }

        .btn-remove {
            background-color: #ff5c5c;
            color: white;
            border-radius: 50%;
            padding: 5px 10px;
            cursor: pointer;
        }

        .btn-remove:hover {
            background-color: #ff0000;
        }

        .btn-finalizar {
            display: block;
            margin-top: 20px;
        }

        .quantity-input {
            width: 60px;
        }

        .client-section {
            margin-bottom: 20px;
        }

        .client-form-group {
            width: 200px; /* Ajuste a largura dos campos */
            margin-right: 10px; /* Espaçamento entre os campos */
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Sistema de Venda</h2>

        <!-- Seção de Cliente e Busca de Produto em uma linha -->
        <div class="d-flex align-items-end mb-3">
            <div class="client-form-group">
                <label for="client-cpfcnpj" class="form-label">CNPJ/CPF:</label>
                <input type="text" id="client-cpfcnpj" class="form-control" placeholder="Digite o CNPJ ou CPF">
            </div>

            <div class="client-form-group">
                <label for="client-name" class="form-label">Nome do Cliente:</label>
                <input type="text" id="client-name" class="form-control" placeholder="Nome do Cliente" readonly>
            </div>
            <div class="form-group w-50">
                <label for="search-product">Buscar Produto:</label>
                <input type="text" id="search-product" class="form-control" placeholder="Digite o nome do produto">
            </div>
        </div>

        <!-- Lista de produtos encontrados -->
        <div id="product-list" class="product-list list-group">
            <!-- Os resultados da busca aparecerão aqui -->
        </div>

        <!-- Produtos adicionados ao carrinho -->
        <h4>Produtos no carrinho</h4>
        <div class="table-responsive">
            <table class="table table-bordered cart-table">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço Unitário</th>
                        <th>Preço Total</th>
                        <th>Remover</th>
                    </tr>
                </thead>
                <tbody id="cart-items">
                    <!-- Itens adicionados aparecerão aqui -->
                </tbody>
            </table>
        </div>

        <!-- Total da venda e botão de finalizar -->
        <div class="total-section">
            <h4>Total: R$ <span id="total-price">0.00</span></h4>
            <button class="btn btn-success btn-finalizar" data-bs-toggle="modal" data-bs-target="#paymentModal">Finalizar Venda</button>
        </div>
    </div>

    <!-- Modal de Formas de Pagamento -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Formas de Pagamento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Selecione a forma de pagamento:</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="payment-cash" value="dinheiro" checked>
                        <label class="form-check-label" for="payment-cash">Dinheiro</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="payment-card" value="cartao_credito">
                        <label class="form-check-label" for="payment-card">Cartão de Crédito</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="payment-pix" value="pix">
                        <label class="form-check-label" for="payment-pix">Pix</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="submitSale()">Enviar Dados</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
<!--scrip para consulta cliente-->
    <script>
        $(document).ready(function () {
            let timeout = null; // Variável para armazenar o timeout

            $('#client-cpfcnpj').keydown(function () {
                try {
                    $(this).unmask(); // Remove qualquer máscara existente
                } catch (e) {}

                var tamanho = $(this).val().length;

                // Aplica a máscara correta com base no tamanho da entrada
                if (tamanho < 11) {
                    $(this).mask("999.999.999-99"); // Máscara para CPF
                } else {
                    $(this).mask("99.999.999/9999-99"); // Máscara para CNPJ
                }

                // Ajustando foco
                var elem = this;
                setTimeout(function () {
                    elem.selectionStart = elem.selectionEnd = 10000;
                }, 0);

                // Reaplico o valor para mudar o foco
                var currentValue = $(this).val();
                $(this).val('');
                $(this).val(currentValue);
            }).trigger('keydown'); // Aplica a máscara ao carregar a página

            // Função para buscar o nome do cliente pelo CNPJ ou CPF
            $('#client-cpfcnpj').on('input', function() {
                clearTimeout(timeout); // Limpa o timeout anterior
                timeout = setTimeout(identifyAndFetchClient, 1000); // Define um novo timeout
            });
        });

        function identifyAndFetchClient() {
            const input = $('#client-cpfcnpj').val().replace(/\D/g, ''); // Remove caracteres não numéricos
            const clientNameInput = $('#client-name');

            if (input.length === 11) { // CPF
                fetch(`../conector/consulta_pdv.php?cpf=${input}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.nome) {
                            clientNameInput.val(data.nome);
                        } else {
                            alert('Cliente não cadastrado.');
                            if (confirm('Deseja cadastrar o cliente?')) {
                                window.location.href = 'cadastro.php';
                            }
                        }
                    })
                    .catch(error => console.error('Erro ao buscar cliente:', error));
            } else if (input.length === 14) { // CNPJ
                fetch(`../conector/consulta_pdv.php?cnpj=${input}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.nome) {
                            clientNameInput.val(data.nome);
                        } else {
                            alert('Cliente não cadastrado.');
                            if (confirm('Deseja cadastrar o cliente?')) {
                                window.location.href = '../cadastro_cliente.php';
                            }
                        }
                    })
                    .catch(error => console.error('Erro ao buscar cliente:', error));
            } else {
                clientNameInput.val(''); // Limpa o campo se não for válido
            }
        }

    </script>

<!--script para consulta produto adicionar carrinho e remove carrinho-->
<script>
            let cart = []; // Array para armazenar produtos no carrinho

            $(document).ready(function() {
                // Adiciona um evento de input ao campo de busca
                $('#search-product').on('input', function() {
                    fetchProducts();
                });
            });

            // Função para buscar produto
            function fetchProducts() {
                const query = $('#search-product').val().trim(); // Remove espaços em branco
                const productList = $('#product-list');

                if (query.length > 0) {
                    fetch(`../conector/consulta_produto_pdv.php?nome=${encodeURIComponent(query)}`)
                        .then(response => response.json())
                        .then(data => {
                            productList.empty(); // Limpa a lista atual
                            if (data.length > 0) {
                                data.forEach(product => {
                                    const price = parseFloat(product.valor_varejo);
                                    const listItem = $('<a>')
                                        .addClass('list-group-item list-group-item-action')
                                        .text(`${product.nome_peca} - ${product.modelo_carro} - R$ ${(isNaN(price) ? 0 : price).toFixed(2)}`)
                                        .data('product', product)
                                        .click(function() {
                                            addToCart(product); // Chama addToCart passando o produto
                                            $('#search-product').val(''); // Limpa o campo de busca
                                            productList.empty(); // Limpa a lista de produtos
                                        });
                                    productList.append(listItem);
                                });
                            } else {
                                productList.append('<div class="list-group-item">Nenhum produto encontrado</div>');
                            }
                        })
                        .catch(error => console.error('Erro ao buscar produtos:', error));
                } else {
                    productList.empty(); // Limpa a lista se o campo estiver vazio
                }
            }

            function addToCart(product) {
                const price = parseFloat(product.valor_varejo);
                if (isNaN(price)) {
                    console.error('Valor do produto não é um número:', product.valor_varejo);
                    return; // Não adiciona ao carrinho se o preço não for válido
                }

                const existingProduct = cart.find(item => item.id === product.id);
                if (existingProduct) {
                    existingProduct.quantity++; // Incrementa a quantidade
                } else {
                    cart.push({ ...product, quantity: 1, valor_varejo: price }); // Garante que valor_varejo é um número
                }
                updateCart();
            }

            function updateCart() {
                const cartItems = $('#cart-items');
                cartItems.empty(); // Limpa os itens atuais do carrinho
                let totalPrice = 0;

                cart.forEach(item => {
                    const priceTotal = item.valor_varejo * item.quantity; // Aqui já garantimos que valor_varejo é um número
                    totalPrice += priceTotal;

                    const row = $('<tr>')
                        .append($('<td>').text(item.nome_peca))
                        .append($('<td>')
                            .append($('<input>')
                                .attr('type', 'number')
                                .attr('min', '1')
                                .val(item.quantity)
                                .change(function() {
                                    const newQuantity = parseInt($(this).val());
                                    if (!isNaN(newQuantity) && newQuantity > 0) {
                                        item.quantity = newQuantity; // Atualiza a quantidade
                                        updateCart(); // Atualiza a tabela do carrinho
                                    }
                                }))
                        )
                        .append($('<td>').text(`R$ ${item.valor_varejo.toFixed(2)}`))
                        .append($('<td>').text(`R$ ${priceTotal.toFixed(2)}`))
                        .append($('<td>')
                            .append($('<button>').addClass('btn-remove').text('Remover').click(function() {
                                removeFromCart(item.id); // Chama a função para remover
                            })));

                    cartItems.append(row);
                });

                $('#total-price').text(totalPrice.toFixed(2)); // Atualiza o preço total
            }

            function removeFromCart(productId) {
                cart = cart.filter(item => item.id !== productId);
                updateCart(); // Atualiza a tabela do carrinho
            }
</script>

<!--envia para o pix e insere no banco de dados-->
<script>
            function submitSale() {
                const clienteCnpj = $('#client-cpfcnpj').val();
                const clienteNome = $('#client-name').val();
                const formaPagamento = $('input[name="paymentMethod"]:checked').val();

                // Monta um array de produtos para enviar
                const produtos = cart.map(item => ({
                    nome: item.nome_peca,
                    quantidade: item.quantity,
                    valor_unitario: item.valor_varejo,
                    valor_total: item.valor_varejo * item.quantity
                }));

                // Calcula o valor total da compra
                const totalCompra = cart.reduce((total, item) => total + (item.valor_varejo * item.quantity), 0);

                // Envia os dados para gravarno banco 
                $.ajax({
                    url: '../conector/finalizar_compra.php', // Substitua pelo caminho correto
                    method: 'POST',
                    data: {
                        cliente_cpfcnpj: clienteCnpj,
                        cliente_nome: clienteNome,
                        forma_pagamento: formaPagamento,
                        produtos: produtos,
                        valor_total: totalCompra // Envia o valor total
                    },
                    success: function(response) {
                        if (formaPagamento === 'pix') {
                            // Redireciona para a página de pagamento Pix com o valor
                            window.location.href = `/QRCode/pagamento.php?pagamento_pix=${totalCompra}`;
                        } else {
                            alert('Compra finalizada com sucesso!');
                            cart = []; // Limpa o carrinho
                            updateCart(); // Atualiza a tabela do carrinho
                            $('#paymentModal').modal('hide'); // Fecha o modal
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Erro ao finalizar compra:', error);
                        alert('Ocorreu um erro ao finalizar a compra. Tente novamente.');
                    }
                });
            }

            //envia o valor para o pix

            function submitSale() {
            const selectedPaymentMethod = $('input[name="paymentMethod"]:checked').val();
            
            if (selectedPaymentMethod === 'pix') {
                const totalAmount = $('#total-price').text().replace(',', '.'); // Certifique-se de que o formato esteja correto
                // Redireciona para pagamento.php com o valor do Pix
                window.location.href = `../QRCode/pagamento.php?pagamento_pix=${totalAmount}`;
            } else {
                // Lógica para outros métodos de pagamento
                alert('Método de pagamento selecionado não é suportado.');
            }
        }


</script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
