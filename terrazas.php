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
    <title>Document</title>
    <link rel="stylesheet" href="./css/mostra2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <nav class="navbar navbar-light bg-lights position-top">
        <div class="container">
            <a class="navbar-brand " href="./mostra.php">
                <img src="./img/LOGORICK _Blanco.png" alt="" width="100" height="90">
            </a>
            <div class="saludo">
            <b style="color:white">¡Bienvenido al portal, <?php echo $_SESSION['user'];?>!</b>

            </div>            <a href="./inc/salir.php"><button class="logoutboton"><img class="logoutimg" src="./img/LOGOUT.png" alt=""></button></a>

        </div>
    </nav>
    <div class="image-grid">
        <a href="./terrazas/terraza1.php">
            <div class="image-item">
                <img src="./img/terraza1.jpg" alt="Imagen 1">
                <div class="image-text">
                    <h2>Terraza 1</h2>
                    <p>Aqui se pone la leyenda</p>
                </div>
            </div>
        </a>
        <a href="./terrazas/terraza2.php">
            <div class="image-item">
                <img src="./img/terraza2.jpg" alt="Imagen 2">
                <div class="image-text">
                    <h2>Terraza 2</h2>
                    <p>Aqui se pone la leyenda</p>
                </div>
            </div>
        </a>

        <a href="./terrazas/terraza3.php">
            <div class="image-item">
                <img src="./img/terraza3.jpg" alt="Imagen 3">
                <div class="image-text">
                    <h2>Terraza 3</h2>
                    <p>Aqui se pone la leyenda</p>
                </div>
            </div>
        </a>
    </div>
</body>

</html>
