<?php

error_reporting(0);
include('../core/controller.php');
include('../modelos/login.php');
include('../modelos/permisos.php');
include('../vistas/login/logicavista.php');


function controlador(){

$evento = 'iniciosesion';

$peticiones = array('iniciosesion', 'validar', 'cerrarsesion');

$evento = control($evento, $peticiones, 'login');

$datos = FormDatosPost();

$login = new Login();
$permiso = new Permisos();
$permiso2 = new Permisos();

switch ($evento) {
	case 'iniciosesion':
	retornar_vista('iniciosesion', $data = array(), 'Bienvenido, Ingrese sus datos de usuario', 'info');
	break;

	case 'cerrarsesion':
	session_start();
	session_unset(); // Borrar las variables de sesión
	setcookie(session_name(), 0, 1 , ini_get("session.cookie_path")); // Eliminar la cookie
	session_destroy(); // Destruye el resto de información sobre la sesión
	retornar_vista('iniciosesion', $data = array(), 'Salió de forma segura del sistema', 'success');
	break;

	case 'validar':
	if($datos['usuario'] == ''){
		retornar_vista('iniciosesion', $data = array(), 'Ingrese un Usuario', 'danger');
	}else if($datos['clave'] == ''){
		retornar_vista('iniciosesion', $data = array(), 'Ingrese Contraseña', 'danger');
	}else if(($datos['modulo'] == '')){
		retornar_vista('iniciosesion', $data = array(), 'Seleccione el Modulo a Ingresar', 'danger');
	}else{
		$login->validarUsuario($datos);
		$data = $login->filas;
		$permiso->VerificarAdmin($datos);
		$dataPermi = $permiso->filas;

		$permiso2->VerificarPermiso($datos);
		$dataPermi2 = $permiso2->filas;
		

		if($data['id_usuario'] > 0){

			if(($data['estado'] == 'A')&& $dataPermi2['id_usuario']>0){
				session_start();
				if(isset($datos['recordar'])){
					setcookie(session_name(), 'recordar', time()+3600); //expira en 1 hora
				}
				$_SESSION['autentificado'] = 'yes';
				$_SESSION['idUsuario'] = $data['id_usuario'];
				$_SESSION['usuario'] = $data['usuario'];
				$_SESSION['modulo'] = $datos['modulo'];
				$_SESSION['nombreUsuario'] = $data['nom_usu']." ".$data["ape_usu"];
				

				//Veo cual es la ocurrencia en la tabla de permisos de ese usuario, si es 3, es porque tiene pemiso a todos los modulos y por ende es administrador
				if (count($dataPermi)==2) {
					$_SESSION['superusuario'] = 'si';
				}
				
				if ($datos['modulo']=='001') {
					header('Location: /investigacion/gcontenido/');
				}else if ($datos['modulo']=='002') {
					header('Location: /investigacion/gauditorio/');
				}
				
			}else{
				retornar_vista('iniciosesion', $data = array(), 'Usuario Inactivo o Sin Permisos para Este Módulo', 'danger');
			}
		}else{
			retornar_vista('iniciosesion', $data = array(), 'Datos Inválidos', 'danger');
		}
	}
	break;
}

}

controlador();
 ?>