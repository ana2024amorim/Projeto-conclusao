
$(document).ready(function() {
    $.ajax({
        url: '../conector/cons_fabricante_veiculo_cad.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var select = $('#marca-fabricante');
            select.empty();
            select.append('<option value="">Selecione o Fabricante</option>');
            
            $.each(data, function(index, fabricante) {
                select.append('<option value="' + fabricante + '">' + fabricante + '</option>');
            });
        },
        error: function() {
            alert("Erro ao carregar os fabricantes.");
        }
    });
});

