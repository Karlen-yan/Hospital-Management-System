<?php
try {

$nif = $_POST['usuario'];
$password = $_POST['password'];



if (validacionLogin($nif, $password))
{

  if (loginUsuario($nif, $password))
  {
    // Encriptar el usuario y guardarlo en cookies: 
    $nifEncryptado = $nif ^ MASCARA;
    setcookie('usuarios', $nifEncryptado, time() + 3600 * 24, '/');

    // Mostrar el menu : 
    $nav = 'menu';

  }
}

} catch (Exception $e) {
$mensaje = "Hay que revisar estos puntos : <br> \n " . $e->getMessage() . "\n";
// header("Location: index.php");

}


?>