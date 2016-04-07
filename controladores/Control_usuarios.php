<?php

error_reporting(0);
include('seguridad.php');
include('../vistas/usuarios/logicavista.php');
include('../modelos/usuarios.php');

include('../core/controller.php');


function controlador(){

$evento = 'registrar';
$peticiones = array('registrar', 'buscarUsuario', 'buscarUsuarioEditar', 'crear', 'verdatos', 'eliminar','perfil', 'buscar', 'editar', 'editarPerfil', 'asignarPermiso', 'cambiarPermiso', 'cambiarClave', 'buscarUsuarioClave', 'cambiarClave2');

$evento = control($evento, $peticiones, 'usuarios');

$datos = FormDatos();

$usuarios = new Usuarios();
$usuarios2 = new Usuarios();


switch ($evento) {
	case 'registrar':
        retornar_vista($evento, $data = array(), $parametros = array());
		break;

	case 'buscarUsuario':
		$resp = $usuarios->validarUsuario($datos);
		$row[0] = array('resp' => $resp);
		echo json_encode($row);
		break;

	case 'buscarUsuarioClave':

		$resp = $usuarios->validarUsuarioClave($datos);
		$row[0] = array('resp' => $resp);
		echo json_encode($row);
		break;

	case 'buscarUsuarioEditar':
		$resp = $usuarios->validarUsuarioEditar($datos);
		$row[0] = array('resp' => $resp);
		echo json_encode($row);
		break;

	case 'crear':
		$usuarios->crear($datos);
		$parametros = array('mensaje' => $usuarios->mensaje, 'tipomsj' => $usuarios->tipomsj);

		if ($_SESSION["superusuario"]=='si') {
			verdatosUsuario2($usuarios, $parametros);
		}else{
			verdatosUsuarioMod2($usuarios, $parametros);
		}
		
		//retornar_vista('verdatos', $data = array(), $parametros);
		//index($usuarios, 'usuarios/verdatos/');
		break;

	case 'editar':
		$usuarios->editar($datos);
		$parametros = array('mensaje' => $usuarios->mensaje, 'tipomsj' => $usuarios->tipomsj);
		
		if ($_SESSION["superusuario"]=='si') {
			verdatosUsuario2($usuarios, $parametros);
		}else{
			verdatosUsuarioMod2($usuarios, $parametros);
		}
		//retornar_vista('registrar', $data = array(), $parametros);
		//index($usuarios, 'usuarios/verdatos/');
		break;

	case 'editarPerfil':
		$usuarios->editarPerfil($datos);
		$parametros = array('mensaje' => $usuarios->mensaje, 'tipomsj' => $usuarios->tipomsj);
		//verdatos($usuarios, $parametros);
		$usuarios->buscar($datos);
		$data = $usuarios->filas;
		retornar_vista('perfil', $data, $parametros);
		//index($usuarios, 'usuarios/verdatos/');
		break;

	case 'verdatos':
		if ($_SESSION["superusuario"]=='si') {
			verdatosUsuario($usuarios);
		}else{
			verdatosUsuarioMod($usuarios);
		}
		break;

	case 'eliminar':
		$usuarios->eliminar('usuarios', $datos['id']);
		$parametros = array('mensaje' => $usuarios->mensaje, 'tipomsj' => $usuarios->tipomsj);
		verdatos($usuarios, $parametros);
		//index($usuarios, 'usuarios/verdatos/');
		break;

	case 'perfil':
		if($datos["id"] == $_SESSION["idUsuario"]){
			$usuarios->buscar($datos);
			$data = $usuarios->filas;
			retornar_vista('perfil', $data, $parametros = array());
		}else{
			header("location: /investigacion/inicio/index/");
		}
		break;

	case 'buscar':
		$usuarios->buscar($datos['id']);
		$data = $usuarios->filas;
		retornar_vista('modificar', $data, $parametros = array());
		break;

	case 'asignarPermiso':
		$usuarios->buscarTodosPorId();
		$data = $usuarios->filas;
	
		retornar_vista('asignarPermiso', $data, $parametros = array());
		break;

	case 'cambiarPermiso':
		$usuarios->buscarTodosPorId();
		$data[0] = $usuarios->filas;
		$data[1] = $datos;

		$parametros = array('mensaje' => $usuarios->mensaje, 'tipomsj' => $usuarios->tipomsj);
		retornar_vista('asignarPermiso', $data, $parametros = array());
		break;

	case 'cambiarClave':
		retornar_vista($evento, $data = array(), $parametros = array());
		break;

	case 'cambiarClave2':
		$usuarios->cambiarClave($datos);
		$parametros = array('mensaje' => $usuarios->mensaje, 'tipomsj' => $usuarios->tipomsj);

		if ($_SESSION["superusuario"]=='si') {
			verdatosUsuario2($usuarios, $parametros);
		}else{
			verdatosUsuarioMod2($usuarios, $parametros);
		}
		break;
}

}

controlador();


 ?>