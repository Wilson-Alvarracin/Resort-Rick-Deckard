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
    <title>RICK DECKARD - TERRAZAS</title>
    <link rel="stylesheet" href="./css/mostra4.css">
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

        <div class="centrado">
    <!----------------FIN DE LA BARRA DE NAVEGACION --------------------->
    <?php

include('./inc/conexion.php');
$sql = "SELECT * FROM mesas WHERE id_sala = ?";
$stmt = mysqli_prepare($conn, $sql);
$id_sala = 6;
mysqli_stmt_bind_param($stmt, 'i', $id_sala);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
echo "<div class='image-grid'>";

while ($mesa = mysqli_fetch_assoc($res)) {
    echo '<a><div class="image-item">';
    
    if ($mesa['estado'] == "ocupada") {
        echo "<img class='filtro' src='./img/privada".$mesa['numero_mesa'].".jpg' alt='Imagen 1'>";
    } else {
        echo "<img src='./img/privada".$mesa['numero_mesa'].".jpg' alt='Imagen 1'>";
    }
    
    echo '<div class="image-text"><h2> Sala Privada nº '.$mesa['numero_mesa'].'</h2>';
    echo '<p class="diss">'.$mesa['estado'].'</p>';
    
    echo "<form method='POST' action='./inc/procesar.php'>";
    echo "<input type='hidden' name='id_sala' value=".$mesa['id_sala'].">";
    echo "<input type='hidden' name='numero_mesa' value=".$mesa['numero_mesa'].">";
    echo "<input type='submit'>";
    echo "</form>";

    echo '</div></div></a>';
}
echo "</div>";

// Libera los recursos después de usarlos
mysqli_stmt_close($stmt);
?>
</div>

</body>
</html>
