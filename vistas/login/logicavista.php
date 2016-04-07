<?php
session_start();
require('../core/logica.php');

$diccionario = array('titulos'=>array('iniciosesion'=>'Inicio de Sesión'));


function retornar_vista($vista, $data=array(), $mensaje, $tipomsj) {

	foreach ($parametros as $campo => $value) {
			$$campo = $value;
	}

	global $diccionario;

	$html = buscar_plantilla_main();

	$html = str_replace('{titulo}', $diccionario['titulos'][$vista], $html);

	$html = str_replace('{contenido}', buscar_plantilla('login', 'login'), $html);

	$html = str_replace('{noticias}', '', $html);
	$html = str_replace('{cuadro}', '', $html);
	$html = str_replace('{carousel}', '', $html);

	$html = str_replace('{login}', 'none', $html);

	$html = mensajes_dinamico($mensaje, $tipomsj, $html);

	print $html;

}


 ?>