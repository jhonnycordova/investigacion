<?php
session_start();

require('../core/logica.php');
require('../core/models.php');



$diccionario = array('titulos'=>array('ver'=>'Jornadas InvExt'));

function cargarJornadas($html, $data){

	$num_filas = count($data);

	for ($i=0; $i < $num_filas ; $i++) {
	
			$html2.='<div align="center" style="border-bottom-style:inset;">
                               <p style="font-weight:bold;font-size:20px;">{nom_jor}</p><p>Fecha: <span class="label label-primary">{fecha}</span></p>
                               <p><a href="/investigacion/publico/admin/img/jornadas/{pro_jor}" target="_blank"><img src="/investigacion/publico/admin/img/Icono_pdf.png" style="max-width:112px;"> Programas</a>
                               <a href="/investigacion/publico/admin/img/jornadas/{mem_jor}"  target="_blank"><img src="/investigacion/publico/admin/img/Icono_pdf.png" style="max-width:112px;"> Memorias</a>
                               <a href="/investigacion/publico/admin/img/jornadas/{norm_jor}"  target="_blank"><img src="/investigacion/publico/admin/img/Icono_pdf.png" style="max-width:112px;"> Normativas</a>
                              
                               
                           </div>

                           <br><br>';
					
		
		
			foreach ($data[$i] as $clave=>$valor) {

				if ($clave=='fecha_jor') {
					
					$fecha= explode('-', $valor);
					$fecha2= $fecha[2]."/".$fecha[1]."/".$fecha[0];
					$html2 = str_replace('{fecha}', $fecha2, $html2);
				}
				
				$html2 = str_replace('{'.$clave.'}', $valor, $html2);
			

				
			}

	
	}


	$html = str_replace('{jornadas}', $html2, $html);

	return $html;

}



function retornar_vista($vista, $data = array(), $parametros = array()) {


	foreach ($parametros as $campo => $value) {
		$$campo = $value;
	}

	global $diccionario;

	$html = buscar_plantilla_main();


	if ($vista=='ver'){
		
		$html = str_replace('{contenido}',  buscar_plantilla('jornadas','jornadas_pub'), $html);
		$html = str_replace('{titulo}', $diccionario['titulos'][$vista], $html);
		$html = cargarJornadas($html, $data);

	}




	print $html;

}


 ?>