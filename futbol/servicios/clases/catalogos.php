<?php
	require_once('../accesodatos/conexion.php');
	require_once('conferencia.php');
	require_once('equipo.php');
	require_once('jugador.php');
	
	class Catalogos extends Conexion
	{
		public static function conferencias()
		{
			$ids = array();
			$conferencias = array();
			parent::abrirConexion();
			$instruccion = 'select ConfId from conferencias';
			$comando = parent::$conexion->prepare($instruccion);
			$comando->execute();
			$comando->bind_result($idConferencia);
			while ($comando->fetch()) array_push($ids, $idConferencia);
			mysqli_stmt_close($comando);
			parent::cerrarConexion();
			foreach($ids as $id)
			{
				array_push($conferencias, new Conferencia($id));
			}
			return $conferencias;
		}
		
		public static function equipos($conferencia)
		{
			$ids = array();
			$equipos = array();
			parent::abrirConexion();
			$instruccion = 'select EquId from equipos where EquIdConferencia = ?';
			$comando = parent::$conexion->prepare($instruccion);
			$comando->bind_param('s', $conferencia); 
			$comando->execute();
			$comando->bind_result($idEquipo);
			while ($comando->fetch()) array_push($ids, $idEquipo);
			mysqli_stmt_close($comando);
			parent::cerrarConexion();
			foreach($ids as $id)
			{
				array_push($equipos, new Equipo($id));
			}
			return $equipos;
		}
		
		public static function posiciones()
		{
			$ids = array();
			$posiciones = array();
			parent::abrirConexion();
			$instruccion = 'select PosId from posiciones';
			$comando = parent::$conexion->prepare($instruccion);
			$comando->execute();
			$comando->bind_result($idPosicion);
			while ($comando->fetch()) array_push($ids, $idPosicion);
			mysqli_stmt_close($comando);
			parent::cerrarConexion();
			foreach($ids as $id)
			{
				array_push($posiciones, new Posicion($id));
			}
			return $posiciones;
		}
		
		public static function jugadores($equipo)
		{
			$ids = array();
			$jugadores = array();
			parent::abrirConexion();
			$instruccion = 'select JugId from jugadores where JugIdEquipo = ?';
			$comando = parent::$conexion->prepare($instruccion);
			$comando->bind_param('s', $equipo); 
			$comando->execute();
			$comando->bind_result($idJugador);
			while ($comando->fetch()) array_push($ids, $idJugador);
			mysqli_stmt_close($comando);
			parent::cerrarConexion();
			foreach($ids as $id)
			{
				array_push($jugadores, new Jugador($id));
			}
			return $jugadores;
		}
	}
?>










