<?php
        session_start();

include_once('./conexion.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['numero_mesa'])) {
        $id_sala = $_POST['id_sala'];
        $numero_mesa = $_POST['numero_mesa'];
        $sql = "SELECT numero_mesa, estado FROM mesas WHERE numero_mesa = ?;";
        $stmt = mysqli_prepare($conn, $sql);

        $fecha_actual = date("Y-m-d H:i:s");

            // Verificar si la mesa está libre u ocupada
            $sql_check = "SELECT estado FROM mesas WHERE id_sala = ? AND id_mesa = ?";
            $stmt_check = mysqli_prepare($conn, $sql_check);
            mysqli_stmt_bind_param($stmt_check, "ii", $id_sala, $id_mesa);
            mysqli_stmt_execute($stmt_check);
            mysqli_stmt_bind_result($stmt_check, $estado);
            mysqli_stmt_fetch($stmt_check);
            mysqli_stmt_close($stmt_check);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $numero_mesa);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                mysqli_stmt_bind_result($stmt, $numero_mesa, $estado);
                mysqli_stmt_fetch($stmt);

                if ($estado == 'libre') {
                    $L_update_sql = "UPDATE mesas SET estado = 'ocupada' WHERE numero_mesa = ?";
                    $L_update_stmt = mysqli_prepare($conn, $L_update_sql);

                    $sql_insert = "INSERT INTO ocupaciones (id_usuario, id_mesa) 
                    VALUES (?, ?)";

$id_sala = $_POST["id_sala"];
$numero_mesa = $_POST["id_mesa"];
$id_mesa = $_POST['id_mesa'];
$id_usuario = $_SESSION['id'];

     $stmt_insert = mysqli_prepare($conn, $sql_insert);
     mysqli_stmt_bind_param($stmt_insert, "ii", $id_usuario, $id_mesa);
     mysqli_stmt_execute($stmt_insert);
     mysqli_stmt_close($stmt_insert);

     // Actualizar el estado de la mesa a 'ocupada'
     $sql_update_estado = "UPDATE mesas SET estado = 'ocupada' WHERE id_sala = ? AND id_mesa = ?";
     $stmt_update_estado = mysqli_prepare($conn, $sql_update_estado);
     mysqli_stmt_bind_param($stmt_update_estado, "ii", $id_sala, $id_mesa);
     mysqli_stmt_execute($stmt_update_estado);
     mysqli_stmt_close($stmt_update_estado);


                    if ($L_update_stmt) {
                        mysqli_stmt_bind_param($L_update_stmt, "i", $numero_mesa);
                        mysqli_stmt_execute($L_update_stmt);

                

                        if ($id_sala == 1 || $id_sala == 2 || $id_sala == 3) {
                            header("Location: ../mesas.php?id=".$id_sala."");
                        } elseif ($id_sala == 4 || $id_sala == 5) {
                            header("Location: ../mesas.php?id=".$id_sala."");
                        } elseif ($id_sala == 6 || $id_sala == 7 || $id_sala == 8 || $id_sala == 9) {
                            header("Location: ../mostrar.php?id=Privada");
                        } else {
                            echo "Error: ID de sala desconocido.";
                        }
                        
                        die();
                    } else {
                        echo "Error al preparar la consulta de actualización (libre).";
                        die();
                    }

                    mysqli_stmt_close($L_update_stmt);
                } elseif ($estado == 'ocupada') {
                    $O_update_sql = "UPDATE mesas SET estado = 'libre' WHERE numero_mesa = ?";
                    $O_update_stmt = mysqli_prepare($conn, $O_update_sql);
                    mysqli_stmt_bind_param($O_update_stmt, "i", $numero_mesa);
                    mysqli_stmt_execute($O_update_stmt);
                    $id_sala = $_POST["id_sala"];
                    $numero_mesa = $_POST["numero_mesa"];
                    $id_mesa = $_POST['id_mesa'];
                    $id_usuario = $_SESSION['id'];

                        $sql_update = "UPDATE ocupaciones SET fecha_fin = ? WHERE id_usuario = ? AND id_mesa = ? AND fecha_fin IS NULL";
                        $stmt_update = mysqli_prepare($conn, $sql_update);
                        mysqli_stmt_bind_param($stmt_update, "sii", $fecha_actual, $id_usuario, $id_mesa);
                        mysqli_stmt_execute($stmt_update);
                        mysqli_stmt_close($stmt_update);
        

                        if ($id_sala == 1 || $id_sala == 2 || $id_sala == 3) {
                            header("Location: ../mesas.php?id=".$id_sala."");
                        } elseif ($id_sala == 4 || $id_sala == 5) {
                            header("Location: ../mesas.php?id=".$id_sala."");
                        } elseif ($id_sala == 6 || $id_sala == 7 || $id_sala == 8 || $id_sala == 9) {
                            header("Location: ../mostrar.php?id=Privada");
                        } else {
                            echo "Error: ID de sala desconocido.";
                        }
                   

                }
            } else {
                echo "Error: La mesa con número $numero_mesa no existe en la BD";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error al preparar la consulta SELECT.";
        }
    } else {
        echo "Error: No se ha enviado el número de mesa.";
    }
} else {
    echo "Error: Método de solicitud no válido.";
}
?>