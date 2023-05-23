<?php

// Inicializar las variables
$paginacion = null;
$option = null;



if (empty($_GET['fila'])) {
    $filas_a_mostrar = filter_input(INPUT_POST, 'numpacientes', FILTER_VALIDATE_INT) ?? 5;

} else {
    $filas_a_mostrar = $_GET['fila'];
}

$opciones = array(
    5 => '5',
    10 => '10',
    20 => '20'
);
// Generar la etiqueta select con la opción seleccionada
$label = '<label for="numpacientes">Mostrar:</label>';
$select = '<select name="numpacientes" onchange="this.form.submit()">';

foreach ($opciones as $valor => $texto) {
    $selected = ($valor == $filas_a_mostrar) ? 'selected' : '';
    $option .= "<option value=\"$valor\" $selected>$texto</option>";
}
$endSelect = '</select>';



$pagina = filter_input(INPUT_GET, 'pagina', FILTER_VALIDATE_INT) ?? 1;



$inicio = ($pagina - 1) * $filas_a_mostrar;

$buscar_apellido = filter_input(INPUT_POST, 'buscaapellido') ?? null;



// Array donde guardamos todos los pacientes : 
$arrayPacientes = select_all($inicio, $filas_a_mostrar, $buscar_apellido);

$total_filas = numeroRows();
$total_paginas = ceil($total_filas / $filas_a_mostrar);




for ($i = 1; $i <= $total_paginas; $i++) {
    $paginacion .= "<button><a href='?consulta&pagina=$i&fila=$filas_a_mostrar'> $i </a></button>";

}



// ----- Biscador por apellido : 

session_start();

if ($_POST['detalle'] ?? null) {
    //Guardamos la valor de //idpaciente para utilizarla en la pantalla de mantenimento
    $IdPaciente = $_POST['idpaciente'] ?? null;
    $_SESSION['paciente'] = $IdPaciente;

}

// echo ("<pre>" . print_r($arrayPacientes, true) . "</pre>");


?>