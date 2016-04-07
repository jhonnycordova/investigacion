<?php
session_start();

require('../core/logica.php');
require('../core/models.php');



$diccionario = array('titulos'=>array('pinvestigacion'=>'Programa de Investigación',
									  'pextension'=>'Programa de Extensión'));

function cargarPrograma($html, $data){
		
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


	if ($vista=='pinvestigacion'){
		
		$html = str_replace('{contenido}',  buscar_plantilla('pinvestigacion','programas_pub'), $html);
		$html = str_replace('{titulo}', $diccionario['titulos'][$vista], $html);
		$html = cargarPrograma($html, $data);

	}

	if ($vista=='pextension'){
		
		$html = str_replace('{contenido}',  buscar_plantilla('pinvestigacion','programas_pub'), $html);
		$html = str_replace('{titulo}', $diccionario['titulos'][$vista], $html);
		//$html = cargarJornadas($html, $data);
		$html = cargarPrograma($html, $data);

	}




	print $html;

}


 ?>