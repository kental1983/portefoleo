document.addEventListener('DOMContentLoaded', function() {
    fetch('recomendacoes.json')
        .then(response => response.json())
        .then(data => {
            const softwareList = document.getElementById('software-recomendacoes').querySelector('ul');
            const hardwareList = document.getElementById('hardware-recomendacoes').querySelector('ul');

            data.software.forEach(item => {
                const li = document.createElement('li');
                li.innerHTML = `<strong>${item.nome}:</strong> ${item.descricao} <br><em>${item.comentario}</em> <br><strong>Prós:</strong> ${item.pros} <br><strong>Contras:</strong> ${item.contras}`;
                softwareList.appendChild(li);
            });

            data.hardware.forEach(item => {
                const li = document.createElement('li');
                li.innerHTML = `<strong>${item.nome}:</strong> ${item.descricao} <br><em>${item.comentario}</em> <br><strong>Prós:</strong> ${item.pros} <br><strong>Contras:</strong> ${item.contras}`;
                hardwareList.appendChild(li);
            });
        })
        .catch(error => console.error('Erro ao carregar as recomendações:', error));
});
