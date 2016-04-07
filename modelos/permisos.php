<?php

include_once('../core/db_conexion.php');

class Permisos extends DBConexion{

#METODOS

public function VerificarAdmin($datos = array()){
	foreach ($datos as $campo => $valor) {
			if($campo == 'clave'){
				$valor = $valor;
			}
			$$campo = $valor;
		}
	
	$this->consulta = "SELECT * FROM permisos WHERE id_usuario = (select id_usuario from usuarios where usuario = '$usuario')";
	$this->traer_resultados_query_general();


}

public function VerificarPermiso($datos = array()){
	foreach ($datos as $campo => $valor) {
			if($campo == 'clave'){
				$valor = $valor;
			}
			$$campo = $valor;
		}
	
	$this->consulta = "SELECT * FROM permisos  WHERE id_usuario = (select id_usuario from usuarios where usuario = '$usuario') and cod_mod = '$modulo'";
	$this->traer_resultados_query();

}

public function cambiarPermisos($datos = array()){
	
	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($status == 'No') {
		$this->consulta = "DELETE FROM permisos where id_usuario = '$id' and cod_mod = '$modulo'";
		if ($this->ejecutar_simple_query('update', 'los Permisos')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('028', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('update', 'los Permisos');
		}
	}else if ($status == 'Si') {
		$this->consulta = "INSERT INTO permisos (id_usuario, cod_mod) VALUES ('$id', '$modulo') ";

		if ($this->ejecutar_simple_query('update', 'los Permisos')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('028', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('update', 'los Permisos');
		}
	}

	

}


}


 ?>