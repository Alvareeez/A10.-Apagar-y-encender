document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("form").forEach(form => {
        form.addEventListener("submit", function (event) {
            let isValid = true;

            // Limpiar errores anteriores
            form.querySelectorAll(".error-message").forEach(errorDiv => errorDiv.remove());

            // Validación del nombre
            let nameInput = form.querySelector("input[name='name']");
            if (nameInput) {
                let nameValue = nameInput.value.trim();
                if (nameValue === "") {
                    showError(nameInput, "El nombre de usuario es obligatorio.");
                    isValid = false;
                } else if (nameValue.length < 3) {
                    showError(nameInput, "El nombre de usuario debe tener al menos 3 caracteres.");
                    isValid = false;
                }
            }

            // Validación de la sede
            let seuInput = form.querySelector("select[name='seu']");
            if (seuInput) {
                if (seuInput.value === "") {
                    showError(seuInput, "Debe seleccionar una sede.");
                    isValid = false;
                }
            }

            // Validación del correo electrónico
            let emailInput = form.querySelector("input[name='email']");
            if (emailInput) {
                let emailValue = emailInput.value.trim();
                let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (emailValue === "") {
                    showError(emailInput, "El correo electrónico es obligatorio.");
                    isValid = false;
                } else if (!emailRegex.test(emailValue)) {
                    showError(emailInput, "El formato del correo electrónico no es válido.");
                    isValid = false;
                }
            }

            // Validación del rol
            let roleInput = form.querySelector("select[name='role']");
            if (roleInput) {
                if (roleInput.value === "") {
                    showError(roleInput, "Debe seleccionar un rol.");
                    isValid = false;
                }
            }

            // Evitar el envío si hay errores
            if (!isValid) {
                event.preventDefault();
            }
        });
    });

    function showError(input, message) {
        let errorDiv = document.createElement("div");
        errorDiv.className = "error-message text-danger mt-1";
        errorDiv.textContent = message;
        input.classList.add("is-invalid");
        input.insertAdjacentElement("afterend", errorDiv);
    }
});
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("form").forEach(form => {
        form.addEventListener("submit", function (event) {
            let isValid = true;

            // Limpiar errores anteriores
            form.querySelectorAll(".error-message").forEach(errorDiv => errorDiv.remove());

            // Validación del nombre
            let nameInput = form.querySelector("input[name='name']");
            if (nameInput) {
                let nameValue = nameInput.value.trim();
                if (nameValue === "") {
                    showError(nameInput, "El nombre de usuario es obligatorio.");
                    isValid = false;
                } else if (nameValue.length < 3) {
                    showError(nameInput, "El nombre de usuario debe tener al menos 3 caracteres.");
                    isValid = false;
                }
            }

            // Validación de la sede
            let seuInput = form.querySelector("select[name='seu']");
            if (seuInput) {
                if (seuInput.value === "") {
                    showError(seuInput, "Debe seleccionar una sede.");
                    isValid = false;
                }
            }

            // Validación del correo electrónico
            let emailInput = form.querySelector("input[name='email']");
            if (emailInput) {
                let emailValue = emailInput.value.trim();
                let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (emailValue === "") {
                    showError(emailInput, "El correo electrónico es obligatorio.");
                    isValid = false;
                } else if (!emailRegex.test(emailValue)) {
                    showError(emailInput, "El formato del correo electrónico no es válido.");
                    isValid = false;
                }
            }

            // Validación del rol
            let roleInput = form.querySelector("select[name='role']");
            if (roleInput) {
                if (roleInput.value === "") {
                    showError(roleInput, "Debe seleccionar un rol.");
                    isValid = false;
                }
            }

            // Evitar el envío si hay errores
            if (!isValid) {
                event.preventDefault();
            }
        });
    });

    function showError(input, message) {
        let errorDiv = document.createElement("div");
        errorDiv.className = "error-message text-danger mt-1";
        errorDiv.textContent = message;
        input.classList.add("is-invalid");
        input.insertAdjacentElement("afterend", errorDiv);
    }
});
