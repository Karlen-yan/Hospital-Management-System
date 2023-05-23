<?php
if (isset($_POST['modificacion'])) {

    try {

        $nif = addslashes($_POST['nif']) ?? null;
        $nombre = addslashes($_POST['nombre']) ?? null;
        $apellido = addslashes($_POST['apellidos']) ?? null;
        $fechaIngreso = addslashes($_POST['fechaingreso']) ?? null;
        $fechaAlta = addslashes($_POST['fechaalta']) ?? null;

        if (validacionDatos($nif, $nombre, $apellido, $fechaIngreso)) {
            if ($fechaAlta == "") {
                modificarPacienteSinFechaAlta($IdPaciente,$nif, $nombre, $apellido, $fechaIngreso);
            } else {
                modificarPacienteConFechaAlta($IdPaciente,$nif, $nombre, $apellido, $fechaIngreso,$fechaAlta);

            }
            $mensaje = "Modificacion efecutada <br> \n ";
        }


    } catch (Exception $e) {

        $mensaje = "Hay que revisar estos puntos : <br> \n " . $e->getMessage() . "\n";

    }

}
?>



