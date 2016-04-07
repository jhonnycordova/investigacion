<?php
error_reporting(0);
include('seguridad.php');
include('../vistas/normas/logicavista.php');

include('../modelos/normas.php');
include('../core/controller.php');


function controlador(){

$evento = 'registrar';
$peticiones = array('registrar', 'verdatos', 'crear', 'buscar', 'editar', 'eliminar');

$evento = control($evento, $peticiones, 'normas');

$datos = FormDatos();

$normas = new Normas();
$normas2 = new Normas();


switch ($evento) {
	
	case 'registrar':
		$normas->buscarEspacios();
		$data_select_espacios = $normas->filas;

		retornar_vista($evento, $data = array(), $parametros = array(), $data_select_espacios);
		break;

	case 'verdatos':

		verdatos($normas);
		break;

	case 'crear':
		
		$normas->crear($datos);
		$parametros = array('mensaje' => $normas->mensaje, 'tipomsj' => $normas->tipomsj);

		verdatos($normas, $parametros);
		break;

	case 'buscar':
	
		$normas->buscar($datos['id']);
		$data = $normas->filas;

		$normas2->buscarEspacios();
		$data_select_espacios = $normas2->filas;

		retornar_vista('modificar', $data, $parametros = array(), $data_select_espacios);
		break;

	case 'editar':

	
		$normas->editar($datos);
		$parametros = array('mensaje' => $normas->mensaje, 'tipomsj' => $normas->tipomsj);

		verdatos($normas, $parametros);
		break;

	case 'eliminar':
		$normas->eliminar($datos['id']);
		$parametros = array('mensaje' => $normas->mensaje, 'tipomsj' => $normas->tipomsj);
		verdatos($normas, $parametros);
		break;

	
}

}

controlador();


 ?>