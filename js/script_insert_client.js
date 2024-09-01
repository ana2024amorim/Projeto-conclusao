$(document).ready(function () {
    $('#telefone').mask('(00)00000-0000');
    $('#cep').mask('00000-000');

    $('#email').on('input', function () {
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailPattern.test($(this).val())) {
            $(this).css('border-color', 'red');
        } else {
            $(this).css('border-color', '');
        }
    });

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

    var successModal = new bootstrap.Modal(document.getElementById('successModal'));
    var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));

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

    $('#successModal').on('hidden.bs.modal', function () {
        $('#client-form')[0].reset(); // Limpar o formulário
    });

    $('#errorModal').on('hidden.bs.modal', function () {
        // Lidar com o fechamento do modal de erro se necessário
    });
});
