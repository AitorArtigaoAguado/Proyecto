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

// Toma de datos GET
$id = $_GET["id"];

// Toma de datos post
$producto = $_POST["producto"];
$categoria = $_POST["categoria"];
$precio = $_POST["precio"];
$stock = $_POST["stock"];

if ($_FILES["imagen"]["name"] != null) {

    $target_dir = "imagenes/";
    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Comprobar si es una imagen
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["imagen"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            header("Location: editarProducto.php?id=$id&error=true");
            $uploadOk = 0;
        }
    }

    // Comprobar si la imagen ya existe
    if (file_exists($target_file)) {
        header("Location: editarProducto.php?id=$id&error=true");
        $uploadOk = 0;
    }

    // Comprobar el tamaño de la imagen
    if ($_FILES["imagen"]["size"] > 5000000) {
        header("Location: editarProducto.php?id=$id&error=true");
        $uploadOk = 0;
    }

    // Permitir formatos
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        header("Location: editarProducto.php?id=$id&error=true");
        $uploadOk = 0;
    }

    // Comprobar si $uploadOk es correcto
    if ($uploadOk == 0) {
        header("Location: editarProducto.php?id=$id&error=true");
        // Si es correcto, subir la imagen
    } else {
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["imagen"]["name"])) . " has been uploaded.";
        } else {
            header("Location: editarProducto.php?id=$id&error=true");
            echo "Error";
        }
    }
    
    // Query
    $sql = "UPDATE productos SET nombre='" . $producto . "',
categoria=$categoria, stock= $stock , precio= $precio , imagen = '" . $_FILES["imagen"]["name"] . "'
WHERE id = $id";

    if ($conn->query($sql)) {
        header("Location: editarProducto.php?id=$id&exito=true");
    } else {
        header("Location: editarProducto.php?id=$id&error=true");
    }
} else {
    $imagen = "";

    // Query
    $sql = "SELECT * FROM productos WHERE id=$id;";
    $resultado = $conn->query($sql);
    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $imagen = $row["imagen"];
        }
    }
    $edit = "UPDATE productos SET nombre='$producto',
categoria=$categoria, stock= $stock , precio= $precio , imagen = '$imagen'
WHERE id = $id";

    if ($conn->query($edit)) {
        header("Location: editarProducto.php?id=$id&exito=true");
    } else {
        header("Location: editarProducto.php?id=$id&error=true");
    }
}