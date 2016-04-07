<?php

error_reporting(0);
include('seguridad.php');
include('../vistas/proyectos/logicavista.php');
include('../modelos/proyectos.php');
include('../modelos/programas.php');
include('../modelos/investigadores.php');
include('../modelos/tipoproy.php');
include('../modelos/centros.php');
include('../core/controller.php');


function controlador(){

$evento = 'registrar';
$peticiones = array('registrar', 'verdatos', 'crear', 'eliminar', 'buscar', 'editar', 'buscarLineas', 'buscarCentros', 'buscarInv', 'buscarLineas2', 'buscarInv2');

$evento = control($evento, $peticiones, 'proyectos');

$datos = FormDatos();


$proyectos = new Proyectos();
$programas = new Programas();
$investigadores = new Investigadores();
$centros = new Centros();
$tipoproy = new Tipoproy();


switch ($evento) {
	
	case 'registrar':
		$programas->buscarTodos();
		$data_select_prog = $programas->filas;

		$tipoproy->buscarTodos();
		$data_select_tipo = $tipoproy->filas;



		retornar_vista($evento, $data = array(), $parametros = array(), $data_select_prog, $data_select_tipo);
		break;

	case 'verdatos':
		verdatos($proyectos);
		break;

	case 'crear':

		$proyectos->crear($datos);
		$parametros = array('mensaje' => $proyectos->mensaje, 'tipomsj' => $proyectos->tipomsj);

		verdatos($proyectos, $parametros);
		break;

	case 'eliminar':

		$proyectos->eliminar($datos['id']);
		$parametros = array('mensaje' => $proyectos->mensaje, 'tipomsj' => $proyectos->tipomsj);
		verdatos($proyectos, $parametros);
		break;

	case 'buscar':
		$proyectos->buscar($datos['id']);
		$data = $proyectos->filas;

		$programas->buscarTodos();
		$data_select_prog = $programas->filas;

		$tipoproy->buscarTodos();
		$data_select_tipo = $tipoproy->filas;

		$centros->buscarTodos();
		$data_select_centro = $centros->filas;

		retornar_vista('modificar', $data, $parametros = array(), $data_select_prog, $data_select_tipo, $data_select_centro);
		break;

	case 'editar':
		
		$proyectos->editar($datos, $datosImagen);
		$parametros = array('mensaje' => $proyectos->mensaje, 'tipomsj' => $proyectos->tipomsj);

		verdatos($proyectos, $parametros);
		break;

	case 'buscarLineas':

		$proyectos->buscarLineas($datos['id_prog']);
		$data = $proyectos->filas;
		echo json_encode($data);
		
		break;

	case 'buscarLineas2':

		$proyectos->buscarLineas2($datos['id_centro']);
		$data = $proyectos->filas;
		echo json_encode($data);
		
		break;

	case 'buscarCentros':

		$proyectos->buscarCentros();
		$data = $proyectos->filas;
		echo json_encode($data);
		
		break;

	case 'buscarInv':
		
		$proyectos->buscarInv($datos["id_prog"]);
		$data = $proyectos->filas;

		echo json_encode($data);
		
		break;

	case 'buscarInv2':
		
		$proyectos->buscarInv2($datos["id_centro"]);
		$data = $proyectos->filas;

		echo json_encode($data);
		
		break;
	
	
}

}

controlador();


 ?>