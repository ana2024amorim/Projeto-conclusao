<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    width: 80%;
    max-width: 1000px;
    box-sizing: border-box;
}

h1 {
    text-align: center;
    color: #333333;
    margin-bottom: 20px;
}

.list-group {
    margin-bottom: 30px;
}

.list-group-item {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    padding: 10px;
    border-radius: 4px;
    margin-bottom: 10px;
    font-size: 1.1rem;
}

strong {
    color: #555;
}

.d-flex {
    margin-top: 20px;
}

button, .btn {
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    width: 45%;
    text-align: center;
}

button:hover, .btn:hover {
    opacity: 0.9;
}

.btn-secondary {
    background-color: #7e6868;
    color: white;
}

.btn-primary {
    background-color: #4CAF50;
    color: white;
}

.btn-secondary:hover {
    background-color: #6d5c5c;
}

.btn-primary:hover {
    background-color: #45a049;
}

.alert-warning {
    color: #856404;
    background-color: #fff3cd;
    border-color: #ffeeba;
    padding: 15px;
    border-radius: 4px;
    font-size: 1rem;
    margin-top: 20px;
}

/* Responsividade */
@media (max-width: 768px) {
    .container {
        padding: 20px;
    }

    h1 {
        font-size: 24px;
    }

    .d-flex {
        flex-direction: column;
        align-items: center;
    }

    .d-flex button {
        width: 100%;
        margin-bottom: 10px;
    }
}

@media (max-width: 480px) {
    .container {
        padding: 15px;
    }

    h1 {
        font-size: 20px;
    }
}

</style>

</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Cadastro do Cliente</h1>
        <div id="client-details" class="list-group">
            <!-- Os detalhes do cliente serão exibidos aqui -->
        </div>
        <div class="d-flex justify-content-between mt-4">
            <a href="pagina_venda.php" class="btn btn-secondary">Voltar</a>
            <button id="send-data" class="btn btn-primary">Enviar Dados</button>
        </div>
    </div>

    <script>
    // Recuperando os dados armazenados no localStorage
    const clientData = JSON.parse(localStorage.getItem('clientData'));

    // Verificando se os dados existem no localStorage
    if (clientData) {
        // Exibindo os dados do cliente
        const clientDetailsContainer = document.getElementById('client-details');
        
        clientDetailsContainer.innerHTML = `
            <div class="list-group-item">
                <strong>CPF/CNPJ:</strong> ${clientData.cpf_cnpj}
            </div>
            <div class="list-group-item">
                <strong>Razão Social/Nome:</strong> ${clientData.razao_nome}
            </div>
            <div class="list-group-item">
                <strong>CEP:</strong> ${clientData.cep}
            </div>
            <div class="list-group-item">
                <strong>Cidade:</strong> ${clientData.cidade}
            </div>
            <div class="list-group-item">
                <strong>Endereço:</strong> ${clientData.endereco}
            </div>
            <div class="list-group-item">
                <strong>Complemento:</strong> ${clientData.complemento || 'Não Informado'}
            </div>
            <div class="list-group-item">
                <strong>Bairro:</strong> ${clientData.bairro}
            </div>
            <div class="list-group-item">
                <strong>UF:</strong> ${clientData.uf}
            </div>
            <div class="list-group-item">
                <strong>Telefone:</strong> ${clientData.telefone}
            </div>
            <div class="list-group-item">
                <strong>E-mail:</strong> ${clientData.email}
            </div>
            <div class="list-group-item">
                <strong>RG/Inscrição:</strong> ${clientData.rginscricao}
            </div>
            <div class="list-group-item">
                <strong>Situação Cadastro:</strong> ${clientData.sitcad}
            </div>
        `;
        
        // Evento de envio dos dados
        document.getElementById('send-data').addEventListener('click', function () {
            // Enviando os dados para o PHP via POST
            fetch('conector/insert2_cliente.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json', // Envia os dados no formato JSON
                },
                body: JSON.stringify(clientData) // Envia os dados recuperados como JSON
            })
            .then(response => response.json())
            .then(data => {
                if (data.sucesso) { // Verificando o retorno de sucesso
                    alert('Dados enviados com sucesso!');
                    // Redirecionar ou realizar outra ação após sucesso
                    window.location.href = "cadastro2_cliente.php"; // Exemplo de redirecionamento
                } else {
                    alert('Erro ao enviar os dados: ' + data.mensagem); // Exibe a mensagem de erro retornada
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('Erro ao enviar os dados! Por favor, tente novamente mais tarde.');
            });
        });
    } else {
        // Caso os dados não sejam encontrados no localStorage
        document.getElementById('client-details').innerHTML = `
            <div class="alert alert-warning" role="alert">
                Nenhum dado de cliente encontrado!
            </div>
        `;
    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
