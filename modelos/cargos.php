<?php

include_once('../core/models.php');
include_once('../core/tcpdf/config/tcpdf_config.php');
include_once('../core/tcpdf/tcpdf.php');

class Cargos extends Models{



public function buscarTodos(){
	$this->buscarDatosPorId('autoridad_cargo', 'id_cargo');
}


public function buscar($id){

	$this->buscarDatosPorId3('autoridad_cargo','id_cargo', $id);
}

public function editar($datos = array()){

	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($des_cargo!='') {
		$this->consulta = "UPDATE autoridad_cargo set des_cargo = '$des_cargo' WHERE id_cargo = '$id_cargo'";
		if ($this->ejecutar_simple_query('update' , 'Cargo')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('030', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('update', 'Cargo');
		}
		
	}


}

public function crear($datos = array()){

	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($des_cargo!='') {
		$this->consulta = "INSERT INTO autoridad_cargo (des_cargo) VALUES ('$des_cargo')";
		if ($this->ejecutar_simple_query('insert' , 'Cargo')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('029', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('insert', 'Cargo');
		}
	}
	


}

public function eliminar($id){
	$this->delete('autoridad_cargo', $id);
}





}

 ?>