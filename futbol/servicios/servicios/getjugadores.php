<?php
	require_once('../clases/jugador.php');
	require_once('../clases/catalogos.php');

	
	header('Access-Control-Allow-Origin: *');
	
	if (isset($_GET['equipo']))
	{
		$e = new Equipo($_GET['equipo']);
		if ($e->getId() != '')
		{
			$jugadores = Catalogos::jugadores($_GET['equipo']);
			$json = '{"status" : 0, "equipo" : {
							"id" : "'.$e->getId().'",
							"nombre" : "'.$e->getNombre().'",
							"conferencia" : {
								"id" : "'.$e->getConferencia()->getId().'",
								"nombre" : "'.$e->getConferencia()->getNombre().'"
							},
							"logo" : "'.$e->getLogo().'" },';
			$json .= '"jugadores" : [';
			$primero =  true;
			foreach($jugadores as $j)
			{
				if (!$primero) $json .= ','; else $primero = false;
				$json .= '{ 
							"id" : "'.$j->getId().'",
							"nombre" : "'.$j->getNombre().'",
							"numero" : "'.$j->getNumero().'",
							"posicion" : {
								"id" : "'.$j->getPosicion()->getId().'",
								"nombre" : "'.$j->getPosicion()->getNombre().'"
								},
							"goles" : "'.$j->getGoles().'"
						}';
			}
			$json .= ']}';
			echo $json;
		}
		else
			echo '{ "status" : 1, "mensaje" : "Grupo Invalido" }';
		
	}
	else
			echo '{ "status" : 2, "mensaje" : "Parametros Invalidos" }';
?>
