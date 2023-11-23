document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');

    const userField = document.getElementById('user');
    const passwordField = document.getElementById('password');

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
});