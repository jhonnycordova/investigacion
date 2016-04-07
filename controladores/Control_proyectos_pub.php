<?php
error_reporting(0);

include('../vistas/proyectos_pub/logicavista.php');
include('../modelos/proyectos.php');
include('../core/controller.php');

function controlador(){


$evento = 'linvestigacion';
$peticiones = array('pinvestigacion', 'pextension', 'buscarLinea', 'buscarProy', 'buscarInv', 'buscarCentro', 'buscarProy2', 'detallePro');

$evento = control($evento, $peticiones, 'proyectos_pub');

$datos = FormDatos();

$proyectos = new Proyectos();



switch ($evento) {
	
	case 'pinvestigacion':
		$proyectos->buscarCentros();
		$data = $proyectos->filas;


		
		retornar_vista($evento, $data, $parametros);
		
		break;

	case 'detallePro':
		$proyectos->buscar($datos["id_proyecto"]);
		$data = $proyectos->filas;

		
		
		retornar_vista('detallePro', $data, $parametros);
		
		break;

	case 'pextension':
		$proyectos->buscarLinExt();
		$data = $proyectos->filas;

		
		retornar_vista('pextension', $data, $parametros);
		
		break;

	case 'buscarLinea':
		$proyectos->buscarLinea($datos["id_linea"]);
		$data = $proyectos->filas;

		echo json_encode($data);
		
		break;

	case 'buscarProy':
		$proyectos->buscarProyectos2($datos["id_centro"]);
		$data = $proyectos->filas;


		echo json_encode($data);
		
		break;

	case 'buscarProy2':
		$proyectos->buscarProyectos($datos["id_linea"]);
		$data = $proyectos->filas;


		echo json_encode($data);
		
		break;

	case 'buscarInv':
		$proyectos->buscarInvLinea($datos["id_linea"]);
		$data = $proyectos->filas;

		
		
		echo json_encode($data);
		
		break;

	case 'buscarCentro':
		$proyectos->buscarCentro($datos["id_centro"]);
		$data = $proyectos->filas;


		echo json_encode($data);
		
		break;

	
	
}

}

controlador();


 ?>