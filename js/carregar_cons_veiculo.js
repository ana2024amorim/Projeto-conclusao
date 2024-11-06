

$(document).ready(function() {
    $.ajax({
        url: '../conector/cons_veiculo_cad.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var select = $('#fabricante-carro');
            select.empty();
            select.append('<option value="">Selecione a Marca</option>');
            
            $.each(data, function(index, veiculo) {
                select.append('<option value="' + veiculo + '">' + veiculo + '</option>');
            });
        },
        error: function() {
            alert("Erro ao carregar os veículos.");
        }
    });
});

