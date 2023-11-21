<?php
include_once('./conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['numero_mesa'])) {
        
        $sql = "SELECT numero_mesa FROM mesas WHERE numero_mesa = ? ;";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $_POST['numero_mesa']);
        mysqli_stmt_execute($stmt);
        
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            echo "La mesa con número ".$_POST['numero_mesa']." existe.";
        } else {
            echo "La mesa con número ".$_POST['numero_mesa']." no existe.";
        }

        mysqli_stmt_close($stmt);
        
    } else {
        echo "No funciona";
    }
}


?>