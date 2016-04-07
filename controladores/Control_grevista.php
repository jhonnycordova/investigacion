<?php

error_reporting(0);
include('../core/controller.php');
include('../vistas/grevista/logicavista.php');
include('../modelos/grevista.php');


function controlador(){

$evento = 'index';
$peticiones = array('index');

$evento = control($evento, $peticiones, 'grevista');

session_start();

$grevista = new Grevista();

switch ($evento) {

	case 'index':
		$data = '';	
		retornar_vista('index', $data, $parametros);
	break;

}

}

controlador();

 ?>