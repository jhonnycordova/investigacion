<?php

include_once('../core/models.php');
include_once('../core/tcpdf/config/tcpdf_config.php');
include_once('../core/tcpdf/tcpdf.php');

class Centros extends Models{



public function buscarTodos(){
	$this->buscarDatosPorId('centros', 'id_centro');
}


public function buscar($id){

	$this->buscarDatosPorId3('centros','id_centro', $id);
}

public function editar($datos = array()){

	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($nom_centro!='') {
		$this->consulta = "UPDATE centros SET nom_centro = '$nom_centro', vision_centro = '$vision_centro', mision_centro = '$mision_centro', objetivos = '$objetivos', director_centro = '$director_centro', valores_cen = '$valores_cen', tel_dir_cen = '$tel_dir_cen', email_dir_cen = '$email_dir_cen' WHERE id_centro = '$id_centro'";
		if ($this->ejecutar_simple_query('update' , 'Centro de Investigación ')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('015', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('update', 'Centro de Investigación');
		}
		
	}


}

public function crear($datos = array()){

	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($nom_centro!='' && $mision_centro!= '' && $vision_centro!= '' && $objetivos!= '' && $valores_cen!= '') {
		$this->consulta = "INSERT INTO centros (nom_centro, mision_centro, vision_centro, objetivos, valores_cen, director_centro, tel_dir_cen, email_dir_cen, id_decanato) VALUES ('$nom_centro', '$mision_centro', '$vision_centro', '$objetivos', '$valores_cen', '$director_centro', '$tel_dir_cen', '$email_dir_cen', 1)";
		if ($this->ejecutar_simple_query('insert' , 'Centro de Investigación')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('014', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('insert', 'Centro de Investigación');
		}
	}else{
		$this->mensaje = "Debe rellenar todos los campos";
		$this->tipomsj= "danger";
	}
	


}

public function eliminar($id){
	$this->delete('centros', $id);
}


public function buscarLineas($id){
	$this->consulta = "SELECT * FROM lineas WHERE id_prog = 1 and id_centro = '$id'";
	$this->traer_resultados_query_general();
}

public function buscarProyectos($id){
	$this->consulta = "SELECT * FROM proyectos WHERE id_prog = 1 and id_centro = '$id'";
	$this->traer_resultados_query_general();
}

public function buscarInvestigadores($id){
	$this->consulta = "SELECT * FROM investigadores WHERE id_prog = 1 and id_centro = '$id'";
	$this->traer_resultados_query_general();
}





}

 ?>