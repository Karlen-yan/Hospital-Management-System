document.getElementById('alta').onclick = altaPaciente;

function altaPaciente() {
	//recuperar los datos del formulario
	let nif = document.querySelector('#nif').value
	let nombre = document.querySelector('#nombre').value;
	let apellidos = document.querySelector('#apellidos').value;
	let fechaIngreso = document.querySelector('#fechaingreso').value;
	//validar los datos (opcionalmente)
	try {
		if (nif === '') {
			throw 'El campo NIF es obligatorio';
		}
		if (nombre === '') {
			throw 'El campo Nombre es obligatorio';
		}
		if (apellidos === '') {
			throw 'El campo Apellidos es obligatorio';
		}
		if (fechaIngreso === '') {
			throw 'El campo Fecha Ingreso es obligatorio';
		}
	

	// Preparar los datos para enviar al servidor
	let url = 'servicios/altapaciente.php';
	let datos = new FormData();
	datos.append('nif', nif);
	datos.append('nombre', nombre);
	datos.append('apellidos', apellidos);
	datos.append('fechaingreso', fechaIngreso);

	// Enviar la petición al servidor
	fetch(url, {
		method: 'POST',
		body: datos
	  })
		.then(function(response) {
			console.log(response)
		  if (response.ok) {
			return response.text();
		  } else {
			throw 'Error en la petición ajax'
		  }
		})
		.then(data => {
		  // Gestionar la respuesta
		  var codigo = data.substring(0, 2);
		  var respuesta = data.substring(2);
		  if (codigo == '00') {
			alert(respuesta);
			console.log(respuesta);
			document.getElementById('formulario').reset();
		  } else {
			alert(respuesta);
			console.log(respuesta);
		  }
		})
		.catch(function(error) {
		  // Manejar errores de petición
		  console.error(error);
		  alert('Error en la petición ajax: ' + error);
		});
	} catch (error) {
		console.log(error);
		alert(error);
	}
}
