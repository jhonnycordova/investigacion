<?php
session_start();

require('../core/logica.php');
require('../core/models.php');



$diccionario = array('titulos'=>array('iinvestigacion'=>'Investigadores', 'iextension'=>'Extensionistas', 'detalleInv'=>'Detalle Investigador/Extensionista'));

function cargarInv($html, $data){

		
	foreach ($data[0] as $clave=>$valor) {
		$modelos = new Models();
		$modelos->buscarInvCentro($data[0]["id_centro"]);
		$investigadores = $modelos->filas;


		$num_inv = count($investigadores);

		for ($i=0; $i < $num_inv ; $i++) { 

		

			$html2.= '<div class="col-md-3" style="">
                             <a href="/investigacion/investigadores_pub/detalleInv/?id_investigador='.$investigadores[$i]["id_investigador"].'" class="thumbnail">
                                  <img style="width:150px;height:130px;" src="/investigacion/publico/admin/img/investigadores/'.$investigadores[$i]["foto_inv"].'">
                                </a>
                                <a href="/investigacion/investigadores_pub/detalleInv/?id_investigador='.$investigadores[$i]["id_investigador"].'">
                                    '.$investigadores[$i]["nom_inv"].' '.$investigadores[$i]["ape_inv"].'
                                </a>
                    </div>';

           
		}

		

		$html = str_replace('{'.$clave.'}', $valor, $html);
		$html = str_replace('{investigadores}', $html2, $html);
		
		
	}

	return $html;

}

function cargarDetalle($html, $data){

		
	foreach ($data as $clave=>$valor) {
		$modelo3 = new Models();
		$modelo3->buscarEsp($data['id_investigador']);
		$especialidades = $modelo3->filas;


		$num_esp = count($especialidades);
		for ($j=0; $j < $num_esp; $j++) { 
			
				$esp.= "<li>".$especialidades[$j]["des_esp"]."</li>";
			
		}

				$modelos = new Models();
				$modelos->buscarDatosId2("investigador_email", "id_investigador", $data["id_investigador"]);
				$correos = $modelos->filas;

				


				$modelos2 = new Models();
				$modelos2->buscarDatosId2("investigador_tel", "id_investigador", $data["id_investigador"]);
				$telefonos = $modelos2->filas;

				

				$num_email = count($correos);
				for ($j=0; $j < $num_email; $j++) { 
					$email .= '<li>'.$correos[$j]["email_inv"].'</li>';
				}

				$num_tel = count($telefonos);
				for ($j=0; $j < $num_tel; $j++) { 
					$tel .= '<li>'.$telefonos[$j]["tel_inv"].'</li>';
				}

				$modelos7 = new Models();
				$modelos7->buscarProPorInv($data["id_investigador"]);
				$proyectos = $modelos7->filas;

				

				$num_pro = count($proyectos);
				for ($j=0; $j < $num_pro; $j++) { 
					$pro .= '<li><a href="/investigacion/proyectos_pub/detallePro/?id_proyecto='.$proyectos[$j]["id_proyecto"].'">'.$proyectos[$j]["tit_pro"].'</a></li>';
				}

		$html = str_replace('{'.$clave.'}', $valor, $html);
		$html = str_replace('{especialidades}', $esp, $html);
		$html = str_replace('{correos}', $email, $html);
		$html = str_replace('{telefonos}', $tel, $html);
		$html = str_replace('{proyectos}', $pro, $html);
		
	}

	return $html;

}


function cargarInv2($html, $data){

		
	foreach ($data[0] as $clave=>$valor) {
		$modelos = new Models();
		$modelos->buscarInvLinea($data[0]["id_linea"]);
		$investigadores = $modelos->filas;



		$num_inv = count($investigadores);

		for ($i=0; $i < $num_inv ; $i++) { 
			$html3.= '<div class="col-md-3" style="">
                             <a href="/investigacion/investigadores_pub/detalleInv/?id_investigador='.$investigadores[$i]["id_investigador"].'" class="thumbnail">
                                  <img style="width:150px;height:130px;" src="/investigacion/publico/admin/img/investigadores/'.$investigadores[$i]["foto_inv"].'">
                                </a>
                                <a href="/investigacion/investigadores_pub/detalleInv/?id_investigador='.$investigadores[$i]["id_investigador"].'">
                                    '.$investigadores[$i]["nom_inv"].' '.$investigadores[$i]["ape_inv"].'
                                </a>
                    </div>';
		}

		

		$html = str_replace('{'.$clave.'}', $valor, $html);
		$html = str_replace('{extensionistas}', $html3, $html);
		
		
	}

	return $html;

}

function llenar_select_lineas($html, $data){

	$num_filas = count($data);

	for ($i=0; $i < $num_filas ; $i++) { 
		$html2 .= "<option value='".$data[$i]['id_linea']."'> ".$data[$i]['nom_lin']."</option>";
	}

	$html = str_replace('{lineas}', $html2, $html);

	return $html;
}

function llenar_select_centros($html, $data){

	$num_filas = count($data);

	for ($i=0; $i < $num_filas ; $i++) { 
		$html2 .= "<option value='".$data[$i]['id_centro']."'> ".$data[$i]['nombrecentro']."</option>";
	}

	$html = str_replace('{centros}', $html2, $html);

	return $html;
}




function retornar_vista($vista, $data = array(), $parametros = array()) {



	foreach ($parametros as $campo => $value) {
		$$campo = $value;
	}

	global $diccionario;

	$html = buscar_plantilla_main();


	if ($vista=='iinvestigacion'){
		
		$html = str_replace('{contenido}',  buscar_plantilla('iinvestigacion','investigadores_pub'), $html);
		$html = str_replace('{titulo}', $diccionario['titulos'][$vista], $html);
		$html = llenar_select_centros($html, $data);
		$html = cargarInv($html, $data);

	}

	if ($vista=='iextension'){
		
		$html = str_replace('{contenido}',  buscar_plantilla('iextension','investigadores_pub'), $html);
		$html = str_replace('{titulo}', $diccionario['titulos'][$vista], $html);
		$html = llenar_select_lineas($html, $data);
		$html = cargarInv2($html, $data);

	}

	if ($vista=='detalleInv'){
		
		$html = str_replace('{contenido}',  buscar_plantilla('detalleInv','investigadores_pub'), $html);
		$html = str_replace('{titulo}', $diccionario['titulos'][$vista], $html);
		//$html = llenar_select_lineas($html, $data);
		$html = cargarDetalle($html, $data);

	}





	print $html;

}


 ?>