<?php
// echo $IdPaciente ?? null;
try {

    if (empty($IdPaciente)) {
        $IdPaciente = $_SESSION['paciente'] ?? null;
        $arrayPaciente = consultaPaciente($IdPaciente);
    } else if (is_numeric($IdPaciente) && $IdPaciente > 0) {
        $arrayPaciente = consultaPaciente($IdPaciente);
    }
} catch (Exception $e) {
    $mensaje = "Hay algun error: <br> \n " . $e->getMessage() . "\n";
}
?>