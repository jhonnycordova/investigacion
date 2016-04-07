<?php

error_reporting(0);
include('seguridad.php');
include('../vistas/investigadores/logicavista.php');
include('../modelos/investigadores.php');
include('../modelos/programas.php');
include('../modelos/espinv.php');
include('../modelos/centros.php');
include('../core/controller.php');


function controlador(){

$evento = 'registrar';
$peticiones = array('registrar', 'verdatos', 'crear', 'eliminar', 'buscar', 'editar');

$evento = control($evento, $peticiones, 'investigadores');

$datos = FormDatos();
$datosImagen = FormFiles();

$investigadores = new Investigadores();
$programas = new Programas();
$especialidades = new Espinv();
$especialidades2 = new Espinv();
$centros = new Centros();


switch ($evento) {
	
	case 'registrar':
		$programas->buscarTodos();
		$data_select_prog = $programas->filas;

		$especialidades->buscarTodos();
		$data_select_esp = $especialidades->filas;

		retornar_vista($evento, $data = array(), $parametros = array(), $data_select_prog, $data_select_esp);
		break;

	case 'verdatos':
		verdatos($investigadores);
		break;

	case 'crear':
		$investigadores->crear($datos, $datosImagen);
		$parametros = array('mensaje' => $investigadores->mensaje, 'tipomsj' => $investigadores->tipomsj);
		
		verdatos($investigadores, $parametros);
		break;

	case 'eliminar':

		$investigadores->eliminar($datos['id']);
		$parametros = array('mensaje' => $investigadores->mensaje, 'tipomsj' => $investigadores->tipomsj);
		verdatos($investigadores, $parametros);
		break;

	case 'buscar':
		$investigadores->buscar($datos['id']);
		$data = $investigadores->filas;

		$programas->buscarTodos();
		$data_select_prog = $programas->filas;

		$especialidades->buscarTodos();
		$data_select_esp = $especialidades->filas;

		$centros->buscarTodos();
		$data_select_centro = $centros->filas;

		$especialidades2->buscarTodosPorId($datos['id']);
		$data_select_esp2 = $especialidades2->filas;

		retornar_vista('modificar', $data, $parametros = array(), $data_select_prog, $data_select_esp, $data_select_centro,  $data_select_esp2);
		break;

	case 'editar':
		
		$investigadores->editar($datos, $datosImagen);
		$parametros = array('mensaje' => $investigadores->mensaje, 'tipomsj' => $investigadores->tipomsj);

		verdatos($investigadores, $parametros);
		break;
	
}

}

controlador();


 ?>