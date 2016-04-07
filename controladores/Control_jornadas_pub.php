<?php
error_reporting(0);

include('../vistas/jornadas_pub/logicavista.php');
include('../modelos/jornadas.php');
include('../core/controller.php');

function controlador(){


$evento = 'ver';
$peticiones = array('ver');

$evento = control($evento, $peticiones, 'jornadas_pub');

$datos = FormDatos();

$jornadas = new Jornadas();



switch ($evento) {
	
	case 'ver':
		$jornadas->buscarTodosOrd();
		$data = $jornadas->filas;

	
		
		retornar_vista($evento, $data, $parametros);
		
		break;

	
	
}

}

controlador();


 ?>