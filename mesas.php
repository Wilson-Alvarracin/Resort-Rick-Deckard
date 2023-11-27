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
    <title>RICK DECKARD - TERRAZA 1</title>
    <link rel="stylesheet" href="./css/mesas.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <!-- Enlace a SweetAlert -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Enlace a tu archivo popup.js -->
  <script src="./js/popup.js" defer></script>
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
            <b>¡Bienvenido al portal, <?php echo $_SESSION['user'];?>!</b>
            </div>
            <div>
            
            <a href="./home.php"><button class="atrasboton"><img class="atrasimg" src="./img/atras.png" alt=""></button></a>
            <a href="./inc/salir.php"><button class="logoutboton"><img class="logoutimg" src="./img/LOGOUT.png" alt=""></button></a>
            </div>
        </div>
    </nav>

    <!----------------FIN DE LA BARRA DE NAVEGACION --------------------->
    <?php
    if (!isset($_GET['id'])) {
        header("Location: ./home.php");
        exit;
    }else{
        try{
            require './inc/conexion.php';
            $id = trim(mysqli_real_escape_string($conn,$_GET['id']));
            $sql = "SELECT * FROM mesas WHERE id_sala = ?";
            $stmt = mysqli_prepare($conn,$sql);
            mysqli_stmt_bind_param($stmt, "s",$id);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            
        }catch(Exception $e){
            echo "Error: " . $e->getMessage();
        }
        

        echo '<div class="centrado">';
        $i = 0;
        foreach ($res as $mesa) {
            if( $i % 3 == 0 || $i == 0 ){
                echo '<div class="image-grid">';
            }
            echo'<a><div class="image-item">';
            if ($mesa['estado'] == "ocupada") {
                echo '<img class="filtro" src="./img/mesas.png" alt="Imagen 1">';
                echo '<div class="image-text"><h2> Mesa'.$mesa['numero_mesa'].'</h2>';
                echo '<p class="diss">'.$mesa['estado'].'</p>';
                $clase = 'class ="btn2 danger  btn-block" value="Desocupar" ';
            }else{
                echo '<img class="" src="./img/mesas.png" alt="Imagen 1">';
                echo '<div class="image-text"><h2> Mesa'.$mesa['numero_mesa'].'</h2>';
                echo '<p>'.$mesa['estado'].'</p>';
                $clase = 'class ="btn2 success btn-block" value="Ocupar" ';


            }
            echo "<form method='POST' action='./inc/procesar.php'>";
                echo "<input type='hidden' name='id_sala' value=".$mesa['id_sala'].">";
                echo "<input type='hidden' name='id_mesa' value=".$mesa['id_mesa'].">";
                echo "<input type='hidden' name='numero_mesa' value=".$mesa['numero_mesa'].">";
                echo "<input ".$clase." type='submit'>";
                echo "</form>";
            echo '</div></div></a>';

            if( $i == 2){
                echo '</div>';
            }
            $i++;
        }
    }
    ?>
</form>
</body>

</html>