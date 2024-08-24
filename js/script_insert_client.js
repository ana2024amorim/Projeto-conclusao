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

 // Preenchimento automático do endereço com base no CEP isso consome uma API dos correios
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