<?php
include_once('./conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['numero_mesa'])) {
        $id_sala = $_POST['id_sala'];
        $numero_mesa = $_POST['numero_mesa'];
        $sql = "SELECT numero_mesa, estado FROM mesas WHERE numero_mesa = ? ;";
        $stmt = mysqli_prepare($conn, $sql);
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

                        if ($L_update_stmt) {
                            mysqli_stmt_bind_param($L_update_stmt, "i", $numero_mesa);
                            mysqli_stmt_execute($L_update_stmt);

                            if ($id_sala = 1) {
                                header('Location: ../terrazas/terraza1.php?id=1');
                            } elseif ($id_sala = 2) {
                                header('Location: ../terrazas/terraza2.php?id=2');
                            }
                            die();
                        } else {
                            echo "Error";
                            die();
                        }

                        mysqli_stmt_close($O_update_stmt);
                    } elseif ($estado == 'ocupada') {
                        $O_update_sql = "UPDATE mesas SET estado = 'libre' WHERE numero_mesa = ?";
                        $O_update_stmt = mysqli_prepare($conn, $O_update_sql);

                        if ($O_update_stmt) {
                            mysqli_stmt_bind_param($O_update_stmt, "i", $numero_mesa);
                            mysqli_stmt_execute($O_update_stmt);

                            if ($id_sala = 1) {
                                header('Location: ../terrazas/terraza1.php');
                            } elseif ($id_sala = 2) {
                                header('Location: ../terrazas/terraza2.php');
                            }
                            die();
                        } else {
                            echo "Error";
                            die();
                        }

                        mysqli_stmt_close($update_stmt);
                    }
                } else {
                    echo "La mesa con número $numero_mesa no existe en la BD";
                }
                mysqli_stmt_close($stmt);
        }
        
    } else {
        echo "No funciona";
    }
}


?>