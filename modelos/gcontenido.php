<?php

include_once('../core/models.php');
include_once('../core/tcpdf/config/tcpdf_config.php');
include_once('../core/tcpdf/tcpdf.php');

class Gcontenido extends Models{

public function buscarCanCentros(){
	$this->consulta = "SELECT count(*) FROM centros ";
	$this->traer_resultados_query();
}

public function buscarCanLineas(){
	$this->consulta = "SELECT count(*) FROM lineas ";
	$this->traer_resultados_query();
}

public function buscarCanProyectos(){
	$this->consulta = "SELECT count(*) FROM proyectos ";
	$this->traer_resultados_query();
}

public function buscarCanInv(){
	$this->consulta = "SELECT count(*) FROM investigadores ";
	$this->traer_resultados_query();
}

}

 ?>