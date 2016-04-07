<?php

error_reporting(0);
include('seguridad.php');
include('../vistas/jornadas/logicavista.php');
include('../modelos/jornadas.php');
include('../core/controller.php');


function controlador(){

$evento = 'registrar';
$peticiones = array('registrar', 'verdatos', 'crear', 'buscar', 'editar', 'eliminar');

$evento = control($evento, $peticiones, 'jornadas');

$datos = FormDatos();
$datosArchivo = FormFiles();

$jornadas = new Jornadas();


switch ($evento) {
	
	case 'registrar':
		retornar_vista($evento, $data = array(), $parametros = array());
		break;

	case 'verdatos':
	
		verdatos($jornadas);
		break;

	case 'crear':

		$jornadas->crear($datos, $datosArchivo);
		$parametros = array('mensaje' => $jornadas->mensaje, 'tipomsj' => $jornadas->tipomsj);

		verdatos($jornadas, $parametros);
		break;

	case 'buscar':
	
		$jornadas->buscar($datos['id']);
		$data = $jornadas->filas;



		retornar_vista('modificar', $data, $parametros = array());
		break;

	case 'editar':

	
		$jornadas->editar($datos, $datosArchivo);
		$parametros = array('mensaje' => $jornadas->mensaje, 'tipomsj' => $jornadas->tipomsj);

		verdatos($jornadas, $parametros);
		break;

	case 'eliminar':
		$jornadas->eliminar($datos['id']);
		$parametros = array('mensaje' => $jornadas->mensaje, 'tipomsj' => $jornadas->tipomsj);
		verdatos($jornadas, $parametros);
		break;

	
}

}

controlador();


 ?>