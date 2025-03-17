document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('incidenciaForm');
    const inputs = form.querySelectorAll('input:not([type="file"]), select, textarea');

    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            validateField(input);
        });
    });

    form.addEventListener('submit', function(event) {
        let valid = true;
        inputs.forEach(input => {
            if (!validateField(input)) {
                valid = false;
            }
        });
        if (!valid) {
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Errores en el formulario',
                text: 'Por favor, corrige los errores antes de enviar el formulario.'
            });
        }
    });

    function validateField(input) {
        const errorMessage = input.nextElementSibling;
        let valid = true;

        if (input.value.trim() === '') {
            input.style.borderColor = 'red';
            if (errorMessage && errorMessage.classList.contains('error-message')) {
                errorMessage.textContent = 'Este campo es obligatorio';
                errorMessage.style.color = 'red';
            } else {
                const error = document.createElement('span');
                error.textContent = 'Este campo es obligatorio';
                error.style.color = 'red';
                error.classList.add('error-message');
                input.parentNode.appendChild(error);
            }
            valid = false;
        } else {
            input.style.borderColor = '';
            if (errorMessage && errorMessage.classList.contains('error-message')) {
                errorMessage.textContent = '';
            }
        }

        return valid;
    }
});

function validateField(field) {
    let errorMessage = '';
    let errorDiv = document.getElementById(field.id + 'Error');

    // Limpiar el mensaje de error y el estilo de error en cada validación
    errorDiv.textContent = '';
    field.classList.remove('error-border'); // Limpiar el borde rojo
    field.classList.remove('error'); // Limpiar texto rojo

    // Validar campos de texto y textarea
    if (field.type === 'text' || field.tagName === 'TEXTAREA') {
        if (field.value.trim() === '') {
            errorMessage = 'Este campo es obligatorio.';
            field.classList.add('error-border'); // Estilo de borde rojo
            field.classList.add('error'); // Estilo de texto rojo
        } else if (field.value.trim().length < 5) {
            errorMessage = 'Este campo debe tener al menos 5 caracteres.';
            field.classList.add('error-border'); // Estilo de borde rojo
            field.classList.add('error'); // Estilo de texto rojo
        }
    }

    // Validar select
    if (field.tagName === 'SELECT') {
        if (field.value === '') {
            errorMessage = 'Este campo es obligatorio.';
            field.classList.add('error-border'); // Estilo de borde rojo
            field.classList.add('error'); // Estilo de texto rojo
        }
    }

    // Validar el campo de imagen
    if (field.type === 'file') {
        let file = field.files[0];
        if (file && file.size > 2 * 1024 * 1024) {
            errorMessage = 'El archivo es demasiado grande. El tamaño máximo permitido es 2MB.';
            field.classList.add('error-border'); // Estilo de borde rojo
            field.classList.add('error'); // Estilo de texto rojo
        } else if (file && !['image/jpeg', 'image/png', 'image/gif'].includes(file.type)) {
            errorMessage = 'Solo se permiten imágenes en formato JPG, PNG o GIF.';
            field.classList.add('error-border'); // Estilo de borde rojo
            field.classList.add('error'); // Estilo de texto rojo
        }
    }

    // Mostrar el mensaje de error
    errorDiv.textContent = errorMessage;
}

function validateForm(event) {
    let formValid = true;

    // Validamos todos los campos con la función validateField
    const fields = document.querySelectorAll('input, textarea, select');
    fields.forEach(field => {
        validateField(field); // Validar cada campo
        if (field.classList.contains('error-border')) { // Si algún campo tiene borde rojo (error)
            formValid = false;
        }
    });

    // Si hay errores, mostrar un mensaje y evitar el envío
    if (!formValid) {
        document.getElementById('submitButton').disabled = true; // Deshabilitar el botón
        event.preventDefault();  // Prevenir el envío del formulario
        alert('Por favor, corrige los errores antes de enviar el formulario.');
    } else {
        document.getElementById('submitButton').disabled = false; // Habilitar el botón si no hay errores
    }
}
