<?php
// Evita entrar a funcion de administrador a no admin
session_start();
if (! isset($_SESSION["login"])) {
    header("Location: index.php");
} else if ($_SESSION["admin"] != 1) {
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

    // Toma de datos GET
    $id = $_GET["id"];

    $sql = "DELETE FROM productos where id = $id";

    if ($conn->query($sql)) {
        header("Location: index.php");
    }
}
$conn->close();