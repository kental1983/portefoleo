document.addEventListener('DOMContentLoaded', function() {
    const menuButton = document.querySelector('.menu-button');
    const topbar = document.querySelector('.topbar');

    menuButton.addEventListener('click', function() {
        topbar.classList.toggle('active');
    });
});
