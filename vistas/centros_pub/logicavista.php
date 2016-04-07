<?php
session_start();

require('../core/logica.php');
require('../core/models.php');
include('../modelos/cargos.php');


$diccionario = array('titulos'=>array('vercentros'=>'Centros de Investigación', 'detalleCentro'=>'Detalle del Centro'));

function cargarCentros($html, $data){

	$num_filas = count($data);

	for ($i=0; $i < $num_filas ; $i++) {
		
		$html2.= ' <div class="row carousel-row">
                    <div class="col-xs-10 slide-row">
                        
                        <div class="slide-content1">
                            <h4> {nom_centro}</h4>
                            <p>
                                {objetivos}
                            </p>

                        </div>
                        <div class="slide-footer">
                            <span class="pull-right buttons">
                                <a class="btn btn-primary btn-xs"  href="/investigacion/centros_pub/detalleCentro/?id_centro={id_centro}"   >
                                Más Información
                                </a>
                            </span>
                        </div>
                    </div>
                </div>';
		
			foreach ($data[$i] as $clave=>$valor) {
				
				$html2 = str_replace('{'.$clave.'}', $valor, $html2);
				
			}
	
	}
	$html = str_replace('{centros}', $html2, $html);
	return $html;

}

function detalleCentro($html, $data, $dataLineas, $dataProyectos, $dataInvestigadores){
	foreach ($data as $clave=>$valor) {
		
		if ($clave=='tel_dir_cen' && $valor!='') {
			$telefono = '<p><b>Teléfono: </b>'.$valor.'</p>';
			$html = str_replace('{telefono}', $telefono, $html);
		}else if ($clave=='tel_dir_cen' && $valor=='') {
			
			$html = str_replace('{telefono}', '', $html);
		}

		if ($clave=='email_dir_cen' && $valor!='') {
			$correo = '<p><b>Correo: </b>'.$valor.'</p>';
			$html = str_replace('{correo}', $correo, $html);
		}else if ($clave=='email_dir_cen' && $valor=='') {
			
			$html = str_replace('{correo}', '', $html);
		}

		$html = str_replace('{'.$clave.'}', $valor, $html);
				
	}

	$num_lineas = count($dataLineas);

	for ($i=0; $i < $num_lineas ; $i++) { 
		$html2.= '<li>'.$dataLineas[$i]["nom_lin"].'</li>';

	}

	$num_proy = count($dataProyectos);

	for ($i=0; $i < $num_proy ; $i++) { 
		$html3.= '<li><a href="/investigacion/proyectos_pub/detallePro/?id_proyecto='.$dataProyectos[$i]["id_proyecto"].'"> '.$dataProyectos[$i]["tit_pro"].' </a></li>';

	}

	$num_inv = count($dataInvestigadores);

	for ($i=0; $i < $num_inv ; $i++) { 
		
			$html4.= '<div class="col-md-3" style="">
                             <a href="/investigacion/investigadores_pub/detalleInv/?id_investigador='.$dataInvestigadores[$i]["id_investigador"].'" class="thumbnail">
                                  <img style="width:150px;height:130px;" src="/investigacion/publico/admin/img/investigadores/'.$dataInvestigadores[$i]["foto_inv"].'">
                                </a>
                                &nbsp;&nbsp;&nbsp;<a href="/investigacion/investigadores_pub/detalleInv/?id_investigador='.$dataInvestigadores[$i]["id_investigador"].'">
                                    '.$dataInvestigadores[$i]["nom_inv"].' '.$dataInvestigadores[$i]["ape_inv"].'
                                </a>
                    </div>';
		
	}

	$html = str_replace('{lineas}', $html2, $html);
	$html = str_replace('{proyectos}', $html3, $html);
	$html = str_replace('{investigadores}', $html4, $html);

	return $html;
}



function retornar_vista($vista, $data = array(), $parametros = array(), $dataLineas, $dataProyectos, $dataInvestigadores) {


	foreach ($parametros as $campo => $value) {
		$$campo = $value;
	}

	global $diccionario;

	$html = buscar_plantilla_main();


	if ($vista=='vercentros'){
		
		$html = str_replace('{contenido}',  buscar_plantilla('centros','centros_pub'), $html);
		$html = str_replace('{titulo}', $diccionario['titulos'][$vista], $html);
		$html = cargarCentros($html, $data);

	}

	if ($vista=='detalleCentro'){
		
		$html = str_replace('{contenido}',  buscar_plantilla('detalleCentro','centros_pub'), $html);
		$html = str_replace('{titulo}', $diccionario['titulos'][$vista], $html);
		$html = detalleCentro($html, $data, $dataLineas, $dataProyectos, $dataInvestigadores);

	}




	print $html;

}


 ?>