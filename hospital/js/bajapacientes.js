

function bajaPaciente() {
	const idPaciente = document.getElementById('id').value;
	if (!idPaciente) {
	  alert('Debe seleccionar un paciente para dar de baja');
	  return;
	}
	fetch('servicios/bajapaciente.php', {
	  method: 'POST',
	  headers: {
		'Content-Type': 'application/x-www-form-urlencoded',
	  },
	  body: `id=${idPaciente}`,
	})
	  .then((response) => response.text())
	  .then((respuesta) => {
		const codigo = respuesta.substring(0, 2);
		const mensaje = respuesta.substring(2);
	
		if (codigo === '00') {

		  // Borrar el storage
		  sessionStorage.removeItem('idpaciente');
		  // Volver a la consulta
		  window.location.href = 'hospital.php?consulta';
		} else {
		  // Error al dar de baja
		  alert(`Error al dar de baja: ${mensaje}`);
		}
	  })
	  .catch((error) => {
		console.error('Error en la petición de baja de paciente:', error);
		alert('Ha ocurrido un error al intentar dar de baja al paciente');
	  });  
	}