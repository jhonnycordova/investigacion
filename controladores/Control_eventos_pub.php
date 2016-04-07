<?php

error_reporting(0);

include('../vistas/eventos_pub/logicavista.php');
include('../modelos/eventos.php');
include('../core/controller.php');

function controlador(){

$evento = 'verEventos';
$peticiones = array('verEventos');

$evento = control($evento, $peticiones, 'eventos_pub');

$datos = FormDatos();

$eventos = new Eventos();
//$eventos2 = new eventos();


switch ($evento) {
	
	case 'verEventos':

		$eventos->buscarEventos($datos["id_espacio"]);
		$data = $eventos->filas;
		retornar_vista($evento, $data, $parametros, $datos["id_espacio"]);
		
		break;
	
}

}

controlador();


 ?>