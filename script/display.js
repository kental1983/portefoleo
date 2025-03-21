// Função para carregar o CSS com base na largura da tela
function loadCSSBasedOnWidth() {
    if (window.innerWidth <= 768) {
        loadCSS('mstyle.css'); // Carrega o estilo para telas pequenas
    } else if (window.innerWidth <= 1024) {
        loadCSS('tabletstyle.css'); // Carrega o estilo para tablets
    } else {
        loadCSS('style.css'); // Carrega o estilo padrão para computadores
    }
}

// Função para carregar um arquivo CSS
function loadCSS(filename) {
    var link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = filename;
    document.head.appendChild(link);
}

// Chama a função para carregar o CSS com base na largura da tela
loadCSSBasedOnWidth();

// Adicione um ouvinte de evento de redimensionamento da janela para atualizar os estilos quando a largura da tela muda
window.addEventListener('resize', loadCSSBasedOnWidth);

function toggleMenu() {
    const topbar = document.querySelector('.topbar');
    topbar.classList.toggle('active');
}

function closeMenu() {
    const topbar = document.querySelector('.topbar');
    if (topbar.classList.contains('active')) {
        topbar.classList.remove('active');
    }
}

// Fechar o menu ao clicar em uma opção
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.topbar ul li a').forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                closeMenu();
            }
        });
    });

    // Garantir que o menu esteja fechado por padrão em dispositivos móveis
    if (window.innerWidth <= 768) {
        closeMenu();
    }
});
