<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
    <link rel="stylesheet" href="css/cadastro_cliente.css">
  
</head>
<body>
    <div class="container">
        <h1>Cadastro de Cliente</h1>
        <form action="conector/insert_client.php" method="POST">
            <div class="form-row">
                <div class="form-group col-50">
                    <label for="cpf_cnpj">CPF/CNPJ:</label>
                    <input type="text" id="cpf_cnpj" name="cpf_cnpj" required>
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
            <div class="button-container">
                <button type="submit">Enviar</button>
            </div>
        </form>
    </div>

        <!-- Adicionando jQuery e jQuery Mask Plugin -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

        <script>
            $(document).ready(function(){
                
                $('#telefone').mask('(00)00000-0000');
                $('#cep').mask('00000-000');
                

                // Validação básica para o campo de e-mail
                $('#email').on('input', function() {
                    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                    if (!emailPattern.test($(this).val())) {
                        $(this).css('border-color', 'red');
                    } else {
                        $(this).css('border-color', '');
                    }
                });
            
             // Preenchimento automático do endereço com base no CEP
                        $('#cep').on('blur', function() {
                var cep = $(this).val().replace(/\D/g, '');
                if (cep.length === 8) {
                    var url = `https://viacep.com.br/ws/${cep}/json/`;

                    $.getJSON(url, function(data) {
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
</body>
</html>
