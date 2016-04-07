<?php
session_start();

require('../core/logica.php');
require('../core/models.php');
include('../modelos/cargos.php');


$diccionario = array('titulos'=>array('registrar'=>'Agregar Nueva Autoridad',
									  'verdatos'=>'Tabla de Autoridades',
									  'modificar'=>'Modificar Autoridad'));

function llenar_tabla($html, $data){

	$num_filas = count($data);


	for ($i=0; $i < $num_filas ; $i++) {

			


		
	
			$html2.="<tr>
					<td style='text-align: center;'> <a href='/investigacion/autoridades/buscar/?id=".$data[$i]['id_autoridad']."' class='btn btn-info btn-xs'><i class='fa fa-pencil'></i> Editar</a> <br><br><a href='#' id='".$data[$i]['id_autoridad']."' class='btn btn-danger btn-xs'><i class='fa fa-eraser'></i> Eliminar</a></td>
					<td style='text-align: center;'>{nom_aut} {ape_aut}</td>
					<td style='text-align: center;'>{email_aut}</td>
					<td style='text-align: center;'>{tel_aut}</td>
					<td style='text-align: center;'>
                                                      <img width='150px' height='150px' src='/investigacion/publico/admin/img/autoridades/{foto_aut}' alt='' />
                                                  </td>
					<td style='text-align: center;'><span class='label label-danger'>{des_cargo}</span></td>";
					
		
			$html2 .= "</tr>";

			$html2 .= "
						<script type='text/javascript'>

						        $('".$data[$i]['id_autoridad']."').onclick = function () {
						            reset();
						            alertify.confirm('¿Desea Eliminar Esta Autoridad?: <b>".$data[$i]['nom_aut']." ".$data[$i]['ape_aut']."</b>', function (e) {
						                if (e) {
						                	location = '/investigacion/autoridades/eliminar/?id=".$data[$i]['id_autoridad']."';
						                } else {
						                	
						                }
						            });
						            return false;
						        };
						</script>";

		
			foreach ($data[$i] as $clave=>$valor) {
				$modelos = new Models();
				$modelos->buscarDatosId2("autoridad_email", "id_autoridad", $data[$i]["id_autoridad"]);
				$correos = $modelos->filas;

				$modelos2 = new Models();
				$modelos2->buscarDatosId2("autoridad_tel", "id_autoridad", $data[$i]["id_autoridad"]);
				$telefonos = $modelos2->filas;

				

				$num_email = count($correos);
				for ($j=0; $j < $num_email; $j++) { 
					if ($j==$num_email-1) {
						$email.= $correos[$j]["email_aut"];
					}else{
						$email.= $correos[$j]["email_aut"].",<br> ";
					}
				}

				$num_tel = count($telefonos);
				for ($j=0; $j < $num_tel; $j++) { 
					if ($j==$num_tel-1) {
						$tel.= $telefonos[$j]["tel_aut"];
					}else{
						$tel.= $telefonos[$j]["tel_aut"].",<br> ";
					}
				}

				$cargos = new Cargos();
				$cargos->buscarTodos();
				$dataCargos = $cargos->filas;
				$num_filas_cargo = count($dataCargos);

				for ($j=0; $j < $num_filas_cargo ; $j++) { 
					if ($dataCargos[$j]["id_cargo"]==$data[$i]["id_cargo"]) {
						$html2 = str_replace('{des_cargo}', $dataCargos[$j]["des_cargo"], $html2);
					}
				}


				
				$html2 = str_replace('{'.$clave.'}', $valor, $html2);
				$html2 = str_replace('{email_aut}', $email, $html2);
				$html2 = str_replace('{tel_aut}', $tel, $html2);

				
			}

			$email = "";
			$tel = "";
		
		


	
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
			$modelos = new Models();
			$modelos->buscarDatosId2("autoridad_email", "id_autoridad", $data["id_autoridad"]);
			$correos = $modelos->filas;
		

			$modelos2 = new Models();
			$modelos2->buscarDatosId2("autoridad_tel", "id_autoridad", $data["id_autoridad"]);
			$telefonos = $modelos2->filas;


			$num_email = count($correos);
			if (count($correos)==0) {
						$html2 .= " <div class='form-group input-group col-lg-8'>

		                                            <input type='text' name='email_aut[]' id='email_aut[]' class='form-control' >
		                                              <span class='input-group-btn'><button type='button' class='btn btn-default btn-add'>+
		                                              </button></span>
		                           </div>";
			}else{
					for ($j=0; $j < $num_email; $j++) { 
						$html2 .= " <div class='form-group input-group col-lg-8'>

		                                            <input type='text' name='email_aut[]' id='email_aut[]' class='form-control' value=".$correos[$j]["email_aut"].">
		                                              <span class='input-group-btn'><button type='button' class='btn btn-default btn-add'>+
		                                              </button></span>
		                           </div>";
					}
			}
		

			$num_tel = count($telefonos);
			if (count($telefonos)==0) {
						$html3 .= "<div class='form-group input-group col-lg-8'>
                                              <input class='form-control' id='tel_aut[]' name='tel_aut[]' type='text'>   
                                              <span class='input-group-btn'><button type='button' class='btn btn-default btn-add'>+
                                              </button></span>
                           </div>";
			}else{
				for ($j=0; $j < $num_tel; $j++) { 

						$html3 .= "<div class='form-group input-group col-lg-8'>
		                                              <input class='form-control' id='tel_aut[]' name='tel_aut[]' type='text' value=".$telefonos[$j]["tel_aut"].">   
		                                              <span class='input-group-btn'><button type='button' class='btn btn-default btn-add'>+
		                                              </button></span>
		                           </div>";
				}
			}
			

			$cargos = new Cargos();
			$cargos->buscarTodos();
			$dataCargos = $cargos->filas;


			$num_filas_cargo = count($dataCargos);

			for ($j=0; $j < $num_filas_cargo ; $j++) { 
				if ($dataCargos[$j]["id_cargo"]==$data["id_cargo"]) {
					$html4 =  "<option value='".$dataCargos[$j]['id_cargo']."'> ".$dataCargos[$j]['des_cargo']."</option>";
				}
			}

		$html = str_replace('{'.$clave.'}', $valor, $html);

		$html = str_replace('{correos}', $html2, $html);

		$html = str_replace('{telefonos}', $html3, $html);

		$html = str_replace('{cargoactual}', $html4, $html);
		
	}
	return $html;
}






function retornar_vista($vista, $data = array(), $parametros = array(), $data_select_cargos) {


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
	$html = str_replace('{contenido}',  buscar_plantilla('registrar','autoridades'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	$html= llenar_select_cargos($html, $data_select_cargos);

}

if ($vista=='verdatos'){
	$html = str_replace('{contenido}',  buscar_plantilla('verdatos','autoridades'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	$html = llenar_tabla($html, $data);
}

if ($vista=='modificar'){
	$html = str_replace('{contenido}',  buscar_plantilla('modificar','autoridades'), $html);
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
