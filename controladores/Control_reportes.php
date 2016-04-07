<?php
error_reporting(0);
include('seguridad.php');
include('../vistas/reportes/logicavista.php');

include('../modelos/reportes.php');
include('../core/controller.php');


function controlador(){

$evento = 'movimientos';
$peticiones = array('movimientos', 'buscarDatos', 'ver');

$evento = control($evento, $peticiones, 'reportes');

$datos = FormDatos();

$reportes = new Reportes();


switch ($evento) {
	
	case 'movimientos':
	
		$reportes->buscarUsuarios();
		$data_select_usuario = $reportes->filas;
		
		
		retornar_vista('movimientos', $data = array(), $parametros = array(), $data_select_usuario);
		break;

	case 'buscarDatos':
		$reportes->buscarDatosParaPdf($datos);
		$data = $reportes->filas;

		$cantidad = count($data);

		if ($cantidad>0) {
			retornar_vista('pdf', $data, $parametros = array(), $data = array(), $datos);
		}else{
			$mensaje="El Usuario Seleccionado no Tiene Movimientos en esas Fechas";
			$tipomsj="danger";

			$parametros = array('mensaje'=>$mensaje, 'tipomsj'=>$tipomsj);
			$reportes->buscarUsuarios();
			$data_select_usuario = $reportes->filas;
			retornar_vista('movimientos', $data = array(), $parametros, $data_select_usuario);

		}
		
		break;

	
		
}

}

controlador();


 ?>