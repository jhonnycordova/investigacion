<?php
error_reporting(0);
include('seguridad.php');

include('../vistas/eventos/logicavista.php');
include('../modelos/eventos.php');
include('../modelos/tipoeve.php');
include('../modelos/tipopub.php');
include('../modelos/areas.php');
include('../core/controller.php');


function controlador(){

$evento = 'registrar';
$peticiones = array('registrar', 'verdatos', 'crear', 'buscar', 'editar', 'eliminar', 'detalleEvento');

$evento = control($evento, $peticiones, 'eventos');

$datos = FormDatos();

$eventos = new Eventos();
$areas = new Areas();
$tipopub = new Tipopub();
$tipoeve = new Tipoeve();


switch ($evento) {
	
	case 'registrar':
		$tipoeve-> buscarTodos();
		$data_select_tipoeve = $tipoeve->filas;

		$tipopub->buscarTodos();
		$data_select_tipopub = $tipopub->filas;

		$areas->buscarTodos();
		$data_select_areas = $areas->filas;

		$eventos->buscarEspacios();
		$data_select_espacios = $eventos->filas;

		retornar_vista($evento, $data = array(), $parametros = array(), $data_select_tipoeve, $data_select_tipopub, $data_select_areas, $data_select_espacios);
		break;

	case 'verdatos':
		
		verdatos($eventos);
		break;

	case 'crear':
		

		$eventos->crear($datos);
		$parametros = array('mensaje' => $eventos->mensaje, 'tipomsj' => $eventos->tipomsj);
	

		verdatos($eventos, $parametros);
		break;

	case 'buscar':


	
		$eventos->buscar($datos['id']);
		$data = $eventos->filas;

		

		$tipoeve-> buscarTodos();
		$data_select_tipoeve = $tipoeve->filas;

		$tipopub->buscarTodos();
		$data_select_tipopub = $tipopub->filas;

		$areas->buscarTodos();
		$data_select_areas = $areas->filas;

		$eventos->buscarEspacios();
		$data_select_espacios = $eventos->filas;

		retornar_vista('modificar', $data, $parametros = array(), $data_select_tipoeve, $data_select_tipopub, $data_select_areas, $data_select_espacios);
		break;

	case 'editar':

		$eventos->editar($datos);
		$parametros = array('mensaje' => $eventos->mensaje, 'tipomsj' => $eventos->tipomsj);

		verdatos($eventos, $parametros);
		break;

	case 'eliminar':
		$eventos->eliminar($datos['id']);
		$parametros = array('mensaje' => $eventos->mensaje, 'tipomsj' => $eventos->tipomsj);
		verdatos($eventos, $parametros);
		break;

	case 'detalleEvento':
		$eventos->buscar($datos['id_evento']);
		$data = $eventos->filas;
		retornar_vista('detalleEvento', $data, $parametros = array());
		break;

	

	
}

}

controlador();


 ?>