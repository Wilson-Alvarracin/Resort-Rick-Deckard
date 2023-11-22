<?php
// procesar.php

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    try {
        $id_sala = $_POST["id_sala"];
        $numero_mesa = $_POST["numero_mesa"];
        $id_mesa = $_POST['id_mesa'];

        // Verificar si la sesión está iniciada y el ID del usuario está definido
        session_start();

        if (isset($_SESSION['id'])) {
            $id_usuario = $_SESSION['id'];

            echo $id_mesa;
            echo "<br>";
            echo $numero_mesa;
            echo "<br>";
            echo $id_usuario;

            // Incluir el archivo de conexión
            include ('../inc/conexion.php');

            // Obtener la fecha y hora actual
            $fecha_actual = date("Y-m-d H:i:s");

            // Verificar si la mesa está libre u ocupada
            $sql_check = "SELECT estado FROM mesas WHERE id_sala = ? AND id_mesa = ?";
            $stmt_check = mysqli_prepare($conn, $sql_check);
            mysqli_stmt_bind_param($stmt_check, "ii", $id_sala, $id_mesa);
            mysqli_stmt_execute($stmt_check);
            mysqli_stmt_bind_result($stmt_check, $estado);
            mysqli_stmt_fetch($stmt_check);
            mysqli_stmt_close($stmt_check);

            echo "<br>";
            echo $estado;

            if ($estado == 'libre') {
                // La mesa está libre, realizar un INSERT
                $sql_insert = "INSERT INTO ocupaciones (id_usuario, id_mesa) 
                               VALUES (?, ?)";
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

                echo "La mesa está libre. Se ha realizado un INSERT.";
            } elseif ($estado == 'ocupada') {
                // La mesa está ocupada, realizar un UPDATE
                $sql_update = "UPDATE ocupaciones SET fecha_fin = ? WHERE id_usuario = ? AND id_mesa = ? AND fecha_fin IS NULL";
                $stmt_update = mysqli_prepare($conn, $sql_update);
                mysqli_stmt_bind_param($stmt_update, "sii", $fecha_actual, $id_usuario, $id_mesa);
                mysqli_stmt_execute($stmt_update);
                mysqli_stmt_close($stmt_update);

                echo "La mesa está ocupada. Se ha realizado un UPDATE.";
            }

            // Cerrar la conexión u realizar otras tareas necesarias
            mysqli_close($conn);
        } else {
            // La sesión no está iniciada, manejar el caso según tus necesidades
            echo "Error: La sesión no está iniciada.";
        }
    } catch (Exception $e) {
        echo "Error: ". $e->getMessage();
    }
}
?>
