<?php
session_start();

require('../core/logica.php');
require('../core/models.php');


$diccionario = array('titulos'=>array('registrar'=>'Agregar Evento',
									  'verdatos'=>'Tabla de Eventos',
									  'modificar'=>'Modificar Evento ',
									  'detalleEvento'=>'Detalle Evento'));

function llenar_tabla($html, $data){

	$num_filas = count($data);

	for ($i=0; $i < $num_filas ; $i++) {
		$html2 .= "<tr>
					<td style='text-align: center;'>
					    <a href='/investigacion/eventos/buscar/?id=".$data[$i]['id_evento']."' class='btn btn-info btn-xs'><i class='fa fa-pencil'></i> Editar</a><br><br>
					    <a href='#' id='".$data[$i]['id_evento']."' class='btn btn-danger btn-xs'><i class='fa fa-eraser'></i> Eliminar</a>

					</td>
					<td >{nom_evento}</td>
					<td >{fechasyhoras}</td>";
					if($data[$i]['est_evento'] == 'A'){
						$html2 .= "<td style='text-align: center;'><span class='label label-success'>{est_evento}</span></td>";
					}else if ($data[$i]['est_evento'] == 'R') {
						$html2 .= "<td style='text-align: center;'><span class='label label-danger'>{est_evento}</span></td>";
					}else if ($data[$i]['est_evento'] == 'E') {
						$html2 .= "<td style='text-align: center;'><span class='label label-info'>{est_evento}</span></td>";
					}
					$html2.="<td>{tipo}</td>
							 <td>{id_espacio}</td>";
						
					
		$html2 .= "</tr>";

		$html2 .= "
						<script type='text/javascript'>

						        $('".$data[$i]['id_evento']."').onclick = function () {
						            reset();
						            alertify.confirm('¿Desea Eliminar Este Evento?: <b>".$data[$i]['nom_evento']."</b>', function (e) {
						                if (e) {
						                	location = '/investigacion/eventos/eliminar/?id=".$data[$i]['id_evento']."';
						                } else {
						                	
						                }
						            });
						            return false;
						        };
						</script>";
		$fecha = "";
	    foreach ($data[$i] as $clave=>$valor) {

	    	if($clave == 'est_evento' && $valor == 'A'){
				$valor = 'Aprobado';
			}else if($clave == 'est_evento' && $valor == 'E'){
				$valor = 'En Evaluación';
			}else if ($clave == 'est_evento' && $valor == 'R') {
				$valor = 'No Aprobado';
			}

			if($clave == 'id_espacio' && $valor == 1){
				$valor = 'Auditorio "Hugo Rafael Chávez Frías"';
			}else if($clave == 'id_espacio' && $valor == 2){
				$valor = 'Salón de Usos Múltiples';
			}

			$modelos = new Models();
			$modelos->buscarDatosPorId("evento_tipo", "id_tipo");
			$tipos = $modelos->filas;

			$num_tip = count($tipos);

			for ($j=0; $j < $num_tip ; $j++) { 
				if ($tipos[$j]["id_tipo"]==$data[$i]["id_tipo"]) {
					$html2 = str_replace('{tipo}', $tipos[$j]["des_tipo"], $html2);
				}
			}
	    	
			$html2 = str_replace('{'.$clave.'}', $valor, $html2);
	    	
	    	
			$modelos2 = new Models();
			$modelos2->buscarInfoEvento($data[$i]["id_evento"]);
			$fechas = $modelos2->filas;

			$num_fechas = count($fechas);

		
			for ($j=0; $j < $num_fechas ; $j++) { 

				if ($fechas[$j]["horainicio"]==6) {
					$horainicio = "06:00";
				}else if ($fechas[$j]["horainicio"]==7) {
					$horainicio = "07:00";
				}else if ($fechas[$j]["horainicio"]==8) {
					$horainicio = "08:00";
				}else if ($fechas[$j]["horainicio"]==9) {
					$horainicio = "09:00";
				}else if ($fechas[$j]["horainicio"]==10) {
					$horainicio = "10:00";
				}else if ($fechas[$j]["horainicio"]==11) {
					$horainicio = "11:00";
				}else if ($fechas[$j]["horainicio"]==12) {
					$horainicio = "12:00";
				}else if ($fechas[$j]["horainicio"]==13) {
					$horainicio = "13:00";
				}else if ($fechas[$j]["horainicio"]==14) {
					$horainicio = "14:00";
				}else if ($fechas[$j]["horainicio"]==15) {
					$horainicio = "15:00";
				}else if ($fechas[$j]["horainicio"]==16) {
					$horainicio = "16:00";
				}else if ($fechas[$j]["horainicio"]==17) {
					$horainicio = "17:00";
				}else if ($fechas[$j]["horainicio"]==18) {
					$horainicio = "18:00";
				}else if ($fechas[$j]["horainicio"]==19) {
					$horainicio = "19:00";
				}else if ($fechas[$j]["horainicio"]==20) {
					$horainicio = "20:00";
				}

				if ($fechas[$j]["horafin"]==6) {
					$horafin = "06:00";
				}else if ($fechas[$j]["horafin"]==7) {
					$horafin = "07:00";
				}else if ($fechas[$j]["horafin"]==8) {
					$horafin = "08:00";
				}else if ($fechas[$j]["horafin"]==9) {
					$horafin = "09:00";
				}else if ($fechas[$j]["horafin"]==10) {
					$horafin = "10:00";
				}else if ($fechas[$j]["horafin"]==11) {
					$horafin = "11:00";
				}else if ($fechas[$j]["horafin"]==12) {
					$horafin = "12:00";
				}else if ($fechas[$j]["horafin"]==13) {
					$horafin = "13:00";
				}else if ($fechas[$j]["horafin"]==14) {
					$horafin = "14:00";
				}else if ($fechas[$j]["horafin"]==15) {
					$horafin = "15:00";
				}else if ($fechas[$j]["horafin"]==16) {
					$horafin = "16:00";
				}else if ($fechas[$j]["horafin"]==17) {
					$horafin = "17:00";
				}else if ($fechas[$j]["horafin"]==18) {
					$horafin = "18:00";
				}else if ($fechas[$j]["horafin"]==19) {
					$horafin = "19:00";
				}else if ($fechas[$j]["horafin"]==20) {
					$horafin = "20:00";
				}



				$html3.= "Día: <b>".$fechas[$j]["fecha"]."</b>, Inicio: <b>".$horainicio."</b>, Fin: <b>".$horafin."</b><br>";
			}

			

			$html2 = str_replace('{fechasyhoras}', $html3, $html2);

		}
		$html3 = "";
		
		

	}



	$html = str_replace('{datosTabla}', $html2, $html);

	return $html;

}

