<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDV</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .navbar-custom {
            background-color: #FFA07A; /* Laranja clara */
        }
        .card-custom {
            background-color: #001f3f; /* Azul marinho */
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
                        <h5 class="card-title">CPF</h5>
                        <input type="text" class="form-control" placeholder="Digite o CPF do cliente">
                    </div>
                </div>
            </div>
        </div>

        <!-- Terceira Coluna (1/4) -->
        <div class="col-md-3">
            <button class="btn btn-primary payment-button">Dinheiro</button>
            <button class="btn btn-success payment-button">Cartão de Crédito</button>
            <button class="btn btn-info payment-button">Cartão de Débito</button>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
