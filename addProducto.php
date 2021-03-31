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

$imagen = $_POST["imagen"];
$producto = $_POST["producto"];
$categoria = $_POST["categoria"];
$precio = $_POST["precio"];
$stock = $_POST["stock"];

move_uploaded_file($imagen, "/Proyecto/imagenes/$imagen");

$sql = "INSERT INTO productos(nombre, categoria, stock, imagen, precio)
VALUES('" . $producto . "'," . $categoria . "," . $stock . ",'" . $imagen . "'," . $precio . ")";

if ($conn->query($sql)) {
    header("Location: nuevoProducto.php?exito=true");
} else {
    header("Location: nuevoProducto.php?error=true");
}