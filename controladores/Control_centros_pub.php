<?php
error_reporting(0);

include('../vistas/centros_pub/logicavista.php');
include('../modelos/centros.php');
include('../core/controller.php');

function controlador(){


$evento = 'vercentros';
$peticiones = array('vercentros', 'detalleCentro');

$evento = control($evento, $peticiones, 'centros_pub');

$datos = FormDatos();

$centros = new Centros();
$centros1 = new Centros();
$centros2 = new Centros();
$centros3 = new Centros();



switch ($evento) {
	
	case 'vercentros':
		$centros->buscarTodos();
		$data = $centros->filas;

		retornar_vista($evento, $data, $parametros);
		
		break;

	case 'detalleCentro':
		$centros->buscar($datos["id_centro"]);
		$data = $centros->filas;

		$centros1->buscarLineas($datos["id_centro"]);
		$dataLineas = $centros1->filas;

		$centros2->buscarProyectos($datos["id_centro"]);
		$dataProyectos = $centros2->filas;

		$centros3->buscarInvestigadores($datos["id_centro"]);
		$dataInvestigadores = $centros3->filas;

		

		retornar_vista('detalleCentro', $data, $parametros, $dataLineas, $dataProyectos, $dataInvestigadores);
		
		break;

	
	
}

}

controlador();


 ?>