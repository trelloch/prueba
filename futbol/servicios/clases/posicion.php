<?php
	require_once('../accesodatos/conexion.php');
	
	class Posicion extends Conexion
	{
		//atributos
		private $id = 0;
		private $nombre = '';
		
		//metodos
		public function getId() { return $this->id; }
		public function setId($valor) { $this->id = $valor; }
		public function getNombre() { return $this->nombre; }
		public function setNombre($valor) { $this->nombre = $valor; }
		
		public function __construct()
		{
			$argumentos = func_get_args();
			if (func_num_args() == 0)
			{
				$this->id = 0;
				$this->nombre = '';
			}
			if (func_num_args() == 1)
			{
				$instruccion = 'select PosId, PosNombre from posiciones where PosId = ?';
				parent::abrirConexion(); 
				$comando = parent::$conexion->prepare($instruccion); 
				$comando->bind_param('s', $argumentos[0]); 
				$comando->execute(); 
				$comando->bind_result($id, $nombre);
				$encontro = $comando->fetch();
				mysqli_stmt_close($comando); 
				parent::cerrarConexion();
				if($encontro)
				{
					$this->id = $id;
					$this->nombre = $nombre;
				}
				else
				{
					$this->id = 0;
					$this->nombre = '';
				}
			}
		}
	}
?>