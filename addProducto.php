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

$producto = $_POST["producto"];
$categoria = $_POST["categoria"];
$precio = $_POST["precio"];
$stock = $_POST["stock"];

$target_dir = "imagenes/";
$target_file = $target_dir . basename($_FILES["imagen"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Comprobar si es una imagen
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        header("Location: nuevoProducto.php?error=true");
        $uploadOk = 0;
    }
}

// Comprobar si la imagen ya existe
if (file_exists($target_file)) {
    header("Location: nuevoProducto.php?error=true");
    $uploadOk = 0;
}

// Comprobar el tama�o de la imagen
if ($_FILES["imagen"]["size"] > 500000) {
    header("Location: nuevoProducto.php?error=true");
    $uploadOk = 0;
}

// Permitir formatos
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    header("Location: nuevoProducto.php?error=true");
    $uploadOk = 0;
}

// Comprobar si $uploadOk es correcto
if ($uploadOk == 0) {
    header("Location: nuevoProducto.php?error=true");
    // Si es correcto, subir la imagen
} else {
    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["imagen"]["name"])) . " has been uploaded.";
    } else {
        header("Location: nuevoProducto.php?error=true");
    }
}

// Query
$sql = "INSERT INTO productos(nombre, categoria, stock, imagen, precio)
VALUES('" . $producto . "'," . $categoria . "," . $stock . ",'" . $_FILES["imagen"]["name"] . "'," . $precio . ")";

if ($conn->query($sql)) {
    header("Location: nuevoProducto.php?exito=true");
} else {
    header("Location: nuevoProducto.php?error=true");
}