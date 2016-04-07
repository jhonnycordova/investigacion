<?php

include_once('../core/models.php');
include_once('../core/tcpdf/config/tcpdf_config.php');
include_once('../core/tcpdf/tcpdf.php');

class Gauditorio extends Models{

public function buscarSolPen(){
	$this->consulta = "SELECT count(*) FROM solic_esp WHERE est_sol = 'E' and interes = false";
	$this->traer_resultados_query();
}

}

 ?>