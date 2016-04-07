<?php
error_reporting(0);
include('seguridad.php');
include('../vistas/tipoeve/logicavista.php');
include('../modelos/tipoeve.php');
include('../core/controller.php');


function controlador(){

$evento = 'registrar';
$peticiones = array('registrar', 'verdatos', 'crear', 'buscar', 'editar', 'eliminar');

$evento = control($evento, $peticiones, 'tipoeve');

$datos = FormDatos();

$tipoeve = new Tipoeve();



switch ($evento) {
	
	case 'registrar':
		retornar_vista($evento, $data = array(), $parametros = array());
		break;

	case 'verdatos':

		verdatos($tipoeve);
		break;

	case 'crear':
		
		$tipoeve->crear($datos);
		$parametros = array('mensaje' => $tipoeve->mensaje, 'tipomsj' => $tipoeve->tipomsj);

		verdatos($tipoeve, $parametros);
		break;

	case 'buscar':
	
		$tipoeve->buscar($datos['id']);
		$data = $tipoeve->filas;

		retornar_vista('modificar', $data, $parametros = array());
		break;

	case 'editar':

	
		$tipoeve->editar($datos);
		$parametros = array('mensaje' => $tipoeve->mensaje, 'tipomsj' => $tipoeve->tipomsj);

		verdatos($tipoeve, $parametros);
		break;

	case 'eliminar':
		$tipoeve->eliminar($datos['id']);
		$parametros = array('mensaje' => $tipoeve->mensaje, 'tipomsj' => $tipoeve->tipomsj);
		verdatos($tipoeve, $parametros);
		break;

	
}

}

controlador();


 ?>