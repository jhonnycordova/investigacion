<?php
//.........................::::::MODELO AREAS::::::................................//
include_once('../core/models.php');
include_once('../core/tcpdf/config/tcpdf_config.php');
include_once('../core/tcpdf/tcpdf.php');

class Areas extends Models{
//Método para Buscar todas las areas académicas
public function buscarTodos(){
	$this->buscarDatosPorId('evento_area', 'id_area');
}
//Método para Buscar un Area académica pasando como referencia un ID
public function buscar($id){

	$this->buscarDatosPorId3('evento_area','id_area', $id);
}
//Método para Editar un Area académica
public function editar($datos = array()){

	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($des_area!='') {
		$this->consulta = "UPDATE evento_area set des_area = '$des_area' WHERE id_area = '$id_area'";
		if ($this->ejecutar_simple_query('update' , 'Área')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('054', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('update', 'Área');
		}
		
	}
}
//------FIN de EDITAR AREA
public function crear($datos = array()){


	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($des_area!='') {
		$this->consulta = "INSERT INTO evento_area (des_area) VALUES ('$des_area')";
		if ($this->ejecutar_simple_query('insert' , 'Área')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('053', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('insert', 'Área');
		}
	}
	


}

public function eliminar($id){
	$this->delete('evento_area', $id);
}





}

 ?>