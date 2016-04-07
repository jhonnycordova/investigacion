<?php

error_reporting(0);
include('../vistas/noticias_pub/logicavista.php');
include('../modelos/noticias.php');
include('../core/controller.php');


function controlador(){

$evento = 'detalle';
$peticiones = array('detalle');

$evento = control($evento, $peticiones, 'noticias');

$datos = FormDatos();


$noticias = new Noticias();

switch ($evento) {
	
	case 'detalle':
		$noticias->buscar($datos["id_noticia"]);
		$data = $noticias->filas;

		
		retornar_vista($evento, $data, $parametros = array());
		break;

	
}

}

controlador();


 ?>