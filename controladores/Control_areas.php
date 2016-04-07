<?php

error_reporting(0);
include('seguridad.php');
include('../vistas/areas/logicavista.php');
include('../modelos/areas.php');
include('../core/controller.php');


function controlador(){

$evento = 'registrar';
$peticiones = array('registrar', 'verdatos', 'crear', 'buscar', 'editar', 'eliminar');

$evento = control($evento, $peticiones, 'areas');

$datos = FormDatos();

$areas = new Areas();


switch ($evento) {
	
	case 'registrar':
		retornar_vista($evento, $data = array(), $parametros = array());
		break;

	case 'verdatos':

		verdatos($areas);
		break;

	case 'crear':
		
		$areas->crear($datos);
		$parametros = array('mensaje' => $areas->mensaje, 'tipomsj' => $areas->tipomsj);

		verdatos($areas, $parametros);
		break;

	case 'buscar':
	
		$areas->buscar($datos['id']);
		$data = $areas->filas;

		retornar_vista('modificar', $data, $parametros = array());
		break;

	case 'editar':

	
		$areas->editar($datos);
		$parametros = array('mensaje' => $areas->mensaje, 'tipomsj' => $areas->tipomsj);

		verdatos($areas, $parametros);
		break;

	case 'eliminar':
		$areas->eliminar($datos['id']);
		$parametros = array('mensaje' => $areas->mensaje, 'tipomsj' => $areas->tipomsj);
		verdatos($areas, $parametros);
		break;

	
}

}

controlador();


 ?>