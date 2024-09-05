$(document).ready(function () {
    // Inicialize o Select2 com marcação habilitada
    $('#select-alterarUser').select2({
        tags: true
    });

    $('#select-alterarUser').on('select2:select', function (e) {
        var selectedUsuario = this.value;

        if(selectedUsuario === "") {
            document.getElementById("login").value = "";
            document.getElementById("email").value = "";
            document.getElementById("nome-input").value = "";
        } else {
            fetch('https://somosdevteam.com/smi/api/v1/user/' + selectedUsuario)
                .then(response => response.json())
                .then(jsonResponse => {
                    // Verifique se jsonResponse é um objeto e contém as propriedades esperadas
                    if (jsonResponse && typeof jsonResponse === 'object') {
                        if (jsonResponse.login !== undefined) {
                            document.getElementById("login").value = jsonResponse.login;
                        }
                        if (jsonResponse.email !== undefined) {
                            document.getElementById("email").value = jsonResponse.email;
                        }
                        if (jsonResponse.nome !== undefined) {
                            document.getElementById("nome-input").value = jsonResponse.nome;
                        }
                    } else {
                        console.error("Resposta da API inválida ou vazia");
                    }
                })
                .catch(error => console.error("Erro ao buscar os dados do usuário:", error));
        }
    });
});
