//SCRIPT DE CONSULTA DE PACIENTES CON PAGINACION
document.querySelector('#numpacientes').onchange = function() {
	consultaPacientes();
}
//variable global de número de página donde nos encontramos
var pag = 1;

//activar listener combo pacientes a mostrar
document.querySelector('#buscaapellido').onkeyup = function() {
	consultaPacientes();
	}
//activar listener filtro de apellido
consultaPacientes();
//ejecutar función de consulta de pacientes al cargar el componente

//función de consulta de pacientes (como parámetro de entrada enviaremos la página a mostrar)
function consultaPacientes(p=1) {

	numPag = document.getElementById('pagina').value ?? 1;
	numPacientes = document.getElementById('fila').value ?? 5; 
	filtroApellidos = document.getElementById('buscaapellidos').value ?? null;

	try{
	//recuperar pacientes a mostrar de la combo y filtro de busqueda
	pag = p;
	//informar la petición ajax
	let url = "servicios/consultapacientes.php"
	let datos =  new FormData()
	datos.append(numPag);
	datos.append(numPacientes);
	datos.append(filtroApellidos);
	//enviar la petición al servidor
	fetch(url,datos)
	.then(function (respuesta){
		if(respuesta.ok){
			return respuesta.json();
		} else{
			throw 'error en la peticion al servidor'
		}
	})
	//con la respuesta montar la tabla con los pacientes y los enlaces de paginación
	} catch(error){
		alert("Error");
	}
}
