<?php
// Clase que elimina el usuario de la base de datos
$id = $_GET["id"];
session_start();
// Este if previene que otro que no sea el mismo elimine dicho usuario
if (! isset($_SESSION["login"])) {
    header("Location: index.php");
} else if ($_SESSION["login"] != $id) {
    header("Location: index.php");
} else {

    // Conexion con la base de datos
    $user = "root";
    $pass = "";
    $server = "localhost";
    $db = "proyecto";

    $conn = mysqli_connect($server, $user, $pass, $db);

    if (! $conn) {
        die("Ha ocurrido un error");
    }

    $sql = "DELETE FROM usuarios WHERE id= " . $id;
    if ($conn->query($sql)) {
        header("Location: logout.php");
    }
}