function hacer_datos_dinamicos2($html, $data) {

	if ($data["id_espacio"]==1) {
		$html = str_replace('{espacio}', 'Auditorio Hugo Rafael Chávez Frías', $html);
	}else{
		$html = str_replace('{espacio}', 'Salón Usos Múltiples', $html);
	}

	if ($data["inversion"]>0) {
		$html = str_replace('{participacion}', 'Con Inversión', $html);
	}else{
		$html = str_replace('{participacion}', 'Entrada Libre', $html);
		$html = str_replace('{hidden}', 'none', $html);
	}

	$modelos = new Models();
	$modelos->buscarDatosPorId("evento_tipo", "id_tipo");
	$tipos = $modelos->filas;

	$num_tip = count($tipos);

	for ($j=0; $j < $num_tip ; $j++) { 
		if ($tipos[$j]["id_tipo"]==$data["id_tipo"]) {
			$html = str_replace('{tipoevento}', $tipos[$j]["des_tipo"], $html);
		}
	}

	if ($data["id_area"]!='') {
		$modelos4 = new Models();
		$modelos4->buscarDatosPorId("evento_area", "id_area");
		$areas = $modelos4->filas;

		
		$num_areas = count($areas);

		for ($j=0; $j < $num_areas ; $j++) { 
			if ($areas[$j]["id_area"]==$data["id_area"]) {
				
				$html = str_replace('{area}', $areas[$j]["des_area"], $html);
			}
		}
	}else{
		$html = str_replace('{areahidden}', 'none', $html);
	}
	

	$modelos2 = new Models();
	$modelos2->buscarDatosPorId("evento_publico", "id_publico");
	$tipopub = $modelos2->filas;

	
	$num_tipopub = count($tipopub);

	for ($j=0; $j < $num_tipopub ; $j++) { 
		if ($tipopub[$j]["id_publico"]==$data["id_publico"]) {
			
			$html = str_replace('{tipopublico}', $tipopub[$j]["des_publico"], $html);
		}
	}

	$modelos5 = new Models();
		$modelos5->buscarInfoEvento($data["id_evento"]);
		$fechas = $modelos5->filas;

		$num_fechas = count($fechas);

		for ($j=0; $j < $num_fechas ; $j++) { 
			$html2.= '<div class="form-group multiple-form-group" >
                                          <label for="Fecha" class="control-label col-lg-2">Fecha</label>
                                          <div class="col-lg-3">
                                              <input type="date" name="fecha[]" id="fecha[]" class="form-control2" value="'.$fechas[$j]["fecha"].'" readonly required>
                                          </div>

                                          <label class="control-label col-lg-1">&nbsp;&nbsp;Desde</label>

                                            <div class="col-lg-2">
                                               <select class="form-control2 m-bot15" name="hora_desde[]" id="hora_desde[]" disabled required>
                                                   <option value =""></option>
                                                    <option value ="6" {desde6}>06:00</option>
                                                    <option value ="7" {desde7}>07:00</option>
                                                    <option value ="8" {desde8}>08:00</option>
                                                    <option value ="9" {desde9}>09:00</option>
                                                    <option value ="10" {desde10}>10:00</option>
                                                    <option value ="11" {desde11}>11:00</option>
                                                    <option value ="12" {desde12}>12:00</option>
                                                    <option value ="13" {desde13}>13:00</option>
                                                    <option value ="14" {desde14}>14:00</option>
                                                    <option value ="15" {desde15}>15:00</option>
                                                    <option value ="16" {desde16}>16:00</option>
                                                    <option value ="17" {desde17}>17:00</option>
                                                    <option value ="18" {desde18}>18:00</option>
                                                    <option value ="19" {desde19}>19:00</option>
                                                    <option value ="20" {desde20}>20:00</option>
                                              
                                             </select>
                                            </div>

                                             <label class="control-label col-lg-1">&nbsp;&nbsp;Hasta</label>

                                            <div class="col-lg-2">
                                               <select class="form-control2 m-bot15" name="hora_hasta[]" id="hora_hasta[]" disabled required>
                                                   <option value =""></option>
                                                    <option value ="6" {hasta6}>06:00</option>
                                                    <option value ="7" {hasta7}>07:00</option>
                                                    <option value ="8" {hasta8}>08:00</option>
                                                    <option value ="9" {hasta9}>09:00</option>
                                                    <option value ="10"{hasta10}>10:00</option>
                                                    <option value ="11"{hasta11}>11:00</option>
                                                    <option value ="12"{hasta12}>12:00</option>
                                                    <option value ="13"{hasta13}>13:00</option>
                                                    <option value ="14"{hasta14}>14:00</option>
                                                    <option value ="15"{hasta15}>15:00</option>
                                                    <option value ="16"{hasta16}>16:00</option>
                                                    <option value ="17"{hasta17}>17:00</option>
                                                    <option value ="18"{hasta18}>18:00</option>
                                                    <option value ="19"{hasta19}>19:00</option>
                                                    <option value ="20"{hasta20}>20:00</option>
                                              
                                             </select>
                                            </div>



                                           
                                      </div>';


             if ($fechas[$j]["horainicio"]==6) {
              		
					$html2 = str_replace('{desde6}', 'selected', $html2);
					$html2 = str_replace('{desde7}', '', $html2);
					$html2 = str_replace('{desde8}', '', $html2);
					$html2 = str_replace('{desde9}', '', $html2);
					$html2 = str_replace('{desde10}', '', $html2);
					$html2 = str_replace('{desde11}', '', $html2);
					$html2 = str_replace('{desde12}', '', $html2);
					$html2 = str_replace('{desde13}', '', $html2);
					$html2 = str_replace('{desde14}', '', $html2);
					$html2 = str_replace('{desde15}', '', $html2);
					$html2 = str_replace('{desde16}', '', $html2);
					$html2 = str_replace('{desde17}', '', $html2);
					$html2 = str_replace('{desde18}', '', $html2);
					$html2 = str_replace('{desde19}', '', $html2);
					$html2 = str_replace('{desde20}', '', $html2);

				}else if ($fechas[$j]["horainicio"]==7) {
					$html2 = str_replace('{desde6}', '', $html2);
					$html2 = str_replace('{desde7}', 'selected', $html2);
					$html2 = str_replace('{desde8}', '', $html2);
					$html2 = str_replace('{desde9}', '', $html2);
					$html2 = str_replace('{desde10}', '', $html2);
					$html2 = str_replace('{desde11}', '', $html2);
					$html2 = str_replace('{desde12}', '', $html2);
					$html2 = str_replace('{desde13}', '', $html2);
					$html2 = str_replace('{desde14}', '', $html2);
					$html2 = str_replace('{desde15}', '', $html2);
					$html2 = str_replace('{desde16}', '', $html2);
					$html2 = str_replace('{desde17}', '', $html2);
					$html2 = str_replace('{desde18}', '', $html2);
					$html2 = str_replace('{desde19}', '', $html2);
					$html2 = str_replace('{desde20}', '', $html2);
				}else if ($fechas[$j]["horainicio"]==8) {
					$html2 = str_replace('{desde6}', '', $html2);
					$html2 = str_replace('{desde7}', '', $html2);
					$html2 = str_replace('{desde8}', 'selected', $html2);
					$html2 = str_replace('{desde9}', '', $html2);
					$html2 = str_replace('{desde10}', '', $html2);
					$html2 = str_replace('{desde11}', '', $html2);
					$html2 = str_replace('{desde12}', '', $html2);
					$html2 = str_replace('{desde13}', '', $html2);
					$html2 = str_replace('{desde14}', '', $html2);
					$html2 = str_replace('{desde15}', '', $html2);
					$html2 = str_replace('{desde16}', '', $html2);
					$html2 = str_replace('{desde17}', '', $html2);
					$html2 = str_replace('{desde18}', '', $html2);
					$html2 = str_replace('{desde19}', '', $html2);
					$html2 = str_replace('{desde20}', '', $html2);
				}else if ($fechas[$j]["horainicio"]==9) {
					$html2 = str_replace('{desde6}', '', $html2);
					$html2 = str_replace('{desde7}', '', $html2);
					$html2 = str_replace('{desde8}', '', $html2);
					$html2 = str_replace('{desde9}', 'selected', $html2);
					$html2 = str_replace('{desde10}', '', $html2);
					$html2 = str_replace('{desde11}', '', $html2);
					$html2 = str_replace('{desde12}', '', $html2);
					$html2 = str_replace('{desde13}', '', $html2);
					$html2 = str_replace('{desde14}', '', $html2);
					$html2 = str_replace('{desde15}', '', $html2);
					$html2 = str_replace('{desde16}', '', $html2);
					$html2 = str_replace('{desde17}', '', $html2);
					$html2 = str_replace('{desde18}', '', $html2);
					$html2 = str_replace('{desde19}', '', $html2);
					$html2 = str_replace('{desde20}', '', $html2);
				}else if ($fechas[$j]["horainicio"]==10) {
					$html2 = str_replace('{desde6}', '', $html2);
					$html2 = str_replace('{desde7}', '', $html2);
					$html2 = str_replace('{desde8}', '', $html2);
					$html2 = str_replace('{desde9}', '', $html2);
					$html2 = str_replace('{desde10}', 'selected', $html2);
					$html2 = str_replace('{desde11}', '', $html2);
					$html2 = str_replace('{desde12}', '', $html2);
					$html2 = str_replace('{desde13}', '', $html2);
					$html2 = str_replace('{desde14}', '', $html2);
					$html2 = str_replace('{desde15}', '', $html2);
					$html2 = str_replace('{desde16}', '', $html2);
					$html2 = str_replace('{desde17}', '', $html2);
					$html2 = str_replace('{desde18}', '', $html2);
					$html2 = str_replace('{desde19}', '', $html2);
					$html2 = str_replace('{desde20}', '', $html2);
				}else if ($fechas[$j]["horainicio"]==11) {
					$html2 = str_replace('{desde6}', '', $html2);
					$html2 = str_replace('{desde7}', '', $html2);
					$html2 = str_replace('{desde8}', '', $html2);
					$html2 = str_replace('{desde9}', '', $html2);
					$html2 = str_replace('{desde10}', '', $html2);
					$html2 = str_replace('{desde11}', 'selected', $html2);
					$html2 = str_replace('{desde12}', '', $html2);
					$html2 = str_replace('{desde13}', '', $html2);
					$html2 = str_replace('{desde14}', '', $html2);
					$html2 = str_replace('{desde15}', '', $html2);
					$html2 = str_replace('{desde16}', '', $html2);
					$html2 = str_replace('{desde17}', '', $html2);
					$html2 = str_replace('{desde18}', '', $html2);
					$html2 = str_replace('{desde19}', '', $html2);
					$html2 = str_replace('{desde20}', '', $html2);
				}else if ($fechas[$j]["horainicio"]==12) {
					$html2 = str_replace('{desde6}', '', $html2);
					$html2 = str_replace('{desde7}', '', $html2);
					$html2 = str_replace('{desde8}', '', $html2);
					$html2 = str_replace('{desde9}', '', $html2);
					$html2 = str_replace('{desde10}', '', $html2);
					$html2 = str_replace('{desde11}', '', $html2);
					$html2 = str_replace('{desde12}', 'selected', $html2);
					$html2 = str_replace('{desde13}', '', $html2);
					$html2 = str_replace('{desde14}', '', $html2);
					$html2 = str_replace('{desde15}', '', $html2);
					$html2 = str_replace('{desde16}', '', $html2);
					$html2 = str_replace('{desde17}', '', $html2);
					$html2 = str_replace('{desde18}', '', $html2);
					$html2 = str_replace('{desde19}', '', $html2);
					$html2 = str_replace('{desde20}', '', $html2);
				}else if ($fechas[$j]["horainicio"]==13) {
					$html2 = str_replace('{desde6}', '', $html2);
					$html2 = str_replace('{desde7}', '', $html2);
					$html2 = str_replace('{desde8}', '', $html2);
					$html2 = str_replace('{desde9}', '', $html2);
					$html2 = str_replace('{desde10}', '', $html2);
					$html2 = str_replace('{desde11}', '', $html2);
					$html2 = str_replace('{desde12}', '', $html2);
					$html2 = str_replace('{desde13}', 'selected', $html2);
					$html2 = str_replace('{desde14}', '', $html2);
					$html2 = str_replace('{desde15}', '', $html2);
					$html2 = str_replace('{desde16}', '', $html2);
					$html2 = str_replace('{desde17}', '', $html2);
					$html2 = str_replace('{desde18}', '', $html2);
					$html2 = str_replace('{desde19}', '', $html2);
					$html2 = str_replace('{desde20}', '', $html2);
				}else if ($fechas[$j]["horainicio"]==14) {
					$html2 = str_replace('{desde6}', '', $html2);
					$html2 = str_replace('{desde7}', '', $html2);
					$html2 = str_replace('{desde8}', '', $html2);
					$html2 = str_replace('{desde9}', '', $html2);
					$html2 = str_replace('{desde10}', '', $html2);
					$html2 = str_replace('{desde11}', '', $html2);
					$html2 = str_replace('{desde12}', '', $html2);
					$html2 = str_replace('{desde13}', '', $html2);
					$html2 = str_replace('{desde14}', 'selected', $html2);
					$html2 = str_replace('{desde15}', '', $html2);
					$html2 = str_replace('{desde16}', '', $html2);
					$html2 = str_replace('{desde17}', '', $html2);
					$html2 = str_replace('{desde18}', '', $html2);
					$html2 = str_replace('{desde19}', '', $html2);
					$html2 = str_replace('{desde20}', '', $html2);
				}else if ($fechas[$j]["horainicio"]==15) {
					$html2 = str_replace('{desde6}', '', $html2);
					$html2 = str_replace('{desde7}', '', $html2);
					$html2 = str_replace('{desde8}', '', $html2);
					$html2 = str_replace('{desde9}', '', $html2);
					$html2 = str_replace('{desde10}', '', $html2);
					$html2 = str_replace('{desde11}', '', $html2);
					$html2 = str_replace('{desde12}', '', $html2);
					$html2 = str_replace('{desde13}', '', $html2);
					$html2 = str_replace('{desde14}', '', $html2);
					$html2 = str_replace('{desde15}', 'selected', $html2);
					$html2 = str_replace('{desde16}', '', $html2);
					$html2 = str_replace('{desde17}', '', $html2);
					$html2 = str_replace('{desde18}', '', $html2);
					$html2 = str_replace('{desde19}', '', $html2);
					$html2 = str_replace('{desde20}', '', $html2);
				}else if ($fechas[$j]["horainicio"]==16) {
					$html2 = str_replace('{desde6}', '', $html2);
					$html2 = str_replace('{desde7}', '', $html2);
					$html2 = str_replace('{desde8}', '', $html2);
					$html2 = str_replace('{desde9}', '', $html2);
					$html2 = str_replace('{desde10}', '', $html2);
					$html2 = str_replace('{desde11}', '', $html2);
					$html2 = str_replace('{desde12}', '', $html2);
					$html2 = str_replace('{desde13}', '', $html2);
					$html2 = str_replace('{desde14}', '', $html2);
					$html2 = str_replace('{desde15}', '', $html2);
					$html2 = str_replace('{desde16}', 'selected', $html2);
					$html2 = str_replace('{desde17}', '', $html2);
					$html2 = str_replace('{desde18}', '', $html2);
					$html2 = str_replace('{desde19}', '', $html2);
					$html2 = str_replace('{desde20}', '', $html2);
				}else if ($fechas[$j]["horainicio"]==17) {
					$html2 = str_replace('{desde6}', '', $html2);
					$html2 = str_replace('{desde7}', '', $html2);
					$html2 = str_replace('{desde8}', '', $html2);
					$html2 = str_replace('{desde9}', '', $html2);
					$html2 = str_replace('{desde10}', '', $html2);
					$html2 = str_replace('{desde11}', '', $html2);
					$html2 = str_replace('{desde12}', '', $html2);
					$html2 = str_replace('{desde13}', '', $html2);
					$html2 = str_replace('{desde14}', '', $html2);
					$html2 = str_replace('{desde15}', '', $html2);
					$html2 = str_replace('{desde16}', '', $html2);
					$html2 = str_replace('{desde17}', 'selected', $html2);
					$html2 = str_replace('{desde18}', '', $html2);
					$html2 = str_replace('{desde19}', '', $html2);
					$html2 = str_replace('{desde20}', '', $html2);
				}else if ($fechas[$j]["horainicio"]==18) {
					$html2 = str_replace('{desde6}', '', $html2);
					$html2 = str_replace('{desde7}', '', $html2);
					$html2 = str_replace('{desde8}', '', $html2);
					$html2 = str_replace('{desde9}', '', $html2);
					$html2 = str_replace('{desde10}', '', $html2);
					$html2 = str_replace('{desde11}', '', $html2);
					$html2 = str_replace('{desde12}', '', $html2);
					$html2 = str_replace('{desde13}', '', $html2);
					$html2 = str_replace('{desde14}', '', $html2);
					$html2 = str_replace('{desde15}', '', $html2);
					$html2 = str_replace('{desde16}', '', $html2);
					$html2 = str_replace('{desde17}', '', $html2);
					$html2 = str_replace('{desde18}', 'selected', $html2);
					$html2 = str_replace('{desde19}', '', $html2);
					$html2 = str_replace('{desde20}', '', $html2);
				}else if ($fechas[$j]["horainicio"]==19) {
					$html2 = str_replace('{desde6}', '', $html2);
					$html2 = str_replace('{desde7}', '', $html2);
					$html2 = str_replace('{desde8}', '', $html2);
					$html2 = str_replace('{desde9}', '', $html2);
					$html2 = str_replace('{desde10}', '', $html2);
					$html2 = str_replace('{desde11}', '', $html2);
					$html2 = str_replace('{desde12}', '', $html2);
					$html2 = str_replace('{desde13}', '', $html2);
					$html2 = str_replace('{desde14}', '', $html2);
					$html2 = str_replace('{desde15}', '', $html2);
					$html2 = str_replace('{desde16}', '', $html2);
					$html2 = str_replace('{desde17}', '', $html2);
					$html2 = str_replace('{desde18}', '', $html2);
					$html2 = str_replace('{desde19}', 'selected', $html2);
					$html2 = str_replace('{desde20}', '', $html2);
				}else if ($fechas[$j]["horainicio"]==20) {
					$html2 = str_replace('{desde6}', '', $html2);
					$html2 = str_replace('{desde7}', '', $html2);
					$html2 = str_replace('{desde8}', '', $html2);
					$html2 = str_replace('{desde9}', '', $html2);
					$html2 = str_replace('{desde10}', '', $html2);
					$html2 = str_replace('{desde11}', '', $html2);
					$html2 = str_replace('{desde12}', '', $html2);
					$html2 = str_replace('{desde13}', '', $html2);
					$html2 = str_replace('{desde14}', '', $html2);
					$html2 = str_replace('{desde15}', '', $html2);
					$html2 = str_replace('{desde16}', '', $html2);
					$html2 = str_replace('{desde17}', '', $html2);
					$html2 = str_replace('{desde18}', '', $html2);
					$html2 = str_replace('{desde19}', '', $html2);
					$html2 = str_replace('{desde20}', 'selected', $html2);
			}

			if ($fechas[$j]["horafin"]==6) {
              		
					$html2 = str_replace('{hasta6}', 'selected', $html2);
					$html2 = str_replace('{hasta7}', '', $html2);
					$html2 = str_replace('{hasta8}', '', $html2);
					$html2 = str_replace('{hasta9}', '', $html2);
					$html2 = str_replace('{hasta10}', '', $html2);
					$html2 = str_replace('{hasta11}', '', $html2);
					$html2 = str_replace('{hasta12}', '', $html2);
					$html2 = str_replace('{hasta13}', '', $html2);
					$html2 = str_replace('{hasta14}', '', $html2);
					$html2 = str_replace('{hasta15}', '', $html2);
					$html2 = str_replace('{hasta16}', '', $html2);
					$html2 = str_replace('{hasta17}', '', $html2);
					$html2 = str_replace('{hasta18}', '', $html2);
					$html2 = str_replace('{hasta19}', '', $html2);
					$html2 = str_replace('{hasta20}', '', $html2);

				}else if ($fechas[$j]["horafin"]==7) {
					$html2 = str_replace('{hasta6}', '', $html2);
					$html2 = str_replace('{hasta7}', 'selected', $html2);
					$html2 = str_replace('{hasta8}', '', $html2);
					$html2 = str_replace('{hasta9}', '', $html2);
					$html2 = str_replace('{hasta10}', '', $html2);
					$html2 = str_replace('{hasta11}', '', $html2);
					$html2 = str_replace('{hasta12}', '', $html2);
					$html2 = str_replace('{hasta13}', '', $html2);
					$html2 = str_replace('{hasta14}', '', $html2);
					$html2 = str_replace('{hasta15}', '', $html2);
					$html2 = str_replace('{hasta16}', '', $html2);
					$html2 = str_replace('{hasta17}', '', $html2);
					$html2 = str_replace('{hasta18}', '', $html2);
					$html2 = str_replace('{hasta19}', '', $html2);
					$html2 = str_replace('{hasta20}', '', $html2);
				}else if ($fechas[$j]["horafin"]==8) {
					$html2 = str_replace('{hasta6}', '', $html2);
					$html2 = str_replace('{hasta7}', '', $html2);
					$html2 = str_replace('{hasta8}', 'selected', $html2);
					$html2 = str_replace('{hasta9}', '', $html2);
					$html2 = str_replace('{hasta10}', '', $html2);
					$html2 = str_replace('{hasta11}', '', $html2);
					$html2 = str_replace('{hasta12}', '', $html2);
					$html2 = str_replace('{hasta13}', '', $html2);
					$html2 = str_replace('{hasta14}', '', $html2);
					$html2 = str_replace('{hasta15}', '', $html2);
					$html2 = str_replace('{hasta16}', '', $html2);
					$html2 = str_replace('{hasta17}', '', $html2);
					$html2 = str_replace('{hasta18}', '', $html2);
					$html2 = str_replace('{hasta19}', '', $html2);
					$html2 = str_replace('{hasta20}', '', $html2);
				}else if ($fechas[$j]["horafin"]==9) {
					$html2 = str_replace('{hasta6}', '', $html2);
					$html2 = str_replace('{hasta7}', '', $html2);
					$html2 = str_replace('{hasta8}', '', $html2);
					$html2 = str_replace('{hasta9}', 'selected', $html2);
					$html2 = str_replace('{hasta10}', '', $html2);
					$html2 = str_replace('{hasta11}', '', $html2);
					$html2 = str_replace('{hasta12}', '', $html2);
					$html2 = str_replace('{hasta13}', '', $html2);
					$html2 = str_replace('{hasta14}', '', $html2);
					$html2 = str_replace('{hasta15}', '', $html2);
					$html2 = str_replace('{hasta16}', '', $html2);
					$html2 = str_replace('{hasta17}', '', $html2);
					$html2 = str_replace('{hasta18}', '', $html2);
					$html2 = str_replace('{hasta19}', '', $html2);
					$html2 = str_replace('{hasta20}', '', $html2);
				}else if ($fechas[$j]["horafin"]==10) {
					$html2 = str_replace('{hasta6}', '', $html2);
					$html2 = str_replace('{hasta7}', '', $html2);
					$html2 = str_replace('{hasta8}', '', $html2);
					$html2 = str_replace('{hasta9}', '', $html2);
					$html2 = str_replace('{hasta10}', 'selected', $html2);
					$html2 = str_replace('{hasta11}', '', $html2);
					$html2 = str_replace('{hasta12}', '', $html2);
					$html2 = str_replace('{hasta13}', '', $html2);
					$html2 = str_replace('{hasta14}', '', $html2);
					$html2 = str_replace('{hasta15}', '', $html2);
					$html2 = str_replace('{hasta16}', '', $html2);
					$html2 = str_replace('{hasta17}', '', $html2);
					$html2 = str_replace('{hasta18}', '', $html2);
					$html2 = str_replace('{hasta19}', '', $html2);
					$html2 = str_replace('{hasta20}', '', $html2);
				}else if ($fechas[$j]["horafin"]==11) {
					$html2 = str_replace('{hasta6}', '', $html2);
					$html2 = str_replace('{hasta7}', '', $html2);
					$html2 = str_replace('{hasta8}', '', $html2);
					$html2 = str_replace('{hasta9}', '', $html2);
					$html2 = str_replace('{hasta10}', '', $html2);
					$html2 = str_replace('{hasta11}', 'selected', $html2);
					$html2 = str_replace('{hasta12}', '', $html2);
					$html2 = str_replace('{hasta13}', '', $html2);
					$html2 = str_replace('{hasta14}', '', $html2);
					$html2 = str_replace('{hasta15}', '', $html2);
					$html2 = str_replace('{hasta16}', '', $html2);
					$html2 = str_replace('{hasta17}', '', $html2);
					$html2 = str_replace('{hasta18}', '', $html2);
					$html2 = str_replace('{hasta19}', '', $html2);
					$html2 = str_replace('{hasta20}', '', $html2);
				}else if ($fechas[$j]["horafin"]==12) {
					$html2 = str_replace('{hasta6}', '', $html2);
					$html2 = str_replace('{hasta7}', '', $html2);
					$html2 = str_replace('{hasta8}', '', $html2);
					$html2 = str_replace('{hasta9}', '', $html2);
					$html2 = str_replace('{hasta10}', '', $html2);
					$html2 = str_replace('{hasta11}', '', $html2);
					$html2 = str_replace('{hasta12}', 'selected', $html2);
					$html2 = str_replace('{hasta13}', '', $html2);
					$html2 = str_replace('{hasta14}', '', $html2);
					$html2 = str_replace('{hasta15}', '', $html2);
					$html2 = str_replace('{hasta16}', '', $html2);
					$html2 = str_replace('{hasta17}', '', $html2);
					$html2 = str_replace('{hasta18}', '', $html2);
					$html2 = str_replace('{hasta19}', '', $html2);
					$html2 = str_replace('{hasta20}', '', $html2);
				}else if ($fechas[$j]["horafin"]==13) {
					$html2 = str_replace('{hasta6}', '', $html2);
					$html2 = str_replace('{hasta7}', '', $html2);
					$html2 = str_replace('{hasta8}', '', $html2);
					$html2 = str_replace('{hasta9}', '', $html2);
					$html2 = str_replace('{hasta10}', '', $html2);
					$html2 = str_replace('{hasta11}', '', $html2);
					$html2 = str_replace('{hasta12}', '', $html2);
					$html2 = str_replace('{hasta13}', 'selected', $html2);
					$html2 = str_replace('{hasta14}', '', $html2);
					$html2 = str_replace('{hasta15}', '', $html2);
					$html2 = str_replace('{hasta16}', '', $html2);
					$html2 = str_replace('{hasta17}', '', $html2);
					$html2 = str_replace('{hasta18}', '', $html2);
					$html2 = str_replace('{hasta19}', '', $html2);
					$html2 = str_replace('{hasta20}', '', $html2);
				}else if ($fechas[$j]["horafin"]==14) {
					$html2 = str_replace('{hasta6}', '', $html2);
					$html2 = str_replace('{hasta7}', '', $html2);
					$html2 = str_replace('{hasta8}', '', $html2);
					$html2 = str_replace('{hasta9}', '', $html2);
					$html2 = str_replace('{hasta10}', '', $html2);
					$html2 = str_replace('{hasta11}', '', $html2);
					$html2 = str_replace('{hasta12}', '', $html2);
					$html2 = str_replace('{hasta13}', '', $html2);
					$html2 = str_replace('{hasta14}', 'selected', $html2);
					$html2 = str_replace('{hasta15}', '', $html2);
					$html2 = str_replace('{hasta16}', '', $html2);
					$html2 = str_replace('{hasta17}', '', $html2);
					$html2 = str_replace('{hasta18}', '', $html2);
					$html2 = str_replace('{hasta19}', '', $html2);
					$html2 = str_replace('{hasta20}', '', $html2);
				}else if ($fechas[$j]["horafin"]==15) {
					$html2 = str_replace('{hasta6}', '', $html2);
					$html2 = str_replace('{hasta7}', '', $html2);
					$html2 = str_replace('{hasta8}', '', $html2);
					$html2 = str_replace('{hasta9}', '', $html2);
					$html2 = str_replace('{hasta10}', '', $html2);
					$html2 = str_replace('{hasta11}', '', $html2);
					$html2 = str_replace('{hasta12}', '', $html2);
					$html2 = str_replace('{hasta13}', '', $html2);
					$html2 = str_replace('{hasta14}', '', $html2);
					$html2 = str_replace('{hasta15}', 'selected', $html2);
					$html2 = str_replace('{hasta16}', '', $html2);
					$html2 = str_replace('{hasta17}', '', $html2);
					$html2 = str_replace('{hasta18}', '', $html2);
					$html2 = str_replace('{hasta19}', '', $html2);
					$html2 = str_replace('{hasta20}', '', $html2);
				}else if ($fechas[$j]["horafin"]==16) {
					$html2 = str_replace('{hasta6}', '', $html2);
					$html2 = str_replace('{hasta7}', '', $html2);
					$html2 = str_replace('{hasta8}', '', $html2);
					$html2 = str_replace('{hasta9}', '', $html2);
					$html2 = str_replace('{hasta10}', '', $html2);
					$html2 = str_replace('{hasta11}', '', $html2);
					$html2 = str_replace('{hasta12}', '', $html2);
					$html2 = str_replace('{hasta13}', '', $html2);
					$html2 = str_replace('{hasta14}', '', $html2);
					$html2 = str_replace('{hasta15}', '', $html2);
					$html2 = str_replace('{hasta16}', 'selected', $html2);
					$html2 = str_replace('{hasta17}', '', $html2);
					$html2 = str_replace('{hasta18}', '', $html2);
					$html2 = str_replace('{hasta19}', '', $html2);
					$html2 = str_replace('{hasta20}', '', $html2);
				}else if ($fechas[$j]["horafin"]==17) {
					$html2 = str_replace('{hasta6}', '', $html2);
					$html2 = str_replace('{hasta7}', '', $html2);
					$html2 = str_replace('{hasta8}', '', $html2);
					$html2 = str_replace('{hasta9}', '', $html2);
					$html2 = str_replace('{hasta10}', '', $html2);
					$html2 = str_replace('{hasta11}', '', $html2);
					$html2 = str_replace('{hasta12}', '', $html2);
					$html2 = str_replace('{hasta13}', '', $html2);
					$html2 = str_replace('{hasta14}', '', $html2);
					$html2 = str_replace('{hasta15}', '', $html2);
					$html2 = str_replace('{hasta16}', '', $html2);
					$html2 = str_replace('{hasta17}', 'selected', $html2);
					$html2 = str_replace('{hasta18}', '', $html2);
					$html2 = str_replace('{hasta19}', '', $html2);
					$html2 = str_replace('{hasta20}', '', $html2);
				}else if ($fechas[$j]["horafin"]==18) {
					$html2 = str_replace('{hasta6}', '', $html2);
					$html2 = str_replace('{hasta7}', '', $html2);
					$html2 = str_replace('{hasta8}', '', $html2);
					$html2 = str_replace('{hasta9}', '', $html2);
					$html2 = str_replace('{hasta10}', '', $html2);
					$html2 = str_replace('{hasta11}', '', $html2);
					$html2 = str_replace('{hasta12}', '', $html2);
					$html2 = str_replace('{hasta13}', '', $html2);
					$html2 = str_replace('{hasta14}', '', $html2);
					$html2 = str_replace('{hasta15}', '', $html2);
					$html2 = str_replace('{hasta16}', '', $html2);
					$html2 = str_replace('{hasta17}', '', $html2);
					$html2 = str_replace('{hasta18}', 'selected', $html2);
					$html2 = str_replace('{hasta19}', '', $html2);
					$html2 = str_replace('{hasta20}', '', $html2);
				}else if ($fechas[$j]["horafin"]==19) {
					$html2 = str_replace('{hasta6}', '', $html2);
					$html2 = str_replace('{hasta7}', '', $html2);
					$html2 = str_replace('{hasta8}', '', $html2);
					$html2 = str_replace('{hasta9}', '', $html2);
					$html2 = str_replace('{hasta10}', '', $html2);
					$html2 = str_replace('{hasta11}', '', $html2);
					$html2 = str_replace('{hasta12}', '', $html2);
					$html2 = str_replace('{hasta13}', '', $html2);
					$html2 = str_replace('{hasta14}', '', $html2);
					$html2 = str_replace('{hasta15}', '', $html2);
					$html2 = str_replace('{hasta16}', '', $html2);
					$html2 = str_replace('{hasta17}', '', $html2);
					$html2 = str_replace('{hasta18}', '', $html2);
					$html2 = str_replace('{hasta19}', 'selected', $html2);
					$html2 = str_replace('{hasta20}', '', $html2);
				}else if ($fechas[$j]["horafin"]==20) {
					$html2 = str_replace('{hasta6}', '', $html2);
					$html2 = str_replace('{hasta7}', '', $html2);
					$html2 = str_replace('{hasta8}', '', $html2);
					$html2 = str_replace('{hasta9}', '', $html2);
					$html2 = str_replace('{hasta10}', '', $html2);
					$html2 = str_replace('{hasta11}', '', $html2);
					$html2 = str_replace('{hasta12}', '', $html2);
					$html2 = str_replace('{hasta13}', '', $html2);
					$html2 = str_replace('{hasta14}', '', $html2);
					$html2 = str_replace('{hasta15}', '', $html2);
					$html2 = str_replace('{hasta16}', '', $html2);
					$html2 = str_replace('{hasta17}', '', $html2);
					$html2 = str_replace('{hasta18}', '', $html2);
					$html2 = str_replace('{hasta19}', '', $html2);
					$html2 = str_replace('{hasta20}', 'selected', $html2);
			}

		}

		$html = str_replace('{fechasyhoras}', $html2, $html);

	foreach ($data as $clave=>$valor) {
		$html = str_replace('{'.$clave.'}', $valor, $html);
	}

	return $html;
}



