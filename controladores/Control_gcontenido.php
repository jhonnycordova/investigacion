<?php
error_reporting(0);
include('../core/controller.php');
include('../vistas/gcontenido/logicavista.php');
include('../modelos/gcontenido.php');


function controlador(){

$evento = 'index';
$peticiones = array('index');

$evento = control($evento, $peticiones, 'gcontenido');

session_start();

$gcontenido = new Gcontenido();

switch ($evento) {

	case 'index':

		$gcontenido->buscarCanCentros();
		$data[0] = $gcontenido->filas;

		unset($gcontenido->filas);
		$gcontenido->buscarCanLineas();
		$data[1] = $gcontenido->filas;

		unset($gcontenido->filas);
		$gcontenido->buscarCanProyectos();
		$data[2] = $gcontenido->filas;

		unset($gcontenido->filas);
		$gcontenido->buscarCanInv();
		$data[3] = $gcontenido->filas;


		retornar_vista('index', $data, $parametros);

	break;

}

}

controlador();

 ?>