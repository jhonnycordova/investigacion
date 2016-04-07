<?php
error_reporting(0);

include('../vistas/investigadores_pub/logicavista.php');
include('../modelos/investigadores.php');
include('../core/controller.php');

function controlador(){


$evento = 'iinvestigacion';
$peticiones = array('iinvestigacion', 'iextension', 'buscarLinea', 'buscarProy', 'buscarInv', 'buscarCentro', 'buscarProy2', 'detalleInv', 'buscarInvLinea');

$evento = control($evento, $peticiones, 'investigadores_pub');

$datos = FormDatos();

$investigadores = new investigadores();



switch ($evento) {
	
	case 'iinvestigacion':
		$investigadores->buscarCentros();
		$data = $investigadores->filas;
		
		retornar_vista($evento, $data, $parametros);
		
		break;

	case 'detalleInv':
		$investigadores->buscar($datos["id_investigador"]);
		$data = $investigadores->filas;

		
		
		retornar_vista('detalleInv', $data, $parametros);
		
		break;

	case 'iextension':
		$investigadores->buscarLinExt();
		$data = $investigadores->filas;

		
		retornar_vista('iextension', $data, $parametros);
		
		break;

	case 'buscarLinea':
		$investigadores->buscarLinea($datos["id_linea"]);
		$data = $investigadores->filas;

		echo json_encode($data);
		
		break;

	case 'buscarInvLinea':
		$investigadores->buscarInvLinea($datos["id_linea"]);
		$data = $investigadores->filas;

		echo json_encode($data);
		
		break;

	case 'buscarProy':
		$investigadores->buscarinvestigadores2($datos["id_centro"]);
		$data = $investigadores->filas;


		echo json_encode($data);
		
		break;

	case 'buscarProy2':
		$investigadores->buscarinvestigadores($datos["id_linea"]);
		$data = $investigadores->filas;


		echo json_encode($data);
		
		break;

	case 'buscarInv':
		$investigadores->buscarInvCentro($datos["id_centro"]);
		$data = $investigadores->filas;

		
		
		echo json_encode($data);
		
		break;

	case 'buscarCentro':
		$investigadores->buscarCentro($datos["id_centro"]);
		$data = $investigadores->filas;


		echo json_encode($data);
		
		break;

	
	
}

}

controlador();


 ?>