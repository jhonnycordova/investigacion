<?php
session_start();

require('../core/logica.php');
require('../core/models.php');
//include('../modelos/cargos.php');
//include('../modelos/espinv.php');




$diccionario = array('titulos'=>array('registrar'=>'Agregar Nuevo Investigador/Extensionista',
									  'verdatos'=>'Tabla de Investigadores/Extensionistas',
									  'modificar'=>'Modificar Investigador/Extensionista'));

function llenar_tabla($html, $data){

	$num_filas = count($data);



	for ($i=0; $i < $num_filas ; $i++) {

	
			$html2.="<tr>
					<td style='text-align: center;'> <a href='/investigacion/investigadores/buscar/?id=".$data[$i]['id_investigador']."' class='btn btn-info btn-xs'><i class='fa fa-pencil'></i> Editar</a> <br><br><a href='#' id='".$data[$i]['id_investigador']."' class='btn btn-danger btn-xs'><i class='fa fa-eraser'></i> Eliminar</a></td>
					<td style='text-align: center;'>{nom_inv} {ape_inv}</td>
					<td style='text-align: center;'>{especialidades}</td>
					<td style='text-align: center;'>
                                                      <img width='150px' height='150px' src='/investigacion/publico/admin/img/investigadores/{foto_inv}' alt='' />
                                                  </td>
					<td style='text-align: center;'><span class='label label-danger'>{des_prog}</span></td>";
					
		
			$html2 .= "</tr>";

			$html2 .= "
						<script type='text/javascript'>

						        $('".$data[$i]['id_investigador']."').onclick = function () {
						            reset();
						            alertify.confirm('¿Desea Eliminar Este Investigador?: <b>".$data[$i]['nom_inv']." ".$data[$i]['ape_inv']."</b>', function (e) {
						                if (e) {
						                	location = '/investigacion/investigadores/eliminar/?id=".$data[$i]['id_investigador']."';
						                } else {
						                	
						                }
						            });
						            return false;
						        };
						</script>";

		
			foreach ($data[$i] as $clave=>$valor) {
				
				$modelo = new Models();
				$modelo->buscarEsp($data[$i]['id_investigador']);
				$especialidades = $modelo->filas;


				$num_esp = count($especialidades);
				for ($j=0; $j < $num_esp; $j++) { 
					
						$esp.= "<li>".$especialidades[$j]["des_esp"]."</li>";
					
				}




				if ($data[$i]["id_prog"]==1) {
					$html2 = str_replace('{des_prog}', 'Programa de Investigación', $html2);
				}else{
					$html2 = str_replace('{des_prog}', 'Programa de Extensión', $html2);
				}

			
				
				$html2 = str_replace('{'.$clave.'}', $valor, $html2);
				$html2 = str_replace('{especialidades}', $esp, $html2);
				

				
			}

			$esp = "";
			
		
		


	
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

function llenar_select_esp2($html, $datos_select_esp2){
	

	$num_filas = count($datos_select_esp2);

	for ($i=0; $i < $num_filas ; $i++) { 
		$html2 .= "<option value='".$datos_select_esp2[$i]['id_esp']."'> ".$datos_select_esp2[$i]['des_esp']."</option>";
	}

	$html = str_replace('{especialidades}', $html2, $html);

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
			$modelos->buscarDatosId2("investigador_email", "id_investigador", $data["id_investigador"]);
			$correos = $modelos->filas;
		

			$modelos2 = new Models();
			$modelos2->buscarDatosId2("investigador_tel", "id_investigador", $data["id_investigador"]);
			$telefonos = $modelos2->filas;


			$num_email = count($correos);
			if (count($correos)==0) {
						$html2 .= " <div class='form-group input-group col-lg-8'>

		                                            <input type='text' name='email_inv[]' id='email_inv[]' class='form-control' >
		                                              <span class='input-group-btn'><button type='button' class='btn btn-default btn-add'>+
		                                              </button></span>
		                           </div>";
			}else{
					for ($j=0; $j < $num_email; $j++) { 
						$html2 .= " <div class='form-group input-group col-lg-8'>

		                                            <input type='text' name='email_inv[]' id='email_inv[]' class='form-control' value=".$correos[$j]["email_inv"].">
		                                              <span class='input-group-btn'><button type='button' class='btn btn-default btn-add'>+
		                                              </button></span>
		                           </div>";
					}
			}
		

			$num_tel = count($telefonos);
			if (count($telefonos)==0) {
						$html3 .= "<div class='form-group input-group col-lg-8'>
                                              <input class='form-control' id='tel_inv[]' name='tel_inv[]' type='text'>   
                                              <span class='input-group-btn'><button type='button' class='btn btn-default btn-add'>+
                                              </button></span>
                           </div>";
			}else{
				for ($j=0; $j < $num_tel; $j++) { 

						$html3 .= "<div class='form-group input-group col-lg-8'>
		                                              <input class='form-control' id='tel_inv[]' name='tel_inv[]' type='text' value=".$telefonos[$j]["tel_inv"].">   
		                                              <span class='input-group-btn'><button type='button' class='btn btn-default btn-add'>+
		                                              </button></span>
		                           </div>";
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
				$modelos5->buscarEsp($data["id_investigador"]);
				$esp = $modelos5->filas;
				$num_cen = count($esp);

				$modelos6 = new Models();
				$modelos6->buscarDatosPorId("esp_inv", "id_esp");
				$todas = $modelos6->filas;
				$num_todas = count($todas);
			

				
				

				
				$entro = 0;
				for ($j=0; $j < $num_todas ; $j++) { 

						for ($h=0; $h < $num_cen ; $h++) { 
							if (in_array($esp[$h]['id_esp'], $todas[$j])) {
								$html7 .=  "<option value='".$esp[$h]['id_esp']."' selected> ".$esp[$h]['des_esp']."</option>";
							   
							}
							
						}
				}

				

			

				


		$html = str_replace('{'.$clave.'}', $valor, $html);

		$html = str_replace('{correos}', $html2, $html);

		$html = str_replace('{telefonos}', $html3, $html);

		$html = str_replace('{programaactual}', $html4, $html);
		$html = str_replace('{hidden}', $html5, $html);
		$html = str_replace('{centroactual}', $html6, $html);
		$html = str_replace('{espactual}', $html7, $html);
		

		
		
	}
	return $html;
}


function retornar_vista($vista, $data = array(), $parametros = array(), $data_select_prog, $data_select_esp, $datos_select_centro, $datos_select_esp2) {



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
	$html = str_replace('{contenido}',  buscar_plantilla('registrar','investigadores'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	$html= llenar_select_prog($html, $data_select_prog);
	$html= llenar_select_esp($html, $data_select_esp);

}

if ($vista=='verdatos'){
	$html = str_replace('{contenido}',  buscar_plantilla('verdatos','investigadores'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	$html = llenar_tabla($html, $data);
}

if ($vista=='modificar'){
	$html = str_replace('{contenido}',  buscar_plantilla('modificar','investigadores'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	//$html= llenar_select_esp($html, $data_select_esp);
	$html = hacer_datos_dinamicos($html, $data);
	$html= llenar_select_esp2($html, $datos_select_esp2);
	
	$html= llenar_select_prog($html, $data_select_prog);
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
