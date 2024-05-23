document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("preferenciasForm");

    form.addEventListener("submit", function(event) {
        event.preventDefault(); // Evitar que el formulario se envíe automáticamente

        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        let anyChecked = false;

        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                anyChecked = true;
            }
        });

        if (anyChecked) {
            alert("¡Formulario enviado con éxito!");

            // Limpiar el formulario
            form.reset();

            // Redirigir a la página normal
            window.location.href = "index.html"; // Cambiar "pagina-normal.html" por la URL de tu página normal
        } else {
            alert("Por favor, complete al menos un campo del formulario.");
        }
    });
});
