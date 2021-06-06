<html>
<head>
<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
<title>Supermercado</title>
<style type="text/css">
.product-table {
	width: 100%;
	height: 700px;
	overflow: scroll;
}
</style>
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
<body style="background-color: #F7F7F7;" onload="intervalo()">
<?php
// Evita entrar al carrito a alguien no loggeado
session_start();
if (! isset($_SESSION["login"])) {
    header("Location: index.php");
    exit();
}
?>
	<!-- Cabecera -->
	<img class="fixed-top" alt="SUPERMERCADO.JPG"
		src="imagenes/supermercado.jpg" style="width: 100%; height: 100">
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark"
		style="margin-top: 100px">
		<a class="navbar-brand" href="index.php"><strong>Minimarket</strong></a>
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
	<div style="margin-top: 160px">
		<div style="margin-top: 55px; margin-right: 20px; margin-bottom: 5px;">
			<?php
if (! isset($_SESSION["login"])) {
    echo "<div style='text-align:right; float: right; margin-right: 10;'><a href='login.php'>Log in</a> | <a href='registrar.php'>Registrarse</a></div>";
} else {
    if ($_SESSION["admin"] != 0) {
        echo "<a href='nuevoProducto.php' style='text-align:left; margin-left: 10;'>+ Añadir producto</a>";
    }
    echo "<div style='text-align:right; float: right; margin-right: 10;'><a href='logout.php'>Log out</a> | <a href='perfil.php'>Perfil</a></div>";
}
?>
		</div>
		<div class="product-table">
			<table class="table" style="width: 100%; text-align: center;">
				<tr>
					<th></th>
					<th>Producto</th>
					<th>Categoría</th>
					<th>Precio individual</th>
					<th>Cantidad</th>
					<th>Precio final</th>
				</tr>
			<?php
$cookie_name = "comprar";
$cookie_value = $_SESSION["login"];
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

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
$sql = "SELECT p.nombre as nombre, c.nombre as categoria, p.precio as precio, pu.id as id, pu.idProducto as idProducto, pu.idUsuario, SUM(pu.cantidad) as cantidad
FROM productousuario as pu, productos as p, categorias as c
WHERE pu.idProducto = p.id AND c.id = p.categoria AND pu.idUsuario=" . $_SESSION["login"] . " GROUP BY idProducto";
$resultado = $conn->query($sql);

$suma = 0;

// Muestra de datos
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td><a href='delCarrito.php?id=" . $row["id"] . "&idProducto=" . $row["idProducto"] . "&cantidad=" . $row["cantidad"] . "'>X</a></td>";
        echo "<td>" . $row["nombre"] . "</td>";
        echo "<td>" . $row["categoria"] . "</td>";
        echo "<td>" . $row["precio"] . " &euro;</td>";
        echo "<td>" . $row["cantidad"] . "</td>";
        $calculo = $row["precio"] * $row["cantidad"];
        $suma += $calculo;
        echo "<td>" . $calculo . " &euro;</td>";
        echo "</tr>";
    }
}
echo "<tr><td/><td/><td/><td/><td><strong>Total:</strong></td><td>" . $suma . " &euro;</td></tr>";
$conn->close();

// Elimina el contenido de carrito cada 24h
if (! isset($_COOKIE["comprar"])) {
    header("Location: comprar.php");
}
?>
		</table>
		</div>
	</div>
	<div style="float: right; margin-right: 50px;">
		<a class="btn btn-secondary btn-lg" href="comprar.php"
			onclick="popup()">Comprar</a>
	</div>
	<div class="container">
		<a href="index.php"><h5><-- Atrás</h5></a>
	</div>
	<!-- Fin contenido -->
	<!-- Footer -->
	<footer style="margin-top: 250px;"
		class="bg-dark text-center text-white">
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
	<script type="text/javascript">
	
	// Mensaje de compra hecha
	function popup(){
		alert("Gracias por su compra.");
	}
	</script>
</body>
</html>