function hacer_datos_dinamicos($html, $data) {


	foreach ($data as $clave=>$valor) {

		if ($data["est_evento"]=='A') {
			$html = str_replace('{aprobado}', 'selected', $html);
		}
		if ($data["est_evento"]=='E') {
			$html = str_replace('{evaluacion}', 'selected', $html);
		}
		if ($data["est_evento"]=='R') {
			$html = str_replace('{noaprobado}', 'selected', $html);
		}

		if ($data["inversion"]>0) {
			$html = str_replace('{inv}', 'selected', $html);
			$html = str_replace('{si}', '', $html);
		}else{
			$html = str_replace('{si}', 'none', $html);
			$html = str_replace('{libre}', 'selected', $html);
		}

		

    	$modelos = new Models();
		$modelos->buscarDatosPorId("evento_tipo", "id_tipo");
		$tipoeve = $modelos->filas;

		
		$num_tipoeve = count($tipoeve);

		for ($j=0; $j < $num_tipoeve ; $j++) { 
			if ($tipoeve[$j]["id_tipo"]==$data["id_tipo"]) {
				
				$html2 =  "<option value='".$tipoeve[$j]['id_tipo']."'> ".$tipoeve[$j]['des_tipo']."</option>";
			}
		}

		$modelos2 = new Models();
		$modelos2->buscarDatosPorId("evento_publico", "id_publico");
		$tipopub = $modelos2->filas;

		
		$num_tipopub = count($tipopub);

		for ($j=0; $j < $num_tipopub ; $j++) { 
			if ($tipopub[$j]["id_publico"]==$data["id_publico"]) {
				
				$html3 =  "<option value='".$tipopub[$j]['id_publico']."'> ".$tipopub[$j]['des_publico']."</option>";
			}
		}

		$modelos3 = new Models();
		$modelos3->buscarDatosPorId("evento_espacio", "id_espacio");
		$espacios = $modelos3->filas;

		
		$num_espacios = count($espacios);

		for ($j=0; $j < $num_espacios ; $j++) { 
			if ($espacios[$j]["id_espacio"]==$data["id_espacio"]) {
				
				$html4 =  "<option value='".$espacios[$j]['id_espacio']."'> ".$espacios[$j]['des_espacio']."</option>";
			}
		}

		$modelos4 = new Models();
		$modelos4->buscarDatosPorId("evento_area", "id_area");
		$areas = $modelos4->filas;

		
		$num_areas = count($areas);

		for ($j=0; $j < $num_areas ; $j++) { 
			if ($areas[$j]["id_area"]==$data["id_area"]) {
				
				$html5 =  "<option value='".$areas[$j]['id_area']."'> ".$areas[$j]['des_area']."</option>";
			}
		}

		$modelos5 = new Models();
		$modelos5->buscarInfoEvento($data["id_evento"]);
		$fechas = $modelos5->filas;

		

		$num_fechas = count($fechas);

		for ($j=0; $j < $num_fechas ; $j++) { 
			$html6.= '<div class="form-group multiple-form-group" >
                                          <label for="Fecha" class="control-label col-lg-2">Fecha</label>
                                          <div class="col-lg-3">
                                              <input type="date" name="fecha[]" id="fecha[]" class="form-control" value="'.$fechas[$j]["fecha"].'" min="{fechaactual}" required>
                                          </div>

                                          <label class="control-label col-lg-1">&nbsp;&nbsp;Desde</label>

                                            <div class="col-lg-2">
                                               <select class="form-control m-bot15" name="hora_desde[]" id="hora_desde[]"  required>
                                                   <option value =""></option>
                                                    <option value ="6" {desde6}>06:00</option>
                                                    <option value ="7" {desde7}>07:00</option>
                                                    <option value ="8" {desde8}>08:00</option>
                                                    <option value ="9" {desde9}>09:00</option>
                                                    <option value ="10" {desde10}>10:00</option>
                                                    <option value ="11" {desde11}>11:00</option>
                                                    <option value ="12" {desde12}>12:00</option>
                                                    <option value ="13" {desde13}>13:00</option>
                                                    <option value ="14" {desde14}>14:00</option>
                                                    <option value ="15" {desde15}>15:00</option>
                                                    <option value ="16" {desde16}>16:00</option>
                                                    <option value ="17" {desde17}>17:00</option>
                                                    <option value ="18" {desde18}>18:00</option>
                                                    <option value ="19" {desde19}>19:00</option>
                                                    <option value ="20" {desde20}>20:00</option>
                                              
                                             </select>
                                            </div>

                                             <label class="control-label col-lg-1">&nbsp;&nbsp;Hasta</label>

                                            <div class="col-lg-2">
                                               <select class="form-control m-bot15" name="hora_hasta[]" id="hora_hasta[]"  required>
                                                   <option value =""></option>
                                                    <option value ="6" {hasta6}>06:00</option>
                                                    <option value ="7" {hasta7}>07:00</option>
                                                    <option value ="8" {hasta8}>08:00</option>
                                                    <option value ="9" {hasta9}>09:00</option>
                                                    <option value ="10"{hasta10}>10:00</option>
                                                    <option value ="11"{hasta11}>11:00</option>
                                                    <option value ="12"{hasta12}>12:00</option>
                                                    <option value ="13"{hasta13}>13:00</option>
                                                    <option value ="14"{hasta14}>14:00</option>
                                                    <option value ="15"{hasta15}>15:00</option>
                                                    <option value ="16"{hasta16}>16:00</option>
                                                    <option value ="17"{hasta17}>17:00</option>
                                                    <option value ="18"{hasta18}>18:00</option>
                                                    <option value ="19"{hasta19}>19:00</option>
                                                    <option value ="20"{hasta20}>20:00</option>
                                              
                                             </select>
                                            </div>



                                           <span class="input-group-btn"><button type="button" class="btn btn-default btn-add">+
                                              </button></span>
                                      </div>';



              if ($fechas[$j]["horainicio"]==6) {
              		
					$html6 = str_replace('{desde6}', 'selected', $html6);
					$html6 = str_replace('{desde7}', '', $html6);
					$html6 = str_replace('{desde8}', '', $html6);
					$html6 = str_replace('{desde9}', '', $html6);
					$html6 = str_replace('{desde10}', '', $html6);
					$html6 = str_replace('{desde11}', '', $html6);
					$html6 = str_replace('{desde12}', '', $html6);
					$html6 = str_replace('{desde13}', '', $html6);
					$html6 = str_replace('{desde14}', '', $html6);
					$html6 = str_replace('{desde15}', '', $html6);
					$html6 = str_replace('{desde16}', '', $html6);
					$html6 = str_replace('{desde17}', '', $html6);
					$html6 = str_replace('{desde18}', '', $html6);
					$html6 = str_replace('{desde19}', '', $html6);
					$html6 = str_replace('{desde20}', '', $html6);

				}else if ($fechas[$j]["horainicio"]==7) {
					$html6 = str_replace('{desde6}', '', $html6);
					$html6 = str_replace('{desde7}', 'selected', $html6);
					$html6 = str_replace('{desde8}', '', $html6);
					$html6 = str_replace('{desde9}', '', $html6);
					$html6 = str_replace('{desde10}', '', $html6);
					$html6 = str_replace('{desde11}', '', $html6);
					$html6 = str_replace('{desde12}', '', $html6);
					$html6 = str_replace('{desde13}', '', $html6);
					$html6 = str_replace('{desde14}', '', $html6);
					$html6 = str_replace('{desde15}', '', $html6);
					$html6 = str_replace('{desde16}', '', $html6);
					$html6 = str_replace('{desde17}', '', $html6);
					$html6 = str_replace('{desde18}', '', $html6);
					$html6 = str_replace('{desde19}', '', $html6);
					$html6 = str_replace('{desde20}', '', $html6);
				}else if ($fechas[$j]["horainicio"]==8) {
					$html6 = str_replace('{desde6}', '', $html6);
					$html6 = str_replace('{desde7}', '', $html6);
					$html6 = str_replace('{desde8}', 'selected', $html6);
					$html6 = str_replace('{desde9}', '', $html6);
					$html6 = str_replace('{desde10}', '', $html6);
					$html6 = str_replace('{desde11}', '', $html6);
					$html6 = str_replace('{desde12}', '', $html6);
					$html6 = str_replace('{desde13}', '', $html6);
					$html6 = str_replace('{desde14}', '', $html6);
					$html6 = str_replace('{desde15}', '', $html6);
					$html6 = str_replace('{desde16}', '', $html6);
					$html6 = str_replace('{desde17}', '', $html6);
					$html6 = str_replace('{desde18}', '', $html6);
					$html6 = str_replace('{desde19}', '', $html6);
					$html6 = str_replace('{desde20}', '', $html6);
				}else if ($fechas[$j]["horainicio"]==9) {
					$html6 = str_replace('{desde6}', '', $html6);
					$html6 = str_replace('{desde7}', '', $html6);
					$html6 = str_replace('{desde8}', '', $html6);
					$html6 = str_replace('{desde9}', 'selected', $html6);
					$html6 = str_replace('{desde10}', '', $html6);
					$html6 = str_replace('{desde11}', '', $html6);
					$html6 = str_replace('{desde12}', '', $html6);
					$html6 = str_replace('{desde13}', '', $html6);
					$html6 = str_replace('{desde14}', '', $html6);
					$html6 = str_replace('{desde15}', '', $html6);
					$html6 = str_replace('{desde16}', '', $html6);
					$html6 = str_replace('{desde17}', '', $html6);
					$html6 = str_replace('{desde18}', '', $html6);
					$html6 = str_replace('{desde19}', '', $html6);
					$html6 = str_replace('{desde20}', '', $html6);
				}else if ($fechas[$j]["horainicio"]==10) {
					$html6 = str_replace('{desde6}', '', $html6);
					$html6 = str_replace('{desde7}', '', $html6);
					$html6 = str_replace('{desde8}', '', $html6);
					$html6 = str_replace('{desde9}', '', $html6);
					$html6 = str_replace('{desde10}', 'selected', $html6);
					$html6 = str_replace('{desde11}', '', $html6);
					$html6 = str_replace('{desde12}', '', $html6);
					$html6 = str_replace('{desde13}', '', $html6);
					$html6 = str_replace('{desde14}', '', $html6);
					$html6 = str_replace('{desde15}', '', $html6);
					$html6 = str_replace('{desde16}', '', $html6);
					$html6 = str_replace('{desde17}', '', $html6);
					$html6 = str_replace('{desde18}', '', $html6);
					$html6 = str_replace('{desde19}', '', $html6);
					$html6 = str_replace('{desde20}', '', $html6);
				}else if ($fechas[$j]["horainicio"]==11) {
					$html6 = str_replace('{desde6}', '', $html6);
					$html6 = str_replace('{desde7}', '', $html6);
					$html6 = str_replace('{desde8}', '', $html6);
					$html6 = str_replace('{desde9}', '', $html6);
					$html6 = str_replace('{desde10}', '', $html6);
					$html6 = str_replace('{desde11}', 'selected', $html6);
					$html6 = str_replace('{desde12}', '', $html6);
					$html6 = str_replace('{desde13}', '', $html6);
					$html6 = str_replace('{desde14}', '', $html6);
					$html6 = str_replace('{desde15}', '', $html6);
					$html6 = str_replace('{desde16}', '', $html6);
					$html6 = str_replace('{desde17}', '', $html6);
					$html6 = str_replace('{desde18}', '', $html6);
					$html6 = str_replace('{desde19}', '', $html6);
					$html6 = str_replace('{desde20}', '', $html6);
				}else if ($fechas[$j]["horainicio"]==12) {
					$html6 = str_replace('{desde6}', '', $html6);
					$html6 = str_replace('{desde7}', '', $html6);
					$html6 = str_replace('{desde8}', '', $html6);
					$html6 = str_replace('{desde9}', '', $html6);
					$html6 = str_replace('{desde10}', '', $html6);
					$html6 = str_replace('{desde11}', '', $html6);
					$html6 = str_replace('{desde12}', 'selected', $html6);
					$html6 = str_replace('{desde13}', '', $html6);
					$html6 = str_replace('{desde14}', '', $html6);
					$html6 = str_replace('{desde15}', '', $html6);
					$html6 = str_replace('{desde16}', '', $html6);
					$html6 = str_replace('{desde17}', '', $html6);
					$html6 = str_replace('{desde18}', '', $html6);
					$html6 = str_replace('{desde19}', '', $html6);
					$html6 = str_replace('{desde20}', '', $html6);
				}else if ($fechas[$j]["horainicio"]==13) {
					$html6 = str_replace('{desde6}', '', $html6);
					$html6 = str_replace('{desde7}', '', $html6);
					$html6 = str_replace('{desde8}', '', $html6);
					$html6 = str_replace('{desde9}', '', $html6);
					$html6 = str_replace('{desde10}', '', $html6);
					$html6 = str_replace('{desde11}', '', $html6);
					$html6 = str_replace('{desde12}', '', $html6);
					$html6 = str_replace('{desde13}', 'selected', $html6);
					$html6 = str_replace('{desde14}', '', $html6);
					$html6 = str_replace('{desde15}', '', $html6);
					$html6 = str_replace('{desde16}', '', $html6);
					$html6 = str_replace('{desde17}', '', $html6);
					$html6 = str_replace('{desde18}', '', $html6);
					$html6 = str_replace('{desde19}', '', $html6);
					$html6 = str_replace('{desde20}', '', $html6);
				}else if ($fechas[$j]["horainicio"]==14) {
					$html6 = str_replace('{desde6}', '', $html6);
					$html6 = str_replace('{desde7}', '', $html6);
					$html6 = str_replace('{desde8}', '', $html6);
					$html6 = str_replace('{desde9}', '', $html6);
					$html6 = str_replace('{desde10}', '', $html6);
					$html6 = str_replace('{desde11}', '', $html6);
					$html6 = str_replace('{desde12}', '', $html6);
					$html6 = str_replace('{desde13}', '', $html6);
					$html6 = str_replace('{desde14}', 'selected', $html6);
					$html6 = str_replace('{desde15}', '', $html6);
					$html6 = str_replace('{desde16}', '', $html6);
					$html6 = str_replace('{desde17}', '', $html6);
					$html6 = str_replace('{desde18}', '', $html6);
					$html6 = str_replace('{desde19}', '', $html6);
					$html6 = str_replace('{desde20}', '', $html6);
				}else if ($fechas[$j]["horainicio"]==15) {
					$html6 = str_replace('{desde6}', '', $html6);
					$html6 = str_replace('{desde7}', '', $html6);
					$html6 = str_replace('{desde8}', '', $html6);
					$html6 = str_replace('{desde9}', '', $html6);
					$html6 = str_replace('{desde10}', '', $html6);
					$html6 = str_replace('{desde11}', '', $html6);
					$html6 = str_replace('{desde12}', '', $html6);
					$html6 = str_replace('{desde13}', '', $html6);
					$html6 = str_replace('{desde14}', '', $html6);
					$html6 = str_replace('{desde15}', 'selected', $html6);
					$html6 = str_replace('{desde16}', '', $html6);
					$html6 = str_replace('{desde17}', '', $html6);
					$html6 = str_replace('{desde18}', '', $html6);
					$html6 = str_replace('{desde19}', '', $html6);
					$html6 = str_replace('{desde20}', '', $html6);
				}else if ($fechas[$j]["horainicio"]==16) {
					$html6 = str_replace('{desde6}', '', $html6);
					$html6 = str_replace('{desde7}', '', $html6);
					$html6 = str_replace('{desde8}', '', $html6);
					$html6 = str_replace('{desde9}', '', $html6);
					$html6 = str_replace('{desde10}', '', $html6);
					$html6 = str_replace('{desde11}', '', $html6);
					$html6 = str_replace('{desde12}', '', $html6);
					$html6 = str_replace('{desde13}', '', $html6);
					$html6 = str_replace('{desde14}', '', $html6);
					$html6 = str_replace('{desde15}', '', $html6);
					$html6 = str_replace('{desde16}', 'selected', $html6);
					$html6 = str_replace('{desde17}', '', $html6);
					$html6 = str_replace('{desde18}', '', $html6);
					$html6 = str_replace('{desde19}', '', $html6);
					$html6 = str_replace('{desde20}', '', $html6);
				}else if ($fechas[$j]["horainicio"]==17) {
					$html6 = str_replace('{desde6}', '', $html6);
					$html6 = str_replace('{desde7}', '', $html6);
					$html6 = str_replace('{desde8}', '', $html6);
					$html6 = str_replace('{desde9}', '', $html6);
					$html6 = str_replace('{desde10}', '', $html6);
					$html6 = str_replace('{desde11}', '', $html6);
					$html6 = str_replace('{desde12}', '', $html6);
					$html6 = str_replace('{desde13}', '', $html6);
					$html6 = str_replace('{desde14}', '', $html6);
					$html6 = str_replace('{desde15}', '', $html6);
					$html6 = str_replace('{desde16}', '', $html6);
					$html6 = str_replace('{desde17}', 'selected', $html6);
					$html6 = str_replace('{desde18}', '', $html6);
					$html6 = str_replace('{desde19}', '', $html6);
					$html6 = str_replace('{desde20}', '', $html6);
				}else if ($fechas[$j]["horainicio"]==18) {
					$html6 = str_replace('{desde6}', '', $html6);
					$html6 = str_replace('{desde7}', '', $html6);
					$html6 = str_replace('{desde8}', '', $html6);
					$html6 = str_replace('{desde9}', '', $html6);
					$html6 = str_replace('{desde10}', '', $html6);
					$html6 = str_replace('{desde11}', '', $html6);
					$html6 = str_replace('{desde12}', '', $html6);
					$html6 = str_replace('{desde13}', '', $html6);
					$html6 = str_replace('{desde14}', '', $html6);
					$html6 = str_replace('{desde15}', '', $html6);
					$html6 = str_replace('{desde16}', '', $html6);
					$html6 = str_replace('{desde17}', '', $html6);
					$html6 = str_replace('{desde18}', 'selected', $html6);
					$html6 = str_replace('{desde19}', '', $html6);
					$html6 = str_replace('{desde20}', '', $html6);
				}else if ($fechas[$j]["horainicio"]==19) {
					$html6 = str_replace('{desde6}', '', $html6);
					$html6 = str_replace('{desde7}', '', $html6);
					$html6 = str_replace('{desde8}', '', $html6);
					$html6 = str_replace('{desde9}', '', $html6);
					$html6 = str_replace('{desde10}', '', $html6);
					$html6 = str_replace('{desde11}', '', $html6);
					$html6 = str_replace('{desde12}', '', $html6);
					$html6 = str_replace('{desde13}', '', $html6);
					$html6 = str_replace('{desde14}', '', $html6);
					$html6 = str_replace('{desde15}', '', $html6);
					$html6 = str_replace('{desde16}', '', $html6);
					$html6 = str_replace('{desde17}', '', $html6);
					$html6 = str_replace('{desde18}', '', $html6);
					$html6 = str_replace('{desde19}', 'selected', $html6);
					$html6 = str_replace('{desde20}', '', $html6);
				}else if ($fechas[$j]["horainicio"]==20) {
					$html6 = str_replace('{desde6}', '', $html6);
					$html6 = str_replace('{desde7}', '', $html6);
					$html6 = str_replace('{desde8}', '', $html6);
					$html6 = str_replace('{desde9}', '', $html6);
					$html6 = str_replace('{desde10}', '', $html6);
					$html6 = str_replace('{desde11}', '', $html6);
					$html6 = str_replace('{desde12}', '', $html6);
					$html6 = str_replace('{desde13}', '', $html6);
					$html6 = str_replace('{desde14}', '', $html6);
					$html6 = str_replace('{desde15}', '', $html6);
					$html6 = str_replace('{desde16}', '', $html6);
					$html6 = str_replace('{desde17}', '', $html6);
					$html6 = str_replace('{desde18}', '', $html6);
					$html6 = str_replace('{desde19}', '', $html6);
					$html6 = str_replace('{desde20}', 'selected', $html6);
			}

			if ($fechas[$j]["horafin"]==6) {
              		
					$html6 = str_replace('{hasta6}', 'selected', $html6);
					$html6 = str_replace('{hasta7}', '', $html6);
					$html6 = str_replace('{hasta8}', '', $html6);
					$html6 = str_replace('{hasta9}', '', $html6);
					$html6 = str_replace('{hasta10}', '', $html6);
					$html6 = str_replace('{hasta11}', '', $html6);
					$html6 = str_replace('{hasta12}', '', $html6);
					$html6 = str_replace('{hasta13}', '', $html6);
					$html6 = str_replace('{hasta14}', '', $html6);
					$html6 = str_replace('{hasta15}', '', $html6);
					$html6 = str_replace('{hasta16}', '', $html6);
					$html6 = str_replace('{hasta17}', '', $html6);
					$html6 = str_replace('{hasta18}', '', $html6);
					$html6 = str_replace('{hasta19}', '', $html6);
					$html6 = str_replace('{hasta20}', '', $html6);

				}else if ($fechas[$j]["horafin"]==7) {
					$html6 = str_replace('{hasta6}', '', $html6);
					$html6 = str_replace('{hasta7}', 'selected', $html6);
					$html6 = str_replace('{hasta8}', '', $html6);
					$html6 = str_replace('{hasta9}', '', $html6);
					$html6 = str_replace('{hasta10}', '', $html6);
					$html6 = str_replace('{hasta11}', '', $html6);
					$html6 = str_replace('{hasta12}', '', $html6);
					$html6 = str_replace('{hasta13}', '', $html6);
					$html6 = str_replace('{hasta14}', '', $html6);
					$html6 = str_replace('{hasta15}', '', $html6);
					$html6 = str_replace('{hasta16}', '', $html6);
					$html6 = str_replace('{hasta17}', '', $html6);
					$html6 = str_replace('{hasta18}', '', $html6);
					$html6 = str_replace('{hasta19}', '', $html6);
					$html6 = str_replace('{hasta20}', '', $html6);
				}else if ($fechas[$j]["horafin"]==8) {
					$html6 = str_replace('{hasta6}', '', $html6);
					$html6 = str_replace('{hasta7}', '', $html6);
					$html6 = str_replace('{hasta8}', 'selected', $html6);
					$html6 = str_replace('{hasta9}', '', $html6);
					$html6 = str_replace('{hasta10}', '', $html6);
					$html6 = str_replace('{hasta11}', '', $html6);
					$html6 = str_replace('{hasta12}', '', $html6);
					$html6 = str_replace('{hasta13}', '', $html6);
					$html6 = str_replace('{hasta14}', '', $html6);
					$html6 = str_replace('{hasta15}', '', $html6);
					$html6 = str_replace('{hasta16}', '', $html6);
					$html6 = str_replace('{hasta17}', '', $html6);
					$html6 = str_replace('{hasta18}', '', $html6);
					$html6 = str_replace('{hasta19}', '', $html6);
					$html6 = str_replace('{hasta20}', '', $html6);
				}else if ($fechas[$j]["horafin"]==9) {
					$html6 = str_replace('{hasta6}', '', $html6);
					$html6 = str_replace('{hasta7}', '', $html6);
					$html6 = str_replace('{hasta8}', '', $html6);
					$html6 = str_replace('{hasta9}', 'selected', $html6);
					$html6 = str_replace('{hasta10}', '', $html6);
					$html6 = str_replace('{hasta11}', '', $html6);
					$html6 = str_replace('{hasta12}', '', $html6);
					$html6 = str_replace('{hasta13}', '', $html6);
					$html6 = str_replace('{hasta14}', '', $html6);
					$html6 = str_replace('{hasta15}', '', $html6);
					$html6 = str_replace('{hasta16}', '', $html6);
					$html6 = str_replace('{hasta17}', '', $html6);
					$html6 = str_replace('{hasta18}', '', $html6);
					$html6 = str_replace('{hasta19}', '', $html6);
					$html6 = str_replace('{hasta20}', '', $html6);
				}else if ($fechas[$j]["horafin"]==10) {
					$html6 = str_replace('{hasta6}', '', $html6);
					$html6 = str_replace('{hasta7}', '', $html6);
					$html6 = str_replace('{hasta8}', '', $html6);
					$html6 = str_replace('{hasta9}', '', $html6);
					$html6 = str_replace('{hasta10}', 'selected', $html6);
					$html6 = str_replace('{hasta11}', '', $html6);
					$html6 = str_replace('{hasta12}', '', $html6);
					$html6 = str_replace('{hasta13}', '', $html6);
					$html6 = str_replace('{hasta14}', '', $html6);
					$html6 = str_replace('{hasta15}', '', $html6);
					$html6 = str_replace('{hasta16}', '', $html6);
					$html6 = str_replace('{hasta17}', '', $html6);
					$html6 = str_replace('{hasta18}', '', $html6);
					$html6 = str_replace('{hasta19}', '', $html6);
					$html6 = str_replace('{hasta20}', '', $html6);
				}else if ($fechas[$j]["horafin"]==11) {
					$html6 = str_replace('{hasta6}', '', $html6);
					$html6 = str_replace('{hasta7}', '', $html6);
					$html6 = str_replace('{hasta8}', '', $html6);
					$html6 = str_replace('{hasta9}', '', $html6);
					$html6 = str_replace('{hasta10}', '', $html6);
					$html6 = str_replace('{hasta11}', 'selected', $html6);
					$html6 = str_replace('{hasta12}', '', $html6);
					$html6 = str_replace('{hasta13}', '', $html6);
					$html6 = str_replace('{hasta14}', '', $html6);
					$html6 = str_replace('{hasta15}', '', $html6);
					$html6 = str_replace('{hasta16}', '', $html6);
					$html6 = str_replace('{hasta17}', '', $html6);
					$html6 = str_replace('{hasta18}', '', $html6);
					$html6 = str_replace('{hasta19}', '', $html6);
					$html6 = str_replace('{hasta20}', '', $html6);
				}else if ($fechas[$j]["horafin"]==12) {
					$html6 = str_replace('{hasta6}', '', $html6);
					$html6 = str_replace('{hasta7}', '', $html6);
					$html6 = str_replace('{hasta8}', '', $html6);
					$html6 = str_replace('{hasta9}', '', $html6);
					$html6 = str_replace('{hasta10}', '', $html6);
					$html6 = str_replace('{hasta11}', '', $html6);
					$html6 = str_replace('{hasta12}', 'selected', $html6);
					$html6 = str_replace('{hasta13}', '', $html6);
					$html6 = str_replace('{hasta14}', '', $html6);
					$html6 = str_replace('{hasta15}', '', $html6);
					$html6 = str_replace('{hasta16}', '', $html6);
					$html6 = str_replace('{hasta17}', '', $html6);
					$html6 = str_replace('{hasta18}', '', $html6);
					$html6 = str_replace('{hasta19}', '', $html6);
					$html6 = str_replace('{hasta20}', '', $html6);
				}else if ($fechas[$j]["horafin"]==13) {
					$html6 = str_replace('{hasta6}', '', $html6);
					$html6 = str_replace('{hasta7}', '', $html6);
					$html6 = str_replace('{hasta8}', '', $html6);
					$html6 = str_replace('{hasta9}', '', $html6);
					$html6 = str_replace('{hasta10}', '', $html6);
					$html6 = str_replace('{hasta11}', '', $html6);
					$html6 = str_replace('{hasta12}', '', $html6);
					$html6 = str_replace('{hasta13}', 'selected', $html6);
					$html6 = str_replace('{hasta14}', '', $html6);
					$html6 = str_replace('{hasta15}', '', $html6);
					$html6 = str_replace('{hasta16}', '', $html6);
					$html6 = str_replace('{hasta17}', '', $html6);
					$html6 = str_replace('{hasta18}', '', $html6);
					$html6 = str_replace('{hasta19}', '', $html6);
					$html6 = str_replace('{hasta20}', '', $html6);
				}else if ($fechas[$j]["horafin"]==14) {
					$html6 = str_replace('{hasta6}', '', $html6);
					$html6 = str_replace('{hasta7}', '', $html6);
					$html6 = str_replace('{hasta8}', '', $html6);
					$html6 = str_replace('{hasta9}', '', $html6);
					$html6 = str_replace('{hasta10}', '', $html6);
					$html6 = str_replace('{hasta11}', '', $html6);
					$html6 = str_replace('{hasta12}', '', $html6);
					$html6 = str_replace('{hasta13}', '', $html6);
					$html6 = str_replace('{hasta14}', 'selected', $html6);
					$html6 = str_replace('{hasta15}', '', $html6);
					$html6 = str_replace('{hasta16}', '', $html6);
					$html6 = str_replace('{hasta17}', '', $html6);
					$html6 = str_replace('{hasta18}', '', $html6);
					$html6 = str_replace('{hasta19}', '', $html6);
					$html6 = str_replace('{hasta20}', '', $html6);
				}else if ($fechas[$j]["horafin"]==15) {
					$html6 = str_replace('{hasta6}', '', $html6);
					$html6 = str_replace('{hasta7}', '', $html6);
					$html6 = str_replace('{hasta8}', '', $html6);
					$html6 = str_replace('{hasta9}', '', $html6);
					$html6 = str_replace('{hasta10}', '', $html6);
					$html6 = str_replace('{hasta11}', '', $html6);
					$html6 = str_replace('{hasta12}', '', $html6);
					$html6 = str_replace('{hasta13}', '', $html6);
					$html6 = str_replace('{hasta14}', '', $html6);
					$html6 = str_replace('{hasta15}', 'selected', $html6);
					$html6 = str_replace('{hasta16}', '', $html6);
					$html6 = str_replace('{hasta17}', '', $html6);
					$html6 = str_replace('{hasta18}', '', $html6);
					$html6 = str_replace('{hasta19}', '', $html6);
					$html6 = str_replace('{hasta20}', '', $html6);
				}else if ($fechas[$j]["horafin"]==16) {
					$html6 = str_replace('{hasta6}', '', $html6);
					$html6 = str_replace('{hasta7}', '', $html6);
					$html6 = str_replace('{hasta8}', '', $html6);
					$html6 = str_replace('{hasta9}', '', $html6);
					$html6 = str_replace('{hasta10}', '', $html6);
					$html6 = str_replace('{hasta11}', '', $html6);
					$html6 = str_replace('{hasta12}', '', $html6);
					$html6 = str_replace('{hasta13}', '', $html6);
					$html6 = str_replace('{hasta14}', '', $html6);
					$html6 = str_replace('{hasta15}', '', $html6);
					$html6 = str_replace('{hasta16}', 'selected', $html6);
					$html6 = str_replace('{hasta17}', '', $html6);
					$html6 = str_replace('{hasta18}', '', $html6);
					$html6 = str_replace('{hasta19}', '', $html6);
					$html6 = str_replace('{hasta20}', '', $html6);
				}else if ($fechas[$j]["horafin"]==17) {
					$html6 = str_replace('{hasta6}', '', $html6);
					$html6 = str_replace('{hasta7}', '', $html6);
					$html6 = str_replace('{hasta8}', '', $html6);
					$html6 = str_replace('{hasta9}', '', $html6);
					$html6 = str_replace('{hasta10}', '', $html6);
					$html6 = str_replace('{hasta11}', '', $html6);
					$html6 = str_replace('{hasta12}', '', $html6);
					$html6 = str_replace('{hasta13}', '', $html6);
					$html6 = str_replace('{hasta14}', '', $html6);
					$html6 = str_replace('{hasta15}', '', $html6);
					$html6 = str_replace('{hasta16}', '', $html6);
					$html6 = str_replace('{hasta17}', 'selected', $html6);
					$html6 = str_replace('{hasta18}', '', $html6);
					$html6 = str_replace('{hasta19}', '', $html6);
					$html6 = str_replace('{hasta20}', '', $html6);
				}else if ($fechas[$j]["horafin"]==18) {
					$html6 = str_replace('{hasta6}', '', $html6);
					$html6 = str_replace('{hasta7}', '', $html6);
					$html6 = str_replace('{hasta8}', '', $html6);
					$html6 = str_replace('{hasta9}', '', $html6);
					$html6 = str_replace('{hasta10}', '', $html6);
					$html6 = str_replace('{hasta11}', '', $html6);
					$html6 = str_replace('{hasta12}', '', $html6);
					$html6 = str_replace('{hasta13}', '', $html6);
					$html6 = str_replace('{hasta14}', '', $html6);
					$html6 = str_replace('{hasta15}', '', $html6);
					$html6 = str_replace('{hasta16}', '', $html6);
					$html6 = str_replace('{hasta17}', '', $html6);
					$html6 = str_replace('{hasta18}', 'selected', $html6);
					$html6 = str_replace('{hasta19}', '', $html6);
					$html6 = str_replace('{hasta20}', '', $html6);
				}else if ($fechas[$j]["horafin"]==19) {
					$html6 = str_replace('{hasta6}', '', $html6);
					$html6 = str_replace('{hasta7}', '', $html6);
					$html6 = str_replace('{hasta8}', '', $html6);
					$html6 = str_replace('{hasta9}', '', $html6);
					$html6 = str_replace('{hasta10}', '', $html6);
					$html6 = str_replace('{hasta11}', '', $html6);
					$html6 = str_replace('{hasta12}', '', $html6);
					$html6 = str_replace('{hasta13}', '', $html6);
					$html6 = str_replace('{hasta14}', '', $html6);
					$html6 = str_replace('{hasta15}', '', $html6);
					$html6 = str_replace('{hasta16}', '', $html6);
					$html6 = str_replace('{hasta17}', '', $html6);
					$html6 = str_replace('{hasta18}', '', $html6);
					$html6 = str_replace('{hasta19}', 'selected', $html6);
					$html6 = str_replace('{hasta20}', '', $html6);
				}else if ($fechas[$j]["horafin"]==20) {
					$html6 = str_replace('{hasta6}', '', $html6);
					$html6 = str_replace('{hasta7}', '', $html6);
					$html6 = str_replace('{hasta8}', '', $html6);
					$html6 = str_replace('{hasta9}', '', $html6);
					$html6 = str_replace('{hasta10}', '', $html6);
					$html6 = str_replace('{hasta11}', '', $html6);
					$html6 = str_replace('{hasta12}', '', $html6);
					$html6 = str_replace('{hasta13}', '', $html6);
					$html6 = str_replace('{hasta14}', '', $html6);
					$html6 = str_replace('{hasta15}', '', $html6);
					$html6 = str_replace('{hasta16}', '', $html6);
					$html6 = str_replace('{hasta17}', '', $html6);
					$html6 = str_replace('{hasta18}', '', $html6);
					$html6 = str_replace('{hasta19}', '', $html6);
					$html6 = str_replace('{hasta20}', 'selected', $html6);
			}


			

		}



    	
    	
    	$html = str_replace('{tipoeveactual}', $html2, $html);
    	$html = str_replace('{tipopubactual}', $html3, $html);
    	$html = str_replace('{espacioactual}', $html4, $html);
    	$html = str_replace('{areaactual}', $html5	, $html);
    	$html = str_replace('{dias}', $html6, $html);



		$html = str_replace('{'.$clave.'}', $valor, $html);
	}

	return $html;
}

