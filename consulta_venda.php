<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Vendas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .container { margin-top: 30px; }
        .search-box {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .table-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .table th { background-color: #007bff; color: white; }
        .icon-btn { cursor: pointer; color: #007bff; }
        .modal-header { background-color: #007bff; color: white; }
        /* Alinhar o campo de Total à direita */
        /* Alinhar os valores à direita */
        #vendaDetailsModal .modal-body .row .col-6:last-child {
            text-align: right;
        }

        /* Opcional: Melhorar a aparência e garantir que o total se destaque */
        #modalTotal {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="search-box">
            <h3>Consulta de Vendas</h3>
            <form id="searchForm" class="row g-3">
                <div class="col-md-6">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome do cliente">
                </div>
                <div class="col-md-6">
                    <label for="cpfCnpj" class="form-label">CPF/CNPJ</label>
                    <input type="text" class="form-control" id="cpfCnpj" name="cpfCnpj" placeholder="Digite o CPF/CNPJ">
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </form>
        </div>

        <div class="table-container">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF/CNPJ</th>
                        <th>Data da Venda</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="vendasTable">
                    <tr>
                        <td colspan="4" class="text-center">Nenhuma venda encontrada.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

   <!-- Modal de detalhes da venda -->
   <div class="modal fade" id="vendaDetailsModal" tabindex="-1" aria-labelledby="vendaDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="vendaDetailsModalLabel">Detalhes da Venda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulário ou Cupom Fiscal -->
                <div class="container">
                    <!-- Dados da venda -->
                    <div class="row">
                        <div class="col-6">
                            <strong>Nome:</strong>
                        </div>
                        <div class="col-6">
                            <span id="modalNome"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <strong>CPF/CNPJ:</strong>
                        </div>
                        <div class="col-6">
                            <span id="modalCpfCnpj"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <strong>Data da Venda:</strong>
                        </div>
                        <div class="col-6">
                            <span id="modalDataVenda"></span>
                        </div>
                    </div>
                    <hr> <!-- Linha divisória -->
                    <!-- Produtos vendidos -->
                    <div class="row">
                        <div class="col-12">
                            <strong>Produtos:</strong>
                        </div>
                    </div>
                    <ul id="modalProdutos" class="list-unstyled">
                        <!-- Os produtos serão adicionados aqui -->
                    </ul>
                    <hr> <!-- Linha divisória -->
                    <!-- Total -->
                    <div class="row">
                        <div class="col-6">
                            <strong>Total:</strong>
                        </div>
                        <div class="col-6">
                            <span id="modalTotal"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>



    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script> <!-- jQuery Mask Plugin -->
    
    <script>
    $(document).ready(function () {
        let timeout = null; // Variável para armazenar o timeout

        // Máscara para o campo de CPF/CNPJ
        $('#cpfCnpj').keydown(function () {
            var $this = $(this);

            try {
                $this.unmask(); // Remove qualquer máscara existente
            } catch (e) {}

            var tamanho = $this.val().length;

            // Aplica a máscara correta com base no tamanho da entrada
            if (tamanho < 11) {
                $this.mask("999.999.999-99"); // Máscara para CPF
            } else {
                $this.mask("99.999.999/9999-99"); // Máscara para CNPJ
            }

            // Ajustando foco
            var elem = this;
            setTimeout(function () {
                elem.selectionStart = elem.selectionEnd = 10000;
            }, 0);

            // Reaplico o valor para mudar o foco
            var currentValue = $this.val();
            $this.val('');
            $this.val(currentValue);
        }).trigger('keydown'); // Aplica a máscara ao carregar a página
    });
</script>





   <script>
     
     
    // Submissão do formulário de busca
    document.getElementById("searchForm").addEventListener("submit", function (e) {
        e.preventDefault();

        const nome = document.getElementById("nome").value.trim();
        const cpfCnpj = document.getElementById("cpfCnpj").value.trim();

        // Garante que o campo cliente_cpfcnpj seja vazio caso não tenha valor
        const searchData = {
            cliente_nome: nome,
            cliente_cpfcnpj: cpfCnpj || "" // Se não houver CPF/CNPJ, passa uma string vazia
        };

        console.log("Dados enviados para a pesquisa:", searchData); // Verifica os dados antes de enviar

        fetch("conector/pesquisa_vendas_concluida.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(searchData), // Enviando os dados como JSON
        })
        .then((response) => response.json())
        .then((data) => atualizarTabela(data))
        .catch((error) => {
            console.error("Erro ao buscar vendas:", error);
            alert("Erro ao realizar a busca. Tente novamente.");
        });
    });

    // Função para preencher a tabela com os dados
    function atualizarTabela(vendas) {
    const tabela = document.getElementById("vendasTable");
    tabela.innerHTML = "";

    if (!vendas || vendas.length === 0) {
        tabela.innerHTML = `<tr><td colspan="4" class="text-center">Nenhuma venda encontrada.</td></tr>`;
        return;
    }

    vendas.forEach((venda) => {
        const tr = document.createElement("tr");
        tr.innerHTML = `
            <td>${venda.cliente_nome}</td>
            <td>${venda.cliente_cpfcnpj}</td>
            <td>${new Date(venda.data_compra).toLocaleDateString()}</td>
            <td class="text-center">
                <span 
                    class="icon-btn" 
                    onclick="openVendaDetails(this)" 
                    data-ids="${venda.ids_concatenados}">
                    <i class="bi bi-eye"></i>
                </span>
            </td>
        `;
        tabela.appendChild(tr);
    });
}


    // Função para abrir o modal com detalhes da venda
        // Função para abrir o modal com detalhes da venda
function openVendaDetails(element) {
    const idsConcatenados = element.getAttribute("data-ids"); // Obtém os IDs concatenados
    console.log("Abrindo detalhes para os IDs concatenados:", idsConcatenados);

    fetch("conector/detalhes_venda.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ ids_concatenados: idsConcatenados }) // Enviando os IDs concatenados como JSON
    })
    .then((response) => response.json())
    .then((data) => {
        console.log("Dados recebidos:", data); // Verifique a resposta no console

        if (!data || data.error) {
            alert("Detalhes da venda não encontrados ou dados incompletos.");
            return;
        }

        // Atualizando o modal com os dados da venda
        document.getElementById("modalNome").innerText = data[0].cliente_nome;
        document.getElementById("modalCpfCnpj").innerText = data[0].cliente_cpfcnpj;
        document.getElementById("modalDataVenda").innerText = new Date(data[0].data_compra).toLocaleDateString();
        
        // Limpar lista de produtos antes de adicionar
        const produtosList = document.getElementById("modalProdutos");
        produtosList.innerHTML = "";
        
        let totalVenda = 0; // Variável para acumular o total

        // Adicionar os produtos ao modal
        data.forEach((venda) => {
            venda.produtos.forEach((produto) => {
                const li = document.createElement("li");
                const totalProduto = produto.quantidade * parseFloat(produto.valor_unitario); // Calcula o valor total do produto
                li.textContent = `${produto.produto_nome} - ${produto.quantidade}x - R$ ${parseFloat(produto.valor_unitario).toFixed(2)} (Total: R$ ${totalProduto.toFixed(2)})`;
                produtosList.appendChild(li);

                totalVenda += totalProduto; // Acumula o valor total
            });
        });

        // Atualizar o total no modal
        document.getElementById("modalTotal").innerText = totalVenda.toFixed(2);

        const modal = new bootstrap.Modal(document.getElementById("vendaDetailsModal"));
        modal.show();
    })
    .catch((error) => {
        console.error("Erro ao buscar detalhes da venda:", error);
        alert("Erro ao carregar os detalhes da venda. Tente novamente.");
    });
}




</script>

</body>
</html>
