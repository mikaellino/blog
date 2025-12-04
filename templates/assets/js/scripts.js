$(document).ready(function () {
    $("#busca").keyup(function () {
        var busca = $(this).val();
        if (busca !== "") {
            $.ajax({
                url: $('form').attr('data-url-busca'),
                method: 'POST',
                data: { busca: busca },
                success: function (data) {
                    if (data.trim() !== "") {
                        $('#buscaResultado').html(data).show();
                    } else {
                        $('#buscaResultado').hide();
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