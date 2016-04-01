<?php
	class Conexion
	{
		//atributos
		private static $servidor = 'localhost';
		private static $usuario = 'root';
		private static $contrasena = '';
		private static $baseDatos = 'futbol';
		//conexion
		protected static $conexion;
		//abrir conexion
		protected static function abrirConexion()
		{
			self::$conexion = new mysqli(self::$servidor, self::$usuario, self::$contrasena, self::$baseDatos);
		}
		//cerrar conexion
		protected static function cerrarConexion()
		{
			self::$conexion->close();
		}
	}
?>