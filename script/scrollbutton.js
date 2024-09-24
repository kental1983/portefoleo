<script>
    document.addEventListener('DOMContentLoaded', function() {
        const scrollButtons = document.querySelectorAll('.scroll-button');

        scrollButtons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = button.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                targetElement.scrollIntoView({ behavior: 'smooth' });
            });
        });
    });
</script>
