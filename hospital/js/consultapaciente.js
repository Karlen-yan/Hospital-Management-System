//SCRIPT DE CONSULTA DE UN PACIENTE
personas.forEach(person => {
	const detalleBtn = document.querySelector(`tr[data-id="${person.idpaciente}"] button[name="paciente"]`);
	detalleBtn.addEventListener('click', () => detallePaciente(person.idpaciente));
  });
//ejecutar dunción de consulta del paciente guardado en el storage

//función de consulta de paciente
function detallePaciente(id) {
	sessionStorage.setItem('idpaciente', id);
	window.location.href = 'mantenimiento.html';
}

window.addEventListener('load', () => {
    consultaPaciente();
});


function consultaPaciente() {
    // Comprobamos si tenemos un id de paciente guardado en el storage de javascript
    if (sessionStorage.getItem('idpaciente') != undefined) {
        var id = sessionStorage.getItem('idpaciente');
    } else {
        // Si no se ha seleccionado un paciente, redirigimos a la pantalla de consulta
        window.location.href = 'hospital.php?consulta';
        return;
    }

    // Creamos un objeto FormData y añadimos el id del paciente a consultar
    var formData = new FormData();
    formData.append('id', id);

    // Realizamos la llamada asíncrona al servicio de consulta de paciente
    fetch('servicios/consultapaciente.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data[0] == '00') {
            // Si la respuesta es correcta, trasladamos los datos del paciente al formulario
            var paciente = data[1];
            document.getElementById('idpaciente').value = paciente[0].idpaciente;
            document.getElementById('nombre').value = paciente[0].nombre;
            document.getElementById('apellidos').value = paciente[0].apellidos;
            document.getElementById('dni').value = paciente[0].dni;
            document.getElementById('telefono').value = paciente[0].telefono;
            document.getElementById('direccion').value = paciente[0].direccion;
            document.getElementById('fecha_nacimiento').value = paciente[0].fecha_nacimiento;
            document.getElementById('sexo').value = paciente[0].sexo;
        } else {
            // Si la respuesta es incorrecta, mostramos una alerta con el mensaje de error
            alert(data[1]);
        }
    })
    .catch(error => console.error(error));
}