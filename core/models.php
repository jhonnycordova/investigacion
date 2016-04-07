<?php
include('db_conexion.php');

class Models extends DBConexion{

//parametros array[campo] = valor;

public function validar($parametros = array(), $tabla){
	foreach ($parametros as $k => $v) {
			$campo = $k;
			$valor = $v;
		}
	
	$this->consulta = "SELECT * FROM ".$tabla." WHERE ".$campo." = '$valor'";
	return $this->traer_resultados_query_simple();
}

public function validarEditar($parametros = array(), $tabla, $id){
	foreach ($parametros as $k => $v) {
			$campo = $k;
			$valor = $v;
		}
	$this->consulta = "SELECT * FROM ".$tabla." WHERE ".$campo." = '$valor' and id_usuario != $id ";
	return $this->traer_resultados_query_simple();
}

/*
public function buscarDatos($tabla){
	$this->consulta = "SELECT * FROM ".$tabla." Order by id ";
	$this->traer_resultados_query_general();
}
*/

public function buscarDatosPorId($tabla, $id){
	$this->consulta = "SELECT * FROM ".$tabla." Order by ".$id;
	$this->traer_resultados_query_general();
}

public function buscarDatosPorMod($tabla, $id, $modulo){
	$this->consulta = "SELECT * FROM ".$tabla." a, permisos b WHERE b.cod_mod = '".$modulo."' and a.".$id." not in(".$_SESSION["idUsuario"].") and a.".$id." = b.".$id."  Order by a.".$id;
	$this->traer_resultados_query_general();
	
}

public function delete($tabla, $id){
	if ($tabla=='autoridad_cargo') {
		$this->consulta="DELETE FROM autoridad_cargo WHERE id_cargo = '$id'";
		if ($this->ejecutar_simple_query('delete', 'Cargo')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('031', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('delete', 'Cargo');
		}
	}else if ($tabla=='proyecto_tipo') {
		$this->consulta="DELETE FROM proyecto_tipo WHERE id_tipo_pro = '$id'";
		if ($this->ejecutar_simple_query('delete', 'Tipo de Proyecto')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('034', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('delete', 'Tipo de Proyecto');
		}
	}else if ($tabla=='esp_inv') {
		$this->consulta="DELETE FROM esp_inv WHERE id_esp = '$id'";
		if ($this->ejecutar_simple_query('delete', 'Especialidad de Investigación')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('037', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('delete', 'Especialidad de Investigación');
		}
	}else if ($tabla=='autoridades') {
		$this->consulta="DELETE FROM autoridad_email WHERE id_autoridad = '$id'";
		$this->ejecutar_simple_query('delete', 'Autoridad');

		$this->consulta="DELETE FROM autoridad_tel WHERE id_autoridad = '$id'";
		$this->ejecutar_simple_query('delete', 'Autoridad');

		$this->consulta="DELETE FROM autoridades WHERE id_autoridad = '$id'";
		
		if ($this->ejecutar_simple_query('delete', 'Autoridad')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('004', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('delete', 'Autoridad');
			
		}

	}else if ($tabla=='info_decanato_jor') {
		$this->consulta="DELETE FROM info_decanato_jor WHERE id_jornada = '$id'";
		if ($this->ejecutar_simple_query('delete', 'Jornada')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('008', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('delete', 'Jornada');
		}
	}else if($tabla=='info_decanato_imagen'){
		$this->consulta="DELETE FROM info_decanato_imagen WHERE id_imagen = '$id'";
		if ($this->ejecutar_simple_query('delete', 'Imagen')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('010', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('delete', 'Imagen');
		}
	}else if ($tabla=='noticias') {
		$this->consulta="DELETE FROM noticia_img WHERE id_noticia = '$id'";
		$this->ejecutar_simple_query('delete', 'Noticia');

		$this->consulta="DELETE FROM noticias WHERE id_noticia = '$id'";
		if ($this->ejecutar_simple_query('delete', 'Noticia')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('013', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('delete', 'Noticia');
		}
	}else if ($tabla=='centros') {
		$this->consulta="DELETE FROM centros WHERE id_centro = '$id'";
		if ($this->ejecutar_simple_query('delete', 'Centro de Investigación')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('016', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('delete', 'Centro de Investigación');
		}
	}else if ($tabla=='lineas') {
		$this->consulta="DELETE FROM lineas WHERE id_linea = '$id'";
		if ($this->ejecutar_simple_query('delete', 'Línea')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('019', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('delete', 'Línea');
		}
	}else if ($tabla=='investigadores') {
		$this->consulta="DELETE FROM investigador_email WHERE id_investigador = '$id'";
		$this->ejecutar_simple_query('delete', 'Investigador');

		$this->consulta="DELETE FROM investigador_tel WHERE id_investigador = '$id'";
		$this->ejecutar_simple_query('delete', 'Investigador');

		$this->consulta="DELETE FROM investigador_esp WHERE id_investigador = '$id'";
		$this->ejecutar_simple_query('delete', 'Investigador');

		$this->consulta="DELETE FROM investigadores WHERE id_investigador = '$id'";
		if ($this->ejecutar_simple_query('delete', 'Investigador')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('025', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('delete', 'Investigador');
		}
	}else if ($tabla=='proyectos') {
		$this->consulta="DELETE FROM proyecto_inv WHERE id_proyecto = '$id'";
		$this->ejecutar_simple_query('delete', 'Proyecto');

		$this->consulta="DELETE FROM proyectos WHERE id_proyecto = '$id'";
		if ($this->ejecutar_simple_query('delete', 'Proyecto')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('022', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('delete', 'Proyecto');
		}
	}else if ($tabla=='evento_area') {
		$this->consulta="DELETE FROM evento_area WHERE id_area = '$id'";
		if ($this->ejecutar_simple_query('delete', 'Área')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('055', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('delete', 'Área');
		}
	}else if ($tabla=='evento_publico') {
		$this->consulta="DELETE FROM evento_publico WHERE id_publico = '$id'";
		if ($this->ejecutar_simple_query('delete', 'Tipo de Público')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('049', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('delete', 'Tipo de Público');
		}
	}else if ($tabla=='evento_tipo') {
		$this->consulta="DELETE FROM evento_tipo WHERE id_tipo = '$id'";
		if ($this->ejecutar_simple_query('delete', 'Tipo de Evento')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('052', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('delete', 'Tipo de Evento');
		}
	}else if ($tabla=='info_decanato_norma') {
		$this->consulta="DELETE FROM info_decanato_norma WHERE id_norma = '$id'";
		if ($this->ejecutar_simple_query('delete', 'Norma')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('046', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('delete', 'Norma');
		}
	}else if ($tabla=='eventos') {
		$this->consulta="DELETE FROM evento_info WHERE id_evento = '$id'";
		$this->ejecutar_simple_query('delete', 'Evento');

		$this->consulta="DELETE FROM solic_esp WHERE id_evento = '$id'";
		$this->ejecutar_simple_query('delete', 'Evento');
		$this->consulta="DELETE FROM eventos WHERE id_evento = '$id'";
		
		if ($this->ejecutar_simple_query('delete', 'Evento')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('041', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('delete', 'Evento');
		}
	}else if ($tabla=='noaprob_causa') {
		$this->consulta="DELETE FROM noaprob_causa WHERE id_causa = '$id'";
		if ($this->ejecutar_simple_query('delete', 'Causa de No Aprobación')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('058', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('delete', 'Causa de No Aprobación');
		}
	}else if ($tabla=='trabajo_tipo') {
		$this->consulta="DELETE FROM trabajo_tipo WHERE id_tipotra = '$id'";
		if ($this->ejecutar_simple_query('delete', 'Tipo de Trabajo')==true) {
			//$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('058', '$_SESSION[idUsuario]', current_date, localtime)";
			//$this->ejecutar_simple_query('delete', 'Norma');
		}
	}else if ($tabla=='autores') {
		$this->consulta="DELETE FROM autores WHERE id_autor = '$id'";
		if ($this->ejecutar_simple_query('delete', 'Autor')==true) {
			//$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('058', '$_SESSION[idUsuario]', current_date, localtime)";
			//$this->ejecutar_simple_query('delete', 'Autor');
		}
	}

}


public function buscarDatosId($tabla, $id){
	$this->consulta = "SELECT * FROM ".$tabla." WHERE id = '$id' ";
	$this->traer_resultados_query();
}

public function buscarDatosPorId3($tabla, $campo, $id){
	$this->consulta = "SELECT * FROM ".$tabla." WHERE ".$campo." = '$id' ";
	$this->traer_resultados_query();
}

public function buscarDatosId2($tabla,$pk, $id){
	$this->consulta = "SELECT * FROM ".$tabla." WHERE $pk = '$id' ";
	$this->traer_resultados_query_general();
}


public function buscarEsp($id){
	$this->consulta = "SELECT a.des_esp, a.id_esp FROM esp_inv a, investigador_esp b WHERE b.id_investigador = '$id' and a.id_esp = b.id_esp";

	$this->traer_resultados_query_general();
}

public function buscarInv($id){
	$this->consulta = "SELECT a.nom_inv,a.ape_inv, a.id_investigador FROM investigadores a, proyecto_inv b WHERE b.id_proyecto = '$id' and a.id_investigador = b.id_investigador";


	$this->traer_resultados_query_general();
}

public function buscarImgNoticia($id){

	$this->consulta = "SELECT img_not, id_noticia from noticia_img where id_noticia = '$id'";
	$this->traer_resultados_query_general();
}

public function buscarProyectos($id){

	$this->consulta = "SELECT * FROM proyectos where id_linea = '$id'";
	$this->traer_resultados_query_general();
}

public function buscarProyectos2($id){

	$this->consulta = "SELECT * FROM proyectos where id_centro = '$id'";
	$this->traer_resultados_query_general();
}

public function buscarInvCentro($id){

	$this->consulta = "SELECT * FROM investigadores where id_centro = '$id'";
	$this->traer_resultados_query_general();
}


public function buscarInvLinea($id){

	$this->consulta = "SELECT * FROM investigadores WHERE id_investigador in 
					   (SELECT  a.id_investigador FROM proyecto_inv a WHERE a.id_proyecto in (select id_proyecto from proyectos where id_linea = '$id'))";
	$this->traer_resultados_query_general();
}

public function buscarProPorInv($id){
	$this->consulta = "SELECT distinct a.id_proyecto, a.tit_pro FROM proyectos a, proyecto_inv b WHERE a.id_proyecto in (select id_proyecto from proyecto_inv where id_investigador = '$id') and a.id_proyecto = b.id_proyecto";
	$this->traer_resultados_query_general();

}

public function buscarInfoEvento($id){
	$this->consulta = "select min(hora) as horainicio, max(hora) as horafin, fecha from evento_info where id_evento = '$id' group by fecha order by fecha asc";
	$this->traer_resultados_query_general();

}

public function buscarHoraInicio($id_evento, $fechainicio){
	$this->consulta= "SELECT min(hora) as horainicio FROM evento_info WHERE id_evento = '$id_evento' and fecha = '$fechainicio'";
	
	$this->traer_resultados_query();
}

public function buscarHoraFin($id_evento, $fechafin){
	$this->consulta= "SELECT max(hora) as horafin FROM evento_info WHERE id_evento = '$id_evento' and fecha = '$fechafin'";
	$this->traer_resultados_query();
}

}


 ?>