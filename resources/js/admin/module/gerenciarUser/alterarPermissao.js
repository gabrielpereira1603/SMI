$(document).ready(function () {
    // Inicialize o Select2 com marcação habilitada
    $('#select-usuario').select2({
        tags: true
    });

    $('#select-usuario').on('select2:select', function (e) {
        const selectedUsuario = this.value; // Obtém o ID do usuário selecionado

        if (selectedUsuario === "") {
            document.getElementById("login-user").value = "";
        } else {
            // Configura o token JWT no cabeçalho Authorization
            const token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJsb2dpbiI6IjEyMyJ9.Fc98BbWEJM79QUqUUVeXmSHxfSjfQnatptBlQQJp6Og"; // Substitua pelo seu token JWT válido

            // Faz a requisição usando fetch
            fetch('https://teste.somosdevteam.com/api/v1/user/' + selectedUsuario)
                .then(response => response.json())
                .then(jsonResponse => {
                    // Preenche o campo de login com o valor retornado no JSON
                    if (jsonResponse.login !== undefined) {
                        document.getElementById("login-user").value = jsonResponse.login;
                    }

                })
                .catch(error => console.log('Erro:', error));
        }
    });
});