function llenar_select_tipoeve($html, $datos_select_tipoeve){


	$num_filas = count($datos_select_tipoeve);

	for ($i=0; $i < $num_filas ; $i++) { 
		$html2 .= "<option value='".$datos_select_tipoeve[$i]['id_tipo']."'> ".$datos_select_tipoeve[$i]['des_tipo']."</option>";
	}

	$html = str_replace('{tipoeventos}', $html2, $html);

	return $html;
}

function llenar_select_tipopub($html, $datos_select_tipopub){


	$num_filas = count($datos_select_tipopub);

	for ($i=0; $i < $num_filas ; $i++) { 
		$html2 .= "<option value='".$datos_select_tipopub[$i]['id_publico']."'> ".$datos_select_tipopub[$i]['des_publico']."</option>";
	}

	$html = str_replace('{tipopublicos}', $html2, $html);

	return $html;
}

function llenar_select_areas($html, $datos_select_areas){


	$num_filas = count($datos_select_areas);
	$html2.="<option value=''></option>";
	for ($i=0; $i < $num_filas ; $i++) { 
		$html2 .= "<option value='".$datos_select_areas[$i]['id_area']."'> ".$datos_select_areas[$i]['des_area']."</option>";
	}

	$html = str_replace('{areas}', $html2, $html);

	return $html;
}

