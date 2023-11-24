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
    <title>RICK DECKARD - HOME</title>
    <link rel="stylesheet" href="./css/mostra.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
    .table-responsive>.table-bordered{
        margin-bottom: 0px !important;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-light bg-lights position-top">
        <div class="container">
            <div>
                <a class="navbar-brand " href="#">
                    <img src="./img/LOGORICK _Blanco.png" alt="" width="100" height="90">
                </a>
            </div>
            <div class="saludo">
                <b style="color:white">¡Bienvenido al portal, <?php echo $_SESSION['user'];?>!</b>
            </div>
            <div>
                <a href="./mostra.php"><button class="atrasboton"><img class="atrasimg" src="./img/atras.png" alt=""></button></a>
                <a href="./inc/salir.php"><button class="logoutboton"><img class="logoutimg" src="./img/LOGOUT.png" alt=""></button></a>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h2 class="mb-4" style="color: white;">Historial de Ocupaciones</h2>

        <form method="get" action="">

            <!-- FILTRO PARA USUARIOS FILTRO PARA USUARIOS FILTRO PARA USUARIOS FILTRO PARA USUARIOS FILTRO PARA USUARIOS FILTRO PARA USUARIOS -->
            <select name="usuario" id="usuario">
                <option value="">Todos los Usuarios</option>
                <!-- Opciones de usuarios aquí -->
                <?php
                include_once('./inc/conexion.php');
                $sqlUser = "SELECT nombre_user FROM usuarios;";
                $stmtUser = mysqli_prepare($conn, $sqlUser);
                mysqli_stmt_execute($stmtUser);
                mysqli_stmt_bind_result($stmtUser, $nom_user);
                while (mysqli_stmt_fetch($stmtUser)) {
                    echo "<option value=\"$nom_user\"";
                    if (isset($_GET['usuario']) && $_GET['usuario'] == $nom_user) {
                        echo " selected";
                    }
                    echo ">$nom_user</option>";
                }

                mysqli_stmt_close($stmtUser);
                ?>
            </select>
            <!-- FILTRO PARA SALAS FILTRO PARA SALAS FILTRO PARA SALAS FILTRO PARA SALAS FILTRO PARA SALAS FILTRO PARA SALAS FILTRO PARA SALAS -->
            <select name="sala" id="sala">
                <option value="">Todas las Salas</option>

                <!-- Opciones de salas aquí -->
                <?php


                $sqlSalas = "SELECT nombre_sala FROM salas;";
                $stmtSalas = mysqli_prepare($conn, $sqlSalas);
                mysqli_stmt_execute($stmtSalas);
                mysqli_stmt_bind_result($stmtSalas, $nom_sala);

                while (mysqli_stmt_fetch($stmtSalas)) {
                    echo "<option value=\"$nom_sala\"";
                    if (isset($_GET['sala']) && $_GET['sala'] == $nom_sala) {
                        echo " selected";
                    }
                    echo ">$nom_sala</option>";
                }

                mysqli_stmt_close($stmtSalas);
                ?>
            </select>

            <!-- FILTRO PARA MESAS FILTRO PARA MESAS FILTRO PARA MESAS FILTRO PARA MESAS FILTRO PARA MESAS FILTRO PARA MESAS FILTRO PARA MESAS -->
            <select name="mesas" id="mesas">
                <option value="">Todas las Mesas</option>
                <!-- Opciones de usuarios aquí -->
                <?php

                $sqlMesas = "SELECT numero_mesa FROM mesas;";
                $stmtMesas = mysqli_prepare($conn, $sqlMesas);
                mysqli_stmt_execute($stmtMesas);
                mysqli_stmt_bind_result($stmtMesas, $num_mesa);

                while (mysqli_stmt_fetch($stmtMesas)) {
                    echo "<option value=\"$num_mesa\"";
                    if (isset($_GET['mesas']) && $_GET['mesas'] == $num_mesa) {
                        echo " selected";
                    }
                    echo ">$num_mesa</option>";
                }

                mysqli_stmt_close($stmtMesas);
                ?>
            </select>

            <!-- FILTRO PARA EL NÚMERO DE REGISTROS -->
            <select name="numero_filtro" id="numero_filtro">
                <option value="0">Todos los registros</option>
                <option value="1" <?php echo (isset($_GET['numero_filtro']) && $_GET['numero_filtro'] == 1) ? 'selected' : ''; ?>>1 registro</option>
                <option value="2" <?php echo (isset($_GET['numero_filtro']) && $_GET['numero_filtro'] == 2) ? 'selected' : ''; ?>>2 registros</option>
                <option value="3" <?php echo (isset($_GET['numero_filtro']) && $_GET['numero_filtro'] == 3) ? 'selected' : ''; ?>>3 registros</option>
                <option value="4" <?php echo (isset($_GET['numero_filtro']) && $_GET['numero_filtro'] == 4) ? 'selected' : ''; ?>>4 registros</option>
                <option value="5" <?php echo (isset($_GET['numero_filtro']) && $_GET['numero_filtro'] == 5) ? 'selected' : ''; ?>>5 registros</option>
                <option value="6" <?php echo (isset($_GET['numero_filtro']) && $_GET['numero_filtro'] == 6) ? 'selected' : ''; ?>>6 registros</option>
            </select>

            <button type="submit">Filtrar</button>
        </form>

        <?php


        $numFiltro = isset($_GET['numero_filtro']) ? intval($_GET['numero_filtro']) : 0;

        $sql = "SELECT u.nombre_user, s.nombre_sala, m.numero_mesa, o.fecha_inicio, o.fecha_fin,
            TIMEDIFF(o.fecha_fin, o.fecha_inicio) AS duracion_ocupacion
            FROM ocupaciones o 
            INNER JOIN usuarios u ON o.id_usuario = u.id_usuario 
            INNER JOIN mesas m ON o.id_mesa = m.id_mesa 
            INNER JOIN salas s ON s.id_sala = m.id_sala";

        // FILTRO DE SALA POR $_GET
        if (isset($_GET['sala']) && !empty($_GET['sala'])) {
            $salaFilter = mysqli_real_escape_string($conn, $_GET['sala']);
            // Le añadimos a esta fila el filtro WHERE 
            $sql .= " WHERE s.nombre_sala = '$salaFilter'";
        }

        // FILTRO DE USUARIO POR $_GET
        if (isset($_GET['usuario']) && !empty($_GET['usuario'])) {
            $usuarioFilter = mysqli_real_escape_string($conn, $_GET['usuario']);
            $sql .= (isset($_GET['sala']) && !empty($_GET['sala'])) ? " AND" : " WHERE";
            $sql .= " u.nombre_user = '$usuarioFilter'";
        }

        // FILTRO DE MESA POR $_GET
        if (isset($_GET['mesas']) && !empty($_GET['mesas'])) {
            $mesaFilter = mysqli_real_escape_string($conn, $_GET['mesas']);
            $sql .= (isset($_GET['mesas']) && !empty($_GET['mesas'])) ? " AND" : " WHERE";
            $sql .= " m.numero_mesa = $mesaFilter";
        }

        // FILTRO NÚMERO REGISTROS
        if ($numFiltro > 0) {
            $sql .= " LIMIT $numFiltro";
        }

        // ACABAMOS EL CÓDIGO (para que se puedan mezclar los filtros, por ejemplo, sala y usuario)
        $sql .= ";";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false) {
            die("Error en la consulta: " . mysqli_error($conn));
        }

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $nombre_user, $nombre_sala, $numero_mesa, $fecha_inicio, $fecha_fin, $tiempo);

        if (mysqli_stmt_fetch($stmt)) {
            echo '<div class="table-responsive" style="background-color: white;">';
            echo '<table class="table table-bordered">';
            echo '<thead class="thead-dark">';
            echo '<tr>';
            echo '<th>Nombre Usuario</th>';
            echo '<th>Sala</th>';
            echo '<th>Número de Mesa</th>';
            echo '<th>Fecha Inicio</th>';
            echo '<th>Fecha Fin</th>';
            echo '<th>Duración</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
        
            // Imprimir resultados
            do {
                echo '<tr>';
                echo "<td>$nombre_user</td>";
                echo "<td>$nombre_sala</td>";
                echo "<td>$numero_mesa</td>";
                echo "<td>$fecha_inicio</td>";
                echo "<td>$fecha_fin</td>";
                echo "<td>$tiempo</td>";
                echo '</tr>';
            } while (mysqli_stmt_fetch($stmt));
        
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        } else {
            echo '<a  href="./registro.php">';
            echo '<img src="./img/LOGORICK _Blanco.png" alt="" style="width: 50%; display: block; margin: auto;"><br>';
            echo '</a>';
            echo "<div style='color: white; display: flex; justify-content: center;'>";
            echo "<b style='font-size: 20px;' >¡Oops! Parece que las hamburguesas se han comido los resultados. ¡Intenta con otra combinación!</b>";
            echo "</div>";
        }

        mysqli_stmt_close($stmt);

        // ... (código de cierre de conexión)
        ?>
    </div>
</body>

</html>
