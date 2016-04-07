<?php
error_reporting(0);

include('../vistas/normas_pub/logicavista.php');

include('../modelos/normas.php');
include('../core/controller.php');


function controlador(){

$evento = 'ver';
$peticiones = array('ver',);

$evento = control($evento, $peticiones, 'normas_pub');

$datos = FormDatos();

$normas = new Normas();
$normas2 = new Normas();


switch ($evento) {
	
	case 'ver':
		$normas->buscarNormas($datos["id_espacio"]);
		$data = $normas->filas;



		retornar_vista($evento, $data, $parametros = array(), $datos["id_espacio"]);
		break;

	

	
}

}

controlador();


 ?>