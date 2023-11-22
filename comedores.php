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
    <title>RICK DECKARD - COMEDORES</title>
    <link rel="stylesheet" href="./css/mostra3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <nav class="navbar navbar-light bg-lights position-top">
        <div class="container">
        <div>
            <a class="navbar-brand " href="./mostra.php">
                <img src="./img/LOGORICK _Blanco.png" alt="" width="100" height="90">
                <a href="./registro.php"><button class="atrasboton"><img class="atrasimg" src="./img/libro.png" alt=""></button></a>
            </a>
            </div>
            <div class="saludo">
            <b style="color:white">¡Bienvenido al portal, <?php echo $_SESSION['user'];?>!</b>

            </div>     
            <div>      
            <a href="javascript:history.back()"><button class="atrasboton"><img class="atrasimg" src="./img/atras.png" alt=""></button></a>
            <a href="./inc/salir.php"><button class="logoutboton"><img class="logoutimg" src="./img/LOGOUT.png" alt=""></button></a>
            </div>
        </div>
    </nav>
    <div class="image-grid">
        <a href="./comedores/comedor1.php">
            <div class="image-item">
                <img src="./img/comedor1.jpg" alt="Imagen 1">
                <div class="image-text">
                    <h2>Comedor 1</h2>
                    <p>Aqui se pone la leyenda</p>
                </div>
            </div>
        </a>
        <a href="./comedores/comedor2.php">
            <div class="image-item">
                <img src="./img/comedor2.jpg" alt="Imagen 2">
                <div class="image-text">
                    <h2>Comedor 2</h2>
                    <p>Aqui se pone la leyenda</p>
                </div>
            </div>
        </a>
    </div>
</body>

</html>
