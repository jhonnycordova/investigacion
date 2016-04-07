<?php

error_reporting(0);
include('seguridad.php');
include('../vistas/programas/logicavista.php');
include('../modelos/programas.php');
include('../core/controller.php');


function controlador(){

$evento = 'verdatos';
$peticiones = array('verdatos', 'buscar', 'editar');

$evento = control($evento, $peticiones, 'programas');

$datos = FormDatos();


$programas = new Programas();

switch ($evento) {
	
	case 'verdatos':
		verdatos($programas);
		break;


	case 'buscar':
		$programas->buscar($datos['id']);
		$data = $programas->filas;


		retornar_vista('modificar', $data, $parametros = array());
		break;

	case 'editar':
		

		$programas->editar($datos);
		$parametros = array('mensaje' => $programas->mensaje, 'tipomsj' => $programas->tipomsj);

		verdatos($programas, $parametros);
		break;
	
}

}

controlador();


 ?>