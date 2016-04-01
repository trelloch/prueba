<?php
	require_once('../accesodatos/conexion.php');
	require_once('conferencia.php');
	
	class Equipo extends Conexion
	{
		//atributos
		private $id='';
		private $nombre='';
		private $conferencia='';
		private $logo='';
		
		//metodos
		public function getId() {return $this->id;}
		public function setId($valor) {$this->id=$valor;}
		public function getNombre() {return $this->nombre;}
		public function setNombre($valor) {$this->nombre=$valor;}
		public function getConferencia() {return $this->conferencia;}
		public function setConferencia($valor) {$this->conferencia=$valor;}
		public function getLogo() {return $this->logo;}
		public function setLogo($valor) {$this->logo=$valor;}
		
		public function __construct()
		{
			$argumentos = func_get_args();
			if(func_num_args() == 0)
			{
				$this->id = '';
				$this->nombre='';
				$this->conferencia=new Conferencia();
				$this->logo='';
			}

			//o sea si recibe un argumento
			if(func_num_args() == 1)
			{
				$instruccion = 'select EquId , EquNombre, EquIdConferencia, EquLogo from equipos where EquId=?';
				parent::abrirConexion();
				$comando = parent::$conexion->prepare($instruccion);
				$comando->bind_param('s', $argumentos[0]);
				$comando->execute(); 
				$comando->bind_result($id, $nombre, $conferencia, $logo); 
				$encontro = $comando->fetch(); 
				mysqli_stmt_close($comando); 
				parent::cerrarConexion(); 
				if ($encontro)
				{
					$this->id = $id;
					$this->nombre=$nombre;
					$this->conferencia=new Conferencia($conferencia);
					$this->logo=$logo;
				}
				else
				{
					$this->id = '';
					$this->nombre='';
					$this->conferencia=new Conferencia();
					$this->logo='';
				}
			}
		}
	}