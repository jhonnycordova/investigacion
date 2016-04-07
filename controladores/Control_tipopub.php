<?php
error_reporting(0);
include('seguridad.php');
include('../vistas/tipopub/logicavista.php');
include('../modelos/tipopub.php');
include('../core/controller.php');


function controlador(){

$evento = 'registrar';
$peticiones = array('registrar', 'verdatos', 'crear', 'buscar', 'editar', 'eliminar');

$evento = control($evento, $peticiones, 'tipopub');

$datos = FormDatos();

$tipopub = new Tipopub();



switch ($evento) {
	
	case 'registrar':
		retornar_vista($evento, $data = array(), $parametros = array());
		break;

	case 'verdatos':

		verdatos($tipopub);
		break;

	case 'crear':
		
		$tipopub->crear($datos);
		$parametros = array('mensaje' => $tipopub->mensaje, 'tipomsj' => $tipopub->tipomsj);

		verdatos($tipopub, $parametros);
		break;

	case 'buscar':
	
		$tipopub->buscar($datos['id']);
		$data = $tipopub->filas;

		retornar_vista('modificar', $data, $parametros = array());
		break;

	case 'editar':

	
		$tipopub->editar($datos);
		$parametros = array('mensaje' => $tipopub->mensaje, 'tipomsj' => $tipopub->tipomsj);

		verdatos($tipopub, $parametros);
		break;

	case 'eliminar':
		$tipopub->eliminar($datos['id']);
		$parametros = array('mensaje' => $tipopub->mensaje, 'tipomsj' => $tipopub->tipomsj);
		verdatos($tipopub, $parametros);
		break;

	
}

}

controlador();


 ?>