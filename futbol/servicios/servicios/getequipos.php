<?php
	require_once('../clases/equipo.php');
	require_once('../clases/catalogos.php');

	
	header('Access-Control-Allow-Origin: *');
	
	//else invalids
	if (isset($_GET['conferencia']))
	{
		$c = new Conferencia($_GET['conferencia']);
		if ($c->getId() != '')
		{
			$equipos = Catalogos::equipos($_GET['conferencia']);
			$json = '{"status" : 0, "conferencia" : {
						"id" : "'.$c->getId().'",
						"nombre" : "'.$c->getNombre().'" },';
			$json .= '"equipos" : [';
			$primero =  true;
			
			foreach($equipos as $e)
			{
				if (!$primero) $json .= ','; else $primero = false;
				$json .= '{ 
							"id" : "'.$e->getId().'",
							"nombre" : "'.$e->getNombre().'",
							"logo" : "'.$e->getLogo().'"
						}';
			}
			
			$json .= '] }';
			echo $json;
			die();
		}
		else
			echo '{ "status" : 1, "mensaje" : "Grupo Invalido" }';
		
	}
	else
			echo '{ "status" : 2, "mensaje" : "Parametros Invalidos" }';
?>