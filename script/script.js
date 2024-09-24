document.addEventListener("DOMContentLoaded", function() {
    var sections = document.querySelectorAll('.section');
    var links = document.querySelectorAll('.nav-link');
    var loader = document.getElementById('loader');

    // Verificar se o usuário já visitou o site
    if (!localStorage.getItem('visited')) {
        localStorage.setItem('visited', 'true');
        loader.style.display = 'flex'; // Exibir o loader na primeira visita
    }

    // Função para esconder o loader após um tempo
    function hideLoader() {
        setTimeout(() => {
            loader.style.display = 'none';
        }, 3000); // Tempo em milissegundos
    }

    hideLoader();

    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetSection = document.getElementById(targetId);

            sections.forEach(section => {
                section.classList.add('hidden');
                section.classList.remove('active');
            });

            targetSection.classList.remove('hidden');
            targetSection.classList.add('active');
            window.history.pushState(null, '', '#' + targetId);
        });
    });

    const hash = window.location.hash.substring(1);
    if (hash === "") {
        sections.forEach(section => {
            section.classList.add('hidden');
            section.classList.remove('active');
        });
        document.getElementById('home').classList.remove('hidden');
        document.getElementById('home').classList.add('active');
    } else {
        const targetSection = document.getElementById(hash);
        if (targetSection) {
            sections.forEach(section => {
                section.classList.add('hidden');
                section.classList.remove('active');
            });
            targetSection.classList.remove('hidden');
            targetSection.classList.add('active');
        }
    }
});

document.addEventListener("DOMContentLoaded", function() {
    var loginModal = document.getElementById("loginModal");
    var registerModal = document.getElementById("registerModal");

    var loginBtn = document.getElementById("loginBtn");
    var registerBtn = document.getElementById("registerBtn");

    var loginClose = document.getElementById("loginClose");
    var registerClose = document.getElementById("registerClose");

    loginBtn.onclick = function () {
        loginModal.style.display = loginModal.style.display === "block" ? "none" : "block";
        registerModal.style.display = "none";
    };

    registerBtn.onclick = function () {
        registerModal.style.display = registerModal.style.display === "block" ? "none" : "block";
        loginModal.style.display = "none";
    };

    loginClose.onclick = function () {
        loginModal.style.display = "none";
    };

    registerClose.onclick = function () {
        registerModal.style.display = "none";
    };

    window.onclick = function (event) {
        if (event.target === loginModal) {
            loginModal.style.display = "none";
        }
        if (event.target === registerModal) {
            registerModal.style.display = "none";
        }
    };

    document.getElementById('login-form').onsubmit = function (event) {
        event.preventDefault();
        var formData = new FormData(this);

        fetch('php/login.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('login-message').textContent = data.message;
            if (data.success) {
                location.reload();
            }
        });
    };

    document.getElementById('register-form').onsubmit = function (event) {
        event.preventDefault();
        var formData = new FormData(this);

        fetch('php/register.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('register-message').textContent = data.message;
            if (data.success) {
                document.getElementById('register-form').reset();
                registerModal.style.display = "none";
            }
        });
    };
});
