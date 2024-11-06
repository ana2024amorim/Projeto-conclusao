
$(document).ready(function() {
    $.ajax({
        url: '../conector/cons_modelo_veiculo_cad.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var select = $('#modelo-carro');
            select.empty();
            select.append('<option value="">Selecione o Modelo</option>');
            
            $.each(data, function(index, modelo) {
                select.append('<option value="' + modelo + '">' + modelo + '</option>');
            });
        },
        error: function() {
            alert("Erro ao carregar os modelos.");
        }
    });
});

