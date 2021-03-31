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
// Toma de datos
$idProducto = $_SESSION["producto"];
$idUsuario = $_SESSION["login"];
$cantidad = $_POST["cantidad"];

// Query de inserción de datos
$sql = "INSERT INTO productousuario(idUsuario, idProducto, cantidad)
VALUES(" . $idUsuario . "," . $idProducto . ", " . $cantidad . ")";
$conn->query($sql);

// Query que toma el stock inicial
$stockInicial = "SELECT stock FROM productos WHERE id=" . $idProducto;
$resultado = $conn->query($stockInicial);

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $calculo = $row["stock"] - $cantidad;
        echo $calculo;
        // Query que nos resta la cantidad tomada
        $stockFinal = "UPDATE productos SET stock = " . $calculo . " WHERE id=" . $idProducto;
        $conn->query($stockFinal);
    }
}

header("Location: producto.php?id=" . $idProducto);
$conn->close();