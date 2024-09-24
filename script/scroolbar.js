
    document.addEventListener('DOMContentLoaded', function() {
        const topbarLinks = document.querySelectorAll('.topbar-link');

        topbarLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                const targetId = link.getAttribute('data-target'); // Obtenha o ID da seção alvo
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    targetElement.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    });


