<?php
error_reporting(0);

include('../vistas/autoridades_pub/logicavista.php');
include('../modelos/autoridades.php');
include('../core/controller.php');

function controlador(){


$evento = 'ver';
$peticiones = array('ver');

$evento = control($evento, $peticiones, 'autoridades_pub');

$datos = FormDatos();

$autoridades = new Autoridades();



switch ($evento) {
	
	case 'ver':
		$autoridades->buscarTodos();
		$data = $autoridades->filas;

		
		retornar_vista($evento, $data, $parametros);
		
		break;

	
	
}

}

controlador();


 ?>