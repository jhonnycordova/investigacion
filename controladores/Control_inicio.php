<?php

error_reporting(0);

include('../core/controller.php');
include('../vistas/inicio/logicavista.php');
include('../modelos/inicio.php');
include('../modelos/carousel.php');
include('../modelos/noticias.php');


function controlador(){

$evento = 'index';
$peticiones = array('index');

$evento = control($evento, $peticiones, 'inicio');

$inicio = new Inicio();
$carousel = new Carousel();
$noticias = new Noticias();

switch ($evento) {

	case 'index':
		$carousel->buscarTodos();
		$data = $carousel->filas;

		$noticias->buscarTodosInicio();
		$data_noticias = $noticias->filas;
		

		retornar_vista('index', $data, $parametros, $data_noticias);
		break;

}

}

controlador();

 ?>