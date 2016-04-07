<?php

error_reporting(0);
include('seguridad.php');
include('../vistas/permisos/logicavista.php');
include('../modelos/usuarios.php');
include('../modelos/permisos.php');
include('../core/controller.php');


function controlador(){

$evento = 'asignarPermiso';
$peticiones = array('cambiarPermiso', 'asignarPermiso');

$evento = control($evento, $peticiones, 'permisos');

$datos = FormDatos();

$permisos = new Permisos();
$usuarios = new Usuarios();



switch ($evento) {
	
	case 'cambiarPermiso':
	
		$permisos->cambiarPermisos($datos);
		$parametros = array('mensaje' => $permisos->mensaje, 'tipomsj' => $permisos->tipomsj);
		verdatosPermisos($usuarios, $parametros);
		break;

	case 'asignarPermiso':
		verdatosPermisos($usuarios);
		break;

	
}

}

controlador();


 ?>