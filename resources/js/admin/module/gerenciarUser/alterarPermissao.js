$(document).ready(function () {
    // Inicialize o Select2 com marcação habilitada
    $('#select-usuario').select2({
        tags: true
    });

    $('#select-usuario').on('select2:select', function (e) {
        const selectedUsuario = this.value;

        if (selectedUsuario === "") {
            document.getElementById("login-user").value = "";
        } else {
            try {
                fetch('https://smi.somosdevteam.com/api/v1/user/' + selectedUsuario)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Erro na requisição: ' + response.statusText);
                        }
                        return response.json();
                    })
                    .then(jsonResponse => {
                        // Exibe a resposta no console para depuração
                        console.log('Resposta JSON:', jsonResponse);

                        // Preenche o campo de login com o valor retornado no JSON
                        if (jsonResponse && jsonResponse.login !== undefined) {
                            document.getElementById("login-user").value = jsonResponse.login;
                        } else {
                            console.log('O campo login não está definido na resposta JSON.');
                        }
                    })
                    .catch(error => {
                        console.log('Erro na requisição fetch:', error);
                    });
            } catch (error) {
                console.log('Erro inesperado:', error);
            }
        }
    });
});
