<?php

include_once('../core/models.php');
include_once('../core/tcpdf/config/tcpdf_config.php');
include_once('../core/tcpdf/tcpdf.php');

class Noticias extends Models{


public function crear($datos = array(), $datosImagen = array()){
	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}
	$noticia = false;
	if ($des_not!='') {
		$this->consulta = "INSERT INTO noticias (titulo, des_not, fec_not, id_decanato) 
								VALUES ('$titulo', '$des_not', to_date('$fec_not', 'dd-mm-yyyy'), 1 )";
		if($this->ejecutar_simple_query('insert' , 'Noticia')==true){
			$noticia = true;
		}
		
	}else{
		$this->consulta = "INSERT INTO noticias (titulo, fec_not, id_decanato) 
								VALUES ('$titulo', to_date('$fec_not', 'dd-mm-yyyy'), 1 )";
		if($this->ejecutar_simple_query('insert' , 'Noticia')==true){
			$noticia = true;
		}
	}

	$cantidad = 0;
	$cantidad2 = 0;

	if ($noticia==true) {
		
		for ($i=0; $i < 3 ; $i++) { 
			if (!empty($datosImagen['img_not']['name'][$i])) {
				$cantidad++;
				$fecha = getdate();

				$e = $fecha['mday']."-".$fecha['mon']."-".$fecha['year']."-".$fecha['hours']."_".$fecha['minutes']."_".$fecha['seconds'];
				
				$img_not = $e.$datosImagen['img_not']['name'][$i];

				$miniatura_ancho_maximo = 800;
				$miniatura_alto_maximo = 400;
				$info_imagen = getimagesize($datosImagen['img_not']['tmp_name'][$i]);
				$imagen_ancho = $info_imagen[0];
				$imagen_alto = $info_imagen[1];
				$imagen_tipo = $info_imagen['mime'];

				$lienzo = imagecreatetruecolor( $miniatura_ancho_maximo, $miniatura_alto_maximo );

				//creo una imagen dependiendo el tipo
				switch ( $imagen_tipo ){
					case "image/jpg":
					case "image/jpeg":
						$imagen = imagecreatefromjpeg($datosImagen['img_not']['tmp_name'][$i]);
						break;
					case "image/png":
						$imagen = imagecreatefrompng($datosImagen['img_not']['tmp_name'][$i]);
						break;
					case "image/gif":
						$imagen = imagecreatefromgif($datosImagen['img_not']['tmp_name'][$i]);
						break;
				}

				//Guardo la Imagen en el Lienzo
				imagecopyresampled($lienzo, $imagen, 0, 0, 0, 0, $miniatura_ancho_maximo, $miniatura_alto_maximo, $imagen_ancho, $imagen_alto);
				//guarda la imagen en la ruta temporal
				imagejpeg( $lienzo, $datosImagen['img_not']['tmp_name'][$i], 90 );

				$imagen = $e.$datosImagen['img_not']['name'][$i];
				$tamaño = getimagesize($datosImagen['img_not']['tmp_name'][$i]);


				$target = "../publico/admin/img/noticias/";
				$target = $target . basename($e.$datosImagen['img_not']['name'][$i]);
				
				$ext = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF');
				$extimg = explode('.', $datosImagen['img_not']['name'][$i]);

				if(in_array($extimg[1], $ext)) {
					if(move_uploaded_file($datosImagen['img_not']['tmp_name'][$i], $target)){
					
						$this->consulta = "INSERT INTO noticia_img (id_noticia, img_not) 
										VALUES ((SELECT max(id_noticia) from noticias), '$imagen')";

						if($this->ejecutar_simple_query('insert' , 'Noticia')==true){
								$cantidad2 = $cantidad2 + 1;
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
	}

	

	if ($cantidad2==$cantidad && $noticia==true) {
		$this->mensaje = 'Se creo la Noticia Satisfactoriamente';
		$this->tipomsj = 'success';

		$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('011', '$_SESSION[idUsuario]', current_date, localtime)";
		$this->ejecutar_simple_query('insert', 'Noticia');
	}else{

		if ($noticia==true) {
			$this->consulta = "DELETE FROM noticia_img WHERE id_noticia = (SELECT max(id_noticia) from noticias)";
			$this->ejecutar_simple_query('delete' , 'Noticia');
			$this->consulta = "DELETE FROM noticias WHERE id_noticia = (SELECT max(id_noticia) from noticias)";
			$this->ejecutar_simple_query('delete' , 'Noticia');
		}
		


		$this->mensaje = 'Hubo un Problema al Crear la Noticia';
		$this->tipomsj = 'danger';
	}

	
}

public function editar($datos = array(), $datosImagen = array()){
	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($titulo!='') {
		$this->consulta = "UPDATE noticias SET titulo = '$titulo', des_not = '$des_not', fec_not = to_date('$fec_not', 'dd-mm-yyyy') WHERE id_noticia = '$id_noticia'";
		if($this->ejecutar_simple_query('update' , 'Noticia')==true){
			$noticia = true;
		}
		
	}

	$cantidad = 0;
	$cantidad2 = 0;

	$this->consulta = "DELETE FROM noticia_img WHERE id_noticia = '$id_noticia'";
	$this->ejecutar_simple_query('delete' , 'Noticia');

	for ($i=0; $i < 3 ; $i++) { 
		if (!empty($datosImagen['img_not']['name'][$i])) {
			$cantidad++;
			$fecha = getdate();

			$e = $fecha['mday']."-".$fecha['mon']."-".$fecha['year']."-".$fecha['hours']."_".$fecha['minutes']."_".$fecha['seconds'];
			
			$img_not = $e.$datosImagen['img_not']['name'][$i];

			$miniatura_ancho_maximo = 800;
			$miniatura_alto_maximo = 400;
			$info_imagen = getimagesize($datosImagen['img_not']['tmp_name'][$i]);
			$imagen_ancho = $info_imagen[0];
			$imagen_alto = $info_imagen[1];
			$imagen_tipo = $info_imagen['mime'];

			$lienzo = imagecreatetruecolor( $miniatura_ancho_maximo, $miniatura_alto_maximo );

			//creo una imagen dependiendo el tipo
			switch ( $imagen_tipo ){
				case "image/jpg":
				case "image/jpeg":
					$imagen = imagecreatefromjpeg($datosImagen['img_not']['tmp_name'][$i]);
					break;
				case "image/png":
					$imagen = imagecreatefrompng($datosImagen['img_not']['tmp_name'][$i]);
					break;
				case "image/gif":
					$imagen = imagecreatefromgif($datosImagen['img_not']['tmp_name'][$i]);
					break;
			}

			//Guardo la Imagen en el Lienzo
			imagecopyresampled($lienzo, $imagen, 0, 0, 0, 0, $miniatura_ancho_maximo, $miniatura_alto_maximo, $imagen_ancho, $imagen_alto);
			//guarda la imagen en la ruta temporal
			imagejpeg( $lienzo, $datosImagen['img_not']['tmp_name'][$i], 90 );

			$imagen = $e.$datosImagen['img_not']['name'][$i];
			$tamaño = getimagesize($datosImagen['img_not']['tmp_name'][$i]);

			$target = "../publico/admin/img/noticias/";
			$target = $target . basename($e.$datosImagen['img_not']['name'][$i]);
			
			$ext = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF');
			$extimg = explode('.', $datosImagen['img_not']['name'][$i]);

			if(in_array($extimg[1], $ext)) {
				if(move_uploaded_file($datosImagen['img_not']['tmp_name'][$i], $target)){
					
					

					$this->consulta = "INSERT INTO noticia_img (id_noticia, img_not) 
									VALUES ('$id_noticia', '$img_not')";

					if($this->ejecutar_simple_query('insert' , 'Noticia')==true){
							$cantidad2 = $cantidad2 + 1;
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

	if ($cantidad2==$cantidad && $noticia==true) {
		$this->mensaje = 'Se Modificó la Noticia Satisfactoriamente';
		$this->tipomsj = 'success';
		$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('012', '$_SESSION[idUsuario]', current_date, localtime)";
		$this->ejecutar_simple_query('update', 'Noticia');
	}else{
		
		$this->mensaje = 'Hubo un Problema al Modificar la Noticia, Archivos Incorrectos, Debe Crearla Nuevamente';
		$this->tipomsj = 'danger';
	}


}

public function buscarTodos(){
	$this->buscarDatosPorId('noticias', 'id_noticia');
}

public function eliminar($id){
	$this->delete('noticias', $id);
}

public function buscar($id){
	
	$this->buscarDatosPorId3('noticias','id_noticia', $id);
}

public function buscarTodosInicio(){

	$this->consulta = "SELECT * FROM noticias order by id_noticia DESC limit 3";
	$this->traer_resultados_query_general();
}





}

 ?>