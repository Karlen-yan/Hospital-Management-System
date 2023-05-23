<?php 
include("conexion.php");

try{
  $nif = addslashes($_POST['nif']) ?? null;
  $nombre = addslashes($_POST['nombre']) ?? null;
  $apellido = addslashes($_POST['apellidos']) ?? null;
  $fechaingreso = addslashes($_POST['fechaingreso']) ?? null;

  if (validacionDatos($nif, $nombre, $apellido, $fechaingreso)) {
      altaPaciente($nif, $nombre, $apellido, $fechaingreso);
      $respuesta = "Alta efectuada";
      $codigo = "00";
      echo ($codigo.$respuesta);
  }else {
      $respuesta = "Alta no efectuada";
      $codigo = "01";
      echo ($codigo.$respuesta);
  }
} catch (Exception $e) {

  $mensaje = "" . $e->getMessage() . "\n";
}

// if ($alta_correcta) {
//   $codigo = '00';
//   $respuesta = 'Alta realizada correctamente';
// } else {
//   $codigo = '01';
//   $respuesta = 'Error al realizar el alta';
// }

// echo ($codigo.$respuesta);

?>