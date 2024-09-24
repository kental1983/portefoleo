
// Aguarde até que a página seja totalmente carregada
window.addEventListener('load', function () {
    // Obtenha referências aos elementos
    const splashScreen = document.getElementById('splash-screen');
    const content = document.getElementById('content');

    // Mostrar a tela de apresentação por 5 segundos
    setTimeout(function () {
        // Esconda a tela de apresentação
        splashScreen.style.display = 'none';
        
        // Mostre o conteúdo da página principal
        content.style.display = 'block';
        
        // Redirecione para o portfólio após 5 segundos
        setTimeout(function () {
            window.location.href = 'portfolio.html'; // Altere 'portfolio.html' para o nome do arquivo da página principal do portfólio
        }, 5000); // 5000 milissegundos = 5 segundos
    }, 5000); // 5000 milissegundos = 5 segundos
});
