<?php
session_start();

require('../core/logica.php');
require('../core/models.php');
include('../modelos/cargos.php');


$diccionario = array('titulos'=>array('registrar'=>'Agregar Nueva Noticia',
									  'verdatos'=>'Tabla de Noticias',
									  'modificar'=>'Modificar Noticia'));

function llenar_tabla($html, $data){

	$num_filas = count($data);


	for ($i=0; $i < $num_filas ; $i++) {

			
			$html2.="<tr>
					<td style='text-align: center;'> <a href='/investigacion/noticias/buscar/?id=".$data[$i]['id_noticia']."' class='btn btn-info btn-xs'><i class='fa fa-pencil'></i> Editar</a> <br><br><a href='#' id='".$data[$i]['id_noticia']."' class='btn btn-danger btn-xs'><i class='fa fa-eraser'></i> Eliminar</a></td>
					<td style='text-align: center;'>{titulo}</td>
					
					<td style='text-align: center;'>{img_not}</td>
					
					<td style='text-align: center;'><span class='label label-danger'>{fec_not}</span></td>";
					
		
			$html2 .= "</tr>";

			$html2 .= "
						<script type='text/javascript'>

						        $('".$data[$i]['id_noticia']."').onclick = function () {
						            reset();
						            alertify.confirm('¿Desea Eliminar Esta Noticia?: <b>".$data[$i]['titulo']." ".$data[$i]['ape_aut']."</b>', function (e) {
						                if (e) {
						                	location = '/investigacion/noticias/eliminar/?id=".$data[$i]['id_noticia']."';
						                } else {
						                	
						                }
						            });
						            return false;
						        };
						</script>";

		
			foreach ($data[$i] as $clave=>$valor) {
				$modelos = new Models();
				$modelos->buscarDatosId2("noticia_img", "id_noticia", $data[$i]["id_noticia"]);
				$imagenes = $modelos->filas;


				$num_img = count($imagenes);


				for ($j=0; $j < $num_img; $j++) { 
					if ($j==$num_img-1) {
						$img_not.= "<li><a href='/investigacion/publico/admin/img/noticias/".$imagenes[$j]["img_not"]."' target='_blank'>".$imagenes[$j]["img_not"]."</a></li>";
					}else{
						$img_not.= "<li><a href='/investigacion/publico/admin/img/noticias/".$imagenes[$j]["img_not"]."' target='_blank'>".$imagenes[$j]["img_not"].",</a></li>";
					}
				}

				
				$html2 = str_replace('{'.$clave.'}', $valor, $html2);
				$html2 = str_replace('{img_not}', $img_not, $html2);
				

				
			}

			$img_not = "";
	
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
	$fecha = date('d-m-Y');
	$html = str_replace('{fecha}', $fecha, $html);
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
	$html = str_replace('{contenido}',  buscar_plantilla('registrar','noticias'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	$fecha = date('d-m-Y');
	
	$html = str_replace('{fec_not}', $fecha , $html);
	

}

if ($vista=='verdatos'){
	$html = str_replace('{contenido}',  buscar_plantilla('verdatos','noticias'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	$html = llenar_tabla($html, $data);
}

if ($vista=='modificar'){
	$html = str_replace('{contenido}',  buscar_plantilla('modificar','noticias'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	$html = hacer_datos_dinamicos($html, $data);
	$html = llenar_select_cargos($html, $data_select_cargos);
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
