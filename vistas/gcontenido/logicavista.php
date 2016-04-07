<?php
session_start();

require('../core/logica.php');

$diccionario = array('titulos'=>array('index'=>'Gestión de Contenido General'));


function retornar_vista($vista, $data, $parametros = array()) {

	

	foreach ($parametros as $campo => $value) {
		$$campo = $value;
	}

	global $diccionario;

	$html = buscar_plantilla_main_admin();

	$html = str_replace('{titulo}', $diccionario['titulos'][$vista], $html);

	$html = str_replace('{modulo}', 'Gestión de <span>Contenido General</span>', $html);

	$html = str_replace('{contenido}',  buscar_plantilla('inicio','gcontenido'), $html);

	$html = str_replace('{sidebar}', buscar_sidebar1(), $html);

	$html = str_replace('{modelo}', 'gcontenido', $html);

	$html = str_replace('{usuario}', $_SESSION['nombreUsuario'], $html);

	$html = str_replace('{idUsuario}', $_SESSION['idUsuario'] , $html);
	$html = str_replace('{cantidadcentros}', $data[0]["count"] , $html);
	$html = str_replace('{cantidadlineas}', $data[1]["count"] , $html);
	$html = str_replace('{cantidadproyectos}', $data[2]["count"] , $html);
	$html = str_replace('{cantidadinv}', $data[3]["count"] , $html);

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