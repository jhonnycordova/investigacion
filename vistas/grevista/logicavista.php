<?php
session_start();

require('../core/logica.php');

$diccionario = array('titulos'=>array('index'=>'Gestión de Revista Nexos'));


function retornar_vista($vista, $data = array(), $parametros = array()) {

	foreach ($parametros as $campo => $value) {
		$$campo = $value;
	}

	global $diccionario;

	$html = buscar_plantilla_main_admin();

	$html = str_replace('{titulo}', $diccionario['titulos'][$vista], $html);

	$html = str_replace('{modulo}', 'Gestion de Revista NEXOS', $html);

	$html = str_replace('{sidebar}', buscar_sidebar3(), $html);

	$html = str_replace('{usuario}', $_SESSION['nombreUsuario'], $html);

	$html = str_replace('{modelo}', 'grevista', $html);

	$html = str_replace('{sidebar}', buscar_sidebar3(), $html);

	$html = str_replace('{idUsuario}', $_SESSION['idUsuario'] , $html);

	if ($_SESSION["superusuario"]=='si') {
		$html = str_replace('{super}', '', $html);
		$html = str_replace('{nosuper}', 'none', $html);
	}else{
		$html = str_replace('{nosuper}', '', $html);
		$html = str_replace('{super}', 'none', $html);
	}

	print $html;

}


 ?>