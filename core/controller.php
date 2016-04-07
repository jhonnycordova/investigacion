<?php

function control($evento, $peticiones, $modelo){

$uri = $_SERVER['REQUEST_URI'];

foreach ($peticiones as $peticion) {
	$uri_peticion = $modelo.'/'.$peticion.'/';
	if( strpos($uri, $uri_peticion) == true ) {
		$evento = $peticion;
	}
}

return $evento;
}

function FormDatosPost() {
	$datos = array();
	foreach ($_POST as $campo => $valor) {
		$datos[$campo] = $valor;
	}
	return $datos;
}

function FormFiles() {
	$datos = array();
	$datos = $_FILES;
	return $datos;
}

function FormDatos() {
	$datos = array();
	if($_POST){
		foreach ($_POST as $campo => $valor) {
			$datos[$campo] = $valor;
		}
	}else if($_GET){
		foreach ($_GET as $campo => $valor) {
			$datos[$campo] = $valor;
		}
	}
	return $datos;
}

function verdatos($modelo, $parametros){
	
	$modelo->buscarTodos();
	$data = $modelo->filas;

	//$parametros = array('mensaje' => $modelo->mensaje, 'tipomsj' => $modelo->tipomsj);
	retornar_vista('verdatos', $data, $parametros);
}

function verdatos2($modelo, $modelo2){
	$modelo->buscarTodos();
	$modelo2->buscarNombreMunicipio();
	$data[1] = $modelo->filas;
	$data[0] = $modelo2->filas;
	print_r($data[0])."<br>";
	print_r($data[1]);
	$parametros = array('mensaje' => $modelo->mensaje, 'tipomsj' => $modelo->tipomsj);
	retornar_vista('verdatos', $data, $parametros);
}

//para ver el Verdatos normal de admin
function verdatosUsuario($modelo){
	$modelo->BuscarTodosSinLog('usuarios', 'id_usuario', $_SESSION["idUsuario"]);

	$data = $modelo->filas;


	$parametros = array('mensaje' => $modelo->mensaje, 'tipomsj' => $modelo->tipomsj);
	retornar_vista('verdatos', $data, $parametros);
}

//Para mostrar el Verdatos NORMAL filtrado por modulo
function verdatosUsuarioMod($modelo){
	$modelo->BuscarTodosPorMod();
	
	$data = $modelo->filas;

	$parametros = array('mensaje' => $modelo->mensaje, 'tipomsj' => $modelo->tipomsj);
	retornar_vista('verdatos', $data, $parametros);
}

//Para mostrar el Verdatos  filtrado despues de crear usuario normal
function verdatosUsuarioMod2($modelo, $parametros){
	$modelo->BuscarTodosPorMod();

	$data = $modelo->filas;

	//$parametros = array('mensaje' => $modelo->mensaje, 'tipomsj' => $modelo->tipomsj);
	retornar_vista('verdatos', $data, $parametros);
}

//para mostrar el Verdatos despues de crear para Admin
function verdatosUsuario2($modelo, $parametros){
	$modelo->BuscarTodosSinLog('usuarios', 'id_usuario', $_SESSION["idUsuario"]);
	
	$data = $modelo->filas;
	//$parametros = array('mensaje' => $modelo->mensaje, 'tipomsj' => $modelo->tipomsj);
	retornar_vista('verdatos', $data, $parametros);
}


function verdatosPermisos($modelo, $parametros){
	
	$modelo->BuscarTodosPorId();
	
	$data = $modelo->filas;
	//$parametros = array('mensaje' => $modelo->mensaje, 'tipomsj' => $modelo->tipomsj);
	retornar_vista('asignarPermiso', $data, $parametros);
}



function index($modelo, $modelourl){
	header('Location: /investigacion/'.$modelourl);
}


function eliminar($modelo, $id){
	$modelo->eliminar($id);
	verdatos($modelo);
}


 ?>