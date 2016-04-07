<?php
session_start();

require('../core/logica.php');
require('../core/models.php');


$diccionario = array('titulos'=>array('auditorio'=>'Eventos Auditorio "Hugo Rafael Chávez Frías"',
									  'salon'=>'Eventos Salón de Usos Múltiples',
									  'modificar'=>'Modificar Área '));

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



	$html2 = str_replace('{datosTabla}', $html2, $html);

	return $html;

}

function llenar_normas($html, $data){

		
        $num_filas = count($data);

		for ($i=0; $i < $num_filas ; $i++) {
			$numero = $i + 1;
			$html2 .='<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="offer offer-radius offer-primary">
                                    <div class="shape">
                                        <div class="shape-text">
                                            '.$numero.'                             
                                        </div>
                                    </div>
                                    <div class="offer-content">
                                                             
                                        <p>
                                            '.$data[$i]["des_norma"].'
                                        </p>
                                    </div>
                                </div>
                            </div>';
			
         }

	$html = str_replace('{normas}', $html2, $html);
	return $html;

}

function hacer_datos_dinamicos($html, $data) {


	foreach ($data as $clave=>$valor) {
		$html = str_replace('{'.$clave.'}', $valor, $html);
	}

	return $html;
}






function retornar_vista($vista, $data = array(), $parametros = array(), $id_espacio) {

foreach ($parametros as $campo => $value) {
	$$campo = $value;
}

global $diccionario;

$html = buscar_plantilla_main();

if ($id_espacio==1) {
	$html = str_replace('{titulo}', 'Normas Auditorio', $html);
}else{
	$html = str_replace('{titulo}', 'Normas Salón Usos Múltiples', $html);
}

$html = str_replace('{usuario}', $_SESSION['nombreUsuario'], $html);

$html = str_replace('{idUsuario}', $_SESSION['idUsuario'] , $html);


if ($_SESSION['modulo']=='001') {
	$html = str_replace('{sidebar}',  buscar_sidebar1(), $html);
}else if ($_SESSION['modulo']=='002') {
	$html = str_replace('{sidebar}',  buscar_sidebar2(), $html);
}else if ($_SESSION['modulo']=='003') {
	$html = str_replace('{sidebar}',  buscar_sidebar3(), $html);
}






if ($vista=='ver'){
	$html = str_replace('{contenido}',  buscar_plantilla('ver','normas_pub'), $html);
	if ($id_espacio==1) {
		$html = str_replace('{subtitulo}', 'Normas Auditorio', $html);
	}else{
		$html = str_replace('{subtitulo}', 'Normas Salón Usos Múltiples', $html);
	}
	$html = llenar_normas($html, $data);
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
