<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Cadastro de Cliente</h1>
        <form id="client-form">
            <!-- Primeira linha -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="cpf_cnpj" class="form-label">CPF/CNPJ:</label>
                    <input type="text" id="cpf_cnpj" name="cpf_cnpj" class="form-control" required placeholder="Digite CPF ou CNPJ">
                </div>
                <div class="col-md-4">
                    <label for="razao_nome" class="form-label">Razão Social/Nome:</label>
                    <input type="text" id="razao_nome" name="razao_nome" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="cep" class="form-label">CEP:</label>
                    <input type="text" id="cep" name="cep" class="form-control" required placeholder="xx.xxx-xxx">
                </div>
            </div>

            <!-- Segunda linha -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="cidade" class="form-label">Cidade:</label>
                    <input type="text" id="cidade" name="cidade" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="endereco" class="form-label">Endereço:</label>
                    <input type="text" id="endereco" name="endereco" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="complemento" class="form-label">Complemento:</label>
                    <input type="text" id="complemento" name="complemento" class="form-control">
                </div>
            </div>

            <!-- Terceira linha -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="bairro" class="form-label">Bairro:</label>
                    <input type="text" id="bairro" name="bairro" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="uf" class="form-label">UF:</label>
                    <input type="text" id="uf" name="uf" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="telefone" class="form-label">Telefone com DDD:</label>
                    <input type="tel" id="telefone" name="telefone" class="form-control" required placeholder="(XX) 9XXXX-XXXX">
                </div>
            </div>

            <!-- Quarta linha -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="email" class="form-label">E-mail:</label>
                    <input type="email" id="email" name="email" class="form-control" required placeholder="email@dominio.com">
                </div>
                <div class="col-md-4">
                    <label for="rginscricao" class="form-label">RG/Inscrição:</label>
                    <input type="text" id="rginscricao" name="rginscricao" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="sitcad" class="form-label">Situação Cad:</label>
                    <select id="sitcad" name="sitcad" class="form-select" required>
                        <option value="Ativo">Ativo</option>
                        <option value="Desativado">Desativado</option>
                        <option value="Semanal">Semanal</option>
                        <option value="Quinzanal">Quinzanal</option>
                    </select>
                </div>
            </div>

            <!-- Botões -->
            <div class="d-flex justify-content-between">
                <a href="pagina_venda.php" class="btn btn-secondary">Voltar</a>
                <button type="button" id="submit-button" class="btn btn-primary">Enviar</button>
            </div>
        </form>
    </div>

    <script>
    document.getElementById('submit-button').addEventListener('click', function () {
        // Obtendo os campos necessários
        const cpfCnpj = document.getElementById('cpf_cnpj').value;
        const razaoNome = document.getElementById('razao_nome').value;

        // Criando objeto para LocalStorage com os demais campos
        const clientData = {
            cep: document.getElementById('cep').value,
            cidade: document.getElementById('cidade').value,
            endereco: document.getElementById('endereco').value,
            complemento: document.getElementById('complemento').value,
            bairro: document.getElementById('bairro').value,
            uf: document.getElementById('uf').value,
            telefone: document.getElementById('telefone').value,
            email: document.getElementById('email').value,
            rginscricao: document.getElementById('rginscricao').value,
            sitcad: document.getElementById('sitcad').value
        };

        // Armazenando os dados no LocalStorage
        localStorage.setItem('clientData', JSON.stringify(clientData));

        // Enviando os campos CPF/CNPJ e Razão Nome para o servidor via POST
        const formData = new FormData();
        formData.append('cpf', cpfCnpj);
        formData.append('nome', razaoNome);

        fetch('PDF/gerar_pdf.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert('Dados enviados com sucesso!');
            console.log(data); // Para depuração

            // Redirecionando para a página de destino com o parâmetro nome
            window.location.href = `PDF/gerar_qr.php?nome=${encodeURIComponent(razaoNome)}`;
        })
        .catch(error => {
            alert('Erro ao enviar os dados!');
            console.error(error);
        });
    });
</script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
