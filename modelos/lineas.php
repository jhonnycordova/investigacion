<?php

include_once('../core/models.php');
include_once('../core/tcpdf/config/tcpdf_config.php');
include_once('../core/tcpdf/tcpdf.php');

class Lineas extends Models{



public function buscarTodos(){
	$this->buscarDatosPorId('lineas', 'id_linea');
}


public function buscar($id){

	$this->buscarDatosPorId3('lineas','id_linea', $id);
}

public function editar($datos = array()){

	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($id_centro!='') {
		$this->consulta = "UPDATE lineas SET nom_lin = '$nom_lin', des_lin = '$des_lin', id_centro = $id_centro, id_prog = $id_prog WHERE id_linea = '$id_linea' ";
		if ($this->ejecutar_simple_query('update' , 'Línea')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('018', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('update', 'Línea');
		}
	}else{
		$this->consulta = "UPDATE lineas SET nom_lin = '$nom_lin', des_lin = '$des_lin',  id_prog = $id_prog, id_centro = null WHERE id_linea = '$id_linea' ";
		if ($this->ejecutar_simple_query('update' , 'Línea')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('018', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('update', 'Línea');
		}
	}


}

public function crear($datos = array()){

	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($id_centro!='') {
		$this->consulta = "INSERT INTO lineas (nom_lin, des_lin, id_prog, id_centro) VALUES ('$nom_lin', '$des_lin', $id_prog, $id_centro) ";
		if ($this->ejecutar_simple_query('insert' , 'Línea')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('017', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('insert', 'Línea');
		}
	}else{
		$this->consulta = "INSERT INTO lineas (nom_lin, des_lin, id_prog) VALUES ('$nom_lin', '$des_lin', $id_prog) ";
		if ($this->ejecutar_simple_query('insert' , 'Línea')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('017', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('insert', 'Línea');
		}
	}
	


}

public function eliminar($id){
	$this->delete('lineas', $id);
}

public function buscarCentros(){
	
	$this->consulta = "SELECT nom_centro as nombrecentro, id_centro FROM centros"; 
	$this->traer_resultados_query_general();
}

public function buscarLinInv(){
	
	$this->consulta = "SELECT * FROM lineas WHERE id_prog = 1 order by id_linea"; 
	$this->traer_resultados_query_general();
}

public function buscarLinExt(){
	
	$this->consulta = "SELECT * FROM lineas WHERE id_prog = 2 order by id_linea"; 
	$this->traer_resultados_query_general();
}




}

 ?>