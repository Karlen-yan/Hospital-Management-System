<?php
include("servicios/conexion.php");

	// session_start();
	// $enlace = null;
	//carga de sección de contenido por defecto
	$seccion = 'index';

	//carga de sección de menu por defecto
	$nav = 'login';
	const MASCARA = 'usuarioLogin';
	const ARRAY_KEYS = array( 'consulta', 'alta', 'mantenimiento');

	try {


		if (!empty($_COOKIE['usuarios'])) {
			// Recuperar el usuario y desencriptarlo
			$nifCookie = addslashes($_COOKIE['usuarios'] ^ MASCARA);
	
			// Comprobar si tenemos este usuario en BD.
			if (usuarioCookies($nifCookie)) {
				$nav = 'menu';
			}
		}
	
		if (sizeof($_GET) > 0) {
			$arrayClaves = array_keys($_GET);
			if (in_array($arrayClaves[0], ARRAY_KEYS)) {
				$seccion = $arrayClaves[0];
				$nav = 'menu';
			}
		}
	
		if (isset($_POST['login'])) {
			require('servicios/loginUser.php');
		}
	
		if (isset($_POST['loginoff'])) {
			require('servicios/loginoff.php');
		}
	
	} catch (Exception $e) {
	
		'Error ' . $e->getMessage();
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Hospital</title>
	<link rel="stylesheet" type="text/css" href="css/hospital.css">
</head>
<body>
<div class="container">
	<header>
		<h1 id="title">HOSPITAL</h1>
	</header>
	<nav>
		<?php include("secciones/$nav.html"); ?>
	</nav>
	
	<section id='contenido'>
		<div>
			<?php include("secciones/$seccion.html"); ?>
		</div>
	</section>
</div>
</body>
</html>