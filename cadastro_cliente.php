<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
    <link rel="stylesheet" href="css/cadastro_cliente.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container">
        <h1>Cadastro de Cliente</h1>
        <form id="client-form" action="conector/insert_client.php" method="POST">
            <div class="form-row">
                <div class="form-group">
                    <label for="cpf_cnpj">CPF/CNPJ:</label>
                    <input type="text" id="cpf_cnpj" name="cpf_cnpj" required placeholder="Digite CPF ou CNPJ">
                </div>
                <div class="form-group">
                    <label for="razao_nome">Razão Social/Nome:</label>
                    <input type="text" id="razao_nome" name="razao_nome" required>
                </div>
                <div class="form-group">
                    <label for="cep">CEP:</label>
                    <input type="text" id="cep" name="cep" required placeholder="xx.xxx-xxx">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="cidade">Cidade:</label>
                    <input type="text" id="cidade" name="cidade" required>
                </div>
                <div class="form-group">
                    <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco" required>
                </div>
                <div class="form-group">
                    <label for="complemento">Complemento:</label>
                    <input type="text" id="complemento" name="complemento" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="bairro">Bairro:</label>
                    <input type="text" id="bairro" name="bairro" required>
                </div>
                <div class="form-group">
                    <label for="uf">UF:</label>
                    <input type="text" id="uf" name="uf" required>
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone com DDD:</label>
                    <input type="tel" id="telefone" name="telefone" required placeholder="(XX) 9XXXX-XXXX">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required placeholder="email@dominio.com">
                </div>
                <div class="form-group">
                    <label for="rginscricao">RG/Inscrição:</label>
                    <input type="text" id="rginscricao" name="rginscricao" required>
                </div>
                <div class="form-group">
                    <label for="sitcad">Situação Cad:</label>
                    <select id="sitcad" name="sitcad" required>
                        <option value="Ativo">Ativo</option>
                        <option value="Desativado">Desativado</option>
                        <option value="Semanal">Semanal</option>
                        <option value="Quinzanal">Quinzanal</option>
                    </select>
                </div>
            </div>
            <div class="button-container">
                <a href="pagina_venda.php" class="btn-back">Voltar</a>
                <button type="submit" class="btn-primary">Enviar</button>
            </div>
        </form>
    </div>

    <!-- Modal de Sucesso -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-success shadow-lg">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="successModalLabel">Sucesso!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                    </div>
                    <p class="text-center mt-3">Cadastro realizado com sucesso!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Erro -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-danger shadow-lg">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="errorModalLabel">Erro!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="bi bi-x-circle-fill text-danger" style="font-size: 3rem;"></i>
                    </div>
                    <p class="text-center mt-3">Ocorreu um erro ao realizar o cadastro!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery e Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script>
        // Máscaras de CPF, CNPJ e outros campos
        $(document).ready(function () {
            $('#cpf_cnpj').keydown(function () {
                try {
                    $(this).unmask();
                } catch (e) {}
                var tamanho = $(this).val().length;
                if (tamanho < 11) {
                    $(this).mask("999.999.999-99"); // CPF
                } else {
                    $(this).mask("99.999.999/9999-99"); // CNPJ
                }
            }).trigger('keydown');
            $('#cep').mask('00000-000');
            $('#telefone').mask('(00) 00000-0000');
        });

        // Lógica de envio do formulário
        $('#client-form').on('submit', function (event) {
            event.preventDefault();

            var formData = new FormData(this); // Coleta os dados do formulário

            fetch('conector/insert_client.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json()) // Receber resposta como JSON
            .then(data => {
                // Verifica a mensagem retornada pelo PHP
                if (data.mensagem === 'Cadastro realizado com sucesso!') {
                    $('#successModal').modal('show'); // Exibe o modal de sucesso
                } else {
                    $('#errorModal').modal('show'); // Exibe o modal de erro
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                $('#errorModal').modal('show'); // Exibe o modal de erro em caso de outro erro
            });
        });

        // Fechar o modal de erro
        $('#errorModal').on('hidden.bs.modal', function () {
            // Lógica adicional, se necessário
        });
        
    // Função para limpar o formulário e fechar o modal de erro
        function closeErrorModal() {
            // Limpa o formulário
            $('#client-form')[0].reset();

            // Fecha o modal de erro
            $('#errorModal').modal('hide');
        }

        // Associa a função ao evento de clique do botão "Fechar" do modal de erro
        $('#errorModal .btn-close').on('click', closeErrorModal);
        $('#errorModal .btn-light').on('click', closeErrorModal); // Caso o botão "Fechar" tenha a classe "btn-light"
    </script>
</body>
</html>
