$(document).ready(function () {
    // Máscaras para telefone, CEP e CPF/CNPJ
    $('#telefone').mask('(00) 00000-0000');
    $('#cep').mask('00000-000');
    $('#cpf_cnpj').mask('000.000.000-00');

    // Validação de e-mail
    $('#email').on('input', function () {
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailPattern.test($(this).val())) {
            $(this).css('border-color', 'red');
        } else {
            $(this).css('border-color', '');
        }
    });

    // Preenchimento de endereço com base no CEP
    $('#cep').on('blur', function () {
        var cep = $(this).val().replace(/\D/g, '');
        if (cep.length === 8) {
            var url = `https://viacep.com.br/ws/${cep}/json/`;
            $.getJSON(url, function (data) {
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

    // Referências aos modais
    var successModal = new bootstrap.Modal(document.getElementById('successModal'));
    var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));

    // Lógica de envio do formulário com AJAX
    $('#client-form').on('submit', function (event) {
        event.preventDefault();
        var formData = new FormData(this);

        fetch('conector/insert_client.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text()) // Receber resposta como texto
        .then(text => {
            if (text.trim() === 'Cadastro realizado com sucesso!') {
                successModal.show();
            } else {
                console.error('Erro:', text);
                errorModal.show();
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            errorModal.show();
        });
    });

    // Reset do formulário após fechar o modal de sucesso
    $('#successModal').on('hidden.bs.modal', function () {
        $('#client-form')[0].reset();
    });

    // Ações adicionais para fechamento do modal de erro, se necessário
    $('#errorModal').on('hidden.bs.modal', function () {
        // Ações adicionais para o modal de erro
    });
});
