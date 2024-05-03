// Função para exibir o alerta
function showAlert(messageType, messageText) {
    let icon, title;

    if (messageType === 'success') {
        icon = 'success';
        title = 'Success!';
    } else if (messageType === 'error') {
        icon = 'error';
        title = 'Error!';
    }

    Swal.fire({
        position: 'center',
        icon: icon,
        title: title,
        text: messageText,
        showConfirmButton: false,
        timer: 1500
    }).then(() => {
        // Limpa os parâmetros de URL após o alerta ser fechado
        const url = new URL(window.location.href);
        url.searchParams.delete(messageType);
        window.history.replaceState({}, document.title, url);
    });
}

// Verifica se há parâmetros de erro ou de sucesso na URL e exibe o alerta correspondente
const urlParams = new URLSearchParams(window.location.search);
const error = urlParams.get('error');
const success = urlParams.get('success');

if (error) {
    showAlert('error', decodeURIComponent(error));
} else if (success) {
    showAlert('success', decodeURIComponent(success));
}
