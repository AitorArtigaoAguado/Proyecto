<html>
<head>
<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
<title>Añadir Producto</title>
<!-- Bootstrap -->
<link rel="stylesheet"
	href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
	integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
	crossorigin="anonymous">
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
<?php
// Evita entrar a funcion de administrador a no admin
session_start();
if (! isset($_SESSION["login"])) {
    header("Location: index.php");
}else if($_SESSION["admin"] != 1){
    header("Location: index.php");
}
?>
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
if (! isset($_SESSION["login"])) {
    echo "<div style='text-align:right; margin-right: 10;'><a href='login.php'>Log in</a> | <a href='registrar.php'>Registrarse</a></div>";
} else {
    echo "<div style='text-align:right; margin-right: 10;'><a href='logout.php'>Log out</a> | <a href='carrito.php'>Carrito</a></div>";
}
?>
	</div>
		<div class="container"
			style="max-width: 700px; margin-left: auto; margin-right: auto; border: 1px solid black; border-radius: 5px; background-color: white;">
			<form action="addProducto.php" method="post"
				style="margin-top: 15px;">
				<label for="imagen">Imagen:</label> <input type="file" name="imagen">
				<br> <br> <label for="producto">Producto:</label> <input
					class="form-control" type="text" name="producto" required><br> <br> <label
					for="categoria">Categoría:</label> <select name="categoria"
					class="form-control">
					<option value="1">Tecnología</option>
					<option value="2">Alimentos</option>
					<option value="3">Textiles</option>
					<option value="4">Videojuegos</option>
					<option value="5">Juguetes</option>
					<option value="6">Higiene</option>
				</select> <br> <br> <label for="precio">Precio:</label> <input
					class="form-control" type="number" name="precio" step="any" required><br> <br>
				<label for="stock">Stock:</label> <input class="form-control"
					type="number" name="stock" required><br> <br> <input
					class='btn btn-secondary btn-lg btn-block' type='submit'
					value='Añadir'>
			</form>
		</div>
		<div class="container" style="text-align: center; margin-top: 10px;">
		<?php
if (isset($_GET["exito"])) {
    echo "<h3 style='color: green;'>Se ha registrado el producto</h3>";
} else if (isset($_GET["error"])) {
    echo "<h3 style='color: red;'>Se ha registrado el producto</h3>";
}
?>
		</div>
	</div>
	<div class="container">
		<a href="index.php"><h5><-- Atrás</h5></a>
	</div>
	<!-- Fin contenido -->
</body>
</html>