<?php

include_once('../core/models.php');
include_once('../core/tcpdf/config/tcpdf_config.php');
include_once('../core/tcpdf/tcpdf.php');

class Tipopub extends Models{



public function buscarTodos(){
	$this->buscarDatosPorId('evento_publico', 'id_publico');
}


public function buscar($id){

	$this->buscarDatosPorId3('evento_publico','id_publico', $id);
}

public function editar($datos = array()){

	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($des_publico!='') {
		$this->consulta = "UPDATE evento_publico set des_publico = '$des_publico' WHERE id_publico = '$id_publico'";
		if ($this->ejecutar_simple_query('update' , 'Tipo de Público')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('048', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('update', 'Tipo de Público');
		}
		
	}


}

public function crear($datos = array()){


	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($des_publico!='') {
		$this->consulta = "INSERT INTO evento_publico (des_publico) VALUES ('$des_publico')";
		if ($this->ejecutar_simple_query('insert' , 'Tipo de Público')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('047', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('insert', 'Tipo de Público');
		}
	}
	


}

public function eliminar($id){
	$this->delete('evento_publico', $id);
}





}

 ?>