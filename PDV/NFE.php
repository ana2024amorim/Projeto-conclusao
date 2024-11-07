<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo - NFE</title>
    <style>
        /* Definindo cores e ajustes de padding */
        .color-gray { color: #BCBCBC; }
        .text-center { text-align: center; }
        .ttu { text-transform: uppercase; }
        
        /* Estilo do recibo */
        .printer-ticket {
            width: 100%;
            max-width: 400px;
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

<!-- Estrutura do recibo -->
<table class="printer-ticket">
 	<thead>
		<tr>
			<th class="title" colspan="3">Guardian Cotrol</th>
		</tr>
		<tr>
			<th colspan="3">17/11/2015 - 11:57:52</th>
		</tr>
		<tr>
			<th colspan="3">
				Nome do cliente <br />
				000.000.000-00
			</th>
		</tr>
		<tr>
			<th class="ttu" colspan="3">
				<b>Cupom não fiscal</b>
			</th>
		</tr>
	</thead>
	<tbody>
		<tr class="top">
			<td colspan="3">Doce de brigadeiro</td>
		</tr>
		<tr>
			<td>R$7,99</td>
			<td>2.0</td>
			<td class="right-align">R$15,98</td>
		</tr>
		<tr>
			<td colspan="3">Opcional Adicional: grande</td>
		</tr>
		<tr>
			<td>R$0,33</td>
			<td>2.0</td>
			<td class="right-align">R$0,66</td>
		</tr>
	</tbody>
	<tfoot>
		<tr class="sup ttu p--0">
			<td colspan="3">
				<b>Totais</b>
			</td>
		</tr>
		<tr class="ttu">
			<td colspan="2">Sub-total</td>
			<td class="right-align">R$43,60</td>
		</tr>
		<tr class="ttu">
			<td colspan="2">Taxa de serviço</td>
			<td class="right-align">R$4,60</td>
		</tr>
		<tr class="ttu">
			<td colspan="2">Desconto</td>
			<td class="right-align">5,00%</td>
		</tr>
		<tr class="ttu">
			<td colspan="2">Total</td>
			<td class="right-align">R$45,56</td>
		</tr>
		<tr class="sup ttu p--0">
			<td colspan="3">
				<b>Pagamentos</b>
			</td>
		</tr>
		<tr class="ttu">
			<td colspan="2">Voucher</td>
			<td class="right-align">R$10,00</td>
		</tr>
		<tr class="ttu">
			<td colspan="2">Dinheiro</td>
			<td class="right-align">R$10,00</td>
		</tr>
		<tr class="ttu">
			<td colspan="2">Total pago</td>
			<td class="right-align">R$10,00</td>
		</tr>
		<tr class="ttu">
			<td colspan="2">Troco</td>
			<td class="right-align">R$0,44</td>
		</tr>
		<tr class="sup">
			<td colspan="3" class="text-center">
				<b>Pedido:</b>
			</td>
		</tr>
		<tr class="sup">
			<td colspan="3" class="text-center">
				www.site.com
			</td>
		</tr>
	</tfoot>
</table>

</body>
</html>
