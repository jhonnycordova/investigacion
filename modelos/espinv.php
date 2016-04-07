<?php

include_once('../core/models.php');
include_once('../core/tcpdf/config/tcpdf_config.php');
include_once('../core/tcpdf/tcpdf.php');

class Espinv extends Models{



public function buscarTodos(){
	$this->buscarDatosPorId('esp_inv', 'id_esp');
}

public function buscarTodosPorId($id){
	$this->consulta= "SELECT distinct a.id_esp, a.des_esp FROM esp_inv a, investigador_esp b WHERE a.id_esp not in(select id_esp from investigador_esp where id_investigador = '$id')";
	
	$this->traer_resultados_query_general();
}


public function buscar($id){

	$this->buscarDatosPorId3('esp_inv','id_esp', $id);
}

public function editar($datos = array()){

	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($des_esp!='') {
		$this->consulta = "UPDATE esp_inv set des_esp = '$des_esp' WHERE id_esp = '$id_esp'";
		if ($this->ejecutar_simple_query('update' , 'Especialidad de Investigación')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('036', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('update', 'Especialidad de Investigación');
		}
		
	}


}

public function crear($datos = array()){

	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($des_esp!='') {
		$this->consulta = "INSERT INTO esp_inv (des_esp) VALUES ('$des_esp')";
		if ($this->ejecutar_simple_query('insert' , 'Especialidad de Investigación')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('035', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('insert', 'Especialidad de Investigación');
		}
	}
	


}

public function eliminar($id){
	$this->delete('esp_inv', $id);
}





}

 ?>