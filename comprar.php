<?php
// Conexion con la base de datos
$user = "root";
$pass = "";
$server = "localhost";
$db = "proyecto";

$conn = mysqli_connect($server, $user, $pass, $db);

if (! $conn) {
    die("Ha ocurrido un error");
}
session_start();
$sql = "DELETE FROM productousuario WHERE idUsuario=" . $_SESSION["login"];

if ($conn->query($sql)) {
    header("Location: index.php");
}
$conn->close();