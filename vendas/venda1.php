<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Cadastro</title>
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
            <label for="nome-peca">Nome da Produto:</label>
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
            <label for="modelo-carro">Modelo Carro:</label>
            <input type="text" id="modelo-carro" name="modelo_carro" required>
        </div>

        <div class="form-group">
            <label for="marca-fabricante">Marca do Fabricante:</label>
            <input type="text" id="marca-fabricante" name="marca_fabricante" required>
        </div>

        <div class="form-group">
            <label for="descricao-peca">Descrição Peça:</label>
            <input type="text" id="descricao-peca" name="descricao_peca" required>
        </div>
        
        <div class="button-group">
            <button type="submit">Cadastrar</button>
        </div>
    </form>
</div>

    <!--  consulta   -->
 
 
<div class="form-section active" id="tab1">
    <h3>Produtos Cadastrados</h3>

    <div class="table-container">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>Código do Produto</th>
                    <th>Nome da Peça</th>
                    <th>Preço</th>
                    <th>Peso</th>
                    <th>Fornecedor</th> <!-- Nova coluna para Fornecedor -->
                    <th>Modelo do Carro</th> <!-- Nova coluna para Modelo do Carro -->
                    <th>Ação</th> <!-- Nova coluna para ações -->
                </tr>
            </thead>
            <tbody id="product-table">
                <!-- Produtos cadastrados no banco aparecerão aqui -->
                <?php 
                // Aqui você inclui o script que busca os produtos
                include 'consulta_produtos.php'; 
                // Lógica de inclusão deve incluir também a coluna de edição
                ?>
            </tbody>
        </table>
    </div>

    <style>
        .table-container {
            max-height: 400px; /* Altura máxima para a tabela com barra de rolagem */
            overflow-y: auto; /* Adiciona rolagem vertical */
            border: 1px solid #000; /* Borda para a tabela */
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #D3D3D3; /* Cor de fundo para cabeçalho */
        }
        tr:nth-child(even) {
            background-color: #F2F2F2; /* Cor de fundo para linhas pares */
        }
        .edit-icon {
            cursor: pointer;
            color: #008CBA; /* Cor do ícone */
        }
    </style>
</div>



    <!-- Tab 2: Consulta Veículo -->
    <div class="form-section" id="tab2">
        <div class="form-group">
            <label for="carros">Carros:</label>
            <input type="text" id="carros">
        </div>
        <div class="form-group">
            <label for="ano">Ano:</label>
            <input type="text" id="ano">
        </div>
        <div class="form-group">
            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo">
        </div>
        <div class="form-group">
            <label for="fabricante-veiculo">Fabricante:</label>
            <input type="text" id="fabricante-veiculo">
        </div>
        <div class="button-group">
            <button>Salvar</button>
            <button>Novo</button>
        </div>
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
            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" required>
        </div>
        <div class="form-group">
            <label for="bairro">Bairro:</label>
            <input type="text" id="bairro" name="bairro" required>
        </div>
        <div class="form-group">
            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" name="cidade" required>
        </div>
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>
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
            <label for="estado">Estado:</label>
            <input type="text" id="estado" name="estado" required>
        </div>
        <div class="button-group">
            <button type="submit">Salvar</button>
        </div>
    </form>
</div>

<!-- Tab 4: Cadastro Veiculo -->
<div class="form-section" id="tab4">
    <form action="../conector/inserir_veiculo.php" method="POST"> <!-- Ação para o script PHP -->
        <div class="form-group">
            <label for="carros">Veículo:</label>
            <input type="text" id="carros" name="veiculo" required>
        </div>
        <div class="form-group">
            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" required>
        </div>
        <div class="form-group">
            <label for="ano">Ano:</label>
            <input type="text" id="ano" name="ano" required>
        </div>
        <div class="form-group">
            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" required>
        </div>
        <div class="form-group">
            <label for="fabricante-veiculo">Fabricante:</label>
            <input type="text" id="fabricante-veiculo" name="fabricante" required>
        </div>
        <div class="button-group">
            <button type="submit">Salvar</button>
        </div>
    </form>
</div>



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
