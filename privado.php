<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ./index.php");
    exit;

}else{
    if (isset($_GET['priv'])) {
        $typsala = "Privada";
        if(isset($_SESSION['id'])){
            include './inc/conexion.php';
        }
        // echo "sapo";
        $sql = "SELECT * FROM salas WHERE tipo_sala = ? ;";
        $stmt = mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt, "s",$typsala);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        foreach ($res as $mesa) {
            # code...
            echo $mesa['nombre_sala']," - ",$mesa['tipo_sala'];
            echo '<br>';
        }
    }

}

