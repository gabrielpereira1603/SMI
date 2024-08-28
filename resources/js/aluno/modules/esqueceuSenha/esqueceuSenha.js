//const apiURL = `https://teste.somosdevteam.com/api/v1/email/${email}`;

async function enviarEmailRedefinicaoSenha(email) {
    try {
        const token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJsb2dpbiI6IjEyMyJ9.Fc98BbWEJM79QUqUUVeXmSHxfSjfQnatptBlQQJp6Og";
        const apiURL = `http://localhost/manutencaoIntegrada/api/v1/email/${email}`;

        const response = await fetch(apiURL, {
            method: 'get',

        });
        console.log(response)
        if (response.ok) {
            // Se a resposta for bem-sucedida, continua com o fluxo normal
            // (neste caso, redirecionamento ou qualquer ação que você queira fazer)
            window.location.href = 'http://localhost/manutencaoIntegrada/aluno/validaToken';
        } else {
            // Se a resposta não for bem-sucedida, trata o erro
            const errorMessage = await response.json();
            throw new Error(errorMessage.error);
        }
    } catch (error) {
        // Trata o erro e exibe uma mensagem para o usuário
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: error.message
        });
        console.error('Erro ao enviar email de redefinição de senha:', error);
    }
}

// Função para abrir o SweetAlert ao clicar em "Esqueceu a senha?"
function showSweetAlert() {
    Swal.fire({
        title: "Insira seu email para enviarmos o código de redefinição!",
        input: "text",
        inputAttributes: {
            autocapitalize: "off"
        },
        showCancelButton: true,
        confirmButtonText: "Enviar",
        showLoaderOnConfirm: true,
        preConfirm: async (email) => {
            await enviarEmailRedefinicaoSenha(email);
        },
        allowOutsideClick: () => !Swal.isLoading()
    });
}
