// Função para exibir o alerta de carregamento
function showLoadingAlert() {
    let timerInterval;
    Swal.fire({
        title: "Redirecionando...",
        html: "A página está sendo carregada.",
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading();
            const timer = Swal.getPopup().querySelector("b");
            timerInterval = setInterval(() => {
                timer.textContent = `${Math.ceil(Swal.getTimerLeft() / 1000)}`;
            }, 100);
        },
        willClose: () => {
            clearInterval(timerInterval);
        }
    });
}

// Função para fechar o alerta de carregamento
function hideLoadingAlert() {
    Swal.close();
}

// Evento disparado antes da página ser descarregada (navegação)
window.addEventListener('beforeunload', function() {
    // Exibe o alerta de carregamento quando a página está prestes a ser descarregada (navegação)
    showLoadingAlert();
});

// Evento disparado quando a nova página é completamente carregada
window.addEventListener('load', function() {
    // Fecha o alerta de carregamento quando a nova página é completamente carregada
    hideLoadingAlert();
});
