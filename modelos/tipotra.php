<?php

include_once('../core/models.php');
include_once('../core/tcpdf/config/tcpdf_config.php');
include_once('../core/tcpdf/tcpdf.php');

class Tipotra extends Models{



public function buscarTodos(){
	$this->buscarDatosPorId('trabajo_tipo', 'id_tipotra');
}


public function buscar($id){

	$this->buscarDatosPorId3('trabajo_tipo','id_tipotra', $id);
}

public function editar($datos = array()){

	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($des_trabajo!='') {
		$this->consulta = "UPDATE trabajo_tipo set des_trabajo = '$des_trabajo' WHERE id_tipotra = '$id_tipotra'";
		if ($this->ejecutar_simple_query('update' , 'Tipo de Trabajo')==true) {
			//$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('048', '$_SESSION[idUsuario]', current_date, localtime)";
			//$this->ejecutar_simple_query('update', 'Tipo de Trabajo');
		}
		
	}


}

public function crear($datos = array()){


	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($des_trabajo!='') {
		$this->consulta = "INSERT INTO trabajo_tipo (des_trabajo) VALUES ('$des_trabajo')";
		if ($this->ejecutar_simple_query('insert' , 'Tipo de Trabajo')==true) {
			//$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('047', '$_SESSION[idUsuario]', current_date, localtime)";
			//$this->ejecutar_simple_query('insert', 'Tipo de Trabajo');
		}
	}
	


}

public function eliminar($id){
	$this->delete('trabajo_tipo', $id);
}





}

 ?>