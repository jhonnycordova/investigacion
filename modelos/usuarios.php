<?php

include_once('../core/models.php');
include_once('../core/tcpdf/config/tcpdf_config.php');
include_once('../core/tcpdf/tcpdf.php');

class Usuarios extends Models{


public function crear($datos = array()){
	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}


	$clave = md5($clave);
	if ($_SESSION["superusuario"]=='si') {
		if(($this->validarUsuario($datos) == false) && ($usuario != '')){
			$this->consulta = "INSERT INTO usuarios (usuario, clave, nom_usu, ape_usu, estado) 
								VALUES ('$usuario', '$clave', '$nom_usu', '$ape_usu', '$estado')";
			if ($this->ejecutar_simple_query('insert' , 'Usuario')==true) {
				$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('026', '$_SESSION[idUsuario]', current_date, localtime)";
				$this->ejecutar_simple_query('insert', 'Usuario');
			}

			for ($i=0; $i <3 ; $i++) { 
				if (!empty($tel_usu[$i])) {
					$this->consulta = "INSERT INTO usuario_tel (id_usuario, tel_usu) 
								VALUES ((Select max(id_usuario) from usuarios), '$tel_usu[$i]')";
					$this->ejecutar_simple_query('insert' , 'Usuario');
				}

				if (!empty($email_usu[$i])) {
					$this->consulta = "INSERT INTO usuario_email (id_usuario, email_usu) 
								VALUES ((Select max(id_usuario) from usuarios), '$email_usu[$i]')";
					$this->ejecutar_simple_query('insert' , 'Usuario');
				}

				if (!empty($permiso[$i])) {
					$this->consulta = "INSERT INTO permisos (id_usuario, cod_mod) 
								VALUES ((Select max(id_usuario) from usuarios), '$permiso[$i]')";
					$this->ejecutar_simple_query('insert' , 'Usuario');
				}
			}

		}else{
			$this->mensaje="Este usuario ya existe";
			$this->tipomsj="info";
		}
	}else{
		if(($this->validarUsuario($datos) == false) && ($usuario != '')){
			$this->consulta = "INSERT INTO usuarios (usuario, clave, nom_usu, ape_usu, estado) 
								VALUES ('$usuario', '$clave', '$nom_usu', '$ape_usu', '$estado')";
			if ($this->ejecutar_simple_query('insert' , 'Usuario')==true) {
				$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('026', '$_SESSION[idUsuario]', current_date, localtime)";
				$this->ejecutar_simple_query('insert', 'Usuario');
			}

			for ($i=0; $i <3 ; $i++) { 
				if (!empty($tel_usu[$i])) {
					$this->consulta = "INSERT INTO usuario_tel (id_usuario, tel_usu) 
								VALUES ((Select max(id_usuario) from usuarios), '$tel_usu[$i]')";
					$this->ejecutar_simple_query('insert' , 'Usuario');
				}

				if (!empty($email_usu[$i])) {
					$this->consulta = "INSERT INTO usuario_email (id_usuario, email_usu) 
								VALUES ((Select max(id_usuario) from usuarios), '$email_usu[$i]')";
					$this->ejecutar_simple_query('insert' , 'Usuario');
				}

			}

			$this->consulta = "INSERT INTO permisos (id_usuario, cod_mod) 
								VALUES ((Select max(id_usuario) from usuarios), '$_SESSION[modulo]')";
			$this->ejecutar_simple_query('insert' , 'Usuario');

		}else{
			$this->mensaje="Este usuario ya existe";
			$this->tipomsj="info";
		}
	}
	
}


public function validarUsuario($datos = array()){
	$parametros = array('usuario' => $datos['usuario']);
	return $this->validar($parametros, 'usuarios');
}

public function validarUsuarioClave($datos = array()){
	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}
	$claveActual = md5($claveActual);

	$this->consulta = "SELECT * FROM usuarios WHERE id_usuario = ".$id." and clave != '$claveActual'";
	return $this->traer_resultados_query_simple();
}

public function validarUsuarioEditar($datos = array()){

	$parametros = array('usuario' => $datos['usuario']);
	$id = $datos['id_usuario'];
	return $this->validarEditar($parametros, 'usuarios', $id);
}


public function editar($datos = array()){

	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if(($this->validarUsuarioEditar($datos) == false) && ($usuario != '')){
		$this->consulta = "UPDATE usuarios SET usuario = '$usuario', estado = '$estado', ape_usu = '$ape_usu', nom_usu = '$nom_usu' WHERE id_usuario = '$id_usuario'";
		if ($this->ejecutar_simple_query('update' , 'Usuario')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('027', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('update', 'Usuario');
		}

		$this->consulta = "DELETE FROM usuario_tel WHERE id_usuario = '$id_usuario'";
		$this->ejecutar_simple_query('update' , 'Usuario');

		$this->consulta = "DELETE FROM usuario_email WHERE id_usuario = '$id_usuario'";
		$this->ejecutar_simple_query('update' , 'Usuario');

		for ($i=0; $i <3 ; $i++) { 
				if (!empty($tel_usu[$i])) {
					$this->consulta = "INSERT INTO usuario_tel (id_usuario, tel_usu) 
								VALUES ((Select id_usuario from usuarios where id_usuario = '$id_usuario'), '$tel_usu[$i]')";

					$this->ejecutar_simple_query('update' , 'Usuario');
				}

				if (!empty($email_usu[$i])) {
					$this->consulta = "INSERT INTO usuario_email (id_usuario, email_usu) 
								VALUES ((Select id_usuario from usuarios where id_usuario = '$id_usuario'), '$email_usu[$i]')";
					$this->ejecutar_simple_query('update' , 'Usuario');
				}

		}

	}
}

public function buscarTodos(){
	$this->buscarDatos('usuarios');
}

public function buscarTodosPorId(){
	$this->buscarDatosPorId('usuarios', 'id_usuario');
}

//Para ADMINISTRADORES, no mostrando al usuario logueado
public function buscarTodosSinLog($tabla, $id, $logueado){
	$this->consulta = "SELECT * FROM ".$tabla." WHERE ".$id." not in (".$logueado.") Order by ".$id;
	$this->traer_resultados_query_general();
}


public function buscarTodosPorMod(){
	$this->buscarDatosPorMod('usuarios', 'id_usuario', $_SESSION["modulo"]);
}

public function eliminar($id){
	$this->delete('usuarios', $id);
}

public function buscar($id){
	$this->buscarDatosPorId3('usuarios','id_usuario', $id);
}

public function buscarTelUsu($id){
	$this->buscarDatosPorId('usuario_tel', $id);
}

public function buscarEmailUsu($id){
	$this->buscarDatosId('usuario_email', $id);
}

public function cambiarClave($datos = array()){
	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	$clave = md5($clave);

	$this->consulta = "UPDATE usuarios set clave = '$clave' WHERE id_usuario =".$id;
	if ($this->ejecutar_simple_query('update' , 'Usuario')==true) {
		$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('038', '$_SESSION[idUsuario]', current_date, localtime)";
		$this->ejecutar_simple_query('update', 'Usuario');
	}
}




}

 ?>