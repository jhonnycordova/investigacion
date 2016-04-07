<?php

include_once('../core/models.php');
include_once('../core/tcpdf/config/tcpdf_config.php');
include_once('../core/tcpdf/tcpdf.php');

class Tipoproy extends Models{



public function buscarTodos(){
	$this->buscarDatosPorId('proyecto_tipo', 'id_tipo_pro');
}


public function buscar($id){

	$this->buscarDatosPorId3('proyecto_tipo','id_tipo_pro', $id);
}

public function editar($datos = array()){

	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($des_tipo_pro!='') {
		$this->consulta = "UPDATE proyecto_tipo set des_tipo_pro = '$des_tipo_pro' WHERE id_tipo_pro = '$id_tipo_pro'";
		if ($this->ejecutar_simple_query('update' , 'Tipo de Proyecto')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('033', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('update', 'Tipo de Proyecto');
		}
		
	}


}

public function crear($datos = array()){

	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($des_tipo_pro!='') {
		$this->consulta = "INSERT INTO proyecto_tipo (des_tipo_pro) VALUES ('$des_tipo_pro')";
		if ($this->ejecutar_simple_query('insert' , 'Tipo de Proyecto')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('032', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('insert', 'Tipo de Proyecto');
		}
	}
	


}

public function eliminar($id){
	$this->delete('proyecto_tipo', $id);
}





}

 ?>