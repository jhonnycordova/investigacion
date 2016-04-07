<?php

include_once('../core/db_conexion.php');

class Decanato extends DBConexion{

#METODOS


public function buscarInfo(){

	$this->consulta = "SELECT * FROM info_decanato";
	$this->traer_resultados_query_general();

}

public function editar($datos = array()){

	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($mision=="" || $vision=="") {
		$this->mensaje = "Debe completar toda la información";
		$this->tipomsj = "danger";
	}else{
		$this->consulta	= "UPDATE info_decanato set mision = '$mision', vision = '$vision', email_dec = '$email_dec', fec_ult_act = current_date WHERE id_decanato = 1 ";

		if ($this->ejecutar_simple_query('update' , 'la Información del Decanato ')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('001', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('update', 'la Información del Decanato ');
		}

	}
	
}

public function buscarMision(){
	
	$this->consulta = "SELECT mision FROM info_decanato";
	$this->traer_resultados_query();
}

public function buscarVision(){
	
	$this->consulta = "SELECT vision FROM info_decanato";
	$this->traer_resultados_query();
}

}
 ?>