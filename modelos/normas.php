<?php

include_once('../core/models.php');
include_once('../core/tcpdf/config/tcpdf_config.php');
include_once('../core/tcpdf/tcpdf.php');

class Normas extends Models{



public function buscarTodos(){
	$this->buscarDatosPorId('info_decanato_norma', 'id_norma');
}

public function buscarNormas($id_espacio){
	$this->consulta = "SELECT * FROM info_decanato_norma WHERE id_espacio = '$id_espacio'";
	$this->traer_resultados_query_general();
}


public function buscar($id){

	$this->buscarDatosPorId3('info_decanato_norma','id_norma', $id);
}

public function editar($datos = array()){

	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($des_norma!='') {
		$this->consulta = "UPDATE info_decanato_norma set des_norma = '$des_norma', id_espacio = $id_espacio WHERE id_norma = '$id_norma'";
		if ($this->ejecutar_simple_query('update' , 'Norma')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('045', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('update', 'Norma');
		}
		
	}


}

public function crear($datos = array()){


	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($des_norma!='') {
		$this->consulta = "INSERT INTO info_decanato_norma (des_norma, id_espacio) VALUES ('$des_norma', $id_espacio)";
		if ($this->ejecutar_simple_query('insert' , 'Norma')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('044', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('insert', 'Norma');
		}
	}
	


}

public function eliminar($id){
	$this->delete('info_decanato_norma', $id);
}

public function buscarEspacios(){
	
	$this->consulta = "SELECT * FROM evento_espacio"; 
	$this->traer_resultados_query_general();
}





}

 ?>