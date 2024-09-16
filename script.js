// Função para carregar projetos usando AJAX
function carregarProjetos() {
    const projetosList = document.getElementById('projetos-list');
    
    // Fazer uma solicitação AJAX para obter os projetos
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'projetos.json', true);
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            const projetos = JSON.parse(xhr.responseText);
            
            // Limpar a lista de projetos antes de adicionar os novos
            projetosList.innerHTML = '';
            
            // Adicionar os projetos dinamicamente
            projetos.forEach(projeto => {
                const projetoItem = document.createElement('div');
                projetoItem.innerHTML = `<h3>${projeto.nome}</h3><p>${projeto.descricao}</p>`;
                projetosList.appendChild(projetoItem);
            });
        } else {
            console.error('Erro ao carregar projetos: ' + xhr.status);
        }
    };
    
    xhr.send();
}

// Chamar a função para carregar os projetos quando a página carregar
window.onload = carregarProjetos;


