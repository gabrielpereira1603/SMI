$(document).ready(function () {
    // Inicialize o Select2 com marcação habilitada
    $('#select-user-relatorioManutencao').select2({
        tags: true
    });

    $('#laboratorio').on('change', function() {
        const selectedLaboratorio = $(this).val();

        if (selectedLaboratorio === "-1") {
            $('#computador').html("<option value='-1' selected>Todos os computadores</option>");
        } else if (selectedLaboratorio >= 1) {
            const token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJsb2dpbiI6IjEyMyJ9.Fc98BbWEJM79QUqUUVeXmSHxfSjfQnatptBlQQJp6Og"; // Substitua pelo seu token JWT válido
            const login = "123";
            const senha = "123";

            const requestOptions = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': token // Adiciona o token no cabeçalho
                },
                body: JSON.stringify({
                    login: login,
                    senha: senha
                })
            };

            fetch('http://localhost/manutencaoIntegrada/api/v1/computador/' + selectedLaboratorio, requestOptions)
                .then(response => response.json())
                .then(jsonResponse => {
                    const selectComputador = $('#computador');
                    selectComputador.prop('disabled', false);
                    selectComputador.html("<option value='-2'>Todos os computadores desse laboratório</option>");
                    jsonResponse.forEach(function (computador) {
                        selectComputador.append($('<option>', {
                            value: computador.codcomputador,
                            text: computador.patrimonio
                        }));
                    });
                });
        } else if (selectedLaboratorio === "") {
            $('#computador').prop('disabled', false);
            $('#computador').html("<option value=''>Selecione um laboratório primeiro</option>");
        }
    });
});
