<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ./index.php");
    exit;
} else if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ./index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RICK DECKARD - HOME</title>
    <link rel="stylesheet" href="./css/mostra.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <nav class="navbar navbar-light bg-lights position-top">
        <div class="container">
            <div>
            <a class="navbar-brand " href="#">
                <img src="./img/LOGORICK _Blanco.png" alt="" width="100" height="90">
                <a href="./registro.php"><button class="atrasboton"><img class="atrasimg" src="./img/libro.png" alt=""></button></a>

            </a>
            </div>
            <div class="saludo">
            <b style="color:white">¡Bienvenido al portal, <?php echo $_SESSION['user'];?>!</b>
            </div>
            <a href="./inc/salir.php"><button class="logoutboton"><img class="logoutimg" src="./img/LOGOUT.png" alt=""></button></a>
        </div>
    </nav>
    
<!------------FIN BARRA DE NAVEGACION--------------------->

    <div class="image-grid">
        <a href="./terrazas.php">
            <div class="image-item">
                <img src="./img/terraza.jpg" alt="Imagen 1">
                <div class="image-text">
                    <h2>Terrazas</h2>
                    <p>En la terraza, encontrarás tres áreas al aire libre, cada una con capacidad para cuatro mesas.</p>
                </div>
            </div>
    </a>
    <a href="./comedores.php">
        <div class="image-item">
            <img src="./img/comedor.jpg" alt="Imagen 2">
            <div class="image-text">
                <h2>Comedores</h2>
                <p>Dentro de nuestros comedores, contamos con dos zonas, cada una con cuatro mesas.</p>
            </div>
    </div>
    </a>

    <a href="./privado.php?priv=true">
        <div class="image-item">
            <img src="./img/private.jpg" alt="Imagen 3">
            <div class="image-text">
                <h2>Areas Privadas</h2>
                <p>Nuestras cuatro salas privadas están equipadas con una mesa en cada una. Estos espacios brindan privacidad y comodidad.</p>
            </div>
        </div>
    </a>
    </div>
</body>

</html>