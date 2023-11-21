<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_mesa'])) {
        $id_mesa = $_POST['id_mesa'];
        echo "Funciona: $id_mesa";
    } else {
        echo "No funciona";
    }
}


?>