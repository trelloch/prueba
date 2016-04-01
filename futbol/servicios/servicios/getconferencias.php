<?php
	require_once('../clases/conferencia.php');
	require_once('../clases/catalogos.php');

	
	header('Access-Control-Allow-Origin: *');
	
	
	$json = '{"conferencias" : [';
	$primero =  true;
	$conferencias = Catalogos::conferencias();
	foreach($conferencias as $c)
	{
		if (!$primero) $json .= ','; else $primero = false;
		$json .= '	{ 
						"id" : "'.$c->getId().'",
						"nombre" : "'.$c->getNombre().'"
					}';
	}
	$json .= '] }';
	echo $json;
?>