<?php

include_once('../core/models.php');
include_once('../core/tcpdf/config/tcpdf_config.php');
include_once('../core/tcpdf/tcpdf.php');

class Carousel extends Models{



public function buscarTodos(){
	$this->buscarDatosPorId('info_decanato_imagen', 'id_imagen');
}


public function buscar($id){

	$this->buscarDatosPorId3('info_decanato_imagen','id_imagen', $id);
}



public function crear($datos = array(), $datosImagen = array()){

	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	$fecha = getdate();

	$e = $fecha['mday']."-".$fecha['mon']."-".$fecha['year']."-".$fecha['hours']."_".$fecha['minutes']."_".$fecha['seconds'];

	$imagen = $e.$datosImagen['imagen']['name'];

	$miniatura_ancho_maximo = 1200;
	$miniatura_alto_maximo = 400;
	$info_imagen = getimagesize($datosImagen['imagen']['tmp_name']);
	$imagen_ancho = $info_imagen[0];
	$imagen_alto = $info_imagen[1];
	$imagen_tipo = $info_imagen['mime'];

	$lienzo = imagecreatetruecolor( $miniatura_ancho_maximo, $miniatura_alto_maximo );

	//creo una imagen dependiendo el tipo
	switch ( $imagen_tipo ){
		case "image/jpg":
		case "image/jpeg":
			$imagen = imagecreatefromjpeg($datosImagen['imagen']['tmp_name']);
			break;
		case "image/png":
			$imagen = imagecreatefrompng($datosImagen['imagen']['tmp_name']);
			break;
		case "image/gif":
			$imagen = imagecreatefromgif($datosImagen['imagen']['tmp_name']);
			break;
	}

	//Guardo la Imagen en el Lienzo
	imagecopyresampled($lienzo, $imagen, 0, 0, 0, 0, $miniatura_ancho_maximo, $miniatura_alto_maximo, $imagen_ancho, $imagen_alto);
	//guarda la imagen en la ruta temporal
	imagejpeg( $lienzo, $datosImagen['imagen']['tmp_name'], 90 );

	$imagen = $e.$datosImagen['imagen']['name'];
	$tamaño = getimagesize($datosImagen['imagen']['tmp_name']);

	$target = "../publico/admin/img/carousel/";
	$target = $target . basename($e.$datosImagen['imagen']['name']);
	$ext = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF');
	$extimg = explode('.', $datosImagen['imagen']['name']);
	if(in_array($extimg[1], $ext)) {
		if(move_uploaded_file($datosImagen['imagen']['tmp_name'], $target)){
		
			$this->consulta = "INSERT INTO info_decanato_imagen (imagen, des_img, id_decanato) VALUES ('$imagen', '$des_img
				', 1 )";
			if ($this->ejecutar_simple_query('insert' , 'Imagen')==true) {
				$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('009', '$_SESSION[idUsuario]', current_date, localtime)";
				$this->ejecutar_simple_query('insert', 'Imagen');
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

public function eliminar($id){
	$this->delete('info_decanato_imagen', $id);
}





}

 ?>