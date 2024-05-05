// Função para abrir o modal de edição de componentes
// Configura o token JWT no cabeçalho Authorization
const token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJsb2dpbiI6IjEyMyJ9.Fc98BbWEJM79QUqUUVeXmSHxfSjfQnatptBlQQJp6Og"; // Substitua pelo seu token JWT válido
const requestOptions = {
    method: 'POST', // Mudar para POST
    headers: {
        'Content-Type': 'application/json', // Definir o tipo de conteúdo como JSON
        'Authorization': token
    },
    body: JSON.stringify({ // Converter o objeto para string JSON
        login: "123", // Substitua por um valor dinâmico se necessário
        senha: "123" // Substitua por um valor dinâmico se necessário
    })
};

function openComponentesModal(codReclamacao, componentesSelecionados) {
    // Exibir SweetAlert
    Swal.fire({
        title: "Carregando...",
        html: "Aguarde enquanto os dados estão sendo carregados.",
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // Realiza o fetch para obter todos os componentes
    fetch('http://localhost/manutencaoIntegrada/api/v1/componente', requestOptions)
        .then(response => response.json())
        .then(data => {
            // Limpa o container de checkboxes
            const container = document.getElementById('componentesCheckboxContainer');
            container.innerHTML = '';

            // Adiciona um checkbox para cada componente
            data.forEach(componente => {
                const checkboxDiv = document.createElement('div');
                checkboxDiv.classList.add('col-6', 'col-lg-4'); // Adiciona classes de grade do Bootstrap

                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.name = 'componentes';
                checkbox.value = componente.codcomponente;
                checkbox.id = `componente_${componente.codcomponente}`;
                checkbox.className = 'form-check-input';

                const label = document.createElement('label');
                label.htmlFor = `componente_${componente.codcomponente}`;
                label.className = 'form-check-label';
                label.innerText = componente.nome_componente;

                checkboxDiv.appendChild(checkbox);
                checkboxDiv.appendChild(label);
                container.appendChild(checkboxDiv);

                // Verifica se o componente está na lista de componentes selecionados
                if (componentesSelecionados.includes(componente.codcomponente)) {
                    checkbox.checked = true;
                }
            });

            // Fecha o SweetAlert
            Swal.close();

            // Abre o modal de edição de componentes
            $('#editarComponentesModal').modal('show');
        })
        .catch(error => {
            console.error('Erro ao buscar dados da API:', error);
            // Exibe um alerta de erro caso ocorra um problema durante o carregamento dos dados
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ocorreu um erro ao carregar os dados. Por favor, tente novamente mais tarde.',
            });
        });
}

// Adiciona um ouvinte de evento para o botão de editar em cada reclamação
$('.btn-editar').on('click', function () {
    // Obtém o código da reclamação associada ao botão
    const codReclamacao = $(this).closest('tr').find('td:first').text();

    // Obtém os componentes selecionados pelo usuário na reclamação
    fetch(`http://localhost/manutencaoIntegrada/api/v1/componente/${codReclamacao}`, requestOptions)
        .then(response => response.json())
        .then(data => {
            const componentesSelecionados = data.map(componente => componente.codcomponente);
            // Abre o modal de edição de componentes, passando os componentes selecionados
            openComponentesModal(codReclamacao, componentesSelecionados);
        })
        .catch(error => console.error('Erro ao buscar dados da API:', error));
});

// Adiciona um ouvinte de evento para o submit do formulário de edição
$('#formEditarLembrete').on('submit', function (event) {
    // Obtém os IDs dos componentes selecionados
    const componentesSelecionados = [];
    $('input[name="componentes"]:checked').each(function () {
        componentesSelecionados.push($(this).val());
    });

    // Verifica se pelo menos um componente foi selecionado
    if (componentesSelecionados.length === 0) {
        // Exibe uma mensagem de erro usando o Swal.fire
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Por favor, selecione pelo menos um componente."
        });
        // Impede o envio do formulário
        event.preventDefault();
    } else {
        // Atualiza o valor do input hidden com os IDs dos componentes selecionados
        $('#componentesSelecionados').val(componentesSelecionados.join(','));
        // Continua com o envio do formulário normalmente
        return true;
    }
});

// Adiciona um ouvinte de evento para o botão "Cancelar"
$('.btn-cancelar').on('click', function () {
    $('#editarComponentesModal').modal('hide'); // Fecha o modal
});
