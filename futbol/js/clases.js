function Conferencia(id, nombre)
{
	if(typeof id!='undefined') this.id=id;
	if(typeof nombre !== 'undefined') this.nombre= nombre;
}

function Equipo(id, nombre, logo)
{
	if(typeof id!='undefined') this.id=id;
	if(typeof nombre !== 'undefined') this.nombre= nombre;
	if(typeof logo !== 'undefined') this.logo=logo;
}

function Jugador(id, nombre, numero, posicion, goles)
{
	if(typeof id!='undefined') this.id=id;
	if(typeof nombre !== 'undefined') this.nombre= nombre;
	if(typeof numero !== 'undefined') this.numero=numero;
	if(typeof posicion !== 'undefined') this.posicion=posicion;
	if(typeof goles !== 'undefined') this.goles=goles;
}