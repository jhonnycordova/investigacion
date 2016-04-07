<?php

error_reporting(0);
include('../core/controller.php');
include('../vistas/gauditorio/logicavista.php');
include('../modelos/gauditorio.php');
include('../modelos/solic_esp.php');
include('../modelos/eventos.php');


function controlador(){

$evento = 'index';
$peticiones = array('index');

$evento = control($evento, $peticiones, 'gauditorio');

session_start();

$gauditorio = new Gauditorio();
$solic_esp = new Solic_esp();
$eventos = new Eventos();

switch ($evento) {

	case 'index':
		$solic_esp->eliminarNoInteresadas();
		$gauditorio->buscarSolPen();
		$data= $gauditorio->filas;

		$eventos->buscarEventosIni();
		$dataEventos = $eventos->filas;

		retornar_vista('index', $data, $parametros, $dataEventos);
	break;

}

}

controlador();

 ?>