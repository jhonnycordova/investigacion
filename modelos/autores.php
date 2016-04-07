<?php

//.....................---MODELO AUTORES---..........................
include_once('../core/models.php');
include_once('../core/tcpdf/config/tcpdf_config.php');
include_once('../core/tcpdf/tcpdf.php');

class Autores extends Models{
//Método para buscar a todos los autores
public function buscarTodos(){
	$this->buscarDatosPorId('autores', 'id_autor');
}
//Método para buscar a un autor pasando como referencia un ID
public function buscar($id){

	$this->buscarDatosPorId3('autores','id_autor', $id);
}
//Método para editar un autor, recibe un array de valores enviados desde el controlador
public function editar($datos = array()){

	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($des_area!='') {
		$this->consulta = "UPDATE autores set des_area = '$des_area' WHERE id_autor = '$id_autor'";
		if ($this->ejecutar_simple_query('update' , 'Autor')==true) {
			//$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('054', '$_SESSION[idUsuario]', current_date, localtime)";
			//$this->ejecutar_simple_query('update', 'Autor');
		}
		
	}


}

public function crear($datos = array()){


	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($nom_autor!='') {
		$this->consulta = "INSERT INTO autores (nom_autor, ape_autor) VALUES ('$nom_autor', '$ape_autor')";
		if ($this->ejecutar_simple_query('insert' , 'Autor')==true) {

			//$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('053', '$_SESSION[idUsuario]', current_date, localtime)";
			//$this->ejecutar_simple_query('insert', 'Autor');
		}
		for ($i=0; $i <3 ; $i++) { 
			if (!empty($tel_autor[$i])) {
				$this->consulta = "INSERT INTO autor_tel (id_autor, tel_autor) 
							VALUES ((Select max(id_autor) from autores), '$tel_autor[$i]')";
				$this->ejecutar_simple_query('insert' , 'Autor');
			}

			if (!empty($email_autor[$i])) {
				$this->consulta = "INSERT INTO autor_email (id_autor, email_autor) 
							VALUES ((Select max(id_autor) from autores), '$email_autor[$i]')";
				$this->ejecutar_simple_query('insert' , 'Autor');
			}
		
		}
	}
	


}

public function eliminar($id){
	$this->delete('autores', $id);
}





}

 ?>