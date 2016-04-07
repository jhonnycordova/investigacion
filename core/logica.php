<?php


function buscar_plantilla_main() {
	$archivo = '../vistas/main.html';

	$plantilla = file_get_contents($archivo);
	return $plantilla;
}

function buscar_plantilla_main_admin() {
	$archivo = '../vistas/main-admin.html';

	$plantilla = file_get_contents($archivo);
	return $plantilla;
}

function buscar_plantilla($formulario, $modelo) {
	$archivo = '../vistas/'.$modelo.'/'.$formulario.'.html';

	$plantilla = file_get_contents($archivo);
	return $plantilla;
}

function buscar_sidebar1(){
		$archivo = '../vistas/sidebar1.html';

		$plantilla = file_get_contents($archivo);
		
	return $plantilla;
}

function buscar_sidebar2(){
		$archivo = '../vistas/sidebar2.html';

		$plantilla = file_get_contents($archivo);
	return $plantilla;
}

function buscar_sidebar3(){
		$archivo = '../vistas/sidebar3.html';

		$plantilla = file_get_contents($archivo);
	return $plantilla;
}

function buscar_mensajes(){
	$archivo = '../vistas/mensajes.html';

	$plantilla = file_get_contents($archivo);
	return $plantilla;
}

function buscar_dataTable(){
	$archivo = '../vistas/datatable.html';

	$plantilla = file_get_contents($archivo);
	return $plantilla;
}

function buscar_alertas(){
	$archivo = '../vistas/alertas.html';
	$plantilla = file_get_contents($archivo);
	return $plantilla;
}

function buscar_alertas2(){
	$archivo = '../vistas/alertas2.html';
	$plantilla = file_get_contents($archivo);
	return $plantilla;
}

function mensajes_dinamico($msj, $tipo, $html){
	$html = str_replace('{tipo}', $tipo, $html);
	$html = str_replace('{msj}', $msj, $html);
	return $html;
}


 ?>