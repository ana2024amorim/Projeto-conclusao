<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venda de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <label for="client-cnpj" class="form-label">CNPJ:</label>
                <input type="text" id="client-cnpj" class="form-control" placeholder="Digite o CNPJ" oninput="fetchClientName()">
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

    <script>
        const products = [
            { id: 1, name: 'Produto 1', price: 10.0 },
            { id: 2, name: 'Produto 2', price: 20.0 },
            { id: 3, name: 'Produto 3', price: 30.0 },
        ];

        let cart = [];

        // Função para buscar o nome do cliente pelo CNPJ
        function fetchClientName() {
            const cnpj = document.getElementById('client-cnpj').value;
            const clientNameInput = document.getElementById('client-name');

            // Simulação de uma busca de cliente (você pode substituir isso por uma chamada AJAX real)
            const clients = {
                '12345678000195': 'Cliente Exemplo 1',
                '98765432000196': 'Cliente Exemplo 2',
                // Adicione mais CNPJs e nomes conforme necessário
            };

            clientNameInput.value = clients[cnpj] || ''; // Define o nome ou limpa se não encontrado
        }

        // Função de busca de produtos
        document.getElementById('search-product').addEventListener('input', function () {
            const searchValue = this.value.toLowerCase();
            const productList = document.getElementById('product-list');
            productList.innerHTML = '';

            const filteredProducts = products.filter(product =>
                product.name.toLowerCase().includes(searchValue)
            );

            filteredProducts.forEach(product => {
                const item = document.createElement('a');
                item.href = '#';
                item.classList.add('list-group-item', 'list-group-item-action');
                item.textContent = `${product.name} - R$ ${product.price.toFixed(2)}`;
                item.onclick = () => addToCart(product);
                productList.appendChild(item);
            });
        });

        // Adiciona produto ao carrinho com quantidade padrão 1
        function addToCart(product) {
            const existingProductIndex = cart.findIndex(item => item.id === product.id);

            if (existingProductIndex !== -1) {
                // Se o produto já está no carrinho, apenas aumenta a quantidade
                cart[existingProductIndex].quantity += 1;
            } else {
                cart.push({ ...product, quantity: 1 });
            }

            renderCart();
        }

        // Renderiza os itens no carrinho e atualiza o total
        function renderCart() {
            const cartItems = document.getElementById('cart-items');
            cartItems.innerHTML = '';
            let totalPrice = 0;

            cart.forEach((product, index) => {
                const itemTotalPrice = product.price * product.quantity;
                totalPrice += itemTotalPrice;

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${product.name}</td>
                    <td><input type="number" class="quantity-input" value="${product.quantity}" min="1" onchange="updateQuantity(${index}, this.value)"></td>
                    <td>R$ ${product.price.toFixed(2)}</td>
                    <td>R$ ${itemTotalPrice.toFixed(2)}</td>
                    <td><span class="btn-remove" onclick="removeFromCart(${index})">&times;</span></td>
                `;
                cartItems.appendChild(row);
            });

            document.getElementById('total-price').textContent = totalPrice.toFixed(2);
        }

        // Atualiza a quantidade do produto no carrinho
        function updateQuantity(index, quantity) {
            cart[index].quantity = parseInt(quantity);
            renderCart();
        }

        // Remove item do carrinho
        function removeFromCart(index) {
            cart.splice(index, 1);
            renderCart();
        }

        // Função para enviar os dados da venda
        function submitSale() {
            const selectedPaymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;
            alert(`Dados da venda enviados!\nForma de pagamento: ${selectedPaymentMethod}\nTotal: R$ ${document.getElementById('total-price').textContent}`);
            // Aqui você pode implementar a lógica para enviar os dados para o formulário de venda
            const modal = bootstrap.Modal.getInstance(document.getElementById('paymentModal'));
            modal.hide(); // Fecha o modal após enviar os dados
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
