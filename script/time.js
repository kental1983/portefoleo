
    // Aguarde até que a página seja totalmente carregada
    window.addEventListener('load', function () {
        // Obtenha referências aos elementos
        const splashScreen = document.getElementById('splash-screen');
        const content = document.getElementById('content');

        // Impede a rolagem da página enquanto o splash está ativo
        document.documentElement.style.overflow = 'hidden';
        document.body.style.overflow = 'hidden';

        // Mostrar a tela de apresentação por 5 segundos
        setTimeout(function () {
            // Esconde a tela de apresentação
            splashScreen.style.display = 'none';

            // Restaura a rolagem do corpo da página
            document.documentElement.style.overflow = '';
            document.body.style.overflow = '';

            // Mostra o conteúdo da página principal
            content.style.display = 'block';

            // Redireciona para o portfólio após 5 segundos
            setTimeout(function () {
                window.location.href = 'portfolio.html'; // Altere 'portfolio.html' para o nome do arquivo da página principal do portfólio
            }, 5000); // 5000 milissegundos = 5 segundos
        }, 5000); // 5000 milissegundos = 5 segundos
    });
