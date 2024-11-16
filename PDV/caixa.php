<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDV</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .navbar-custom {
            background-color: #FFA726; /* Laranja claro */
        }
        .card-custom {
            background-color: #FFA726; /* Laranja Claro */
            color: #FFFFFF;
        }
        .card-payment {
            background-color: #f8f9fa; /* Cinza claro */
        }
        .payment-section {
            text-align: center;
        }
        .payment-button {
            width: 100%;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<?php
// Captura os dados enviados pela URL
$nome_cliente = isset($_GET['cliente_nome']) ? htmlspecialchars($_GET['cliente_nome']) : 'Nome não informado';
$valor_total = isset($_GET['valor_total']) ? htmlspecialchars($_GET['valor_total']) : '0.00';
$forma_pagamento = isset($_GET['forma_pagamento']) ? htmlspecialchars($_GET['forma_pagamento']) : 'Não especificado';
$cliente_cpfcnpj = isset($_GET['cliente_cpfcnpj']) ? htmlspecialchars($_GET['cliente_cpfcnpj']) : 'Não especificado';

// Captura os arrays de produtos, quantidades e valores unitários
$nomeproduto = isset($_GET['nomeproduto']) ? explode(',', htmlspecialchars($_GET['nomeproduto'])) : [];
$quantidade = isset($_GET['quantidade']) ? explode(',', htmlspecialchars($_GET['quantidade'])) : [];
$valor_unitario = isset($_GET['valor_unitario']) ? explode(',', htmlspecialchars($_GET['valor_unitario'])) : [];
?>

<!-- Barra Superior -->
<nav class="navbar navbar-custom">
    <div class="container-fluid d-flex justify-content-between">
        <span class="navbar-brand mb-0 h1">PDV</span>
        <a href="logout.php" class="btn btn-outline-light">Sair</a>
    </div>
</nav>

<!-- Conteúdo Principal -->
<div class="container mt-4">
    <div class="row">

        <!-- Primeira Coluna (1/4) -->
        <div class="col-md-3">
            <div class="card card-custom mb-3">
                <div class="card-body">
                    <h5 class="card-title">Cliente</h5>
                    <p class="card-text"><?= $nome_cliente ?></p>
                </div>
            </div>
            <div class="card card-custom mb-3">
                <div class="card-body">
                    <h5 class="card-title">Valor Total</h5>
                    <p class="card-text">R$ <?= $valor_total ?></p>
                </div>
            </div>
            <div class="card card-custom">
                <div class="card-body">
                    <h5 class="card-title">Forma de Pagamento</h5>
                    <p class="card-text"><?= $forma_pagamento ?></p>
                </div>
            </div>
        </div>

        <!-- Segunda Coluna (2/4) -->
        <div class="col-md-6">
            <div class="payment-section">
                <h5>Detalhes dos Produtos</h5>
                <table class="table table-striped mb-3">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Valor Unitário</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Exibe os detalhes dos produtos, quantidades e valores unitários
                        for ($i = 0; $i < count($nomeproduto); $i++) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($nomeproduto[$i]) . "</td>";
                            echo "<td>" . htmlspecialchars($quantidade[$i]) . "</td>";
                            echo "<td>R$ " . htmlspecialchars($valor_unitario[$i]) . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <div class="card card-payment mb-3">
                    <div class="card-body">
                        <h5 class="card-title">E-mail</h5>
                        <input type="email" class="form-control" placeholder="Digite o e-mail do cliente">
                    </div>
                </div>
                <div class="card card-payment">
                    <div class="card-body">
                        <h5 class="card-title">CPF ou CNPJ</h5>
                        <input type="text" class="form-control" 
                            placeholder="Digite o CPF ou CNPJ do cliente" 
                            name="cliente_cpfcnpj" 
                            value="<?= isset($_GET['cliente_cpfcnpj']) ? htmlspecialchars($_GET['cliente_cpfcnpj']) : '' ?>">
                    </div>
                </div>

            </div>
        </div>

        <!-- Terceira Coluna (1/4) -->
        <div class="col-md-3">

            <button class="btn btn-primary payment-button" onclick="registrarPagamento('dinheiro')">Pago em Dinheiro</button>
            <button class="btn btn-success payment-button" onclick="registrarPagamento('credito')">Pago em Cartão de Crédito</button>
            <button class="btn btn-info payment-button" onclick="registrarPagamento('debito')">Pago em Cartão de Débito</button>
           <!-- Botão de Imprimir Nota Fiscal com chamada JavaScript -->
           <button type="button" class="btn btn-warning payment-button mt-2" onclick="imprimirNotaFiscal()">Imprimir Nota Fiscal</button>        
       
        </div>

    </div>
</div>

<!-- Modal de Resposta -->
<div class="modal fade" id="modalResposta" tabindex="-1" role="dialog" aria-labelledby="modalRespostaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRespostaLabel">Resultado do Pagamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalMensagem">
                <!-- Mensagem de sucesso ou erro será exibida aqui -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function registrarPagamento(metodo) {
        // Captura todos os detalhes dos produtos do PHP para JavaScript
        const produtos = <?= json_encode($nomeproduto) ?>;
        const quantidades = <?= json_encode($quantidade) ?>;
        const valoresUnitarios = <?= json_encode($valor_unitario) ?>;

        // Monta os dados a serem enviados via AJAX
        $.ajax({
            url: '../conector/atualizar_pagamento.php', // Ajuste o caminho conforme necessário
            method: 'POST',
            data: {
                metodo_pagamento: metodo,  // Método de pagamento selecionado
                produtos: produtos,        // Produtos enviados
                quantidades: quantidades,  // Quantidades dos produtos
                valores_unitarios: valoresUnitarios,  // Valores unitários dos produtos
            },
            success: function(response) {
                // Exibe o modal com a resposta do servidor
                $('#modalMensagem').text(response); // Atualiza a mensagem do modal
                $('#modalResposta').modal('show');  // Exibe o modal
            },
            error: function() {
                // Exibe o modal com erro
                $('#modalMensagem').text('Erro ao registrar o pagamento.');
                $('#modalResposta').modal('show');  // Exibe o modal
            }
        });
    }

    function imprimirNotaFiscal() {
        // Dados do formulário para passar para NFE.php
        const dados = {
            cliente_nome: "<?= $nome_cliente ?>",
            valor_total: "<?= $valor_total ?>",
            forma_pagamento: "<?= $forma_pagamento ?>",
            nomeproduto: "<?= implode(',', $nomeproduto) ?>",
            quantidade: "<?= implode(',', $quantidade) ?>",
            valor_unitario: "<?= implode(',', $valor_unitario) ?>",
            cliente_cpfcnpj: "<?= isset($_GET['cliente_cpfcnpj']) ? htmlspecialchars($_GET['cliente_cpfcnpj']) : '' ?>"
        };

        // Cria um formulário para enviar os dados via POST
        const form = document.createElement("form");
        form.method = "POST";
        form.action = "NFE.php";

        // Adiciona os dados ao formulário como campos hidden
        for (const [key, value] of Object.entries(dados)) {
            const input = document.createElement("input");
            input.type = "hidden";
            input.name = key;
            input.value = value;
            form.appendChild(input);
        }

        // Abre uma nova aba e envia o formulário via POST
        const newTab = window.open("", "_blank"); // Abre uma nova aba
        newTab.document.write('<html><head><title>Nota Fiscal</title></head><body><h2>Aguarde enquanto a nota fiscal está sendo processada...</h2></body></html>');
        
        // Espera o conteúdo da nova aba ser carregado antes de submeter o formulário
        setTimeout(() => {
            form.submit(); // Envia o formulário para NFE.php
        }, 500);

        // Adiciona o formulário ao body da nova aba
        newTab.document.body.appendChild(form);

        // Redireciona a página atual (caixa.php) para caixa1.php
        setTimeout(() => {
            window.location.href = "caixa1.php"; // Redireciona para a tela caixa1.php após abrir a nova aba
        }, 1000); // Ajuste o tempo de delay para garantir que o formulário foi enviado
    

        
    }
</script>

</body>
</html>
