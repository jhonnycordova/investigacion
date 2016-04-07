<?php
error_reporting(0);

include('../vistas/lineas_pub/logicavista.php');
include('../modelos/lineas.php');
include('../core/controller.php');

function controlador(){


$evento = 'linvestigacion';
$peticiones = array('linvestigacion', 'lextension', 'buscarLinea', 'buscarProy', 'buscarInv');

$evento = control($evento, $peticiones, 'lineas_pub');

$datos = FormDatos();

$lineas = new Lineas();



switch ($evento) {
	
	case 'linvestigacion':
		$lineas->buscarLinInv();
		$data = $lineas->filas;

		
		retornar_vista($evento, $data, $parametros);
		
		break;

	case 'lextension':
		$lineas->buscarLinExt();
		$data = $lineas->filas;

		
		retornar_vista('lextension', $data, $parametros);
		
		break;

	case 'buscarLinea':
		$lineas->buscar($datos["id_linea"]);
		$data = $lineas->filas;

		echo json_encode($data);
		
		break;

	case 'buscarProy':
		$lineas->buscarProyectos($datos["id_linea"]);
		$data = $lineas->filas;


		echo json_encode($data);
		
		break;

	case 'buscarInv':
		$lineas->buscarInvLinea($datos["id_linea"]);
		$data = $lineas->filas;

		
		
		echo json_encode($data);
		
		break;

	
	
}

}

controlador();


 ?>