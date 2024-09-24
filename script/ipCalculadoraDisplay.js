$(document).ready(function () {
    $('#calculadora-form').submit(function (event) {
        event.preventDefault(); // Evita o envio do formulário padrão

        // Obtenha os valores dos campos
        var ip = $('#ip').val();
        var subrede = parseInt($('#subrede').val());

        // Valide os valores
        if (ip === "" || isNaN(subrede) || subrede < 0 || subrede > 32) {
            $('#resultado-container').html('<p>Por favor, insira um IP válido e um número de bits de sub-rede entre 0 e 32.</p>');
            return;
        }

        // Prepare os dados do formulário
        var formData = {
            ip: ip,
            subrede: subrede
        };

        $.ajax({
            url: 'calculadora.php',
            type: 'POST',
            data: formData,
            dataType: 'html', // Tipo de dado a ser recebido (HTML)
            success: function (responseHTML) {
                // Exiba os resultados na página
                $('#resultado-container').html(responseHTML); // Insira o conteúdo HTML no elemento com id "resultado-container"
            },
            error: function () {
                $('#resultado-container').html('<p>Erro ao calcular IP.</p>');
            }
        });
    });
});

