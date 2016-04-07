<?php
session_start();

require('../core/logica.php');
require('../core/models.php');



$diccionario = array('titulos'=>array('pinvestigacion'=>'Proyectos de Investigación', 'pextension'=>'Proyectos de Extensión', 'detallePro'=>'Detalle Proyecto'));

function cargarProyectos($html, $data){

		
	foreach ($data[0] as $clave=>$valor) {
		$modelos = new Models();
		$modelos->buscarProyectos2($data[0]["id_centro"]);
		$proyectos = $modelos->filas;

		

		$num_proy = count($proyectos);

		for ($i=0; $i < $num_proy ; $i++) { 
			$html2.= '<li><a href="/investigacion/proyectos_pub/detallePro/?id_proyecto='.$proyectos[$i]["id_proyecto"].'">'.$proyectos[$i]["tit_pro"].'</a></li>';
		}

		

		$html = str_replace('{'.$clave.'}', $valor, $html);
		$html = str_replace('{proyectos}', $html2, $html);
		
		
	}

	return $html;

}

function cargarDetalle($html, $data){

		
	foreach ($data as $clave=>$valor) {
		
		$modelos3 = new Models();
				$modelos3->buscarDatosPorId("proyecto_tipo", "id_tipo_pro");
				$tipos = $modelos3->filas;

			

				$num_tipo = count($tipos);

				for ($j=0; $j < $num_tipo ; $j++) { 
					if ($tipos[$j]["id_tipo_pro"]==$data["id_tipo_pro"]) {
						$html = str_replace('{tipopro}', $tipos[$j]["des_tipo_pro"], $html);
					}
				}

				$modelos2 = new Models();
				$modelos2->buscarDatosPorId("lineas", "id_linea");
				$lineas = $modelos2->filas;

				$num_prog = count($lineas);

				for ($j=0; $j < $num_prog ; $j++) { 
					if ($lineas[$j]["id_linea"]==$data["id_linea"]) {


						$html = str_replace('{linea}', $lineas[$j]["nom_lin"], $html);
					}
				}

				if ($clave=='id_prog' && $valor==2) {
						
					$html = str_replace('{none}', 'none', $html);
				}else if ($clave=='id_prog' && $valor==1) {
						$modelos4 = new Models();
						$modelos4->buscarDatosPorId("centros", "id_centro");
						$centros = $modelos4->filas;

						$num_cen = count($centros);

							for ($j=0; $j < $num_cen ; $j++) { 
								if ($centros[$j]["id_centro"]==$data["id_centro"]) {

									$centro = '<a href="/investigacion/centros_pub/detalleCentro/?id_centro='.$centros[$j]["id_centro"].'">'.$centros[$j]["nom_centro"].'</a>';

									$html = str_replace('{centro}', $centro, $html);
								}
							}

					$html = str_replace('{none}', '', $html);
				}

				if ($clave=='fec_ini_pro') {
					$fecha = explode("-", $valor);
					$fecha2 = $fecha[2]."/".$fecha[1]."/".$fecha[0];
					$html = str_replace('{fechaInicio}', $fecha2, $html);
				}

				if ($clave=='fec_cul_pro') {
					$fecha3 = explode("-", $valor);
					$fecha4 = $fecha3[2]."/".$fecha3[1]."/".$fecha3[0];
					$html = str_replace('{fechaCul}', $fecha4, $html);
				}

				$modelo = new Models();
				$modelo->buscarInv($data['id_proyecto']);
				$investigadores = $modelo->filas;




				$num_esp = count($investigadores);
				for ($j=0; $j < $num_esp; $j++) { 
					
						$inv.= "<li><a href='/investigacion/investigadores_pub/detalleInv/?id_investigador=".$investigadores[$j]["id_investigador"]."'>".$investigadores[$j]["nom_inv"]." ".$investigadores[$j]["ape_inv"]."</a></li>";
					
				}
				
		

		$html = str_replace('{'.$clave.'}', $valor, $html);
		$html = str_replace('{investigadores}', $inv, $html);

		
		
		
	}

	return $html;

}


function cargarProyectos2($html, $data){

		
	foreach ($data[0] as $clave=>$valor) {
		$modelos = new Models();
		$modelos->buscarProyectos($data[0]["id_linea"]);
		$proyectos = $modelos->filas;

		

		$num_proy = count($proyectos);

		for ($i=0; $i < $num_proy ; $i++) { 
			$html2.= '<li><a href="/investigacion/proyectos_pub/detallePro/?id_proyecto='.$proyectos[$i]["id_proyecto"].'">'.$proyectos[$i]["tit_pro"].'</a></li>';
		}

		

		$html = str_replace('{'.$clave.'}', $valor, $html);
		$html = str_replace('{proyectos}', $html2, $html);
		
		
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


	if ($vista=='pinvestigacion'){
		
		$html = str_replace('{contenido}',  buscar_plantilla('pinvestigacion','proyectos_pub'), $html);
		$html = str_replace('{titulo}', $diccionario['titulos'][$vista], $html);
		$html = llenar_select_centros($html, $data);
		$html = cargarProyectos($html, $data);

	}

	if ($vista=='pextension'){
		
		$html = str_replace('{contenido}',  buscar_plantilla('pextension','proyectos_pub'), $html);
		$html = str_replace('{titulo}', $diccionario['titulos'][$vista], $html);
		$html = llenar_select_lineas($html, $data);
		$html = cargarProyectos2($html, $data);

	}

	if ($vista=='detallePro'){
		
		$html = str_replace('{contenido}',  buscar_plantilla('detallePro','proyectos_pub'), $html);
		$html = str_replace('{titulo}', $diccionario['titulos'][$vista], $html);
		//$html = llenar_select_lineas($html, $data);
		$html = cargarDetalle($html, $data);

	}





	print $html;

}


 ?>