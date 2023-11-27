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
    
include_once('./conexion.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['numero_mesa'])) {
        try {
            $id_sala = $_POST['id_sala'];
            $numero_mesa = $_POST['numero_mesa'];
            $id_mesa = $_POST['id_mesa'];
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

        } catch (Exception $e) {
            echo "Error:" . $e->getMessage();
            die();
        }

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $numero_mesa);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                mysqli_stmt_bind_result($stmt, $numero_mesa, $estado);
                mysqli_stmt_fetch($stmt);

                if ($estado == 'libre') {
                    try {
                        mysqli_autocommit($conn, false);
                        mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);

                        $L_update_sql = "UPDATE mesas SET estado = 'ocupada' WHERE numero_mesa = ?";
                        $L_update_stmt = mysqli_prepare($conn, $L_update_sql);

                        $sql_insert = "INSERT INTO ocupaciones (id_usuario, id_mesa) VALUES (?, ?)";
                        $stmt_insert = mysqli_prepare($conn, $sql_insert);

                        $id_usuario = $_SESSION['id'];

                        mysqli_stmt_bind_param($L_update_stmt, "i", $numero_mesa);
                        mysqli_stmt_execute($L_update_stmt);

                        mysqli_stmt_bind_param($stmt_insert, "ii", $id_usuario, $id_mesa);
                        mysqli_stmt_execute($stmt_insert);
                        mysqli_stmt_close($stmt_insert);

                        mysqli_commit($conn);

                        // Redirect based on the id_sala
                        if ($id_sala >= 1 && $id_sala <= 3) {
                            header("Location: ../mesas.php?id=" . $id_sala);
                        } elseif ($id_sala >= 4 && $id_sala <= 5) {
                            header("Location: ../mesas.php?id=" . $id_sala);
                        } elseif ($id_sala >= 6 && $id_sala <= 9) {
                            header("Location: ../mostrar.php?id=Privada");
                        } else {
                            echo "Error: ID de sala desconocido.";
                        }

                        die();
                    } catch (Exception $e) {
                        echo "Error:" . $e->getMessage();
                        mysqli_rollback($conn);
                        die();
                    } finally {
                        mysqli_stmt_close($L_update_stmt);
                    }
                } elseif ($estado == 'ocupada') {
                    try {
                        mysqli_autocommit($conn, false);
                        mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);

                        $O_update_sql = "UPDATE mesas SET estado = 'libre' WHERE numero_mesa = ?";
                        $O_update_stmt = mysqli_prepare($conn, $O_update_sql);

                        $sql_update = "UPDATE ocupaciones SET fecha_fin = ? WHERE id_usuario = ? AND id_mesa = ? AND fecha_fin IS NULL";
                        $stmt_update = mysqli_prepare($conn, $sql_update);

                        $id_usuario = $_SESSION['id'];

                        mysqli_stmt_bind_param($O_update_stmt, "i", $numero_mesa);
                        mysqli_stmt_execute($O_update_stmt);

                        mysqli_stmt_bind_param($stmt_update, "sii", $fecha_actual, $id_usuario, $id_mesa);
                        mysqli_stmt_execute($stmt_update);
                        mysqli_stmt_close($stmt_update);

                        mysqli_commit($conn);

                        // Redirect based on the id_sala
                        if ($id_sala >= 1 && $id_sala <= 3) {
                            header("Location: ../mesas.php?id=" . $id_sala);
                        } elseif ($id_sala >= 4 && $id_sala <= 5) {
                            header("Location: ../mesas.php?id=" . $id_sala);
                        } elseif ($id_sala >= 6 && $id_sala <= 9) {
                            header("Location: ../mostrar.php?id=Privada");
                        } else {
                            echo "Error: ID de sala desconocido.";
                        }
                        die();
                    } catch (Exception $e) {
                        echo "Error:" . $e->getMessage();
                        mysqli_rollback($conn);
                        die();
                    } finally {
                        mysqli_stmt_close($O_update_stmt);
                    }
                }
            } else {
                echo "Error: La mesa con número $numero_mesa no existe en la BD";
            }

            mysqli_stmt_close($stmt);
            mysqli_close($conn);
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
