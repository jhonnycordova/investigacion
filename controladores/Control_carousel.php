<?php
error_reporting(0);
include('seguridad.php');
include('../vistas/carousel/logicavista.php');
include('../modelos/carousel.php');
include('../core/controller.php');


function controlador(){

$evento = 'registrar';
$peticiones = array('registrar', 'verdatos', 'crear', 'buscar', 'editar', 'eliminar');

$evento = control($evento, $peticiones, 'carousel');

$datos = FormDatos();
$datosImagen = FormFiles();


$carousel = new Carousel();


switch ($evento) {
	
	case 'registrar':
		retornar_vista($evento, $data = array(), $parametros = array());
		break;

	case 'verdatos':

		verdatos($carousel);
		break;

	case 'crear':
	
		$carousel->crear($datos, $datosImagen);
		$parametros = array('mensaje' => $carousel->mensaje, 'tipomsj' => $carousel->tipomsj);

		verdatos($carousel, $parametros);
		break;

	case 'buscar':
	
		$carousel->buscar($datos['id']);
		$data = $carousel->filas;

		retornar_vista('modificar', $data, $parametros = array());
		break;

	case 'editar':

	
		$carousel->editar($datos);
		$parametros = array('mensaje' => $carousel->mensaje, 'tipomsj' => $carousel->tipomsj);

		verdatos($carousel, $parametros);
		break;

	case 'eliminar':
		
		$carousel->eliminar($datos['id']);
		$parametros = array('mensaje' => $carousel->mensaje, 'tipomsj' => $carousel->tipomsj);
		verdatos($carousel, $parametros);
		break;

	
}

}

controlador();


 ?>