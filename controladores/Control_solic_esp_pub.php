<?php

error_reporting(0);
include('../vistas/solic_esp_pub/logicavista.php');
include('../modelos/solic_esp.php');
include('../modelos/eventos.php');
include('../modelos/tipoeve.php');
include('../modelos/tipopub.php');
include('../modelos/areas.php');
include('../core/controller.php');
include('../modelos/reportes.php');


function controlador(){

$evento = 'verdatos';
$peticiones = array('solicitud','estadoSol', 'crear', 'consultar', 'prueba');

$evento = control($evento, $peticiones, 'solic_esp_pub');

$datos = FormDatos();

$solic_esp = new Solic_esp();
$eventos = new Eventos();
$areas = new Areas();
$tipopub = new Tipopub();
$tipoeve = new Tipoeve();
$reportes = new Reportes();


switch ($evento) {

	case 'solicitud':

		$tipoeve-> buscarTodos();
		$data_select_tipoeve = $tipoeve->filas;

		$tipopub->buscarTodos();
		$data_select_tipopub = $tipopub->filas;

		$areas->buscarTodos();
		$data_select_areas = $areas->filas;

		$eventos->buscarEspacios();
		$data_select_espacios = $eventos->filas;

		$parametros = array('mensaje' => $datos["mensaje"], 'tipomsj' => $datos["tipomsj"]);
		
		retornar_vista('solicitud', $data = array(), $parametros, $data_select_tipoeve, $data_select_tipopub, $data_select_areas, $data_select_espacios);
		break;

	case 'estadoSol':
		
		retornar_vista('estadoSol', $data, $parametros = array());
		break;

	case 'crear':
		
		$solic_esp->crear($datos);
		
		break;

	case 'consultar':
		$solic_esp->buscarEstadoSol($datos["cod_sol"]);
		$data = $solic_esp->filas;

		if (empty($data)) {
			$parametros = array('mensaje' => 'Ese Código de Solicitud No Existe en la Base de Datos. Intente Nuevamente', 'tipomsj' => 'danger');
			retornar_vista('estadoSol', $data, $parametros);
		}else{
			
			$solic_esp->generarEstadoSolicitud($data);
		}

		break;

	

	
}

}

controlador();


 ?>