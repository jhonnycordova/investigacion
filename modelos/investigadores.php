<?php

include_once('../core/models.php');
include_once('../core/tcpdf/config/tcpdf_config.php');
include_once('../core/tcpdf/tcpdf.php');

class Investigadores extends Models{


public function buscarCargos(){

	$this->consulta = "SELECT * FROM autoridad_cargo WHERE id_cargo not in(select id_cargo from investigadores)";
	$this->traer_resultados_query_general();
}

public function crear($datos = array(), $datosImagen = array()){
	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	$fecha = getdate();

	$e = $fecha['mday']."-".$fecha['mon']."-".$fecha['year']."-".$fecha['hours']."_".$fecha['minutes']."_".$fecha['seconds'];

	
	$foto_inv = $e.$datosImagen['foto_inv']['name'];

	$target = "../publico/admin/img/investigadores/";
	$target = $target . basename($e.$datosImagen['foto_inv']['name']);
	
	$ext = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF');
	$extimg = explode('.', $datosImagen['foto_inv']['name']);
	if(in_array($extimg[1], $ext)) {
		if(move_uploaded_file($datosImagen['foto_inv']['tmp_name'], $target)){
			
			if ($id_centro!='') {
				$this->consulta = "INSERT INTO investigadores (nom_inv, ape_inv, foto_inv, des_inv, id_centro, id_prog) 
								VALUES ('$nom_inv', '$ape_inv', '$foto_inv', '$des_inv', $id_centro, $id_prog )";
				if ($this->ejecutar_simple_query('insert' , 'Investigador')==true) {
					$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('023', '$_SESSION[idUsuario]', current_date, localtime)";
					$this->ejecutar_simple_query('insert', 'Investigador');
				}
			}else{
				$this->consulta = "INSERT INTO investigadores (nom_inv, ape_inv, foto_inv, des_inv, id_prog) 
								VALUES ('$nom_inv', '$ape_inv', '$foto_inv', '$des_inv', $id_prog )";
				if ($this->ejecutar_simple_query('insert' , 'Investigador')==true) {
					$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('023', '$_SESSION[idUsuario]', current_date, localtime)";
					$this->ejecutar_simple_query('insert', 'Investigador');
				}
			}

			for ($i=0; $i <3 ; $i++) { 
				if (!empty($tel_inv[$i])) {
					$this->consulta = "INSERT INTO investigador_tel (id_investigador, tel_inv) 
								VALUES ((Select max(id_investigador) from investigadores), '$tel_inv[$i]')";
					$this->ejecutar_simple_query('insert' , 'Investigador');
				}

				if (!empty($email_inv[$i])) {
					$this->consulta = "INSERT INTO investigador_email (id_investigador, email_inv) 
								VALUES ((Select max(id_investigador) from investigadores), '$email_inv[$i]')";
					$this->ejecutar_simple_query('insert' , 'Investigador');
				}
			
			}

			$num_esp = count($id_esp);

			for ($i=0; $i < $num_esp; $i++) { 
				if (!empty($id_esp[$i])) {
					$this->consulta = "INSERT INTO investigador_esp (id_investigador, id_esp) 
								VALUES ((Select max(id_investigador) from investigadores), '$id_esp[$i]')";
					$this->ejecutar_simple_query('insert' , 'Investigador');
				}
			}
			
		}else{
			$this->mensaje = 'Error Subiendo la Imagen';
			$this->tipomsj = 'danger';
		}
	}else{
		$this->mensaje = 'Error, Extensión de Imagen no Permitida';
		$this->tipomsj = 'danger';
	}

	
}

public function editar($datos = array(), $datosImagen = array()){
	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	$foto_inv = $datosImagen['foto_inv']['name'];

	if ($foto_inv=="") {
		if ($id_centro!='') {
			$this->consulta = "UPDATE investigadores SET nom_inv = '$nom_inv', ape_inv = '$ape_inv', des_inv = '$des_inv', id_prog = $id_prog, id_centro = $id_centro WHERE id_investigador = '$id_investigador' ";
			if ($this->ejecutar_simple_query('update' , 'Investigador')==true) {
				$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('024', '$_SESSION[idUsuario]', current_date, localtime)";
				$this->ejecutar_simple_query('insert', 'Investigador');
			}
		}else{
			$this->consulta = "UPDATE investigadores SET nom_inv = '$nom_inv', ape_inv = '$ape_inv', des_inv = '$des_inv', id_prog = $id_prog, id_centro = null WHERE id_investigador = '$id_investigador' ";
			if ($this->ejecutar_simple_query('update' , 'Investigador')==true) {
				$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('024', '$_SESSION[idUsuario]', current_date, localtime)";
				$this->ejecutar_simple_query('insert', 'Investigador');
			}
		}

		$this->consulta = "DELETE FROM investigador_tel WHERE id_investigador = '$id_investigador'";
		$this->ejecutar_simple_query('update' , 'Investigador');

		$this->consulta = "DELETE FROM investigador_email WHERE id_investigador = '$id_investigador'";
		$this->ejecutar_simple_query('update' , 'Investigador');

		$this->consulta = "DELETE FROM investigador_esp WHERE id_investigador = '$id_investigador'";
		$this->ejecutar_simple_query('update' , 'Investigador');

		for ($i=0; $i <3 ; $i++) { 
			if (!empty($tel_inv[$i])) {
				$this->consulta = "INSERT INTO investigador_tel (id_investigador, tel_inv) 
							VALUES ('$id_investigador', '$tel_inv[$i]')";
				$this->ejecutar_simple_query('update' , 'Investigador');
			}

			if (!empty($email_inv[$i])) {
				$this->consulta = "INSERT INTO investigador_email (id_investigador, email_inv) 
							VALUES ('$id_investigador', '$email_inv[$i]')";
				$this->ejecutar_simple_query('update' , 'Investigador');
			}
		
		}

		$num_esp = count($id_esp);

		for ($i=0; $i < $num_esp; $i++) { 
			if (!empty($id_esp[$i])) {
				$this->consulta = "INSERT INTO investigador_esp (id_investigador, id_esp) 
							VALUES ('$id_investigador', '$id_esp[$i]')";
				$this->ejecutar_simple_query('update' , 'Investigador');
			}
		}
	}else{

		$fecha = getdate();

		$e = $fecha['mday']."-".$fecha['mon']."-".$fecha['year']."-".$fecha['hours']."_".$fecha['minutes']."_".$fecha['seconds'];

		
		$foto_inv = $e.$datosImagen['foto_inv']['name'];

		$target = "../publico/admin/img/investigadores/";
		$target = $target . basename($e.$datosImagen['foto_inv']['name']);
		
		$ext = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF');
		$extimg = explode('.', $datosImagen['foto_inv']['name']);
		if(in_array($extimg[1], $ext)) {
			if(move_uploaded_file($datosImagen['foto_inv']['tmp_name'], $target)){
				
				if ($id_centro!='') {
					$this->consulta = "UPDATE investigadores SET nom_inv = '$nom_inv', ape_inv = '$ape_inv', foto_inv = '$foto_inv', des_inv = '$des_inv', id_prog = $id_prog, id_centro = $id_centro WHERE id_investigador = '$id_investigador' ";
					if ($this->ejecutar_simple_query('update' , 'Investigador')==true) {
						$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('024', '$_SESSION[idUsuario]', current_date, localtime)";
						$this->ejecutar_simple_query('insert', 'Investigador');
					}
				}else{
					$this->consulta = "UPDATE investigadores SET nom_inv = '$nom_inv', ape_inv = '$ape_inv', foto_inv = '$foto_inv', des_inv = '$des_inv', id_prog = $id_prog, id_centro = null WHERE id_investigador = '$id_investigador' ";
					if ($this->ejecutar_simple_query('update' , 'Investigador')==true) {
						$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('024', '$_SESSION[idUsuario]', current_date, localtime)";
						$this->ejecutar_simple_query('insert', 'Investigador');
					}
				}

				$this->consulta = "DELETE FROM investigador_tel WHERE id_investigador = '$id_investigador'";
				$this->ejecutar_simple_query('update' , 'Investigador');

				$this->consulta = "DELETE FROM investigador_email WHERE id_investigador = '$id_investigador'";
				$this->ejecutar_simple_query('update' , 'Investigador');

				$this->consulta = "DELETE FROM investigador_esp WHERE id_investigador = '$id_investigador'";
				$this->ejecutar_simple_query('update' , 'Investigador');

				for ($i=0; $i <3 ; $i++) { 
					if (!empty($tel_inv[$i])) {
						$this->consulta = "INSERT INTO investigador_tel (id_investigador, tel_inv) 
									VALUES ('$id_investigador', '$tel_inv[$i]')";
						$this->ejecutar_simple_query('update' , 'Investigador');
					}

					if (!empty($email_inv[$i])) {
						$this->consulta = "INSERT INTO investigador_email (id_investigador, email_inv) 
									VALUES ('$id_investigador', '$email_inv[$i]')";
						$this->ejecutar_simple_query('update' , 'Investigador');
					}
				
				}

				$num_esp = count($id_esp);

				for ($i=0; $i < $num_esp; $i++) { 
					if (!empty($id_esp[$i])) {
						$this->consulta = "INSERT INTO investigador_esp (id_investigador, id_esp) 
									VALUES ('$id_investigador', '$id_esp[$i]')";
						$this->ejecutar_simple_query('update' , 'Investigador');
					}
				}
				
			}else{
				$this->mensaje = 'Error Subiendo la Imagen';
				$this->tipomsj = 'danger';
			}
		}else{
			$this->mensaje = 'Error, Extensión de Imagen no Permitida';
			$this->tipomsj = 'danger';
		}
	}



	
}

public function buscarTodos(){
	$this->consulta = "SELECT * FROM investigadores order by id_investigador DESC"; 
	$this->traer_resultados_query_general();
}

public function eliminar($id){
	$this->delete('investigadores', $id);
}

public function buscar($id){
	
	$this->buscarDatosPorId3('investigadores','id_investigador', $id);
}

public function buscarEsp($id){
	$this->consulta = "SELECT a.des_esp FROM esp_inv a, investigador_esp b WHERE b.id_investigador = '$id' and a.id_esp = b.id_esp";
	$this->traer_resultados_query_general();
}

public function buscarCentros(){
	
	$this->consulta = "SELECT nom_centro as nombrecentro, id_centro FROM centros order by id_centro"; 
	
	$this->traer_resultados_query_general();
}

public function buscarLinExt(){
	
	$this->consulta = "SELECT * FROM lineas WHERE id_prog = 2 order by id_linea"; 
	$this->traer_resultados_query_general();
}




}

 ?>