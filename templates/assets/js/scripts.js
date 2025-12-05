$(document).ready(function () {
    $("#busca").keyup(function () {
        var busca = $(this).val();
        if (busca.length > 0) {
            $.ajax({
                url: $('form').attr('data-url-busca'),
                method: 'POST',
                data: { busca: busca },
                success: function (resultado) {
                    if (resultado.trim() !== "") {
                        $('#buscaResultado').html(resultado).show();
                    } else {
                        $('#buscaResultado').html('<div class="alert alert-warning">Nenhum resultado encontrado.</div>').show();
                    }
                }
            });
        } else {
            $('#buscaResultado').hide();
        }
    });

    // Ocultar sugestões ao clicar fora
    $(document).click(function(e) {
        if (!$(e.target).closest('#busca, #buscaResultado').length) {
            $('#buscaResultado').hide();
        }
    });

    // Mostrar sugestões ao focar no input se há conteúdo
    $("#busca").focus(function() {
        if ($(this).val() !== "" && $('#buscaResultado').html() !== "") {
            $('#buscaResultado').show();
        }
    });
});