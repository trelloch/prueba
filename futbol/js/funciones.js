var x= new XMLHttpRequest();
var urlServidor= 'http://proyecto.futbol/futbol/servicios/servicios/';
var urlConferencias= urlServidor + 'getconferencias.php';
var urlEquipos = urlServidor + 'getequipos.php';
var urlJugadores= urlServidor + 'getjugadores.php';


function cargarConferencias()
{
	x.open('POST', urlConferencias, true);
	x.onreadystatechange= function()
	{
		if(x.status ==200 & x.readyState==4)
		{
			//console.log(x.responseText);
			parsearConferencias(x.responseText);
		}
	}
	x.send();
}

function parsearConferencias(respuesta)
{
	var datosJSON = JSON.parse(respuesta);
	var conferenciasJSON = datosJSON.conferencias;
	var conferencias = [];
	for(var i=0; i < conferenciasJSON.length; i++)
	{
		var conferenciaJSON = conferenciasJSON[i];
		conferencia = new Conferencia(conferenciaJSON.id, conferenciaJSON.nombre);
		conferencias[i]= conferencia;
	}
	//console.log(conferencias);
	desplegarConferencias(conferencias);
}

function desplegarConferencias(datos)
{
	var select = document.getElementById('selConf');
	for(var i=0; i< datos.length; i++)
	{
		var opcion= document.createElement('option');
		opcion.value= datos[i].id;
		opcion.text= datos[i].nombre;
		select.appendChild(opcion);
	}
}

function cargarEquipos(valor)
{
	if(valor != "")
	{
		var url = urlEquipos + '?conferencia=' + valor;
		x.open('GET', url, true);
		x.onreadystatechange = function()
		{
			if(x.status==200 & x.readyState==4)
			{
				console.log(x.responseText);
				parsearEquipos(x.responseText);
			}
		}
		x.send();
	}
}

function parsearEquipos(respuesta)
{
	var datosJSON = JSON.parse(respuesta);
	var equiposJSON = datosJSON.equipos;
	var equipos = [];
	for(var i=0; i<equiposJSON.length;i++)
	{
		var equipoJSON= equiposJSON[i];
		var equipo= new Equipo(equipoJSON.id, equipoJSON.nombre, equipoJSON.logo);
		equipos[i]= equipo;
	}
	//console.log(equipos);
	desplegarEquipos(equipos);
}

function desplegarEquipos(equipos)
{

	var tabla = document.getElementById('tablaEquipos'); 
	var clase = 'renglon';
	for (var i = tabla.rows.length; i > 1; i--)
		tabla.removeChild(tabla.childNodes[i]);
	for (var i = 0; i < equipos.length; i++)
	{
		var equipo = equipos[i];
		var renglon = document.createElement('tr');
		renglon.className = clase;
		renglon.setAttribute('onMouseOver', "this.className='renglonseleccionado';");
		renglon.setAttribute('onMouseOut', "this.className='" + clase + "'");
		renglon.setAttribute('onClick', "cargarJugadores('" + equipo.id + "'); ");
		if (clase == 'renglon') 
			clase = 'renglonalterno';
		else
			clase = 'renglon';
		var celdaId = document.createElement('td');
		celdaId.innerHTML = equipo.id;
		celdaId.style.width = '30%';
		var celdaNombre = document.createElement('td');
		celdaNombre.innerHTML = equipo.nombre;
		celdaNombre.style.width = '35%';
		var celdaLogo = document.createElement('td');
		var imagenLogo= document.createElement('img');
		imagenLogo.src = "logos/" + equipo.logo;
		imagenLogo.style.width='200px';
		imagenLogo.style.height='200px';
		celdaLogo.appendChild(imagenLogo);
		celdaLogo.style.width = '25%';
		celdaLogo.style.height = '25%';
		renglon.appendChild(celdaLogo);
		renglon.appendChild(celdaId);
		renglon.appendChild(celdaNombre);
		
		tabla.appendChild(renglon);
	}
}

function cargarJugadores(valor)
{
	if(valor != "")
	{
		
		var url = urlJugadores + '?equipo='+valor;
		x.open('GET', url, true);
		x.onreadystatechange = function()
		{
			if(x.status==200 & x.readyState==4)
			{
			
				console.log(x.responseText);
				parsearJugadores(x.responseText);
			}
		}
		x.send();
		
	}
}

function parsearJugadores(respuesta)
{
	var datosJSON = JSON.parse(respuesta);
	var jugadoresJSON = datosJSON.jugadores;
	jugadores = [];
	for(var i=0; i<jugadoresJSON.length;i++)
	{
		var jugadorJSON= jugadoresJSON[i];
		var jugador= new Jugador(jugadorJSON.id, jugadorJSON.nombre, jugadorJSON.numero, jugadorJSON.posicion, jugadorJSON.goles);
		jugadores[i]= jugador;
	}

	localStorage['jugadores']=JSON.stringify(jugadores);
	//console.log(jugadores);
	window.location="http://proyecto.futbol/futbol/servicios/index.html";
	
}
function borrarJugadores()
{
	var tabla = document.getElementById('tablaJugadores'); 
	var clase = 'renglon';
	for (var i = tabla.rows.length; i > 1; i--)
		tabla.removeChild(tabla.childNodes[i]);
	document.getElementById("regresarEquipos").style.visibility = "hidden"
}

function ocultarBoton()
{
	document.getElementById("regresarEquipos").style.visibility = "hidden"
}

function verEquipos()
{
    document.getElementById("regresarEquipos").style.visibility = "hidden"
	var tabla = document.getElementById('tablaJugadores'); 
	var clase = 'renglon';
	for (var i = tabla.rows.length; i > 1; i--)
		tabla.removeChild(tabla.childNodes[i]);
	cargarEquipos(document.getElementById('selConf').value);
}

function desplegarJugadores(jugadores)
{
    document.getElementById("regresarEquipos").style.visibility = "visible"
	var tabla1 = document.getElementById('tablaEquipos'); 
	var clase1 = 'renglon';
	for (var i = tabla1.rows.length; i > 1; i--)
		tabla1.removeChild(tabla1.childNodes[i]);


	var tabla = document.getElementById('tablaJugadores'); 
	var clase = 'renglon';
	for (var i = tabla.rows.length; i > 1; i--)
		tabla.removeChild(tabla.childNodes[i]);
	for (var i = 0; i < jugadores.length; i++)
	{
		var jugador = jugadores[i];
		var renglon = document.createElement('tr');
		renglon.className = clase;
		renglon.setAttribute('onMouseOver', "this.className='renglonseleccionado';");
		renglon.setAttribute('onMouseOut', "this.className='" + clase + "'");
		
		if (clase == 'renglon') 
			clase = 'renglonalterno';
		else
			clase = 'renglon';
		
		var celdaId = document.createElement('td');
		celdaId.innerHTML = jugador.id;
		celdaId.style.width = '15%';
		
		var celdaNombre = document.createElement('td');
		celdaNombre.innerHTML = jugador.nombre;
		celdaNombre.style.width = '35%';
		
		var celdaNumero = document.createElement('td');
		celdaNumero.innerHTML = jugador.numero;
		celdaNumero.style.width = '15%';
		
		var celdaPosicion = document.createElement('td');
		celdaPosicion.innerHTML = jugador.posicion.nombre;
		celdaPosicion.style.width = '35%';
		
		renglon.appendChild(celdaId);
		renglon.appendChild(celdaNombre);
		renglon.appendChild(celdaNumero);
		renglon.appendChild(celdaPosicion);
		
		tabla.appendChild(renglon);
	}
}









