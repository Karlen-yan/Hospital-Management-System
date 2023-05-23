<?php
//Conexion para ESTABLECER la CONEXION a la base de datos
$mysqli = new mysqli("localhost", "root", "Karlen-1999", "hospital");

if ($mysqli->connect_errno) {
    echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    exit();
}

//Conexion para RECIBIR datos
function consultaPaciente($id) // Funcion para conultar los datos en la base de datos 
{
  global $mysqli;

  $sql = "SELECT * FROM paciente where idpaciente = '$id'";
  $result = $mysqli->query($sql);
  $arrayPaciente = array();

  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $arrayPaciente = array("IdPaciente" => $row["idpaciente"], "nif" => $row["nif"], "Nombre" => $row["nombre"], "Apellidos" => $row["apellidos"], "FechaIngreso" => $row["fechaingreso"], "FechaAlta" => $row["fechaalta"]);
    }
    return $arrayPaciente;
  }
}

//Conexion para INSERTAR datos
function altaPaciente($nif, $nom, $apellido, $data){
    global $mysqli;
    if (!$mysqli->query("INSERT INTO paciente (nif, nombre, apellidos, fechaingreso) VALUES ('$nif','$nom','$apellido','$data');")) {
        echo ("Error description: " . $mysqli->error);
    }
    $mysqli->close();
}

//Conexion para ELIMINAR datos
function delete($idPaciente)
{
    global $mysqli;
    $sql = "DELETE FROM paciente WHERE idpaciente=$idPaciente;";
    $objetoDatos = mysqli_query($mysqli, $sql);
}


// Modificacion
//Conexion para ACTUALIZAR datos
function update($nif, $nombre, $apellidos, $fechaingreso, $idPaciente)
{
    global $mysqli;
    $sql = "UPDATE paciente SET  nif = '$nif', nombre='$nombre', apellidos='$apellidos', fechaingreso='$fechaingreso' WHERE idpaciente= $idPaciente;";
    $objetoDatos = mysqli_query($mysqli, $sql);
}


function modificarPacienteSinFechaAlta($idpaciente, $nif, $nombre, $apellidos, $fechaIngreso) // Funcion para insertar en la base de datos 
{
  global $mysqli;


  $sql = "UPDATE paciente SET
                          nif = '$nif',
                          nombre = '$nombre',
                          apellidos = '$apellidos',
                          fechaingreso = '$fechaIngreso'
                          WHERE idpaciente ='$idpaciente'";

  if ($mysqli->query($sql) === TRUE) {
    $mensaje = "New record created successfully";

  } else {
    $mensaje = "Error: " . $sql . "<br>" . $mysqli->error;
  }

}
function modificarPacienteConFechaAlta($idpaciente, $nif, $nombre, $apellidos, $fechaIngreso, $fechaalta) // Funcion para insertar en la base de datos 

{
 
  global $mysqli;


  $sql = "UPDATE paciente SET nif = '$nif',
                              nombre = '$nombre',
                              apellidos = '$apellidos',
                              fechaingreso = '$fechaIngreso',
                              fechaalta = '$fechaalta'
                              WHERE idpaciente ='$idpaciente'";

  if ($mysqli->query($sql) === TRUE) {
    $mensaje = "New record created successfully";

  } else {
    $mensaje = "Error: " . $sql . "<br>" . $mysqli->error;
  }
}



//Conexion para OBTENER TODOS los datos de la TABLA
function select_all($inicio, $filas_a_mostrar, $buscar_apellido){
    global $mysqli;
    $sql = "SELECT * FROM paciente WHERE apellidos LIKE '%$buscar_apellido%' order by nombre asc LIMIT $inicio, $filas_a_mostrar ";
    $objetoDatos = mysqli_query($mysqli, $sql);
    return $objetoDatos;
}

function numeroRows() // Funcion para conultar los datos en la base de datos 

{
    global $mysqli;
  $sql = "SELECT * FROM paciente";
  $result = mysqli_query($mysqli, $sql);
  $arrayPacientes = array();

  if ($result->num_rows > 0)
    // output data of each row
    return $result->num_rows;
}



//Conexion pedir datos de usuario
function pedirUs($nif,$contrasenia) { 
    global $mysqli;
	$sql = "SELECT * FROM hospital.usuarios where nif='$nif' and 'password'='$contrasenia';";
	$objetoDatos = mysqli_query($mysqli, $sql);
    $paciente = $objetoDatos->fetch_assoc();
    return $paciente;
}


function validacionLogin($nif, $password)
{ // VALIDAR LOS DATOS 
  $mensaje = '';
  if (empty($nif)) {
    $mensaje = "- El usuario es obligatorio <br>";
  }
  if (empty($password)) {
    $mensaje .= "- El password es obligatorio <br>";
  }

  if ($mensaje != null) {
    throw new Exception($mensaje);
    // return false;
  } else {
    return true;
  }
}

function loginUsuario($nif, $passwordUsusario)
{

    global $mysqli;

  $sql = "SELECT * FROM usuarios WHERE nif = '$nif' and password = '$passwordUsusario'";

  $result =  mysqli_query($mysqli, $sql);

  if ($result->num_rows > 0)
    return true;
  
    throw new Exception("- El nombre de usuario o la contraseña no son correctos <br>");
}

function usuarioCookies($nif)
{

    global $mysqli;

  $sql = "SELECT * FROM usuarios WHERE nif = '$nif'";
  $permiso = false;
  $result =  mysqli_query($mysqli, $sql);

  if ($result->num_rows > 0)
    $permiso = true;
  else
    $permiso = false;

  return $permiso;

}


// Baja paciente 
function bajaPaciente($idpaciente) // Funcion para insertar en la base de datos 

{
  global $mysqli;

  $sql = "DELETE FROM paciente
WHERE idpaciente = '$idpaciente'";

  if ($mysqli->query($sql) === TRUE) {
    $mensaje = "New record created successfully";

  } else {
    $mensaje = "Error: " . $sql . "<br>" . $mysqli->error;
  }
}


// Validaciones 
function validacionDatos($nif, $nombre, $apellidos, $fechaIngreso)
{ // VALIDAR LOS DATOS 
  $mensaje = '';
  if (empty($nif)) {
    $mensaje = "- El NIF es obligatorio <br>";
  }
  if (empty($nombre)) {
    $mensaje .= "- El Nombre es obligatorio <br>";
  }
  if (empty($apellidos)) {
    $mensaje .= "- El apellidos es obligatorio <br>";
  }
  if (empty($fechaIngreso)) {
    $mensaje .= "- La fecha de ingreso es obligatoria <br>";
  }

  if ($mensaje != null) {
    throw new Exception($mensaje);
    // return false;
  } else {
    return true;
  }
}


?>