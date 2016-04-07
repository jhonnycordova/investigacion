<?php

include_once('../core/models.php');
include_once('../core/tcpdf/config/tcpdf_config.php');
include_once('../core/tcpdf/tcpdf.php');

class Causas extends Models{



public function buscarTodos(){
	$this->buscarDatosPorId('noaprob_causa', 'id_causa');
}


public function buscar($id){

	$this->buscarDatosPorId3('noaprob_causa','id_causa', $id);
}

public function editar($datos = array()){

	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($des_causa!='') {
		$this->consulta = "UPDATE noaprob_causa set des_causa = '$des_causa' WHERE id_causa = '$id_causa'";
		if ($this->ejecutar_simple_query('update' , 'Causa de No Aprobación')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('057', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('update', 'Causa de No Aprobación');
		}
		
	}


}

public function crear($datos = array()){


	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($des_causa!='') {
		$this->consulta = "INSERT INTO noaprob_causa (des_causa) VALUES ('$des_causa')";
		if ($this->ejecutar_simple_query('insert' , 'Causa de No Aprobación')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('056', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('insert', 'Causa de No Aprobación');
		}
	}
	


}

public function eliminar($id){
	$this->delete('noaprob_causa', $id);
}





}

 ?>