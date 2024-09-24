document.addEventListener('DOMContentLoaded', () => {
    const menuBtn = document.querySelector('.menu-btn');
    const navMenu = document.querySelector('.topbar ul');
  
    if (menuBtn && navMenu) {
      menuBtn.addEventListener('click', () => {
        navMenu?.classList.toggle('active'); // O símbolo `?.` assegura que não haja erro se 'navMenu' for nulo.
      });
    }
  });






