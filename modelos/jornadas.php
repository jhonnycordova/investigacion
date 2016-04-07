<?php

include_once('../core/models.php');
include_once('../core/tcpdf/config/tcpdf_config.php');
include_once('../core/tcpdf/tcpdf.php');

class Jornadas extends Models{


public function crear($datos = array(), $datosArchivo = array()){
	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}


	$fecha = getdate();

	$e = $fecha['mday']."-".$fecha['mon']."-".$fecha['year']."-".$fecha['hours']."_".$fecha['minutes']."_".$fecha['seconds'];

	$pro_jor = $e.$datosArchivo['pro_jor']['name'];
	$norm_jor = $e.$datosArchivo['norm_jor']['name'];
	$mem_jor = $e.$datosArchivo['mem_jor']['name'];
	

	$target = "../publico/admin/img/jornadas/";
	$target1 = $target . basename($e.$datosArchivo['pro_jor']['name']);
	$target2 = $target . basename($e.$datosArchivo['norm_jor']['name']);
	$target3 = $target . basename($e.$datosArchivo['mem_jor']['name']);

	$ext = array('pdf', 'PDF');
	$extimg1 = explode('.', $datosArchivo['pro_jor']['name']);
	$extimg2 = explode('.', $datosArchivo['norm_jor']['name']);
	$extimg3 = explode('.', $datosArchivo['mem_jor']['name']);


	if((in_array($extimg1[1], $ext))&&(in_array($extimg2[1], $ext))&&(in_array($extimg3[1], $ext))) {
		if((move_uploaded_file($datosArchivo['pro_jor']['tmp_name'], $target1))&&(move_uploaded_file($datosArchivo['norm_jor']['tmp_name'], $target2))&&(move_uploaded_file($datosArchivo['mem_jor']['tmp_name'], $target3))){
			

			$this->consulta = "INSERT INTO info_decanato_jor (pro_jor, norm_jor, mem_jor, fecha_jor, id_decanato, nom_jor) VALUES ('$pro_jor', '$norm_jor', '$mem_jor', to_date('$fecha_jor', 'dd-mm-yyyy'), 1, '$nom_jor')";
			
			if ($this->ejecutar_simple_query('insert' , 'Jornada')==true) {
				$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('006', '$_SESSION[idUsuario]', current_date, localtime)";
				$this->ejecutar_simple_query('insert', 'Jornada');
			}

			
			
			
		}else{
			$this->mensaje = 'Error Subiendo los Archivos';
			$this->tipomsj = 'danger';
		}
	}else{
		$this->mensaje = 'Error, Algunos de los Archivos NO son PDF';
		$this->tipomsj = 'danger';
	}

	
}

public function editar($datos = array(), $datosArchivo = array()){
	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	$fecha = getdate();

	$e = $fecha['mday']."-".$fecha['mon']."-".$fecha['year']."-".$fecha['hours']."_".$fecha['minutes']."_".$fecha['seconds'];

	$pro_jor = $e.$datosArchivo['pro_jor']['name'];
	$norm_jor = $e.$datosArchivo['norm_jor']['name'];
	$mem_jor = $e.$datosArchivo['mem_jor']['name'];
	

	$target = "../publico/admin/img/jornadas/";
	$target1 = $target . basename($e.$datosArchivo['pro_jor']['name']);
	$target2 = $target . basename($e.$datosArchivo['norm_jor']['name']);
	$target3 = $target . basename($e.$datosArchivo['mem_jor']['name']);

	$ext = array('pdf', 'PDF');
	$extimg1 = explode('.', $datosArchivo['pro_jor']['name']);
	$extimg2 = explode('.', $datosArchivo['norm_jor']['name']);
	$extimg3 = explode('.', $datosArchivo['mem_jor']['name']);


	if((in_array($extimg1[1], $ext))&&(in_array($extimg2[1], $ext))&&(in_array($extimg3[1], $ext))) {
		if((move_uploaded_file($datosArchivo['pro_jor']['tmp_name'], $target1))&&(move_uploaded_file($datosArchivo['norm_jor']['tmp_name'], $target2))&&(move_uploaded_file($datosArchivo['mem_jor']['tmp_name'], $target3))){
			

			$this->consulta = "UPDATE info_decanato_jor SET pro_jor = '$pro_jor', norm_jor = '$norm_jor', mem_jor = '$mem_jor', nom_jor = '$nom_jor', fecha_jor = to_date('$fecha_jor', 'dd-mm-yyyy') WHERE id_jornada = '$id_jornada'";
			
			if ($this->ejecutar_simple_query('update' , 'Jornada')==true) {
				$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('007', '$_SESSION[idUsuario]', current_date, localtime)";
				$this->ejecutar_simple_query('update', 'Jornada');
			}

			
			
			
		}else{
			$this->mensaje = 'Error Subiendo los Archivos';
			$this->tipomsj = 'danger';
		}
	}else{
		$this->mensaje = 'Error, Algunos de los Archivos NO son PDF';
		$this->tipomsj = 'danger';
	}

	

}

public function buscarTodos(){
	$this->buscarDatosPorId('info_decanato_jor', 'id_jornada');
}

public function eliminar($id){
	$this->delete('info_decanato_jor', $id);
}

public function buscar($id){
	
	$this->buscarDatosPorId3('info_decanato_jor','id_jornada', $id);
}

public function buscarTodosOrd(){
	$this->consulta = "SELECT * FROM info_decanato_jor Order by fecha_jor DESC";
	$this->traer_resultados_query_general();
}





}

 ?>