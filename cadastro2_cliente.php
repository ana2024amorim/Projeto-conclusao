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
        <form id="client-form">
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
                    <input type="text" id="complemento" name="complemento">
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
                        <option value="Quinzenal">Quinzanal</option>
                    </select>
                </div>
            </div>
            <div class="button-container">
                <a href="pagina_venda.php" class="btn-back">Voltar</a>
                <button type="submit" id="submit-button" class="btn btn-primary">Enviar</button>
            </div>
        </form>
    </div>

  <!-- Modal de Sucesso 
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-success shadow-lg">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="successModalLabel">Sucesso!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                    </div>
                    <p class="text-center mt-3">Cadastro realizado com sucesso!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>-->

    <!-- Modal de Erro
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-danger shadow-lg">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="errorModalLabel">Erro!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="bi bi-x-circle-fill text-danger" style="font-size: 3rem;"></i>
                    </div>
                    <p class="text-center mt-3">Ocorreu um erro ao realizar o cadastro!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>  -->

    <!-- jQuery e Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    
    <script>
            $(document).ready(function () {
                // Máscaras
                $('#telefone').mask('(00) 00000-0000');
                $('#cep').mask('00000-000');

                // Máscara para CPF ou CNPJ dinâmico
                $('#cpf_cnpj').on('input', function () {
                    var valor = $(this).val().replace(/\D/g, ''); // Remove qualquer caractere não numérico

                    if (valor.length < 11) {
                        // Aplica a máscara de CPF
                        $(this).mask('000.000.000-00');
                    } else {
                        // Aplica a máscara de CNPJ
                        $(this).mask('00.000.000/0000-00');
                    }
                });

                // Validação de e-mail
                $('#email').on('input', function () {
                    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                    $(this).css('border-color', emailPattern.test($(this).val()) ? '' : 'red');
                });

                // Preenchimento de endereço com base no CEP
                $('#cep').on('blur', function () {
                    var cep = $(this).val().replace(/\D/g, '');
                    if (cep.length === 8) {
                        $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function (data) {
                            if (!("erro" in data)) {
                                $('#endereco').val(data.logradouro);
                                $('#bairro').val(data.bairro);
                                $('#cidade').val(data.localidade);
                                $('#uf').val(data.uf);
                            } else {
                                alert("CEP não encontrado.");
                            }
                        });
                    } else {
                        alert("CEP inválido.");
                    }
                });
            
        });
    </script>

<script>
    document.getElementById('submit-button').addEventListener('click', function (event) {
        event.preventDefault(); // Previne o comportamento padrão de submissão do formulário

        // Obtendo os campos necessários
        const cpfCnpj = document.getElementById('cpf_cnpj').value.trim();
        const razaoNome = document.getElementById('razao_nome').value.trim();

        

        // Verificação básica antes de enviar
        if (!cpfCnpj || !razaoNome) {
            alert('Preencha os campos obrigatórios: CPF/CNPJ e Razão/Nome.');
            return;
        }

        // Criando objeto para LocalStorage com os demais campos
        const clientData = {
            razao_nome: razaoNome,
            cpf_cnpj: cpfCnpj,
            cep: document.getElementById('cep').value.trim(),
            cidade: document.getElementById('cidade').value.trim(),
            endereco: document.getElementById('endereco').value.trim(),
            complemento: document.getElementById('complemento').value.trim(),
            bairro: document.getElementById('bairro').value.trim(),
            uf: document.getElementById('uf').value.trim(),
            telefone: document.getElementById('telefone').value.trim(),
            email: document.getElementById('email').value.trim(),
            rginscricao: document.getElementById('rginscricao').value.trim(),
            sitcad: document.getElementById('sitcad').value.trim()
        };

        // Armazenando os dados no LocalStorage
        localStorage.setItem('clientData', JSON.stringify(clientData));

        // Obtendo os dados do formulário para envio
        const formData = new FormData(document.getElementById('client-form'));

        // Enviando os campos CPF/CNPJ e Razão Nome para o servidor via POST
        const formData2 = new FormData();
        formData2.append('cpf', cpfCnpj);
        formData2.append('nome', razaoNome);

        fetch('PDF/gerar_pdf.php', {
            method: 'POST',
            body: formData2
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro na resposta do servidor');
            }
            return response.text();
        })
        .then(data => {
            alert('Dados enviados com sucesso!');
            console.log('Resposta do servidor:', data);

            // Redirecionando para a página de destino com os parâmetros codificados
            window.location.href = `PDF/gerar_qr.php?nome=${encodeURIComponent(razaoNome)}`;
        })
        .catch(error => {
            alert('Erro ao enviar os dados! Verifique a conexão e tente novamente.');
            console.error('Erro:', error);
        });
    });
</script>


</body>
</html>
