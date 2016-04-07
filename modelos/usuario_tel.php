<?php

include_once('../core/models.php');
include_once('../core/tcpdf/config/tcpdf_config.php');
include_once('../core/tcpdf/tcpdf.php');

class Usuario_tel extends Models{


public function buscarTodosPorId(){
	$this->buscarDatosPorId('usuario_tel', 'id_usuario');
}


}

 ?>