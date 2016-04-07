<?php
session_start();

require('../core/logica.php');
require('../core/models.php');
//include('../modelos/cargos.php');
//include('../modelos/espinv.php');




$diccionario = array('titulos'=>array('registrar'=>'Agregar Nuevo Proyecto',
									  'verdatos'=>'Tabla de Proyectos',
									  'modificar'=>'Modificar Proyecto'));

function llenar_tabla($html, $data){

	$num_filas = count($data);


	for ($i=0; $i < $num_filas ; $i++) {

	
			$html2.="<tr>
					<td style='text-align: center;'> <a href='/investigacion/proyectos/buscar/?id=".$data[$i]['id_proyecto']."' class='btn btn-info btn-xs'><i class='fa fa-pencil'></i> Editar</a> <br><br><a href='#' id='".$data[$i]['id_proyecto']."' class='btn btn-danger btn-xs'><i class='fa fa-eraser'></i> Eliminar</a></td>
					<td style='text-align: center;'>{tit_pro}</td>
					<td style='text-align: center;'>{investigadores}</td>
					<td style='text-align: center;'>{des_tipo_pro}</td>
					<td style='text-align: center;'><span class='label label-danger'>{des_prog}</span></td>";
					
		
			$html2 .= "</tr>";

			$html2 .= "
						<script type='text/javascript'>

						        $('".$data[$i]['id_proyecto']."').onclick = function () {
						            reset();
						            alertify.confirm('¿Desea Eliminar Esta Proyecto?: <b>".$data[$i]['tit_pro']."</b>', function (e) {
						                if (e) {
						                	location = '/investigacion/proyectos/eliminar/?id=".$data[$i]['id_proyecto']."';
						                } else {
						                	
						                }
						            });
						            return false;
						        };
						</script>";

		
			foreach ($data[$i] as $clave=>$valor) {

				$modelo = new Models();
				$modelo->buscarInv($data[$i]['id_proyecto']);
				$investigadores = $modelo->filas;




				$num_esp = count($investigadores);
				for ($j=0; $j < $num_esp; $j++) { 
					
						$inv.= "<li>".$investigadores[$j]["nom_inv"]." ".$investigadores[$j]["ape_inv"]."</li>";
					
				}

				if ($data[$i]["id_prog"]==1) {
					$html2 = str_replace('{des_prog}', 'Programa de Investigación', $html2);
				}else{
					$html2 = str_replace('{des_prog}', 'Programa de Extensión', $html2);
				}

				$modelos3 = new Models();
				$modelos3->buscarDatosPorId("proyecto_tipo", "id_tipo_pro");
				$tipos = $modelos3->filas;

			

				$num_tipo = count($tipos);

				for ($j=0; $j < $num_tipo ; $j++) { 
					if ($tipos[$j]["id_tipo_pro"]==$data[$i]["id_tipo_pro"]) {
						$html2 = str_replace('{des_tipo_pro}', $tipos[$j]["des_tipo_pro"], $html2);
					}
				}


				
				$html2 = str_replace('{'.$clave.'}', $valor, $html2);
				$html2 = str_replace('{investigadores}', $inv, $html2);
				

				
			}

			$inv = "";
			
		
		


	
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

function llenar_select_esp($html, $datos_select_esp){

	$num_filas = count($datos_select_esp);

	for ($i=0; $i < $num_filas ; $i++) { 
		$html2 .= "<option value='".$datos_select_esp[$i]['id_esp']."'> ".$datos_select_esp[$i]['des_esp']."</option>";
	}

	$html = str_replace('{especialidades}', $html2, $html);

	return $html;
}

function llenar_select_tipo($html, $datos_select_tipo){
	

	$num_filas = count($datos_select_tipo);

	for ($i=0; $i < $num_filas ; $i++) { 
		$html2 .= "<option value='".$datos_select_tipo[$i]['id_tipo_pro']."'> ".$datos_select_tipo[$i]['des_tipo_pro']."</option>";
	}

	$html = str_replace('{tipos}', $html2, $html);

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
				$modelos->buscarDatosPorId("lineas", "id_linea");
				$lineas = $modelos->filas;

				
				$num_lin = count($lineas);

				for ($j=0; $j < $num_lin ; $j++) { 
					if ($lineas[$j]["id_linea"]==$data["id_linea"]) {
						
						$html2 =  "<option value='".$lineas[$j]['id_linea']."'> ".$lineas[$j]['nom_lin']."</option>";
					}
				}

				$modelos2 = new Models();
				$modelos2->buscarDatosPorId("proyecto_tipo", "id_tipo_pro");
				$tipos = $modelos2->filas;

				
				$num_tipo = count($tipos);

				for ($j=0; $j < $num_tipo ; $j++) { 
					if ($tipos[$j]["id_tipo_pro"]==$data["id_tipo_pro"]) {
						
						$html3 =  "<option value='".$tipos[$j]['id_tipo_pro']."'> ".$tipos[$j]['des_tipo_pro']."</option>";
					}
				}
			
				$modelos3 = new Models();
				$modelos3->buscarDatosPorId("info_decanato_prog", "id_prog");
				$programas = $modelos3->filas;

				
				$num_prog = count($programas);

				for ($j=0; $j < $num_prog ; $j++) { 
					if ($programas[$j]["id_prog"]==$data["id_prog"]) {
						
						$html4 =  "<option value='".$programas[$j]['id_prog']."'> ".$programas[$j]['des_prog']."</option>";
					}
				}

				if ($data["id_prog"]==2) {
					$html5 = 'none';
				}else{
					$html5 = '';
				}

				$modelos4 = new Models();
				$modelos4->buscarDatosPorId("centros", "id_centro");
				$centros = $modelos4->filas;

				
				$num_cen = count($centros);

				for ($j=0; $j < $num_cen ; $j++) { 
					if ($centros[$j]["id_centro"]==$data["id_centro"]) {
						
						$html6 =  "<option value='".$centros[$j]['id_centro']."'> ".$centros[$j]['nom_centro']."</option>";
					}
				}

				$modelos5 = new Models();
				$modelos5->buscarInv($data["id_proyecto"]);
				$pro = $modelos5->filas;
				$num_pro = count($pro);


				$modelos6 = new Models();
				$modelos6->buscarDatosPorId("investigadores", "id_investigador");
				$todas = $modelos6->filas;
				$num_todas = count($todas);
			
				$entro = 0;
				for ($j=0; $j < $num_todas ; $j++) { 

						for ($h=0; $h < $num_pro ; $h++) { 
							if (in_array($pro[$h]['id_investigador'], $todas[$j])) {
								$html7 .=  "<option value='".$pro[$h]['id_investigador']."' selected> ".$pro[$h]['nom_inv']." ".$pro[$h]['ape_inv']."</option>";
							   
							}
							
						}
				}

		if ($clave == 'fec_ini_pro') {
			$fecha_ini = explode('-', $valor);
			$fec_ini_pro = $fecha_ini[2]."-".$fecha_ini[1]."-".$fecha_ini[0];
			$html = str_replace('{fecha_ini}', $fec_ini_pro, $html);
		}

		if ($clave == 'fec_cul_pro') {
			$fecha_cul = explode('-', $valor);
			$fec_cul_pro = $fecha_cul[2]."-".$fecha_cul[1]."-".$fecha_cul[0];
			$html = str_replace('{fecha_cul}', $fec_cul_pro, $html);
		}


		$html = str_replace('{'.$clave.'}', $valor, $html);
		$html = str_replace('{lineaactual}', $html2, $html);
		$html = str_replace('{tipoactual}', $html3, $html);
		$html = str_replace('{programaactual}', $html4, $html);
		$html = str_replace('{programaactual}', $html4, $html);
		$html = str_replace('{hidden}', $html5, $html);
		$html = str_replace('{centroactual}', $html6, $html);
		$html = str_replace('{invactual}', $html7, $html);
		

		
		
	}
	return $html;
}


function retornar_vista($vista, $data = array(), $parametros = array(), $data_select_prog,  $data_select_tipo, $data_select_centro) {


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
	$html = str_replace('{contenido}',  buscar_plantilla('registrar','proyectos'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	$html= llenar_select_prog($html, $data_select_prog);
	$html= llenar_select_tipo($html, $data_select_tipo);

}

if ($vista=='verdatos'){
	$html = str_replace('{contenido}',  buscar_plantilla('verdatos','proyectos'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	$html = llenar_tabla($html, $data);
}

if ($vista=='modificar'){
	$html = str_replace('{contenido}',  buscar_plantilla('modificar','proyectos'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	//$html= llenar_select_esp($html, $data_select_esp);
	$html = hacer_datos_dinamicos($html, $data);
	$html= llenar_select_tipo($html, $data_select_tipo);
	
	$html= llenar_select_prog($html, $data_select_prog);
	$html = llenar_select_centro($html, $data_select_centro);
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
