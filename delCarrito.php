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

$idProducto = $_GET["idProducto"];

$sql = "DELETE FROM productousuario WHERE idProducto=" . $idProducto;

$cantidad = $_GET["cantidad"];

// Restaurar los productos
$numProductos = "SELECT stock FROM productos WHERE id=" . $idProducto;
$resultado = $conn->query($numProductos);

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $calculo = $row["stock"] + $cantidad;
        echo $calculo;
        $recuperarProducto = "UPDATE productos SET stock=" . $calculo . " WHERE id=" . $idProducto;
        $conn->query($recuperarProducto);
    }
}

if ($conn->query($sql)) {
    header("Location: carrito.php");
}
$conn->close();