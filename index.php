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
                            </div>
                            <div class="inputs">
                                <label for="contrasena">Contraseña:</label>
                                <input type="password" id="password" name="password" id="form2Example27" class="form-control"/>

                            </div>
                            <?php if (isset($_GET['error'])) {echo " <br> <br> <p style='text-align: center;'>Usuario o contraseña incorrecto.</p>"; } ?>
                            <?php if (isset($_GET['correo'])) {echo " <br> <br> <p style='text-align: center;'>El correo debe ser <strong>@fje.edu</strong></p>"; } ?>
                            <?php if (isset($_GET['emptyUsr'])) {echo " <br> <br> <p style='text-align: center;'>No has rellenado el usuario. </p>"; } ?>
                            <?php if (isset($_GET['emptyPwd'])) {echo " <br> <br> <p style='text-align: center;'>No has rellenado la contraseña</p>"; } ?>
                            <?php if (isset($_GET['empty'])) {echo " <br> <br> <p style='text-align: center;'>El usuario y la contraseña son obligatorios.</p>"; } ?>
                            <div class="flex">
                                <input type="submit" class="boton" name="inicio" value="Iniciar sesión">
                            </div>
                                                </form>
                    </div>
                </div>
            </div>
        </form>
    </section>
</body>



</html>