<?php

include_once('../core/models.php');
include_once('../core/tcpdf/config/tcpdf_config.php');
include_once('../core/tcpdf/tcpdf.php');

class Proyectos extends Models{



public function buscarTodos(){
	$this->buscarDatosPorId('proyectos', 'id_proyecto');
}


public function buscar($id){

	$this->buscarDatosPorId3('proyectos','id_proyecto', $id);
}

public function editar($datos = array()){

	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($id_prog==1) {
		$this->consulta = "UPDATE proyectos SET tit_pro = '$tit_pro', obj_pro = '$obj_pro', fec_ini_pro = to_date('$fec_ini_pro', 'dd-mm-yyyy'), fec_cul_pro = to_date('$fec_cul_pro', 'dd-mm-yyyy'), id_tipo_pro = $id_tipo_pro, id_prog = $id_prog, id_centro = $id_centro, id_linea = $id_linea WHERE id_proyecto = '$id_proyecto' ";
		if ($this->ejecutar_simple_query('update' , 'Proyecto')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('021', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('update', 'Proyecto');
		}
	}else if($id_prog==2){
		$this->consulta = "UPDATE proyectos SET tit_pro = '$tit_pro', obj_pro = '$obj_pro', fec_ini_pro = to_date('$fec_ini_pro', 'dd-mm-yyyy'), fec_cul_pro = to_date('$fec_cul_pro', 'dd-mm-yyyy'), id_tipo_pro = $id_tipo_pro, id_prog = $id_prog, id_centro = null, id_linea = $id_linea WHERE id_proyecto = '$id_proyecto' ";
		if ($this->ejecutar_simple_query('update' , 'Proyecto')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('021', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('update', 'Proyecto');
		}
	}

			$this->consulta = "DELETE FROM proyecto_inv WHERE id_proyecto = '$id_proyecto'";
			$this->ejecutar_simple_query('update' , 'Proyecto');

			$num_inv = count($id_investigador);

				for ($i=0; $i <$num_inv ; $i++) { 
					if (!empty($id_investigador[$i])) {
						$this->consulta = "INSERT INTO proyecto_inv (id_proyecto, id_investigador) 
									VALUES ('$id_proyecto', '$id_investigador[$i]')";
						$this->ejecutar_simple_query('update' , 'Proyecto');
					}
				
				}


}

public function crear($datos = array()){

	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($id_prog==1) {
		$this->consulta = "INSERT INTO proyectos (tit_pro, obj_pro, fec_ini_pro, fec_cul_pro, id_prog, id_centro, id_linea, id_tipo_pro) VALUES ('$tit_pro', '$obj_pro', to_date('$fec_ini_pro', 'dd-mm-yyyy'), to_date('$fec_cul_pro', 'dd-mm-yyyy'), $id_prog, $id_centro, $id_linea, $id_tipo_pro) ";
		if ($this->ejecutar_simple_query('insert' , 'Proyecto')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('020', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('insert', 'Proyecto');
		}
	}else if ($id_prog==2) {
		$this->consulta = "INSERT INTO proyectos (tit_pro, obj_pro, fec_ini_pro, fec_cul_pro, id_prog, id_linea, id_tipo_pro) VALUES ('$tit_pro', '$obj_pro', to_date('$fec_ini_pro', 'dd-mm-yyyy'), to_date('$fec_cul_pro', 'dd-mm-yyyy'), $id_prog, $id_linea, $id_tipo_pro ) ";
		if ($this->ejecutar_simple_query('insert' , 'Proyecto')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('020', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('insert', 'Proyecto');
		}
	}

	$num_inv = count($id_investigador);

	for ($i=0; $i <$num_inv ; $i++) { 
		if (!empty($id_investigador[$i])) {
			$this->consulta = "INSERT INTO proyecto_inv (id_proyecto, id_investigador) 
						VALUES ((Select max(id_proyecto) from proyectos), '$id_investigador[$i]')";
			$this->ejecutar_simple_query('insert' , 'Proyecto');
		}
	
	}



}

public function eliminar($id){
	$this->delete('proyectos', $id);
}

public function buscarCentros(){
	
	$this->consulta = "SELECT nom_centro as nombrecentro, id_centro FROM centros order by id_centro"; 
	
	$this->traer_resultados_query_general();
}

public function buscarLineas($id){
	$this->consulta = "SELECT nom_lin as nombrelinea, id_linea FROM lineas WHERE id_prog = '$id'";
	
	$this->traer_resultados_query_general();
}

public function buscarLineas2($id){
	$this->consulta = "SELECT nom_lin as nombrelinea, id_linea FROM lineas WHERE id_centro = '$id'";
	
	$this->traer_resultados_query_general();
}



public function buscarInv($id){

	$this->consulta = "SELECT nom_inv as nombre, ape_inv as apellido, id_investigador FROM investigadores WHERE id_prog = '$id'";
	
	$this->traer_resultados_query_general();
}

public function buscarInv2($id){

	$this->consulta = "SELECT nom_inv as nombre, ape_inv as apellido, id_investigador FROM investigadores WHERE id_centro = '$id'";
	
	$this->traer_resultados_query_general();
}

public function buscarCentro($id){
	
	$this->consulta = "SELECT nom_centro as nombrecentro, id_centro FROM centros WHERE id_centro = '$id'"; 
	
	$this->traer_resultados_query_general();
}

public function buscarLinExt(){
	
	$this->consulta = "SELECT * FROM lineas WHERE id_prog = 2 order by id_linea"; 
	$this->traer_resultados_query_general();
}

public function buscarLinea($id){
	
	$this->consulta = "SELECT * FROM lineas WHERE id_linea = '$id'"; 
	$this->traer_resultados_query_general();
}




}

 ?>