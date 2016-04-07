<?php

error_reporting(0);
include('seguridad.php');
include('../vistas/espinv/logicavista.php');
include('../modelos/espinv.php');
include('../core/controller.php');


function controlador(){

$evento = 'registrar';
$peticiones = array('registrar', 'verdatos', 'crear', 'buscar', 'editar', 'eliminar');

$evento = control($evento, $peticiones, 'espinv');

$datos = FormDatos();

$espinv = new Espinv();


switch ($evento) {
	
	case 'registrar':
		retornar_vista($evento, $data = array(), $parametros = array());
		break;

	case 'verdatos':

		verdatos($espinv);
		break;

	case 'crear':
		$espinv->crear($datos);
		$parametros = array('mensaje' => $espinv->mensaje, 'tipomsj' => $espinv->tipomsj);

		verdatos($espinv, $parametros);
		break;

	case 'buscar':
	
		$espinv->buscar($datos['id']);
		$data = $espinv->filas;

		retornar_vista('modificar', $data, $parametros = array());
		break;

	case 'editar':

	
		$espinv->editar($datos);
		$parametros = array('mensaje' => $espinv->mensaje, 'tipomsj' => $espinv->tipomsj);

		verdatos($espinv, $parametros);
		break;

	case 'eliminar':
		$espinv->eliminar($datos['id']);
		$parametros = array('mensaje' => $espinv->mensaje, 'tipomsj' => $espinv->tipomsj);
		verdatos($espinv, $parametros);
		break;

	
}

}

controlador();


 ?>