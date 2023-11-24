<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    if ($_GET['id'] == "Menjador" || $_GET['id'] == "Privada" ||$_GET['id']=="Terraza"){
        $style = $_GET['id'];
    }else{
        header("Location: ./home.php");
    }
    echo '<link rel="stylesheet" href="./css/'.$style.'.css">';
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-light bg-lights position-top">
        <div class="container">
        <div>
            <a class="navbar-brand " href="./home.php">
                <img src="./img/LOGORICK _Blanco.png" alt="" width="100" height="90">
                <a href="./registro.php"><button class="atrasboton"><img class="atrasimg" src="./img/libro.png" alt=""></button></a>
            </a>
            </div>
            <div class="saludo">
            <b style="color:white">¡Bienvenido al portal, <?php echo $_SESSION['user'];?>!</b>

            </div>     
            <div>      
            <a href="./home.php"><button class="atrasboton"><img class="atrasimg" src="./img/atras.png" alt=""></button></a>
            <a href="./inc/salir.php"><button class="logoutboton"><img class="logoutimg" src="./img/LOGOUT.png" alt=""></button></a>
            </div>
        </div>
    </nav>
<?php
if (!isset($_SESSION['id'])) {
    header("Location: ./index.php");
    exit;

} else if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ./index.php");
    exit;

}else{
    if (!isset($_GET['id'])) {
        header("Location: ./home.php");
        exit;
    }
    include './inc/conexion.php';
    $id = trim(mysqli_real_escape_string($conn,$_GET['id']));
    if ($id == "Privada") {
        $sql = 'SELECT distinct s.id_sala, m.id_mesa, m.numero_mesa, s.nombre_sala, s.capacidad, s.tipo_sala, m.estado FROM salas s INNER JOIN mesas m ON s.id_sala = m.id_sala  WHERE s.tipo_sala = "Privada";';
        $stmt = mysqli_prepare($conn,$sql);
    }else {
        $sql= "SELECT s.*, 
        (SELECT COUNT(numero_mesa) FROM mesas WHERE mesas.id_sala = s.id_sala AND mesas.estado = 'libre') AS contador
        FROM salas s
        WHERE s.tipo_sala = ?;";
        $stmt = mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt, "s",$id); 
    }
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    echo '<div class="image-grid">';
    foreach ($res as $sala) {
        if (!($id == "Privada")) {
            echo '<a href="./mesas.php?id='.$sala['id_sala'].'">
            <div class="image-item"><img src="./img/'.$sala['nombre_sala'].'.jpg" alt="Imagen '.$sala['id_sala'].'">
            <div class="image-text"><h2>'.$sala['nombre_sala'].'</h2><h5>Mesas disponibles: '.$sala['contador'].'</h5>';
            
        }else{
            if ($sala['estado']== "ocupada") {
                $diss = 'class="filtro"';
            }else{
                $diss = "";
            }
            echo '<a>
            <div class="image-item"><img '.$diss.' src="./img/'.$sala['nombre_sala'].'.jpg" alt="Imagen '.$sala['id_sala'].'">
            <div class="image-text"><h2>'.$sala['nombre_sala'].'</h2><h5>ESTADO: '.$sala['estado'].'</h5>
            <h5>Capacidad: '.$sala['capacidad'].'</h5>';
            // FORMULARIO 
            echo '<form method="POST" action="./inc/procesar.php">
            <input type="hidden" name="id_sala" value="'.$sala['id_sala'].'">
            <input type="hidden" name="numero_mesa" value="'.$sala['numero_mesa'].'">
            <input type="hidden" name="id_mesa" value="'.$sala['id_mesa'].'">
            <input type="submit"></form>';
        }
        echo '</div>';
        echo '</div></a>';
    }

    
}
?>
</body>
</html>