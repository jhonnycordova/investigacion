<?php
session_start();

require('../core/logica.php');
require('../core/models.php');




$diccionario = array('titulos'=>array('registrar'=>'Agregar Nueva Línea',
									  'verdatos'=>'Tabla de Líneas',
									  'modificar'=>'Modificar Línea'));

function llenar_tabla($html, $data){

	$num_filas = count($data);


	for ($i=0; $i < $num_filas ; $i++) {

			$html2.="<tr>
					<td style='text-align: center;'> <a href='/investigacion/lineas/buscar/?id=".$data[$i]['id_linea']."' class='btn btn-info btn-xs'><i class='fa fa-pencil'></i> Editar</a> <a href='#' id='".$data[$i]['id_linea']."' class='btn btn-danger btn-xs'><i class='fa fa-eraser'></i> Eliminar</a></td>
					<td style='text-align: center;'>{nom_lin}</td>
					<td style='text-align: center;'><textarea  class='form-control' rows='3' cols='50' readonly >{des_lin}</textarea></td>
					<td style='text-align: center;'><span class='label label-success'>{des_prog}</span></td>";
					
		
			$html2 .= "</tr>";

			$html2 .= "
						<script type='text/javascript'>

						        $('".$data[$i]['id_linea']."').onclick = function () {
						            reset();
						            alertify.confirm('¿Desea Eliminar Esta Linea?: <b>".$data[$i]['nom_lin']." ".$data[$i]['ape_aut']."</b>', function (e) {
						                if (e) {
						                	location = '/investigacion/lineas/eliminar/?id=".$data[$i]['id_linea']."';
						                } else {
						                	
						                }
						            });
						            return false;
						        };
						</script>";

		
			foreach ($data[$i] as $clave=>$valor) {
					

				$modelos = new Models();
				$modelos->buscarDatosPorId("info_decanato_prog", "id_prog");
				$programas = $modelos->filas;

				$num_prog = count($programas);

				for ($j=0; $j < $num_prog ; $j++) { 
					if ($programas[$j]["id_prog"]==$data[$i]["id_prog"]) {
						$html2 = str_replace('{des_prog}', $programas[$j]["des_prog"], $html2);
					}
				}
		

				
				$html2 = str_replace('{'.$clave.'}', $valor, $html2);
				

				
			}

	
	}


	$html = str_replace('{datosTabla}', $html2, $html);

	return $html;

}

function llenar_select_prog($html, $datos_select_prog){

	$num_filas = count($datos_select_prog);

	for ($i=0; $i < $num_filas ; $i++) { 
		$html2 .= "<option value='".$datos_select_prog[$i]['id_prog']."'> ".$datos_select_prog[$i]['des_prog']."</option>";
	}

	$html = str_replace('{programas}', $html2, $html);

	return $html;
}

function llenar_select_centro($html, $datos_select_centro){

	$num_filas = count($datos_select_centro);

	for ($i=0; $i < $num_filas ; $i++) { 
		$html2 .= "<option value='".$datos_select_centro[$i]['id_centro']."'> ".$datos_select_centro[$i]['nom_centro']."</option>";
	}

	$html = str_replace('{centros}', $html2, $html);

	return $html;
}



function hacer_datos_dinamicos($html, $data) {

	foreach ($data as $clave=>$valor) {
		
				$modelos = new Models();
				$modelos->buscarDatosPorId("info_decanato_prog", "id_prog");
				$programas = $modelos->filas;

				
				$num_prog = count($programas);

				for ($j=0; $j < $num_prog ; $j++) { 
					if ($programas[$j]["id_prog"]==$data["id_prog"]) {
						
						$html2 =  "<option value='".$programas[$j]['id_prog']."'> ".$programas[$j]['des_prog']."</option>";
					}
				}

				if ($data["id_prog"]==2) {
					$html3 = 'none';
				}else{
					$html3 = '';
				}

				$modelos = new Models();
				$modelos->buscarDatosPorId("centros", "id_centro");
				$centros = $modelos->filas;

				
				$num_cen = count($centros);

				for ($j=0; $j < $num_cen ; $j++) { 
					if ($centros[$j]["id_centro"]==$data["id_centro"]) {
						
						$html4 =  "<option value='".$centros[$j]['id_centro']."'> ".$centros[$j]['nom_centro']."</option>";
					}
				}

				



		$html = str_replace('{'.$clave.'}', $valor, $html);
		$html = str_replace('{programaactual}', $html2, $html);
		$html = str_replace('{hidden}', $html3, $html);
		$html = str_replace('{centroactual}', $html4, $html);
		
	}
	return $html;
}






function retornar_vista($vista, $data = array(), $parametros = array(), $data_select_prog, $datos_select_centro) {


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
	$html = str_replace('{contenido}',  buscar_plantilla('registrar','lineas'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	$html= llenar_select_prog($html, $data_select_prog);

}

if ($vista=='verdatos'){
	$html = str_replace('{contenido}',  buscar_plantilla('verdatos','lineas'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	$html = llenar_tabla($html, $data);
}

if ($vista=='modificar'){
	$html = str_replace('{contenido}',  buscar_plantilla('modificar','lineas'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	$html = hacer_datos_dinamicos($html, $data);
	$html = llenar_select_prog($html, $data_select_prog);
	$html = llenar_select_centro($html, $datos_select_centro);
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
