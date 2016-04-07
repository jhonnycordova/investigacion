<?php

error_reporting(0);
include('seguridad.php');
include('../vistas/decanato/logicavista.php');
include('../modelos/decanato.php');
include('../core/controller.php');


function controlador(){

$evento = 'infoDecanato';
$peticiones = array('infoDecanato', 'editar');

$evento = control($evento, $peticiones, 'decanato');

$datos = FormDatos();

$decanato = new Decanato();
//$decanato2 = new Decanato();


switch ($evento) {
	
	case 'infoDecanato':

		$decanato->buscarInfo();
		$data = $decanato->filas;

		foreach ($datos as $campo => $valor) {
			$$campo = $valor;
		}

		$parametros = array('mensaje' => $mensaje, 'tipomsj' => $tipomsj);

		retornar_vista($evento, $data, $parametros);
		
		break;

	case 'editar':

		$decanato->editar($datos);
		$parametros = array('mensaje' => $decanato->mensaje, 'tipomsj' => $decanato->tipomsj);

		header('Location: /investigacion/decanato/infoDecanato?mensaje='.$decanato->mensaje.'&tipomsj='.$decanato->tipomsj);

	
		break;

	
}

}

controlador();


 ?>