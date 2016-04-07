<?php
error_reporting(0);
include('seguridad.php');
include('../vistas/lineas/logicavista.php');
include('../modelos/lineas.php');
include('../modelos/programas.php');
include('../modelos/centros.php');
include('../core/controller.php');



function controlador(){

$evento = 'registrar';
$peticiones = array('registrar', 'verdatos', 'crear', 'eliminar', 'buscar', 'editar', 'buscarCentros');

$evento = control($evento, $peticiones, 'lineas');

$datos = FormDatos();


$lineas = new Lineas();
$programas = new Programas();
$centros = new Centros();

switch ($evento) {
	
	case 'registrar':
		$programas->buscarTodos();
		$data_select_prog = $programas->filas;



		retornar_vista($evento, $data = array(), $parametros = array(), $data_select_prog);
		break;

	case 'verdatos':
		verdatos($lineas);
		break;

	case 'crear':
		$lineas->crear($datos);
		$parametros = array('mensaje' => $lineas->mensaje, 'tipomsj' => $lineas->tipomsj);

		verdatos($lineas, $parametros);
		break;

	case 'eliminar':

		$lineas->eliminar($datos['id']);
		$parametros = array('mensaje' => $lineas->mensaje, 'tipomsj' => $lineas->tipomsj);
		verdatos($lineas, $parametros);
		break;

	case 'buscar':
		$lineas->buscar($datos['id']);
		$data = $lineas->filas;

		$programas->buscarTodos();
		$data_select_prog = $programas->filas;

		$centros->buscarTodos();
		$data_select_centro = $centros->filas;

		retornar_vista('modificar', $data, $parametros = array(), $data_select_prog, $data_select_centro);
		break;

	case 'editar':
		
		$lineas->editar($datos);
		$parametros = array('mensaje' => $lineas->mensaje, 'tipomsj' => $lineas->tipomsj);

		verdatos($lineas, $parametros);
		break;

	case 'buscarCentros':

		$lineas->buscarCentros();
		$data = $lineas->filas;
		echo json_encode($data);
		break;
	
}

}

controlador();


 ?>