
var valores = [];

var barras = [];

var idTimer = 0;
var svgBarra, svgPie; 
var titulosY = [ ];
var colores = ['#00CC00', '#66CC00', '#CCCC00', '#CC6600', '#CC0000' ];
var jugadores= [];
//timer
function inicializar()
{
	
	desplegarJugadores();
}
//dibujar gráficas vacias
function dibujarGraficas()
{

	svgBarra = document.getElementById('svgBarra');
	//gráfica de barra
	var barraTitulo = dibujarTexto(svgBarra, 'Goles Anotados Por Jugador', '40%', '30px', 'middle', 24, '#AAA'); 
	//eje de las Y
	dibujarLinea(svgBarra, '15%', '50px', '15%', '350px', '#AAA');
	var y = 110;
	for (var i = 0; i < titulosY.length; i++)
	{
		//dibujar punto
		dibujarLinea(svgBarra, '14%', (y + 'px'), '16%', (y + 'px'), '#AAA');
		dibujarTexto(svgBarra, titulosY[i], '14%', ((y - 23) + 'px'), 'end', 10, '#AAA');
		//crear barras
		dibujarRectangulo(svgBarra, '15%', ((y - 50) + 'px'), '3px', '40px', '#AAA', colores[i], 'barra' + i);
		y += 60;
	}
	//eje X
	dibujarLinea(svgBarra, '15%', '350px', '95%', '350px', '#AAA');
	var x = 15;
	for (var i = 0; i <= 100; i += 10)
	{
		dibujarLinea(svgBarra, (x + '%'), '345px', (x + '%'), '350px', '#AAA');
		dibujarTexto(svgBarra, i, (x + '%'), '370px', 'middle', 10, '#AAA'); 
		x += 8;
	}
	//gráfica de pie
	
}

function desplegarJugadores()
{
	var jugadoresJSON= JSON.parse(localStorage['jugadores']);
	var jugador = jugadoresJSON;
	var suma= 0;
	for(var i=0; i<jugadoresJSON.length;i++)
	{
		valores[i] = parseFloat(jugador[i].goles);
		titulosY[i] = jugador[i].nombre;
		suma +=valores[i];
	}
	document.getElementById('golesCO2').innerHTML=suma;
	dibujarGraficas();
	graficar();
	
}

//mostrar gráficas
function graficar()
{

	svgBarra = document.getElementById('svgBarra');
	//recorrer valores
	for (var i = 0; i < valores.length; i++)
	{
		//accesar barra
		var barra = document.getElementById('barra' + i);
		//quitar atributo width
		barra.removeAttribute('width');
		//calcular ancho de la barra
		var ancho = valores[i] * 0.8;
		//asignar ancho de la barra
		barra.setAttribute('width', ancho + '%');
	}
	
}







