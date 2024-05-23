document.addEventListener("DOMContentLoaded", function() {
    const loginForm = document.getElementById("loginForm");
    const registerForm = document.getElementById("registerForm");
    const registerLink = document.getElementById("registerLink");
    const toggleForm = document.getElementById("toggleForm");

    // Alternar formularios
    registerLink.addEventListener("click", function(event) {
        event.preventDefault();
        loginForm.classList.add("hidden");
        registerForm.classList.remove("hidden");
        toggleForm.innerHTML = '¿Ya tienes una cuenta? <a href="#" id="loginLink">Inicia sesión aquí</a>.';

        // Actualizar el evento de clic para el nuevo enlace
        document.getElementById("loginLink").addEventListener("click", function(event) {
            event.preventDefault();
            loginForm.classList.remove("hidden");
            registerForm.classList.add("hidden");
            toggleForm.innerHTML = '¿No tienes una cuenta? <a href="#" id="registerLink">Regístrate aquí</a>.';
        });
    });

    // Manejo del formulario de inicio de sesión
    loginForm.addEventListener("submit", function(event) {
        event.preventDefault();

        const username = document.getElementById("loginUsername").value;
        const password = document.getElementById("loginPassword").value;

        // Aquí puedes agregar la lógica de autenticación real
        if (username && password) {
            alert("Iniciando sesión...");
            window.location.href = "index.html"; // Redirigir a la página principal
        } else {
            alert("Por favor, ingrese un nombre de usuario y contraseña válidos.");
        }
    });
});
