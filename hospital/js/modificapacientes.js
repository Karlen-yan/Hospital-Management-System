//SCRIPT DE MODIFICACION PACIENTES
//activar el botón de modificacion
document.getElementById('modificacion').onclick=modificaPaciente


//función de modificación paciente
function modificaPaciente() {
	// Recuperar los datos del formulario
	const idPaciente = document.getElementById('idpaciente').value;
	const nif = document.getElementById('nif').value;
	const nombre = document.getElementById('nombre').value;
	const apellidos = document.getElementById('apellidos').value;
	const fechaIngreso = document.getElementById('fechaingreso').value;
	const fechaAlta = document.getElementById('fechaalta').value;
  
	// Validar los datos
	if (!idPaciente || !nif || !nombre || !apellidos || !fechaIngreso) {
	  alert('Por favor, complete todos los campos obligatorios');
	  return;
	}
  
	// Configurar la solicitud
	const requestOptions = {
	  method: 'PUT',
	  headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
	  body: `id=${idPaciente}&nif=${nif}&nombre=${nombre}&apellidos=${apellidos}&fecha_ingreso=${fechaIngreso}&fecha_alta=${fechaAlta}`
	};
  
	// Realizar la solicitud
	fetch('servicios/modificarpaciente.php', requestOptions)
	  .then(response => response.text())
	  .then(respuesta => {
		const codigo = respuesta.substring(0, 2);
		const mensaje = respuesta.substring(2);
  
		if (codigo === '00') {
		  alert('El paciente se ha modificado correctamente');
		} else {
		  alert(`Error al modificar el paciente: ${mensaje}`);
		}
	  })
	  .catch(error => console.error('Error al modificar el paciente:', error));}