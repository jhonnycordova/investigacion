<?php
session_start();

require('../core/logica.php');
require('../core/models.php');


$diccionario = array('titulos'=>array('mision'=>'Misión Decanato',
									  'vision'=>'Visión Decanato'));

function cargarMision($html, $data){

	foreach ($data as $clave=>$valor) {


		$html = str_replace('{'.$clave.'}', $valor, $html);
	}
	return $html;
}

function cargarVision($html, $data){

	foreach ($data as $clave=>$valor) {


		$html = str_replace('{'.$clave.'}', $valor, $html);
	}
	return $html;
}



function retornar_vista($vista, $data = array(), $parametros = array()) {


	foreach ($parametros as $campo => $value) {
		$$campo = $value;
	}

	global $diccionario;

	$html = buscar_plantilla_main();


	if ($vista=='mision'){
		
		$html = str_replace('{contenido}',  buscar_plantilla('mision','decanato_pub'), $html);
		$html = str_replace('{titulo}', $diccionario['titulos'][$vista], $html);
		$html = cargarMision($html, $data);

	}

	if ($vista=='vision'){
		
		$html = str_replace('{contenido}',  buscar_plantilla('vision','decanato_pub'), $html);
		$html = str_replace('{titulo}', $diccionario['titulos'][$vista], $html);
		$html = cargarVision($html, $data);

	}


	print $html;

}


 ?>