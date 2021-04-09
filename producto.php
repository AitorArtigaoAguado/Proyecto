<html>
<head>
<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
<title>Producto</title>
<!-- Bootstrap -->
<link rel="stylesheet"
	href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
	integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
	crossorigin="anonymous">
<link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css"
	rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
	integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
	crossorigin="anonymous"></script>
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
	integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
	crossorigin="anonymous"></script>
<script
	src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
	integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
	crossorigin="anonymous"></script>
<!-- Fin Bootstrap -->
</head>
<body style="background-color: #F7F7F7;">
	<!-- Cabecera -->
	<img class="fixed-top" alt="SUPERMERCADO.JPG"
		src="/imagenes/supermercado.jpg" style="width: 100%; height: 50">
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark"
		style="margin-top: 50px">
		<a class="navbar-brand" href="index.php"><strong>Supermercado</strong></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse"
			data-target="#navbarSupportedContent"
			aria-controls="navbarSupportedContent" aria-expanded="false"
			aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active"><a class="nav-link" href="index.php">Todos
						<span class="sr-only">(current)</span>
				</a></li>
				<li class="nav-item active"><a class="nav-link"
					href="tecnologia.php">Tecnología <span class="sr-only">(current)</span>
				</a></li>
				<li class="nav-item active"><a class="nav-link" href="alimentos.php">Alimentos
						<span class="sr-only">(current)</span>
				</a></li>
				<li class="nav-item active"><a class="nav-link" href="textiles.php">Textiles
						<span class="sr-only">(current)</span>
				</a></li>
				<li class="nav-item active"><a class="nav-link"
					href="videojuegos.php">Videojuegos <span class="sr-only">(current)</span>
				</a></li>
				<li class="nav-item active"><a class="nav-link" href="juguetes.php">Juguetes
						<span class="sr-only">(current)</span>
				</a></li>
				<li class="nav-item active"><a class="nav-link" href="higiene.php">Higiene
						<span class="sr-only">(current)</span>
				</a></li>
			</ul>
		</div>
	</nav>
	<!-- Fin cabecera -->
	<!-- Contenido -->
	<div style="margin-top: 110px">
		<div style="margin-top: 55px; margin-right: 20px; margin-bottom: 5px;">
			<?php
session_start();

// Recogida de datos GET
$id = $_GET["id"];

if (! isset($_SESSION["login"])) {
    echo "<div style='text-align:right; float: right; margin-right: 10;'><a href='login.php'>Log in</a> | <a href='registrar.php'>Registrarse</a></div>";
} else {
    if ($_SESSION["admin"] != 0) {
        echo "<a href='nuevoProducto.php' style='text-align:left; margin-left: 10;'>+ Añadir producto</a> | ";
        echo "<a href='editarProducto.php?id=" . $id . "'>Editar producto</a> | ";
        echo "<a href='delProducto.php?id=$id'>Eliminar Producto</a>";
    }
    echo "<div style='text-align:right; float: right; margin-right: 10;'><a href='logout.php'>Log out</a> | <a href='carrito.php'>Carrito</a></div>";
}
?>
	</div>
		<div class="container">
			<table width='100%'>
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

// Query
$sql = "SELECT productos.id as id, productos.nombre as producto, productos.stock as stock, categorias.nombre as categoria, productos.imagen as imagen, productos.precio as precio 
FROM productos, categorias WHERE productos.categoria = categorias.id and productos.id=" . $id;
$resultado = $conn->query($sql);

// Mostrar datos
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $_SESSION["producto"] = $id;
        echo "<tr>";
        echo "<td style='text-align: center' width='50%'><img alt='PRODUCTO.JPG' width='300' heigth='300' src='imagenes/" . $row["imagen"] . "'></td>";
        echo "<td style='margin-left:100px;' width='50%'><h4><strong>Nombre del producto: </strong>" . $row["producto"] . "<br><br>";
        echo "<strong>Categoría: </strong>" . $row["categoria"] . "<br><br>";
        echo "<strong>Precio: </strong>" . $row["precio"] . " &euro;<br><br>";
        $_SESSION["precio"] = $row["precio"];
        echo "<strong>Stock disponible: </strong>" . $row["stock"] . " unidades</h4><br><br>";

        // Mostrar solo si está loggeado
        if (isset($_SESSION["login"])) {
            if ($row["stock"] == 0) {
                echo "<h3 style='color:red;'>AGOTADO</h3>";
            } else {
                echo "<h5><form method='post' action='addCarrito.php'>";
                echo "<label for='cantidad'>Cantidad</label> <input id='cantidad' name='cantidad' min='1' max='" . $row["stock"] . "' type='number' required><br><br>";
                echo "<input onclick='popup()' class='btn btn-secondary btn-lg' type='submit' value='Añadir al carro'>";
                echo "</form></h5></td></tr>";
            }
        } else {
            if ($row["stock"] == 0) {
                echo "<h3 style='color:red;'>AGOTADO</h3>";
            }
        }
    }
}
$conn->close();
?>
		</table>
			<br> <br> <a href="index.php"><h5><-- Atrás</h5></a>
		</div>
	</div>
	<!-- Fin contenido -->
	<!-- Footer -->
	<footer class="bg-dark text-center text-white">
		<!-- Grid container -->
		<div class="container p-4 pb-0">
			<!-- Section: Social media -->
			<section class="mb-4">
				<!-- Facebook -->
				<a class="btn btn-outline-light btn-floating m-1" href="#!"
					role="button"><i class="fab fa-facebook-f"></i></a>

				<!-- Twitter -->
				<a class="btn btn-outline-light btn-floating m-1" href="#!"
					role="button"><i class="fab fa-twitter"></i></a>

				<!-- Google -->
				<a class="btn btn-outline-light btn-floating m-1" href="#!"
					role="button"><i class="fab fa-google"></i></a>

				<!-- Instagram -->
				<a class="btn btn-outline-light btn-floating m-1" href="#!"
					role="button"><i class="fab fa-instagram"></i></a>

				<!-- Linkedin -->
				<a class="btn btn-outline-light btn-floating m-1" href="#!"
					role="button"><i class="fab fa-linkedin-in"></i></a>

				<!-- Github -->
				<a class="btn btn-outline-light btn-floating m-1" href="#!"
					role="button"><i class="fab fa-github"></i></a>
			</section>
			<!-- Section: Social media -->
		</div>
		<!-- Grid container -->

		<!-- Copyright -->
		<div class="text-center p-3"
			style="background-color: rgba(0, 0, 0, 0.2);">
			© 2021 Copyright: <a class="text-white" href="#">Supermercado</a>
		</div>
		<!-- Copyright -->
	</footer>
	<!-- Footer -->
	<!-- Scripts -->
	<script type="text/javascript">
		// Mensaje de añadido al carro
		function popup(){
			var cantidad = document.getElementById("cantidad").value;
			if(cantidad != ""){
				alert("Se ha añadido al carrito con éxito.");
			}
		}
	</script>
	<!-- Fin Scripts -->
</body>
</html>