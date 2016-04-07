<?php

error_reporting(0);
include('seguridad.php');
include('../vistas/causas/logicavista.php');
include('../modelos/causas.php');
include('../core/controller.php');


function controlador(){

$evento = 'registrar';
$peticiones = array('registrar', 'verdatos', 'crear', 'buscar', 'editar', 'eliminar');

$evento = control($evento, $peticiones, 'causas');

$datos = FormDatos();

$causas = new Causas();


switch ($evento) {
	
	case 'registrar':
		retornar_vista($evento, $data = array(), $parametros = array());
		break;

	case 'verdatos':

		verdatos($causas);
		break;

	case 'crear':
		
		$causas->crear($datos);
		$parametros = array('mensaje' => $causas->mensaje, 'tipomsj' => $causas->tipomsj);

		verdatos($causas, $parametros);
		break;

	case 'buscar':
	
		$causas->buscar($datos['id']);
		$data = $causas->filas;

		retornar_vista('modificar', $data, $parametros = array());
		break;

	case 'editar':

	
		$causas->editar($datos);
		$parametros = array('mensaje' => $causas->mensaje, 'tipomsj' => $causas->tipomsj);

		verdatos($causas, $parametros);
		break;

	case 'eliminar':
		$causas->eliminar($datos['id']);
		$parametros = array('mensaje' => $causas->mensaje, 'tipomsj' => $causas->tipomsj);
		verdatos($causas, $parametros);
		break;

	
}

}

controlador();


 ?>