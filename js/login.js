document.addEventListener('DOMContentLoaded', function() {
    const userField = document.getElementById('user');
    const passwordField = document.getElementById('password');
    const hiddenUsername = document.getElementById('hiddenUsername');
    const form = document.getElementById('loginForm');

    userField.addEventListener('blur', function() {
        const username = userField.value;
        const hasNumber = /\d/.test(username);

        const userError = document.getElementById('userError');
        if (username === '') {
            userError.textContent = 'Por favor, completa este campo.';
        } else if (hasNumber) {
            userError.textContent = 'El usuario no puede contener números.';
        } else {
            userError.textContent = '';
        }
    });

    passwordField.addEventListener('blur', function() {
        const password = passwordField.value;

        const passwordError = document.getElementById('passwordError');
        if (password === '') {
            passwordError.textContent = 'Por favor, completa este campo.';
        } else if (password.length <= 5) {
            passwordError.textContent = 'La contraseña debe tener más de 5 caracteres.';
        } else {
            passwordError.textContent = '';
        }
    });

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const username = userField.value;
        const password = passwordField.value;
        const hasNumber = /\d/.test(username);

        const passwordError = document.getElementById('passwordError');

        if (username === '') {
            userError.textContent = 'Por favor, completa este campo.';
        } else if (hasNumber) {
            userError.textContent = 'El usuario no puede contener números.';
        } else {
            userError.textContent = '';
        }

        if (password === '') {
            passwordError.textContent = 'Por favor, completa este campo.';
        } else if (password.length <= 5) {
            passwordError.textContent = 'La contraseña debe tener más de 5 caracteres.';
        } else {
            passwordError.textContent = '';

            // Almacena el nombre de usuario en el campo oculto
            hiddenUsername.value = username;
            form.submit();
        }
    });
});