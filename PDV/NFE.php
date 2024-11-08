<?php
// Verificar se os dados foram enviados via POST e usar valores padrão caso contrário
$cliente_nome = isset($_POST['cliente_nome']) ? $_POST['cliente_nome'] : 'Nome não informado';
$valor_total = isset($_POST['valor_total']) ? $_POST['valor_total'] : '0.00';
$forma_pagamento = isset($_POST['forma_pagamento']) ? $_POST['forma_pagamento'] : 'Não especificado';
$cliente_cpfcnpj = isset($_POST['cliente_cpfcnpj']) ? $_POST['cliente_cpfcnpj'] : 'Não especificado';

// Verificando se as variáveis de produtos, quantidades e valores unitários existem
$nomeproduto = isset($_POST['nomeproduto']) ? explode(',', $_POST['nomeproduto']) : [];
$quantidade = isset($_POST['quantidade']) ? explode(',', $_POST['quantidade']) : [];
$valor_unitario = isset($_POST['valor_unitario']) ? explode(',', $_POST['valor_unitario']) : [];

// Exibe os dados capturados
//echo "<h1>Recibo - NFE</h1>";
//echo "<p><strong>Cliente:</strong> $cliente_nome</p>";
//echo "<p><strong>Valor Total:</strong> R$ $valor_total</p>";
//echo "<p><strong>Forma de Pagamento:</strong> $forma_pagamento</p>";

//echo "<h2>Itens:</h2>";
//echo "<table border='1'>";
//echo "<tr><th>Produto</th><th>Quantidade</th><th>Valor Unitário</th><th>Valor Total</th></tr>";

// Verificar se há itens para exibir
if (count($nomeproduto) > 0) {
    for ($i = 0; $i < count($nomeproduto); $i++) {
        $produto = $nomeproduto[$i];
        $quant = isset($quantidade[$i]) ? $quantidade[$i] : 0;
        $valor = isset($valor_unitario[$i]) ? $valor_unitario[$i] : 0;
        $valor_item = (float)$quant * (float)$valor; // Garantir que os valores sejam numéricos

        //echo "<tr>
        //        <td>$produto</td>
        //        <td>$quant</td>
        //        <td>R$ " . number_format($valor, 2, ',', '.') . "</td>
        //        <td>R$ " . number_format($valor_item, 2, ',', '.') . "</td>
        //      </tr>";
    }
} else {
    echo "<tr><td colspan='4'>Nenhum item encontrado</td></tr>";
}

echo "</table>";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo - NFE</title>
    <style>
        /* Estilos do recibo */
        .color-gray { color: #BCBCBC; }
        .text-center { text-align: center; }
        .ttu { text-transform: uppercase; }
        
        /* Estilo do recibo */
        .printer-ticket {
            width: 100%;
            max-width: 300px;
            margin: 0 auto;
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 10px;
            line-height: 1.3em;
            border-collapse: collapse;
        }

        .printer-ticket th,
        .printer-ticket td {
            padding: 8px 5px;
            border-bottom: 1px dashed #BCBCBC;
        }

        .printer-ticket th.title {
            font-size: 1.5em;
            padding: 15px 0;
        }

        .printer-ticket .top td {
            padding-top: 10px;
        }

        .printer-ticket .last td {
            padding-bottom: 10px;
        }

        .printer-ticket tfoot .sup td {
            border-top: 1px dashed #BCBCBC;
            padding: 10px 5px;
        }

        .printer-ticket tfoot .p--0 td {
            padding-bottom: 0;
        }

        .right-align { text-align: right; }

		

    </style>   
</head>
<body>

<!-- Estrutura do recibo 1-->
<table class="printer-ticket">
    <thead>
        <tr>
            <th class="title" colspan="3">Guardian Control</th>
        </tr>
        <tr>
            <th colspan="3" id="datetime"></th> <!-- Data e hora -->
		</tr>

        <tr>
            <th colspan="3">
                Nome do cliente: <?= htmlspecialchars($cliente_nome) ?> <br />
                CPF/CNPJ: <?= htmlspecialchars($cliente_cpfcnpj) ?> <br />
            </th>
        </tr>
        <tr>
            <th class="ttu" colspan="3">
                <b>Cupom não fiscal</b>
            </th>
        </tr>
    </thead>
    <tbody>
        <!-- Exemplo de item -->
		<?php
			// Loop para percorrer cada produto na lista de produtos
			for ($i = 0; $i < count($nomeproduto); $i++) {
				// Exibe o nome do produto na primeira linha
				echo "<tr class='top'>
						<td colspan='4'>{$nomeproduto[$i]}</td> <!-- Nome do produto -->
					</tr>";

				// Exibe o valor unitário, quantidade e valor total na segunda linha
				echo "<tr>
						<td>R$ {$valor_unitario[$i]}</td> <!-- Valor unitário -->
						<td>{$quantidade[$i]}</td> <!-- Quantidade -->
						<td class='right-align'>R$ " . number_format($valor_unitario[$i] * $quantidade[$i], 2, ',', '.') . "</td> <!-- Valor total -->
					</tr>";
			}
		?>


    </tbody>
    <tfoot>
        <tr class="sup ttu p--0">
            <td colspan="3">
                <b>Totais</b>
            </td>
        </tr>
        <tr class="ttu">
            <td colspan="2">Sub-total</td>
            <td class="right-align">R$ <?= number_format($valor_total, 2, ',', '.') ?></td>
        </tr>
        <!-- Outros totais podem ser adicionados -->
    </tfoot>
</table>

<script>
   document.addEventListener('DOMContentLoaded', function() {
    const currentDateTime = new Date();
    const formattedDateTime = currentDateTime.toLocaleString('pt-BR', {
        dateStyle: 'short',
        timeStyle: 'medium'
    });
    document.getElementById('datetime').textContent = formattedDateTime;
	});
</script>

</body>
</html>
