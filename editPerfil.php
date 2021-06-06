<?php
session_start();
// Este if previene que otro que no sea el mismo modifique el usuario
if (! isset($_SESSION["login"])) {
    header("Location: index.php");
} else {
    $id = $_SESSION["login"];

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
    $sql = "UPDATE usuarios SET dni='" . $dni . "', nombre='" . $nombre . "', apellidos='" . $apellidos . "', email='" . $email . "',direccion='" . $direccion . "', ciudad='" . $ciudad . "', CP=" . $cp . ", usuario='" . $usuario . "', pass='" . $hash . "' WHERE id=" . $id;

    // Ejecución y redirección
    if ($conn->query($sql)) {
        header("Location: perfil.php");
    } else {
        header("Location: editarPerfil.php?error=true");
    }
}
$conn->close();