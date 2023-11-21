<?php
include_once('./conexion.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_mesa'])) {
        
        $sql = "SELECT nombre_mesa FROM mesas WHERE id_mesa = ? ;";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id_mesa);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            echo "La mesa con número ".$_POST['numero_mesa']." existe.";
        } else {
            echo "La mesa con número ".$_POST['numero_mesa']." no existe.";
        }
        
    } else {
        echo "No funciona";
    }
}


?>