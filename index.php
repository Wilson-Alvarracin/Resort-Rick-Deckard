<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RICK DECKARD - LOGIN</title>
    <link rel="shortcut icon" href="./img/LOGORICK.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <section class="">
        <header class="flex">
            <div class="nav">
                <img class="logoarriba" src="./img/LOGORICK _Blanco.png">
            </div>
        </header>
        <form action="./inc/validaciones.php" method="post" id="loginForm">
            <div class="flex" id="oscuro">
                <div class="container row">
                    <div class="column-2-izq flex">
                        <img class="logo" src="./img/LOGORICK _Blanco.png" alt="">
                    </div>
                    <div class="column-2-der">
                        <h2 id="titulo">Inicie Sesión</h2>
                        <form>
                            <div class="inputs">
                                <label for="form2Example17">Nombre Usuario:</label>
                                <input type="text" id="user" name="user" class="form-control" />
                                <p id="userError" style="color: red; text-align: center;"></p>
                            </div>
                            <div class="inputs">
                                <label for="contrasena">Contraseña:</label>
                                <input type="password" id="password" name="password" id="form2Example27" class="form-control"/>
                                <p id="passwordError" style="color: red; text-align: center;"></p>
                            </div>
                            <?php if (isset($_GET['error'])) {echo " <br> <br> <p style='text-align: center;'>Usuario o contraseña incorrecto.</p>"; } ?>
                            <?php if (isset($_GET['correo'])) {echo " <br> <br> <p style='text-align: center;'>El correo debe ser <strong>@fje.edu</strong></p>"; } ?>
                            <?php if (isset($_GET['emptyUsr'])) {echo " <br> <br> <p style='text-align: center;'>No has rellenado el usuario. </p>"; } ?>
                            <?php if (isset($_GET['emptyPwd'])) {echo " <br> <br> <p style='text-align: center;'>No has rellenado la contraseña</p>"; } ?>
                            <?php if (isset($_GET['empty'])) {echo " <br> <br> <p style='text-align: center;'>El usuario y la contraseña son obligatorios.</p>"; } ?>
                            <div class="flex">
                                <input type="hidden" id="hiddenUsername" name="hiddenUsername">
                                <input type="submit" class="boton" name="inicio" value="Iniciar sesión">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <script>
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
                const username = userField.value;
                const password = passwordField.value;
                const hasNumber = /\d/.test(username);

                const userError = document.getElementById('userError');
                const passwordError = document.getElementById('passwordError');

                if (username === '') {
                    userError.textContent = 'Por favor, completa este campo.';
                    event.preventDefault();
                } else if (hasNumber) {
                    userError.textContent = 'El usuario no puede contener números.';
                    event.preventDefault();
                } else {
                    userError.textContent = '';
                }

                if (password === '') {
                    passwordError.textContent = 'Por favor, completa este campo.';
                    event.preventDefault();
                } else if (password.length <= 5) {
                    passwordError.textContent = 'La contraseña debe tener más de 5 caracteres.';
                    event.preventDefault();
                } else {
                    passwordError.textContent = '';

                    // Almacena el nombre de usuario en el campo oculto
                    hiddenUsername.value = username;
                }
            });
        });
    </script>
</body>

</html>