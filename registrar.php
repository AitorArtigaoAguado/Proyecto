<html>
<head>
<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
<title>Registrar</title>
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
<?php
// Evita entrar a registrarse a alguien loggeado
session_start();
if (isset($_SESSION["login"])) {
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
	<div class="container"
		style="margin-top: 120px; max-width: 700px; margin-left: auto; margin-right: auto; border: 1px solid black; border-radius: 5px; background-color: white;">
		<form action="addUsuario.php" method="post" style="margin-top: 15px;">
			<h4>
				<label for="dni">DNI:</label> <input class="form-control"
					type="text" name="dni" required><br> <label for="nombre">Nombre:</label>
				<input class="form-control" type="text" name="nombre" required><br>
				<label for="apellidos">Apellidos:</label> <input
					class="form-control" type="text" name="apellidos" required><br> <label
					for="email">Email:</label> <input class="form-control" type="text"
					name="email" required><br> <label for="direccion">Dirección:</label>
				<input class="form-control" type="text" name="direccion" required><br>
				<label for="ciudad">Ciudad:</label> <input class="form-control"
					type="text" name="ciudad" required><br> <label for="cp">CP:</label>
				<input class="form-control" type="number" name="cp" required><br> <label
					for="usuario">Usuario:</label> <input class="form-control"
					type="text" name="usuario" required><br> <label for="pass">Contraseña:</label>
				<input class="form-control" type="password" name="pass" required><br>
				<input class='btn btn-secondary btn-lg btn-block' type='submit'
					value='Registrarse'>
			</h4>
		</form>
	</div>
	<?php
// Si existe el error, lo mostramos en pantalla
if (isset($_GET["error"])) {
    echo "<h3 style='color:red; text-align:center;margin-top=20px';>Ha ocurrido un error en el registro</h3>";
}
?>
	<br>
	<br>
	<div class="container">
		<a href="index.php"><h5><-- Atrás</h5></a>
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
</body>
</html>