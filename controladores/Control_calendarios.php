<?php

error_reporting(0);
include('seguridad.php');
include('../vistas/calendarios/logicavista.php');
include('../modelos/calendarios.php');
include('../core/controller.php');


function controlador(){

$evento = 'auditorio';
$peticiones = array('auditorio','salon');

$evento = control($evento, $peticiones, 'calendarios');

$datos = FormDatos();

$calendarios = new Calendarios();


switch ($evento) {

	case 'auditorio':
		$calendarios->buscarEventos();
		$data = $calendarios->filas;
		retornar_vista($evento, $data, $parametros = array());
		break;

	case 'salon':
		$calendarios->buscarEventosS();
		$data = $calendarios->filas;

		
		retornar_vista('salon', $data, $parametros = array());
		break;


	
}

}

controlador();


 ?>