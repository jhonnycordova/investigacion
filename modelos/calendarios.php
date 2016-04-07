<?php

include_once('../core/models.php');
include_once('../core/tcpdf/config/tcpdf_config.php');
include_once('../core/tcpdf/tcpdf.php');

class Calendarios extends Models{


public function buscarEventos(){
	
	$this->consulta = "SELECT a.id_evento as evento, min(fecha) as fechainicio, max(fecha) as fechafin, min(hora) as horainicio, max(hora) as horafin, b.nom_evento
							FROM evento_info a, eventos b
							WHERE b.est_evento = 'A' AND b.id_espacio = 1 AND a.id_evento = b.id_evento group by a.id_evento, b.nom_evento";
	$this->traer_resultados_query_general();

}

public function buscarEventos2($id_espacio){
	
	$this->consulta = "SELECT a.id_evento as evento, min(fecha) as fechainicio, max(fecha) as fechafin, min(hora) as horainicio, max(hora) as horafin, b.nom_evento
							FROM evento_info a, eventos b
							WHERE b.est_evento = 'A' AND b.id_espacio = '$id_espacio' AND a.id_evento = b.id_evento group by a.id_evento, b.nom_evento";
	$this->traer_resultados_query_general();

}

public function buscarEventosS(){
	
	$this->consulta = "SELECT a.id_evento as evento, min(fecha) as fechainicio, max(fecha) as fechafin, min(hora) as horainicio, max(hora) as horafin, b.nom_evento
							FROM evento_info a, eventos b
							WHERE b.est_evento = 'A' AND b.id_espacio = 2 AND a.id_evento = b.id_evento group by a.id_evento, b.nom_evento";
	$this->traer_resultados_query_general();

}





}

 ?>