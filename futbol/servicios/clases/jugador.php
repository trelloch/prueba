<?php
	require_once('../accesodatos/conexion.php');
	require_once('equipo.php');
	require_once('posicion.php');
	
	class Jugador extends Conexion
	{
		//atributos
		private $id=0;
		private $nombre='';
		private $goles=0;
		private $numero=0;
		private $equipo='';
		private $posicion='';

		//metodos
		public function getId() {return $this->id;}
		public function setId($valor) {$this->id=$valor;}
		public function getNombre() {return $this->nombre;}
		public function setNombre($valor) {$this->nombre=$valor;}
		public function getGoles() {return $this->goles;}
		public function setGoles($valor) {$this->goles=$valor;}
		public function getNumero() {return $this->numero;}
		public function setNumero($valor) {$this->numero=$valor;}
		public function getEquipo() {return $this->equipo;}
		public function setEquipo($valor) {$this->equipo=$valor;}
		public function getPosicion() {return $this->posicion;}
		public function setPosicion($valor) {$this->posicion=$valor;}
		
		public function __construct()
		{
			$argumentos = func_get_args();
			if(func_num_args() == 0)
			{
				$this->id=0;
				$this->nombre=''; 
				$this->goles=0;
				$this->numero=0;
				$this->equipo=new Equipo();
				$this->posicion=new Posicion();
			}

			//o sea si recibe un argumento
			if(func_num_args() == 1)
			{
				//recibe los argumentosdentro de un array
				$arguments = func_get_args();
				//agregar el id
				$idJugador=$arguments[0];
				$instruccion = 'select JugId, JugNombre, JugNumero, JugIdEquipo, JugIdPosicion, JugGoles from jugadores where JugId= ?';			
				//abrir la conxion a MYSQL
				parent::abrirConexion();
				//prepare el command
				$comando = parent::$conexion->prepare($instruccion);
				$comando->bind_param('i', $argumentos[0]);
				$comando->execute(); 
				//link results to class attributes
				$comando->bind_result($id, $nombre, $numero, $equipo, $posicion, $goles); 
				$encontro = $comando->fetch(); 
				mysqli_stmt_close($comando); 
				parent::cerrarConexion(); 
				if ($encontro)
				{
					$this->id=$id;
					$this->nombre=$nombre; 
					$this->goles=$goles;
					$this->numero=$numero;
					$this->equipo=new Equipo($equipo);
					$this->posicion=new Posicion($posicion);
				}
				else
				{
					$this->id=0;
					$this->nombre='';
					$this->goles=0; 
					$this->numero=0;
					$this->equipo=new Equipo();
					$this->posicion=new Posicion();
				}
			}
		}
	}