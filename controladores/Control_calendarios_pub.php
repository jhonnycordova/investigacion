<?php

error_reporting(0);

include('../vistas/calendarios_pub/logicavista.php');
include('../modelos/calendarios.php');
include('../core/controller.php');


function controlador(){

$evento = 'ver';
$peticiones = array('ver');

$evento = control($evento, $peticiones, 'calendarios_pub');

$datos = FormDatos();

$calendarios = new Calendarios();


switch ($evento) {

	case 'ver':
		$calendarios->buscarEventos2($datos["id_espacio"]);
		$data = $calendarios->filas;

		retornar_vista($evento, $data, $parametros = array(), $datos["id_espacio"]);
		break;

	


	
}

}

controlador();


 ?>