<?php
session_start();

require('../core/logica.php');
require('../core/models.php');
include('../modelos/cargos.php');


$diccionario = array('titulos'=>array('ver'=>'Autoridades'));

function cargarAutoridades($html, $data){

	$num_filas = count($data);

	for ($i=0; $i < $num_filas ; $i++) {
	
			$html2.='<div>
                                <img src="/investigacion/publico/admin/img/autoridades/{foto_aut}" style="max-width:191px;height:179px;float:left;width:191px;min-height:179px;">
                                <br>
                                <p style="font-weight:bold;font-size:18px;"> &nbsp;&nbsp;{nom_aut} {ape_aut}</p>
                                <p> &nbsp;&nbsp;Teléfonos: {tel_aut}</p>
                                <p> &nbsp;&nbsp;Correos: {email_aut}</p>

                                <p> &nbsp;&nbsp;Cargo: {des_cargo}</p>

                           </div>

                           <br><br><br>';
					
		
		
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
						$email.= '<span class="label label-info">'.$correos[$j]["email_aut"].'</span> ';
					}else{
						$email.= '<span class="label label-info">'.$correos[$j]["email_aut"].'</span>,  ';
					}
				}

				$num_tel = count($telefonos);
				for ($j=0; $j < $num_tel; $j++) { 
					if ($j==$num_tel-1) {
						$tel.= '<span class="label label-danger">'.$telefonos[$j]["tel_aut"].'</span>';
					}else{
						$tel.= '<span class="label label-danger">'.$telefonos[$j]["tel_aut"].'</span>, ';
					}
				}

				$cargos = new Cargos();
				$cargos->buscarTodos();
				$dataCargos = $cargos->filas;
				$num_filas_cargo = count($dataCargos);

				for ($j=0; $j < $num_filas_cargo ; $j++) { 
					if ($dataCargos[$j]["id_cargo"]==$data[$i]["id_cargo"]) {

						$cargo = '<span class="label label-success">'.$dataCargos[$j]["des_cargo"].'</span> ';

						$html2 = str_replace('{des_cargo}', $cargo, $html2);
					}
				}


				
				$html2 = str_replace('{'.$clave.'}', $valor, $html2);
				$html2 = str_replace('{email_aut}', $email, $html2);
				$html2 = str_replace('{tel_aut}', $tel, $html2);

				
			}

			$email = "";
			$tel = "";
		
		


	
	}


	$html = str_replace('{autoridades}', $html2, $html);

	return $html;

}



function retornar_vista($vista, $data = array(), $parametros = array()) {


	foreach ($parametros as $campo => $value) {
		$$campo = $value;
	}

	global $diccionario;

	$html = buscar_plantilla_main();


	if ($vista=='ver'){
		
		$html = str_replace('{contenido}',  buscar_plantilla('autoridades','autoridades_pub'), $html);
		$html = str_replace('{titulo}', $diccionario['titulos'][$vista], $html);
		$html = cargarAutoridades($html, $data);

	}




	print $html;

}


 ?>