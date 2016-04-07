<?php

include_once('../core/models.php');
include_once('../core/tcpdf/config/tcpdf_config.php');
include_once('../core/tcpdf/tcpdf.php');

class Autoridades extends Models{


public function buscarCargos(){

	$this->consulta = "SELECT * FROM autoridad_cargo WHERE id_cargo not in(select id_cargo from autoridades)";
	$this->traer_resultados_query_general();
}

public function crear($datos = array(), $datosImagen = array()){
	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	$fecha = getdate();

	$e = $fecha['mday']."-".$fecha['mon']."-".$fecha['year']."-".$fecha['hours']."_".$fecha['minutes']."_".$fecha['seconds'];


	
	$foto_aut = $e.$datosImagen['foto_aut']['name'];



	$target = "../publico/admin/img/autoridades/";
	$target = $target . basename($e.$datosImagen['foto_aut']['name']);
	
	$ext = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF');
	$extimg = explode('.', $datosImagen['foto_aut']['name']);
	if(in_array($extimg[1], $ext)) {
		if(move_uploaded_file($datosImagen['foto_aut']['tmp_name'], $target)){
		
			$this->consulta = "INSERT INTO autoridades (nom_aut, ape_aut, foto_aut, id_cargo, id_decanato) 
							VALUES ('$nom_aut', '$ape_aut', '$foto_aut', '$id_cargo', 1 )";
			if ($this->ejecutar_simple_query('insert' , 'Autoridad')==true) {
				$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('002', '$_SESSION[idUsuario]', current_date, localtime)";
				$this->ejecutar_simple_query('insert', 'Autoridad');
			}

			for ($i=0; $i <3 ; $i++) { 
				if (!empty($tel_aut[$i])) {
					$this->consulta = "INSERT INTO autoridad_tel (id_autoridad, tel_aut) 
								VALUES ((Select max(id_autoridad) from autoridades), '$tel_aut[$i]')";
					$this->ejecutar_simple_query('insert' , 'Autoridad');
				}

				if (!empty($email_aut[$i])) {
					$this->consulta = "INSERT INTO autoridad_email (id_autoridad, email_aut) 
								VALUES ((Select max(id_autoridad) from autoridades), '$email_aut[$i]')";
					$this->ejecutar_simple_query('insert' , 'Autoridad');
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

	$foto_aut = $datosImagen['foto_aut']['name'];

	if ($foto_aut=="") {
		$this->consulta = "UPDATE autoridades SET nom_aut = '$nom_aut', ape_aut = '$ape_aut',  id_cargo = '$id_cargo' WHERE id_autoridad = '$id_autoridad'";
				
		if ($this->ejecutar_simple_query('update' , 'Autoridad')==true) {
			$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('003', '$_SESSION[idUsuario]', current_date, localtime)";
			$this->ejecutar_simple_query('update', 'Autoridad');
		}

		$this->consulta = "DELETE FROM autoridad_tel WHERE id_autoridad = '$id_autoridad'";
		$this->ejecutar_simple_query('update' , 'Autoridad');

		$this->consulta = "DELETE FROM autoridad_email WHERE id_autoridad = '$id_autoridad'";
		$this->ejecutar_simple_query('update' , 'Autoridad');

		for ($i=0; $i <3 ; $i++) { 
			if (!empty($tel_aut[$i])) {
				$this->consulta = "INSERT INTO autoridad_tel (id_autoridad, tel_aut) 
							VALUES ((Select id_autoridad from autoridades where id_autoridad = '$id_autoridad'), '$tel_aut[$i]')";

				$this->ejecutar_simple_query('update' , 'Autoridad');
			}

			if (!empty($email_aut[$i])) {
				$this->consulta = "INSERT INTO autoridad_email (id_autoridad, email_aut) 
							VALUES ((Select id_autoridad from autoridades where id_autoridad = '$id_autoridad'), '$email_aut[$i]')";
				$this->ejecutar_simple_query('update' , 'Autoridad');
			}

	   	}
	}else{
		$fecha = getdate();

		$e = $fecha['mday']."-".$fecha['mon']."-".$fecha['year']."-".$fecha['hours']."_".$fecha['minutes']."_".$fecha['seconds'];


		
		$foto_aut = $e.$datosImagen['foto_aut']['name'];

		$target = "../publico/admin/img/autoridades/";
		$target = $target . basename($e.$datosImagen['foto_aut']['name']);


		$ext = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF');
		$extimg = explode('.', $datosImagen['foto_aut']['name']);
		if(in_array($extimg[1], $ext)) {
			if(move_uploaded_file($datosImagen['foto_aut']['tmp_name'], $target)){
			
				$this->consulta = "UPDATE autoridades SET nom_aut = '$nom_aut', ape_aut = '$ape_aut', foto_aut = '$foto_aut', id_cargo = '$id_cargo' WHERE id_autoridad = '$id_autoridad'";
				
				if ($this->ejecutar_simple_query('update' , 'Autoridad')==true) {
					$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('003', '$_SESSION[idUsuario]', current_date, localtime)";
					$this->ejecutar_simple_query('update', 'Autoridad');
				}

				$this->consulta = "DELETE FROM autoridad_tel WHERE id_autoridad = '$id_autoridad'";
				$this->ejecutar_simple_query('update' , 'Autoridad');

				$this->consulta = "DELETE FROM autoridad_email WHERE id_autoridad = '$id_autoridad'";
				$this->ejecutar_simple_query('update' , 'Autoridad');

				for ($i=0; $i <3 ; $i++) { 
					if (!empty($tel_aut[$i])) {
						$this->consulta = "INSERT INTO autoridad_tel (id_autoridad, tel_aut) 
									VALUES ((Select id_autoridad from autoridades where id_autoridad = '$id_autoridad'), '$tel_aut[$i]')";

						$this->ejecutar_simple_query('update' , 'Autoridad');
					}

					if (!empty($email_aut[$i])) {
						$this->consulta = "INSERT INTO autoridad_email (id_autoridad, email_aut) 
									VALUES ((Select id_autoridad from autoridades where id_autoridad = '$id_autoridad'), '$email_aut[$i]')";
						$this->ejecutar_simple_query('update' , 'Autoridad');
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
	$this->buscarDatosPorId('autoridades', 'id_autoridad');
}

public function eliminar($id){
	$this->delete('autoridades', $id);
}

public function buscar($id){
	
	$this->buscarDatosPorId3('autoridades','id_autoridad', $id);
}





}

 ?>