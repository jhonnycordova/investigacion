<?php

error_reporting(0);
include('seguridad.php');
include('../vistas/tipoproy/logicavista.php');
include('../modelos/tipoproy.php');
include('../core/controller.php');


function controlador(){

$evento = 'registrar';
$peticiones = array('registrar', 'verdatos', 'crear', 'buscar', 'editar', 'eliminar');

$evento = control($evento, $peticiones, 'tipoproy');

$datos = FormDatos();

$tipoproy = new Tipoproy();


switch ($evento) {
	
	case 'registrar':
		retornar_vista($evento, $data = array(), $parametros = array());
		break;

	case 'verdatos':

		verdatos($tipoproy);
		break;

	case 'crear':
		$tipoproy->crear($datos);
		$parametros = array('mensaje' => $tipoproy->mensaje, 'tipomsj' => $tipoproy->tipomsj);

		verdatos($tipoproy, $parametros);
		break;

	case 'buscar':
	
		$tipoproy->buscar($datos['id']);
		$data = $tipoproy->filas;

		retornar_vista('modificar', $data, $parametros = array());
		break;

	case 'editar':

	
		$tipoproy->editar($datos);
		$parametros = array('mensaje' => $tipoproy->mensaje, 'tipomsj' => $tipoproy->tipomsj);

		verdatos($tipoproy, $parametros);
		break;

	case 'eliminar':
		$tipoproy->eliminar($datos['id']);
		$parametros = array('mensaje' => $tipoproy->mensaje, 'tipomsj' => $tipoproy->tipomsj);
		verdatos($tipoproy, $parametros);
		break;

	
}

}

controlador();


 ?>