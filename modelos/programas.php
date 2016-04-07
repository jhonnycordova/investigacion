<?php

include_once('../core/models.php');
include_once('../core/tcpdf/config/tcpdf_config.php');
include_once('../core/tcpdf/tcpdf.php');

class Programas extends Models{



public function buscarTodos(){
	$this->buscarDatosPorId('info_decanato_prog', 'id_prog');
}


public function buscar($id){

	$this->buscarDatosPorId3('info_decanato_prog','id_prog', $id);
}

public function editar($datos = array()){

	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($des_prog!='') {
		$this->consulta = "UPDATE info_decanato_prog set des_prog = '$des_prog', mision_prog = '$mision_prog', vision_prog = '$vision_prog' WHERE id_prog = '$id_prog'";
		
		if ($this->ejecutar_simple_query('update' , 'Programa')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('005', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('update', 'Programa');
		}
		
	}


}

public function buscarPInvestigacion(){
	$this->consulta = "SELECT * FROM info_decanato_prog WHERE id_prog = 1";
	$this->traer_resultados_query();
}

public function buscarPExtension(){
	$this->consulta = "SELECT * FROM info_decanato_prog WHERE id_prog = 2";
	$this->traer_resultados_query();
}






}

 ?>