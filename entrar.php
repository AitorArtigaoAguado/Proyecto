<?php
// Conexion a base de datos
$user = "root";
$pass = "";
$server = "localhost";
$db = "proyecto";

$conn = mysqli_connect($server, $user, $pass, $db);

if (! $conn) {
    die("Ha ocurrido un error");
}

// Toma de valores
$usuario = $_POST["usuario"];
$password = $_POST["pass"];

$sql = "SELECT id, pass, admin FROM usuarios WHERE usuario ='" . $usuario . "'";
$resultado = $conn->query($sql);

session_start();
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        if (password_verify($password, $row["pass"])) {
            $_SESSION["login"] = $row["id"];
            $_SESSION["admin"] = $row["admin"];
            header("Location: index.php");
        } else {
            header("Location: login.php?error=true");
        }
    }
} else {
    header("Location: login.php?error=true");
}

$conn->close();