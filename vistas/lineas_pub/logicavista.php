<?php
session_start();

require('../core/logica.php');
require('../core/models.php');



$diccionario = array('titulos'=>array('linvestigacion'=>'Líneas de Investigación', 'lextension'=>'Líneas de Extensión'));

function cargarLinea($html, $data){
	
		
	foreach ($data[0] as $clave=>$valor) {
		$modelos = new Models();
		$modelos->buscarProyectos($data[0]["id_linea"]);
		$proyectos = $modelos->filas;

		$num_proy = count($proyectos);

		for ($i=0; $i < $num_proy ; $i++) { 
			$html2.= '<li><a href="/investigacion/proyectos_pub/detallePro/?id_proyecto='.$proyectos[$i]["id_proyecto"].'">'.$proyectos[$i]["tit_pro"].'</a></li>';
		}

		$modelos = new Models();
		$modelos->buscarInvLinea($data[0]["id_linea"]);
		$investigadores = $modelos->filas;



		$num_inv = count($investigadores);

		for ($i=0; $i < $num_inv ; $i++) { 
			$html3.= '<div class="col-md-3" style="">
                             <a href="/investigacion/investigadores_pub/detalleInv/?id_investigador='.$investigadores[$i]["id_investigador"].'" class="thumbnail">
                                  <img style="width:150px;height:130px;" src="/investigacion/publico/admin/img/investigadores/'.$investigadores[$i]["foto_inv"].'">
                                </a>
                                &nbsp;&nbsp;&nbsp;<a href="/investigacion/investigadores_pub/detalleInv/?id_investigador='.$investigadores[$i]["id_investigador"].'">
                                    '.$investigadores[$i]["nom_inv"].' '.$investigadores[$i]["ape_inv"].'
                                </a>
                    </div>';
		}

		$html = str_replace('{'.$clave.'}', $valor, $html);
		$html = str_replace('{proyectos}', $html2, $html);
		$html = str_replace('{investigadores}', $html3, $html);
		
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



function retornar_vista($vista, $data = array(), $parametros = array()) {


	foreach ($parametros as $campo => $value) {
		$$campo = $value;
	}

	global $diccionario;

	$html = buscar_plantilla_main();


	if ($vista=='linvestigacion'){
		
		$html = str_replace('{contenido}',  buscar_plantilla('lineas','lineas_pub'), $html);
		$html = str_replace('{titulo}', $diccionario['titulos'][$vista], $html);
		$html = llenar_select_lineas($html, $data);
		$html = cargarLinea($html, $data);

	}

	if ($vista=='lextension'){
		
		$html = str_replace('{contenido}',  buscar_plantilla('lineas','lineas_pub'), $html);
		$html = str_replace('{titulo}', $diccionario['titulos'][$vista], $html);
		$html = llenar_select_lineas($html, $data);
		$html = cargarLinea($html, $data);

	}





	print $html;

}


 ?>