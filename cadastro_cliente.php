<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
    <link rel="stylesheet" href="css/cadastro_cliente.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Estilos adicionais para o botão Voltar */
        .button-container {
            display: flex;
            justify-content: space-between; /* Espaçamento entre os botões */
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #4CAF50; /* Cor verde para o botão de enviar */
            color: white;
        }

        .btn-primary:hover {
            background-color: #45a049;
        }

        .btn-back {
            background-color: #f44336; /* Cor vermelha para o botão de voltar */
            color: white;
        }

        .btn-back:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cadastro de Cliente</h1>
        <form id="client-form" action="conector/insert_client.php" method="POST">
            <div class="form-row">
                <div class="form-group col-50">
                    <label for="cpf_cnpj">CPF/CNPJ:</label>
                    <input type="text" id="cpf_cnpj" name="cpf_cnpj" required placeholder="Digite CPF ou CNPJ">
                </div>
                <div class="form-group col-50">
                    <label for="razao_nome">Razão Social/Nome:</label>
                    <input type="text" id="razao_nome" name="razao_nome" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-50">
                    <label for="cep">CEP:</label>
                    <input type="text" id="cep" name="cep" required>
                </div>
                <div class="form-group col-50">
                    <label for="cidade">Cidade:</label>
                    <input type="text" id="cidade" name="cidade" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-50">
                    <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco" required>
                </div>
                <div class="form-group col-50">
                    <label for="complemento">Complemento:</label>
                    <input type="text" id="complemento" name="complemento" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-50">
                    <label for="bairro">Bairro:</label>
                    <input type="text" id="bairro" name="bairro" required>
                </div>
                <div class="form-group col-50">
                    <label for="uf">UF:</label>
                    <input type="text" id="uf" name="uf" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-50">
                    <label for="telefone">Telefone com DDD:</label>
                    <input type="tel" id="telefone" name="telefone" required>
                </div>
                <div class="form-group col-50">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-50">
                    <label for="rginscricao">RG/Inscrição:</label>
                    <input type="text" id="rginscricao" name="rginscricao" required>
                </div>
                <div class="form-group col-50">
                    <label for="sitcad">Situação Cad:</label>
                    <input type="text" id="sitcad" name="sitcad" required>
                </div>
            </div>
            <div class="button-container">
                <a href="pagina_venda.php" class="btn btn-back">Voltar</a>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>
    </div>

    <!-- Modal de Sucesso -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">
                        <i class="fas fa-check-circle"></i> Sucesso
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Cadastro realizado com sucesso!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Erro -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">
                        <i class="fas fa-exclamation-circle"></i> Erro
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Ocorreu um erro ao realizar o cadastro. Tente novamente.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery e Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Script personalizado -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="js/script_insert_client.js"></script>
</body>
</html>
