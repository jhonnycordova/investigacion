<?php
session_start();

require('../core/logica.php');
require('../core/models.php');
include('../modelos/cargos.php');


$diccionario = array('titulos'=>array('registrar'=>'Agregar Nuevo Centro',
									  'verdatos'=>'Tabla de Centros de Investigación',
									  'modificar'=>'Modificar Centro'));

function llenar_tabla($html, $data){

	$num_filas = count($data);


	for ($i=0; $i < $num_filas ; $i++) {

	
			$html2.="<tr>
					<td style='text-align: center;'> <a href='/investigacion/centros/buscar/?id=".$data[$i]['id_centro']."' class='btn btn-info btn-xs'><i class='fa fa-pencil'></i> Editar</a> <a href='#' id='".$data[$i]['id_centro']."' class='btn btn-danger btn-xs'><i class='fa fa-eraser'></i> Eliminar</a></td>
					<td style='text-align: center;'>{nom_centro}</td>
					<td style='text-align: center;'>{director_centro}</td>";
					
		
			$html2 .= "</tr>";

			$html2 .= "
						<script type='text/javascript'>

						        $('".$data[$i]['id_centro']."').onclick = function () {
						            reset();
						            alertify.confirm('¿Desea Eliminar Este Centro?: <b>".$data[$i]['nom_centro']." ".$data[$i]['ape_aut']."</b>', function (e) {
						                if (e) {
						                	location = '/investigacion/centros/eliminar/?id=".$data[$i]['id_centro']."';
						                } else {
						                	
						                }
						            });
						            return false;
						        };
						</script>";

		
			foreach ($data[$i] as $clave=>$valor) {
				
				$html2 = str_replace('{'.$clave.'}', $valor, $html2);
				
			}
	
	}


	$html = str_replace('{datosTabla}', $html2, $html);

	return $html;

}

function llenar_select_cargos($html, $datos_select_cargos){

	$num_filas = count($datos_select_cargos);

	for ($i=0; $i < $num_filas ; $i++) { 
		$html2 .= "<option value='".$datos_select_cargos[$i]['id_cargo']."'> ".$datos_select_cargos[$i]['des_cargo']."</option>";
	}

	$html = str_replace('{cargos}', $html2, $html);

	return $html;
}



function hacer_datos_dinamicos($html, $data) {

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

$html = buscar_plantilla_main_admin();

$html = str_replace('{titulo}', $diccionario['titulos'][$vista], $html);

$html = str_replace('{usuario}', $_SESSION['nombreUsuario'], $html);

$html = str_replace('{idUsuario}', $_SESSION['idUsuario'] , $html);


if ($_SESSION['modulo']=='001') {
	$html = str_replace('{sidebar}',  buscar_sidebar1(), $html);
}else if ($_SESSION['modulo']=='002') {
	$html = str_replace('{sidebar}',  buscar_sidebar2(), $html);
}else if ($_SESSION['modulo']=='003') {
	$html = str_replace('{sidebar}',  buscar_sidebar3(), $html);
}



if ($vista=='registrar'){
	$html = str_replace('{contenido}',  buscar_plantilla('registrar','centros'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	$html= llenar_select_cargos($html, $data_select_cargos);

}

if ($vista=='verdatos'){
	$html = str_replace('{contenido}',  buscar_plantilla('verdatos','centros'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	$html = llenar_tabla($html, $data);
}

if ($vista=='modificar'){
	$html = str_replace('{contenido}',  buscar_plantilla('modificar','centros'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	$html = hacer_datos_dinamicos($html, $data);
	
}




if ($_SESSION['modulo']=='001') {
	$html = str_replace('{modelo}', 'gcontenido', $html);
	$html = str_replace('{modulo}', 'Gestión de Contenido General', $html);
}else if ($_SESSION['modulo']=='002') {
	$html = str_replace('{modelo}', 'gauditorio', $html);
	$html = str_replace('{modulo}', 'Gestión de Espacios', $html);
}else if ($_SESSION['modulo']=='003') {
	$html = str_replace('{modelo}', 'grevista', $html);
	$html = str_replace('{modulo}', 'Gestión de Revista NEXOS', $html);
}



if ($_SESSION["superusuario"]=='si') {
	$html = str_replace('{super}', '', $html);
	$html = str_replace('{nosuper}', 'none', $html);
}else{
	$html = str_replace('{nosuper}', '', $html);
	$html = str_replace('{super}', 'none', $html);
}


if($mensaje != ''){
	$html = str_replace('{mensaje}', buscar_mensajes(), $html);
	$html =mensajes_dinamico($mensaje, $tipomsj, $html);
}else{
	$html = str_replace('{mensaje}', '', $html);
}


print $html;



}
?>
