<?php

error_reporting(0);
include('seguridad.php');
include('../vistas/noticias/logicavista.php');
include('../modelos/noticias.php');
include('../core/controller.php');


function controlador(){

$evento = 'registrar';
$peticiones = array('registrar', 'verdatos', 'crear', 'eliminar', 'buscar', 'editar');

$evento = control($evento, $peticiones, 'noticias');

$datos = FormDatos();
$datosImagen = FormFiles();

$noticias = new Noticias();

switch ($evento) {
	
	case 'registrar':
		retornar_vista($evento, $data = array(), $parametros = array());
		break;

	case 'verdatos':
		$parametros = array('mensaje' => $datos["mensaje"], 'tipomsj' => $datos["tipomsj"]);
		
		verdatos($noticias, $parametros);
		break;

	case 'crear':

		$noticias->crear($datos, $datosImagen);
		$parametros = array('mensaje' => $noticias->mensaje, 'tipomsj' => $noticias->tipomsj);

		
		header('Location: /investigacion/noticias/verdatos/?mensaje='.$noticias->mensaje.'&tipomsj='.$noticias->tipomsj);
		
		break;

	case 'eliminar':

		$noticias->eliminar($datos['id']);
		$parametros = array('mensaje' => $noticias->mensaje, 'tipomsj' => $noticias->tipomsj);
		verdatos($noticias, $parametros);
		break;

	case 'buscar':
		$noticias->buscar($datos['id']);
		$data = $noticias->filas;

		retornar_vista('modificar', $data, $parametros = array());
		break;

	case 'editar':
		$noticias->editar($datos, $datosImagen);
		$parametros = array('mensaje' => $noticias->mensaje, 'tipomsj' => $noticias->tipomsj);

		header('Location: /investigacion/noticias/verdatos/?mensaje='.$noticias->mensaje.'&tipomsj='.$noticias->tipomsj);
		break;
	
}

}

controlador();


 ?>