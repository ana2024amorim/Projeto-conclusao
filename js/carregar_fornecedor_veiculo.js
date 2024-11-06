

$(document).ready(function() {
    $.ajax({
        url: '../conector/cons_fornecedor_veiculo_cad.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            var select = $('#fornecedor1');
            select.empty();
            select.append('<option value="">Selecione o Fornecedor</option>');
            
            $.each(data, function(index, fornecedor) {
                select.append('<option value="' + fornecedor + '">' + fornecedor + '</option>');
            });
        },
        error: function() {
            alert("Erro ao carregar os fornecedores.");
        }
    });
});

