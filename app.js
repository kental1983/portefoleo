// app.js

document.addEventListener('DOMContentLoaded', () => {
    fetch('/projetos') // Rota para buscar projetos do backend
        .then(response => response.json())
        .then(data => {
            const projetosList = document.getElementById('projetos-list');
            data.forEach(projeto => {
                const li = document.createElement('li');
                li.textContent = `${projeto.nome} - ${projeto.descricao}`;
                projetosList.appendChild(li);
            });
        })
        .catch(error => {
            console.error('Erro ao buscar projetos:', error);
        });
});
