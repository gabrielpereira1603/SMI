async function enviarEmailRedefinicaoSenha(email) {
    try {
        const token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJsb2dpbiI6IjEyMyJ9.Fc98BbWEJM79QUqUUVeXmSHxfSjfQnatptBlQQJp6Og";
        const apiURL = `https://smi.somosdevteam.com/api/v1/email/${email}`;
        const response = await fetch(apiURL, {
            method: 'get',
        });

        // Exibe o status e a resposta para debugging
        console.log('Response status:', response.status);
        console.log('Response data:', await response.json());

        if (response.ok) {
            // Coloque um console.log antes de redirecionar
            console.log('Redirecionando para validaToken...');
            window.location.href = 'https://smi.somosdevteam.com/aluno/validaToken';
        } else {
            const errorMessage = await response.json();
            throw new Error(errorMessage.error);
        }
    } catch (error) {
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
