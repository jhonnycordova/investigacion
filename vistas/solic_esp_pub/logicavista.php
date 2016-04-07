<?php
session_start();

require('../core/logica.php');
require('../core/models.php');


$diccionario = array('titulos'=>array('solicitud'=>'Solicitud en Línea',
									'estadoSol'=>'Estado de Solicitud'));

function llenar_tabla($html, $data){

	$num_filas = count($data);

	for ($i=0; $i < $num_filas ; $i++) {
		$html2 .= "<tr>
					<td style='text-align: center;'>
					    <a href='/investigacion/areas/buscar/?id=".$data[$i]['id_area']."' class='btn btn-info btn-xs'><i class='fa fa-pencil'></i> Editar</a>
					    <a href='#' id='".$data[$i]['id_area']."' class='btn btn-danger btn-xs'><i class='fa fa-eraser'></i> Eliminar</a>

					</td>
					<td >{des_area}</td>";
		$html2 .= "</tr>";

		$html2 .= "
						<script type='text/javascript'>

						        $('".$data[$i]['id_area']."').onclick = function () {
						            reset();
						            alertify.confirm('¿Desea Eliminar Esta Área?: <b>".$data[$i]['des_area']."</b>', function (e) {
						                if (e) {
						                	location = '/investigacion/areas/eliminar/?id=".$data[$i]['id_area']."';
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



function hacer_datos_dinamicos($html, $data) {


	foreach ($data as $clave=>$valor) {
		$html = str_replace('{'.$clave.'}', $valor, $html);
	}

	return $html;
}

function llenar_select_tipoeve($html, $datos_select_tipoeve){


	$num_filas = count($datos_select_tipoeve);

	for ($i=0; $i < $num_filas ; $i++) { 
		$html2 .= "<option value='".$datos_select_tipoeve[$i]['id_tipo']."'> ".$datos_select_tipoeve[$i]['des_tipo']."</option>";
	}

	$html = str_replace('{tipoeventos}', $html2, $html);

	return $html;
}

function llenar_select_tipopub($html, $datos_select_tipopub){


	$num_filas = count($datos_select_tipopub);

	for ($i=0; $i < $num_filas ; $i++) { 
		$html2 .= "<option value='".$datos_select_tipopub[$i]['id_publico']."'> ".$datos_select_tipopub[$i]['des_publico']."</option>";
	}

	$html = str_replace('{tipopublicos}', $html2, $html);

	return $html;
}

function llenar_select_areas($html, $datos_select_areas){


	$num_filas = count($datos_select_areas);

	for ($i=0; $i < $num_filas ; $i++) { 
		$html2 .= "<option value='".$datos_select_areas[$i]['id_area']."'> ".$datos_select_areas[$i]['des_area']."</option>";
	}

	$html = str_replace('{areas}', $html2, $html);

	return $html;
}

function llenar_select_espacios($html, $datos_select_espacios){


	$num_filas = count($datos_select_espacios);

	for ($i=0; $i < $num_filas ; $i++) { 
		$html2 .= "<option value='".$datos_select_espacios[$i]['id_espacio']."'> ".$datos_select_espacios[$i]['des_espacio']."</option>";
	}

	$html = str_replace('{espacios}', $html2, $html);

	return $html;
}







function retornar_vista($vista, $data = array(), $parametros = array(), $datos_select_tipoeve, $datos_select_tipopub, $datos_select_areas, $datos_select_espacios) {

foreach ($parametros as $campo => $value) {
	$$campo = $value;
}

global $diccionario;

$html = buscar_plantilla_main();

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


if ($vista=='solicitud'){
	$html = str_replace('{contenido}',  buscar_plantilla('solicitud','solic_esp_pub'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	$html = llenar_select_tipoeve($html, $datos_select_tipoeve);
	$html = llenar_select_tipopub($html, $datos_select_tipopub);
	$html = llenar_select_areas($html, $datos_select_areas);
	$html = llenar_select_espacios($html, $datos_select_espacios);
	$fechaactual = date('Y-m-d');
	$nuevafecha = strtotime ( '+15 day' , strtotime ( $fechaactual ) ) ;
	$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
	$html = str_replace('{fechaanticipada}', $nuevafecha, $html);
}
if ($vista=='estadoSol'){
	$html = str_replace('{contenido}',  buscar_plantilla('estadoSol','solic_esp_pub'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	//$html = llenar_tabla($html, $data);
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
