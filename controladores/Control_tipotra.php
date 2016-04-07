<?php
error_reporting(0);
include('seguridad.php');
include('../vistas/tipotra/logicavista.php');
include('../modelos/tipotra.php');
include('../core/controller.php');


function controlador(){

$evento = 'registrar';
$peticiones = array('registrar', 'verdatos', 'crear', 'buscar', 'editar', 'eliminar');

$evento = control($evento, $peticiones, 'tipotra');

$datos = FormDatos();

$tipotra = new Tipotra();



switch ($evento) {
	
	case 'registrar':
		retornar_vista($evento, $data = array(), $parametros = array());
		break;

	case 'verdatos':

		verdatos($tipotra);
		break;

	case 'crear':
		
		$tipotra->crear($datos);
		$parametros = array('mensaje' => $tipotra->mensaje, 'tipomsj' => $tipotra->tipomsj);

		verdatos($tipotra, $parametros);
		break;

	case 'buscar':
	
		$tipotra->buscar($datos['id']);
		$data = $tipotra->filas;

		retornar_vista('modificar', $data, $parametros = array());
		break;

	case 'editar':

	
		$tipotra->editar($datos);
		$parametros = array('mensaje' => $tipotra->mensaje, 'tipomsj' => $tipotra->tipomsj);

		verdatos($tipotra, $parametros);
		break;

	case 'eliminar':
		$tipotra->eliminar($datos['id']);
		$parametros = array('mensaje' => $tipotra->mensaje, 'tipomsj' => $tipotra->tipomsj);
		verdatos($tipotra, $parametros);
		break;

	
}

}

controlador();


 ?>