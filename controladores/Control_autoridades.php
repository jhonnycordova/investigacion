<?php

error_reporting(0);
include('seguridad.php');
include('../vistas/autoridades/logicavista.php');
include('../modelos/autoridades.php');
include('../core/controller.php');


function controlador(){

$evento = 'registrar';
$peticiones = array('registrar', 'verdatos', 'crear', 'eliminar', 'buscar', 'editar');

$evento = control($evento, $peticiones, 'autoridades');

$datos = FormDatos();
$datosImagen = FormFiles();

$autoridades = new Autoridades();

switch ($evento) {
	
	case 'registrar': //En el caso de que el evento sea "Registrar":
		$autoridades->buscarCargos(); //Busco todos los cargos
		$data_select_cargos = $autoridades->filas; //Asigno esos cargos a esta variable
		retornar_vista($evento, $data = array(), $parametros = array(), $data_select_cargos);//Llamo a la vista y le paso los datos
		break;//Se rompe el Switch

	case 'verdatos':
		verdatos($autoridades);
		break;

	case 'crear':
		$autoridades->crear($datos, $datosImagen);
		$parametros = array('mensaje' => $autoridades->mensaje, 'tipomsj' => $autoridades->tipomsj);
		
		verdatos($autoridades, $parametros);
		break;

	case 'eliminar':

		$autoridades->eliminar($datos['id']);
		$parametros = array('mensaje' => $autoridades->mensaje, 'tipomsj' => $autoridades->tipomsj);
		verdatos($autoridades, $parametros);
		break;

	case 'buscar':
		$autoridades->buscar($datos['id']);
		$data = $autoridades->filas;

		$cargos = new Autoridades();
		$cargos->buscarCargos();
		$data_select_cargos = $cargos->filas;

		retornar_vista('modificar', $data, $parametros = array(), $data_select_cargos);
		break;

	case 'editar':
		$autoridades->editar($datos, $datosImagen);
		$parametros = array('mensaje' => $autoridades->mensaje, 'tipomsj' => $autoridades->tipomsj);

		verdatos($autoridades, $parametros);
		break;
	
}

}

controlador();


 ?>