<?php

error_reporting(0);
include('seguridad.php');
include('../vistas/solic_esp/logicavista.php');
include('../modelos/solic_esp.php');
include('../modelos/causas.php');
include('../modelos/eventos.php');
include('../modelos/tipoeve.php');
include('../modelos/tipopub.php');
include('../modelos/areas.php');
include('../core/controller.php');


function controlador(){

$evento = 'verdatos';
$peticiones = array('verdatos', 'buscarSol', 'aprobar', 'rechazar', 'modificar', 'editar', 'interes');

$evento = control($evento, $peticiones, 'solic_esp');

$datos = FormDatos();

$solic_esp = new Solic_esp();
$causas = new Causas();

$eventos = new Eventos();
$areas = new Areas();
$tipopub = new Tipopub();
$tipoeve = new Tipoeve();


switch ($evento) {

	case 'verdatos':

		$solic_esp->eliminarNoInteresadas();
		
		$solic_esp->buscarSolicitudes();
		$data = $solic_esp->filas;

		retornar_vista('verdatos', $data, $parametros = array());
		break;

	case 'buscarSol':
		
		$solic_esp->buscarSol($datos["cod_sol"]);
		$data = $solic_esp->filas;

		$causas->buscarTodos();
		$data_select_causas = $causas->filas;

		retornar_vista('detalleSol', $data, $parametros = array(), $data_select_causas);
		break;

	case 'aprobar':
		
		if ($solic_esp->aprobar($datos["cod_sol"])) {
			$solic_esp->buscarSolicitudes();
			$data = $solic_esp->filas;
			$parametros = array('mensaje' => $solic_esp->mensaje, 'tipomsj' => $solic_esp->tipomsj);
			retornar_vista('verdatos', $data, $parametros);
		}else{
			$solic_esp->buscarSol($datos["cod_sol"]);
			$data = $solic_esp->filas;

			$causas->buscarTodos();
			$data_select_causas = $causas->filas;

			$parametros = array('mensaje' => $solic_esp->mensaje, 'tipomsj' => $solic_esp->tipomsj);
			retornar_vista('detalleSol', $data, $parametros, $data_select_causas);
		}
		break;

	case 'rechazar':
		$solic_esp->rechazar($datos);
		$parametros = array('mensaje' => $solic_esp->mensaje, 'tipomsj' => $solic_esp->tipomsj);
		retornar_vista('verdatos', $data, $parametros);
		break;

	case 'modificar':
		$solic_esp->buscarSol($datos["cod_sol"]);
		$data = $solic_esp->filas;


		$tipoeve-> buscarTodos();
		$data_select_tipoeve = $tipoeve->filas;

		$tipopub->buscarTodos();
		$data_select_tipopub = $tipopub->filas;

		$areas->buscarTodos();
		$data_select_areas = $areas->filas;

		$eventos->buscarEspacios();
		$data_select_espacios = $eventos->filas;

		retornar_vista('modificar', $data, $parametros = array(), $causas = array(), $data_select_tipoeve, $data_select_tipopub, $data_select_areas, $data_select_espacios);
		break;

	case 'editar':
		
		$solic_esp->editar($datos);

		$solic_esp->buscarSol($datos["cod_sol"]);
		$data = $solic_esp->filas;

		$causas->buscarTodos();
		$data_select_causas = $causas->filas;

		$parametros = array('mensaje' => $solic_esp->mensaje, 'tipomsj' => $solic_esp->tipomsj);
		retornar_vista('detalleSol', $data, $parametros, $data_select_causas);

		break;

	case 'interes':
		$solic_esp->cambiarInteres($datos);

		$solic_esp->buscarSolicitudes();
		$data = $solic_esp->filas;

		$parametros = array('mensaje' => $solic_esp->mensaje, 'tipomsj' => $solic_esp->tipomsj);
		retornar_vista('verdatos', $data, $parametros);
		break;




	
}

}

controlador();


 ?>