function llenar_select_espacios($html, $datos_select_espacios){


	$num_filas = count($datos_select_espacios);

	for ($i=0; $i < $num_filas ; $i++) { 
		$html2 .= "<option value='".$datos_select_espacios[$i]['id_espacio']."'> ".$datos_select_espacios[$i]['des_espacio']."</option>";
	}

	$html = str_replace('{espacios}', $html2, $html);

	return $html;
}






function retornar_vista($vista, $data = array(), $parametros = array(), $datos_select_tipoeve, $datos_select_tipopub, $datos_select_areas, $datos_select_espacios) {

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
	$fechaactual = date('Y-m-d');
	$html = str_replace('{contenido}',  buscar_plantilla('registrar','eventos'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	$html = llenar_select_tipoeve($html, $datos_select_tipoeve);
	$html = llenar_select_tipopub($html, $datos_select_tipopub);
	$html = llenar_select_areas($html, $datos_select_areas);
	$html = llenar_select_espacios($html, $datos_select_espacios);
	$html = str_replace('{fechaactual}', $fechaactual, $html);


}

if ($vista=='verdatos'){
	$html = str_replace('{contenido}',  buscar_plantilla('verdatos','eventos'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	$html = llenar_tabla($html, $data);
}

if ($vista=='detalleEvento'){
	$html = str_replace('{contenido}',  buscar_plantilla('detalleEvento','eventos'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	$html = hacer_datos_dinamicos2($html, $data);
}

if ($vista=='modificar'){
	$html = str_replace('{contenido}',  buscar_plantilla('modificar','eventos'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	$html = hacer_datos_dinamicos($html, $data);
	$html = llenar_select_tipoeve($html, $datos_select_tipoeve);
	$html = llenar_select_tipopub($html, $datos_select_tipopub);
	$html = llenar_select_areas($html, $datos_select_areas);
	$html = llenar_select_espacios($html, $datos_select_espacios);
	$fechaactual = date('Y-m-d');
	$html = str_replace('{fechaactual}', $fechaactual, $html);
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
