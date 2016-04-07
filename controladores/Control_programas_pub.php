<?php
error_reporting(0);

include('../vistas/programas_pub/logicavista.php');
include('../modelos/programas.php');
include('../core/controller.php');


function controlador(){

$evento = 'pinvestigacion';
$peticiones = array('pinvestigacion', 'pextension');

$evento = control($evento, $peticiones, 'programas_pub');

$datos = FormDatos();

$programas = new Programas();
//$decanato2 = new Decanato();


switch ($evento) {
	
	case 'pinvestigacion':
		
		$programas->buscarPInvestigacion();
		$data = $programas->filas;


		retornar_vista($evento, $data, $parametros);
		
		break;

	case 'pextension':
	
		$programas->buscarPExtension();
		$data = $programas->filas;

		
		retornar_vista('pextension', $data, $parametros);
		
		break;
	
}

}

controlador();


 ?>