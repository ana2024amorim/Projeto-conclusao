<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 20px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .filter-section {
            margin-bottom: 20px;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .img-thumbnail {
            width: 100px; /* Ajuste o tamanho da imagem conforme necessário */
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Consulta de Produtos</h2>

        <!-- Formulário de Filtro -->
        <div class="filter-section">
            <div class="row">
                <div class="col-md-3">
                    <label for="filter-supplier" class="form-label">Fornecedor:</label>
                    <select id="filter-supplier" class="form-select">
                        <option value="">Selecione um fornecedor</option>
                        <option value="fornecedor1">Fornecedor 1</option>
                        <option value="fornecedor2">Fornecedor 2</option>
                        <!-- Adicione mais opções conforme necessário -->
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="filter-brand" class="form-label">Marca Fabricante:</label>
                    <select id="filter-brand" class="form-select">
                        <option value="">Selecione uma marca</option>
                        <option value="marca1">Marca 1</option>
                        <option value="marca2">Marca 2</option>
                        <!-- Adicione mais opções conforme necessário -->
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="filter-vehicle" class="form-label">Veículo:</label>
                    <select id="filter-vehicle" class="form-select">
                        <option value="">Selecione um veículo</option>
                        <option value="veiculo1">Veículo 1</option>
                        <option value="veiculo2">Veículo 2</option>
                        <!-- Adicione mais opções conforme necessário -->
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="filter-year" class="form-label">Ano:</label>
                    <select id="filter-year" class="form-select">
                        <option value="">Selecione um ano</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <!-- Adicione mais opções conforme necessário -->
                    </select>
                </div>
            </div>
            <button class="btn btn-primary mt-3" onclick="applyFilter()">Aplicar Filtros</button>
        </div>

        <!-- Tabela de Produtos -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Código Produto</th>
                    <th>Fornecedor</th>
                    <th>Valor Varejo</th>
                    <th>Descrição da Peça</th>
                    <th>Imagem</th>
                </tr>
            </thead>
            <tbody id="product-table-body">
                <!-- Os produtos serão inseridos aqui via JavaScript -->
            </tbody>
        </table>
    </div>

    <script>
        // Simulação de dados de produtos
        const products = [
            { code: '001', supplier: 'Fornecedor 1', retailPrice: 50.0, description: 'Peça A', image: 'https://via.placeholder.com/100' },
            { code: '002', supplier: 'Fornecedor 2', retailPrice: 75.0, description: 'Peça B', image: 'https://via.placeholder.com/100' },
            { code: '003', supplier: 'Fornecedor 1', retailPrice: 100.0, description: 'Peça C', image: 'https://via.placeholder.com/100' },
            { code: '004', supplier: 'Fornecedor 2', retailPrice: 150.0, description: 'Peça D', image: 'https://via.placeholder.com/100' },
        ];

        // Função para aplicar filtros
        function applyFilter() {
            const supplier = document.getElementById('filter-supplier').value;
            const brand = document.getElementById('filter-brand').value;
            const vehicle = document.getElementById('filter-vehicle').value;
            const year = document.getElementById('filter-year').value;

            const filteredProducts = products.filter(product => {
                return (!supplier || product.supplier === supplier) &&
                       (!brand || product.brand === brand) &&
                       (!vehicle || product.vehicle === vehicle) &&
                       (!year || product.year === year);
            });

            renderProducts(filteredProducts);
        }

        // Função para renderizar produtos na tabela
        function renderProducts(products) {
            const productTableBody = document.getElementById('product-table-body');
            productTableBody.innerHTML = '';

            products.forEach(product => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${product.code}</td>
                    <td>${product.supplier}</td>
                    <td>R$ ${product.retailPrice.toFixed(2)}</td>
                    <td>${product.description}</td>
                    <td><img src="${product.image}" class="img-thumbnail" alt="${product.description}"></td>
                `;
                productTableBody.appendChild(row);
            });
        }

        // Renderiza todos os produtos ao carregar a página
        document.addEventListener('DOMContentLoaded', () => {
            renderProducts(products);
        });
    </script>
</body>

</html>
