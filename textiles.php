<html>
<head>
<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
<title>Textiles</title>
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
			<form class="form-inline my-2 my-lg-0" action="buscar.php"
				method="post">
				<input class="form-control mr-sm-2" type="search"
					placeholder="Buscar" aria-label="Buscar" name="buscar">
				<button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button>
			</form>
		</div>
	</nav>
	<!-- Fin cabecera -->
	<!-- Contenido -->
	<div style="margin-top: 110px">
		<div style="margin-top: 55px; margin-right: 20px; margin-bottom: 5px;">
			<?php
session_start();
if (! isset($_SESSION["login"])) {
    echo "<div style='text-align:right; float: right; margin-right: 10;'><a href='login.php'>Log in</a> | <a href='registrar.php'>Registrarse</a></div>";
} else {
    if ($_SESSION["admin"] != 0) {
        echo "<a href='nuevoProducto.php' style='text-align:left; margin-left: 10;'>+ Añadir producto</a>";
    }
    echo "<div style='text-align:right; float: right; margin-right: 10;'><a href='logout.php'>Log out</a> | <a href='carrito.php'>Carrito</a></div>";
}
?>
		</div>
		<table class="table" style="width: 100%; text-align: center;">
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
$sql = "SELECT * FROM productos WHERE categoria = 3";
$resultado = $conn->query($sql);

// Recoger los resultados
$productos = array();
$imagenes = array();
$id = array();
$a = 1;
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $id[$a] = $row["id"];
        $productos[$a] = $row["nombre"];
        $imagenes[$a] = $row["imagen"];
        $a ++;
    }
}

// Mostrar los resultados
echo "<tr>";
for ($i = 1; $i < $a; $i ++) {
    echo "<td><a href='producto.php?id=" . $id[$i] . "'><img alt='PRODUCTO.JPG' style='width: 100px; height: 100px;' src='imagenes/" . $imagenes[$i] . "'><br>" . $productos[$i] . "</a></td>";
    if ($i % 5 == 0 && $i != 0) {
        echo "</tr>";
    }
}
$conn->close();
?>
		</table>
	</div>
	<!-- Fin contenido -->
	<!-- Footer -->
	<footer style="margin-top: 250px;" class="bg-dark text-center text-white">
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
</body>
</html>