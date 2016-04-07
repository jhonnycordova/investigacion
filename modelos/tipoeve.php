<?php

include_once('../core/models.php');
include_once('../core/tcpdf/config/tcpdf_config.php');
include_once('../core/tcpdf/tcpdf.php');

class Tipoeve extends Models{



public function buscarTodos(){
	$this->buscarDatosPorId('evento_tipo', 'id_tipo');
}


public function buscar($id){

	$this->buscarDatosPorId3('evento_tipo','id_tipo', $id);
}

public function editar($datos = array()){

	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($des_tipo!='') {
		$this->consulta = "UPDATE evento_tipo set des_tipo = '$des_tipo' WHERE id_tipo = '$id_tipo'";
		if ($this->ejecutar_simple_query('update' , 'Tipo de Evento')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('051', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('update', 'Tipo de Evento');
		}
		
	}


}

public function crear($datos = array()){


	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($des_tipo!='') {
		$this->consulta = "INSERT INTO evento_tipo (des_tipo) VALUES ('$des_tipo')";
		if ($this->ejecutar_simple_query('insert' , 'Tipo de Evento')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('050', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('insert', 'Tipo de Evento');
		}
	}
	


}

public function eliminar($id){
	$this->delete('evento_tipo', $id);
}





}

 ?>