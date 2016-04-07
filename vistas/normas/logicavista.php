<?php
session_start();

require('../core/logica.php');
require('../core/models.php');


$diccionario = array('titulos'=>array('registrar'=>'Agregar Norma',
									  'verdatos'=>'Tabla de Normas',
									  'modificar'=>'Modificar Norma '));

function llenar_tabla($html, $data){

	$num_filas = count($data);

	for ($i=0; $i < $num_filas ; $i++) {
		$html2 .= "<tr>
					<td style='text-align: center;'>
					    <a href='/investigacion/normas/buscar/?id=".$data[$i]['id_norma']."' class='btn btn-info btn-xs'><i class='fa fa-pencil'></i> Editar</a>
					    <a href='#' id='".$data[$i]['id_norma']."' class='btn btn-danger btn-xs'><i class='fa fa-eraser'></i> Eliminar</a>

					</td>
					<td ><textarea class='form-control' readonly cols='60'>{des_norma}</textarea></td>
					<td >{espacio}</td>";
		$html2 .= "</tr>";

		$html2 .= "
						<script type='text/javascript'>

						        $('".$data[$i]['id_norma']."').onclick = function () {
						            reset();
						            alertify.confirm('¿Desea Eliminar Esta Norma?', function (e) {
						                if (e) {
						                	location = '/investigacion/normas/eliminar/?id=".$data[$i]['id_norma']."';
						                } else {
						                	
						                }
						            });
						            return false;
						        };
						</script>";

	    foreach ($data[$i] as $clave=>$valor) {

	    		$modelos2 = new Models();
				$modelos2->buscarDatosPorId("evento_espacio", "id_espacio");
				$espacios = $modelos2->filas;

				$num_esp = count($espacios);

				for ($j=0; $j < $num_esp ; $j++) { 
					if ($espacios[$j]["id_espacio"]==$data[$i]["id_espacio"]) {
						$html2 = str_replace('{espacio}', $espacios[$j]["des_espacio"], $html2);
					}
				}
			$html2 = str_replace('{'.$clave.'}', $valor, $html2);
		}

	}



	$html = str_replace('{datosTabla}', $html2, $html);

	return $html;

}



function hacer_datos_dinamicos($html, $data) {


	foreach ($data as $clave=>$valor) {
				$modelos = new Models();
				$modelos->buscarDatosPorId("evento_espacio", "id_espacio");
				$espacios = $modelos->filas;

				
				$num_esp = count($espacios);

				for ($j=0; $j < $num_esp ; $j++) { 
					if ($espacios[$j]["id_espacio"]==$data["id_espacio"]) {
						
						$html2 =  "<option value='".$espacios[$j]['id_espacio']."'> ".$espacios[$j]['des_espacio']."</option>";
					}
				}
		$html = str_replace('{'.$clave.'}', $valor, $html);
		$html = str_replace('{espacioactual}', $html2, $html);
	}

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






function retornar_vista($vista, $data = array(), $parametros = array(), $data_select_espacios) {

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
	$html = str_replace('{contenido}',  buscar_plantilla('registrar','normas'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	$html = llenar_select_espacios($html, $data_select_espacios);

}

if ($vista=='verdatos'){
	$html = str_replace('{contenido}',  buscar_plantilla('verdatos','normas'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	$html = llenar_tabla($html, $data);
}

if ($vista=='modificar'){
	$html = str_replace('{contenido}',  buscar_plantilla('modificar','normas'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	$html = hacer_datos_dinamicos($html, $data);
	$html = llenar_select_espacios($html, $data_select_espacios);

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
