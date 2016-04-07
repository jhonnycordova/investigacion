<?php

error_reporting(0);
include('seguridad.php');
include('../vistas/autores/logicavista.php');
include('../modelos/autores.php');
include('../core/controller.php');


function controlador(){

$evento = 'registrar';
$peticiones = array('registrar', 'verdatos', 'crear', 'buscar', 'editar', 'eliminar');

$evento = control($evento, $peticiones, 'autores');

$datos = FormDatos();

$autores = new Autores();


switch ($evento) {
	
	case 'registrar':
		retornar_vista($evento, $data = array(), $parametros = array());
		break;

	case 'verdatos':

		verdatos($autores);
		break;

	case 'crear':

		$autores->crear($datos);
		$parametros = array('mensaje' => $autores->mensaje, 'tipomsj' => $autores->tipomsj);

		
		verdatos($autores, $parametros);
		break;

	case 'buscar':
	
		$autores->buscar($datos['id']);
		$data = $autores->filas;

		retornar_vista('modificar', $data, $parametros = array());
		break;

	case 'editar':

	
		$autores->editar($datos);
		$parametros = array('mensaje' => $autores->mensaje, 'tipomsj' => $autores->tipomsj);

		verdatos($autores, $parametros);
		break;

	case 'eliminar':
		$autores->eliminar($datos['id']);
		$parametros = array('mensaje' => $autores->mensaje, 'tipomsj' => $autores->tipomsj);
		verdatos($autores, $parametros);
		break;

	
}

}

controlador();


 ?>