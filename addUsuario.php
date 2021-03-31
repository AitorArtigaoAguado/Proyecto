<?php
// Conexion a la base de datos
$user = "root";
$pass = "";
$server = "localhost";
$db = "proyecto";

$conn = mysqli_connect($server, $user, $pass, $db);

if (! $conn) {
    die("Ha ocurrido un error");
}

// Toma de valores
$dni = $_POST["dni"];
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$email = $_POST["email"];
$direccion = $_POST["direccion"];
$ciudad = $_POST["ciudad"];
$cp = $_POST["cp"];
$usuario = $_POST["usuario"];
$password = $_POST["pass"];
$hash = password_hash($password, PASSWORD_DEFAULT);

// Query
$sql = "INSERT INTO usuarios(dni, nombre, apellidos, email, direccion, ciudad, CP, usuario, pass)
VALUES('" . $dni . "','" . $nombre . "','" . $apellidos . "','" . $email . "','" . $direccion . "','" . $ciudad . "'," . $cp . ",'" . $usuario . "','" . $hash . "')";

// Ejecución y redirección
if ($conn->query($sql)) {
    header("Location: login.php?success=true");
} else {
    header("Location: registrar.php?error=true");
}
$conn->close();