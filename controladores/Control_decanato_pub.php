<?php

error_reporting(0);

include('../vistas/decanato_pub/logicavista.php');
include('../modelos/decanato.php');
include('../core/controller.php');

function controlador(){

$evento = 'mision';
$peticiones = array('mision', 'vision');

$evento = control($evento, $peticiones, 'decanato_pub');

$datos = FormDatos();

$decanato = new Decanato();
//$decanato2 = new Decanato();


switch ($evento) {
	
	case 'mision':
		$decanato->buscarMision();
		$data = $decanato->filas;

		
		retornar_vista($evento, $data, $parametros);
		
		break;

	case 'vision':
	
		$decanato->buscarVision();
		$data = $decanato->filas;

		
		retornar_vista('vision', $data, $parametros);
		
		break;
	
}

}

controlador();


 ?>