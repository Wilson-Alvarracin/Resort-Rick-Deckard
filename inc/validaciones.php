<?php
session_start();

if (!filter_has_var(INPUT_POST, 'inicio')) {
    header('Location: ../index.php');
    exit();
} else {
    include_once("./conexion.php");

    $user = $_POST["user"];
    $password = $_POST["password"];

    if (empty($user) || empty($password)) {
        header("Location: ../index.php?empty");
        exit();
    } else {
        $query = "SELECT id_usuario, nombre_user, contrasena FROM usuarios WHERE nombre_user = ?";
        $stmt = mysqli_prepare($conn, $query);

        mysqli_stmt_bind_param($stmt, "s", $user);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_bind_result($stmt, $id_usuario, $nombre_user, $contrasena);
            mysqli_stmt_fetch($stmt);

            if (password_verify($password, $contrasena)) {
                $_SESSION["id"] = $id_usuario;
                $_SESSION["user"] = $nombre_user;
                header("Location: ../mostra.php");
                exit();
            } else {
                header("Location: ../index.php?error");
                exit();
            }
        } else {
            header("Location: ../index.php?error");
            exit();
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}
?>
