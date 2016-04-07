<?php

error_reporting(0);
include('seguridad.php');
include('../vistas/cargos/logicavista.php');
include('../modelos/cargos.php');
include('../core/controller.php');


function controlador(){

$evento = 'registrar';
$peticiones = array('registrar', 'verdatos', 'crear', 'buscar', 'editar', 'eliminar');

$evento = control($evento, $peticiones, 'cargos');

$datos = FormDatos();

$cargos = new Cargos();


switch ($evento) {
	
	case 'registrar':
		retornar_vista($evento, $data = array(), $parametros = array());
		break;

	case 'verdatos':

		verdatos($cargos);
		break;

	case 'crear':
		$cargos->crear($datos);
		$parametros = array('mensaje' => $cargos->mensaje, 'tipomsj' => $cargos->tipomsj);

		verdatos($cargos, $parametros);
		break;

	case 'buscar':
	
		$cargos->buscar($datos['id']);
		$data = $cargos->filas;

		retornar_vista('modificar', $data, $parametros = array());
		break;

	case 'editar':

	
		$cargos->editar($datos);
		$parametros = array('mensaje' => $cargos->mensaje, 'tipomsj' => $cargos->tipomsj);

		verdatos($cargos, $parametros);
		break;

	case 'eliminar':
		$cargos->eliminar($datos['id']);
		$parametros = array('mensaje' => $cargos->mensaje, 'tipomsj' => $cargos->tipomsj);
		verdatos($cargos, $parametros);
		break;

	
}

}

controlador();


 ?>