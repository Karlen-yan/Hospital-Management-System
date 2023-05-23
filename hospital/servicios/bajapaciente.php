<?php


if (isset($_POST['baja'])) {

    try {

            bajaPaciente($IdPaciente);
            $mensaje = "Baja efecutada <br> \n ";
            $nif = $nombre = $apellido = $fechaAlta = $fechaIngreso =  '';


    } catch (Exception $e) {

        $mensaje = "Hay que revisar estos puntos : <br> \n " . $e->getMessage() . "\n";

    }

}
?>
