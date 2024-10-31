$(document).ready(function () {
    let timeout = null;

    $('#client-cpfcnpj').keydown(function () {
        try {
            $(this).unmask();
        } catch (e) {}

        var tamanho = $(this).val().length;

        if (tamanho < 11) {
            $(this).mask("999.999.999-99");
        } else {
            $(this).mask("99.999.999/9999-99");
        }

        var elem = this;
        setTimeout(function () {
            elem.selectionStart = elem.selectionEnd = 10000;
        }, 0);

        var currentValue = $(this).val();
        $(this).val('');
        $(this).val(currentValue);
    }).trigger('keydown');

    $('#client-cpfcnpj').on('input', function() {
        clearTimeout(timeout);
        timeout = setTimeout(identifyAndFetchClient, 1000);
    });

    function identifyAndFetchClient() {
        const input = $('#client-cpfcnpj').val().replace(/\D/g, '');
        const clientNameInput = $('#client-name');

        if (input.length === 11) {
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
        } else if (input.length === 14) {
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
            clientNameInput.val('');
        }
    }

    let cart = [];

    $('#search-product').on('input', function() {
        fetchProducts();
    });

    function fetchProducts() {
        const query = $('#search-product').val().trim();
        const productList = $('#product-list');

        if (query.length > 0) {
            fetch(`../conector/consulta_produto_pdv.php?nome=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    productList.empty();
                    if (data.length > 0) {
                        data.forEach(product => {
                            const price = parseFloat(product.valor_varejo);
                            const listItem = $('<a>')
                                .addClass('list-group-item list-group-item-action')
                                .text(`${product.nome_peca} - ${product.modelo_carro} - R$ ${(isNaN(price) ? 0.00 : price).toFixed(2)}`)
                                .attr('data-id', product.id)
                                .on('click', function() {
                                    addToCart(product);
                                });
                            productList.append(listItem);
                        });
                    } else {
                        productList.append('<div class="list-group-item">Nenhum produto encontrado.</div>');
                    }
                })
                .catch(error => console.error('Erro ao buscar produtos:', error));
        } else {
            productList.empty();
        }
    }

    function addToCart(product) {
        const existingProduct = cart.find(item => item.id === product.id);
        if (existingProduct) {
            existingProduct.quantity++;
        } else {
            cart.push({ ...product, quantity: 1 });
        }
        renderCart();
    }

    function renderCart() {
        const cartItems = $('#cart-items');
        cartItems.empty();
        let total = 0;

        cart.forEach(item => {
            const price = parseFloat(item.valor_varejo);
            const totalPrice = price * item.quantity;
            total += totalPrice;

            const row = $('<tr>');
            row.append($('<td>').text(item.nome_peca));
            row.append($('<td>').append($('<input>')
                .attr('type', 'number')
                .addClass('quantity-input')
                .val(item.quantity)
                .on('change', function() {
                    item.quantity = parseInt($(this).val());
                    renderCart();
                })));
            row.append($('<td>').text(`R$ ${(isNaN(price) ? 0.00 : price).toFixed(2)}`));
            row.append($('<td>').text(`R$ ${(isNaN(totalPrice) ? 0.00 : totalPrice).toFixed(2)}`));
            row.append($('<td>').append($('<button>')
                .addClass('btn-remove')
                .text('X')
                .on('click', function() {
                    cart = cart.filter(p => p.id !== item.id);
                    renderCart();
                })));
            cartItems.append(row);
        });

        $('#total-price').text(total.toFixed(2));
    }

    function submitSale() {
        const paymentMethod = $('input[name="paymentMethod"]:checked').val();
        const clientCpfCnpj = $('#client-cpfcnpj').val();
        const saleData = {
            items: cart,
            total: $('#total-price').text(),
            payment_method: paymentMethod,
            client_cpfcnpj: clientCpfCnpj
        };

        fetch('../conector/salvar_venda.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(saleData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Venda registrada com sucesso!');
                cart = [];
                renderCart();
                $('#paymentModal').modal('hide');
            } else {
                alert('Erro ao registrar a venda.');
            }
        })
        .catch(error => console.error('Erro ao enviar dados da venda:', error));
    }
});
