<?php

include_once('../core/models.php');
include_once('../core/tcpdf/config/tcpdf_config.php');
include_once('../core/tcpdf/tcpdf.php');

class Reportes extends Models{



public function buscarUsuarios(){
	$this->buscarDatosPorId('usuarios', 'id_usuario');
}

public function buscarDatosParaPdf($datos = array()){

	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	$modulo = $_SESSION["modulo"];

	$this->consulta = "SELECT a.usuario as usuario, c.des_mov as descripcion, b.fec_mov as fecha, b.hor_mov as hora 
						FROM usuarios a, movimiento_usuario b, movimientos c WHERE a.id_usuario = '$usuario' AND 
						 b.fec_mov between to_date('$fec_des', 'dd-mm-yyyy') and  to_date('$fec_has', 'dd-mm-yyyy')
						AND b.cod_mov = c.cod_mov AND c.cod_mod = '$modulo' AND a.id_usuario = b.id_usuario order by b.id_movimiento_usu DESC"; 

	$this->traer_resultados_query_general();
}





}

 ?>