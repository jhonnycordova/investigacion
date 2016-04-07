<?php

error_reporting(0);
include('seguridad.php');
include('../vistas/centros/logicavista.php');
include('../modelos/centros.php');
include('../core/controller.php');


function controlador(){

$evento = 'registrar';
$peticiones = array('registrar', 'verdatos', 'crear', 'eliminar', 'buscar', 'editar');

$evento = control($evento, $peticiones, 'centros');

$datos = FormDatos();
$datosImagen = FormFiles();

$centros = new Centros();

switch ($evento) {
	
	case 'registrar':
		
		retornar_vista($evento, $data = array(), $parametros = array());
		break;

	case 'verdatos':

		$parametros = array('mensaje' => $datos["mensaje"], 'tipomsj' => $datos["tipomsj"]);
		verdatos($centros, $parametros);
		break;

	case 'crear':
		
		$centros->crear($datos);
		$parametros = array('mensaje' => $centros->mensaje, 'tipomsj' => $centros->tipomsj);
		
		header('Location: /investigacion/centros/verdatos/?mensaje='.$centros->mensaje.'&tipomsj='.$centros->tipomsj);
		break;

	case 'eliminar':

		$centros->eliminar($datos['id']);
		$parametros = array('mensaje' => $centros->mensaje, 'tipomsj' => $centros->tipomsj);
		verdatos($centros, $parametros);
		break;

	case 'buscar':
		$centros->buscar($datos['id']);
		$data = $centros->filas;

		retornar_vista('modificar', $data, $parametros = array());
		break;

	case 'editar':
		$centros->editar($datos);
		$parametros = array('mensaje' => $centros->mensaje, 'tipomsj' => $centros->tipomsj);

		header('Location: /investigacion/centros/verdatos/?mensaje='.$centros->mensaje.'&tipomsj='.$centros->tipomsj);
		
		break;
	
}

}

controlador();


 ?>