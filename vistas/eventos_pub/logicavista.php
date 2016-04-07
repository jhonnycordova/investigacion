<?php
session_start();

require('../core/logica.php');
require('../core/models.php');


$diccionario = array('titulos'=>array('verEventos'=>'Eventos'));

function llenar_eventos($html, $data){

	$num_filas = count($data);

	for ($i=0; $i < $num_filas ; $i++) {
		$html2 .= '<div class="col-xs-12  col-sm-12 col-md-12 col-lg-12">
                                        <ul class="event-list">
                                          

                                          <li class="col-lg-12">
                                            <time datetime="2014-07-20 0000" style="background-color:rgb(36, 166, 62)">
                                              <span class="accion" style="display:{unafecha}">Inicia</span>
                                              <span class="day">{diainicio}</span>
                                              <span class="month">{mesinicio}</span>
                                              <span class="time" style="display:{unafecha}" >{desde}</span>
                                            </time>
                                             <time datetime="2014-07-20 0000" style="background-color:rgb(220, 84, 105);display:{unafecha}">
                                              <span class="accion">Finaliza</span>
                                              <span class="day">{diafin}</span>
                                              <span class="month">{mesfin}</span>
                                              <span class="time">{hasta}</span>
                                            </time>
                                            <div class="info" >
                                              <h2 class="title" >{nom_evento}</h2>
                                              <p class="desc"> {tipopublico}</p>
                                              <p class="desc" style="display:{dosfechas}"> Desde: {desde}, Hasta: {hasta}</p>
                                              <ul>
                                                <li style="width:50%;"><a href="#website"><span class="fa fa-globe"></span> {tipoevento}</a></li>
                                                <li style="width:50%;">{participacion}</li>
                                              </ul>
                                            </div>
                                            
                                          </li>

                                          
                                        </ul>
                                      </div>';

        
        if ($data[$i]["fechainicio"] == $data[$i]["fechafin"]) {

        	$html2 = str_replace('{unafecha}', 'none', $html2);
        	$html2 = str_replace('{dosfechas}', '', $html2);
        }else{
        	$html2 = str_replace('{unafecha}', '', $html2);
        	$html2 = str_replace('{dosfechas}', 'none', $html2);
        }

       

       

        $fechaini = explode("-", $data[$i]["fechainicio"]);
        $diainicio = $fechaini[2];
        $mesinicio = $fechaini[1];

        if ($mesinicio=='01') {
        	$html2 = str_replace('{mesinicio}', 'Ene', $html2);
        }else if ($mesinicio=='02') {
        	$html2 = str_replace('{mesinicio}', 'Feb', $html2);
        }else if ($mesinicio=='03') {
        	$html2 = str_replace('{mesinicio}', 'Mar', $html2);
        }else if ($mesinicio=='04') {
        	$html2 = str_replace('{mesinicio}', 'Abr', $html2);
        }else if ($mesinicio=='05') {
        	$html2 = str_replace('{mesinicio}', 'May', $html2);
        }else if ($mesinicio=='06') {
        	$html2 = str_replace('{mesinicio}', 'Jun', $html2);
        }else if ($mesinicio=='07') {
        	$html2 = str_replace('{mesinicio}', 'Jul', $html2);
        }else if ($mesinicio=='08') {
        	$html2 = str_replace('{mesinicio}', 'Ago', $html2);
        }else if ($mesinicio=='09') {
        	$html2 = str_replace('{mesinicio}', 'Sep', $html2);
        }else if ($mesinicio=='10') {
        	$html2 = str_replace('{mesinicio}', 'Oct', $html2);
        }else if ($mesinicio=='11') {
        	$html2 = str_replace('{mesinicio}', 'Nov', $html2);
        }else if ($mesinicio=='12') {
        	$html2 = str_replace('{mesinicio}', 'Dic', $html2);
        }

        $fechafin = explode("-", $data[$i]["fechafin"]);
        $diafin = $fechafin[2];
        $mesfin = $fechafin[1];

        if ($mesfin=='01') {
        	$html2 = str_replace('{mesfin}', 'Ene', $html2);
        }else if ($mesfin=='02') {
        	$html2 = str_replace('{mesfin}', 'Feb', $html2);
        }else if ($mesfin=='03') {
        	$html2 = str_replace('{mesfin}', 'Mar', $html2);
        }else if ($mesfin=='04') {
        	$html2 = str_replace('{mesfin}', 'Abr', $html2);
        }else if ($mesfin=='05') {
        	$html2 = str_replace('{mesfin}', 'May', $html2);
        }else if ($mesfin=='06') {
        	$html2 = str_replace('{mesfin}', 'Jun', $html2);
        }else if ($mesfin=='07') {
        	$html2 = str_replace('{mesfin}', 'Jul', $html2);
        }else if ($mesfin=='08') {
        	$html2 = str_replace('{mesfin}', 'Ago', $html2);
        }else if ($mesfin=='09') {
        	$html2 = str_replace('{mesfin}', 'Sep', $html2);
        }else if ($mesfin=='10') {
        	$html2 = str_replace('{mesfin}', 'Oct', $html2);
        }else if ($mesfin=='11') {
        	$html2 = str_replace('{mesfin}', 'Nov', $html2);
        }else if ($mesfin=='12') {
        	$html2 = str_replace('{mesfin}', 'Dic', $html2);
        }



        $html2 = str_replace('{diainicio}', $diainicio, $html2);
        $html2 = str_replace('{diafin}', $diafin, $html2);

        $modelos3 = new Models();
        $modelos3->buscarHoraInicio($data[$i]["id_evento"], $data[$i]["fechainicio"]);
        $horainicio = $modelos3->filas;

        $modelos4 = new Models();
        $modelos4->buscarHoraFin($data[$i]["id_evento"], $data[$i]["fechafin"]);
        $horafin = $modelos4->filas;


        ///////////////////////////////////////////////////////

        if ($horainicio["horainicio"]==6) {
        	$html2 = str_replace('{desde}', '06:00', $html2);
        }else if ($horainicio["horainicio"]==7) {
        	$html2 = str_replace('{desde}', '07:00', $html2);
        }else if ($horainicio["horainicio"]==8) {
        	$html2 = str_replace('{desde}', '08:00', $html2);
        }else if ($horainicio["horainicio"]==9) {
        	$html2 = str_replace('{desde}', '09:00', $html2);
        }else if ($horainicio["horainicio"]==10) {
        	$html2 = str_replace('{desde}', '10:00', $html2);
        }else if ($horainicio["horainicio"]==11) {
        	$html2 = str_replace('{desde}', '11:00', $html2);
        }else if ($horainicio["horainicio"]==12) {
        	$html2 = str_replace('{desde}', '12:00', $html2);
        }else if ($horainicio["horainicio"]==13) {
        	$html2 = str_replace('{desde}', '13:00', $html2);
        }else if ($horainicio["horainicio"]==14) {
        	$html2 = str_replace('{desde}', '14:00', $html2);
        }else if ($horainicio["horainicio"]==15) {
        	$html2 = str_replace('{desde}', '15:00', $html2);
        }else if ($horainicio["horainicio"]==16) {
        	$html2 = str_replace('{desde}', '16:00', $html2);
        }else if ($horainicio["horainicio"]==17) {
        	$html2 = str_replace('{desde}', '17:00', $html2);
        }else if ($horainicio["horainicio"]==18) {
        	$html2 = str_replace('{desde}', '18:00', $html2);
        }else if ($horainicio["horainicio"]==19) {
        	$html2 = str_replace('{desde}', '19:00', $html2);
        }else if ($horainicio["horainicio"]==20) {
        	$html2 = str_replace('{desde}', '20:00', $html2);
        }

        if ($horafin["horafin"]==6) {
        	$html2 = str_replace('{hasta}', '06:00', $html2);
        }else if ($horafin["horafin"]==7) {
        	$html2 = str_replace('{hasta}', '07:00', $html2);
        }else if ($horafin["horafin"]==8) {
        	$html2 = str_replace('{hasta}', '08:00', $html2);
        }else if ($horafin["horafin"]==9) {
        	$html2 = str_replace('{hasta}', '09:00', $html2);
        }else if ($horafin["horafin"]==10) {
        	$html2 = str_replace('{hasta}', '10:00', $html2);
        }else if ($horafin["horafin"]==11) {
        	$html2 = str_replace('{hasta}', '11:00', $html2);
        }else if ($horafin["horafin"]==12) {
        	$html2 = str_replace('{hasta}', '12:00', $html2);
        }else if ($horafin["horafin"]==13) {
        	$html2 = str_replace('{hasta}', '13:00', $html2);
        }else if ($horafin["horafin"]==14) {
        	$html2 = str_replace('{hasta}', '14:00', $html2);
        }else if ($horafin["horafin"]==15) {
        	$html2 = str_replace('{hasta}', '15:00', $html2);
        }else if ($horafin["horafin"]==16) {
        	$html2 = str_replace('{hasta}', '16:00', $html2);
        }else if ($horafin["horafin"]==17) {
        	$html2 = str_replace('{hasta}', '17:00', $html2);
        }else if ($horafin["horafin"]==18) {
        	$html2 = str_replace('{hasta}', '18:00', $html2);
        }else if ($horafin["horafin"]==19) {
        	$html2 = str_replace('{hasta}', '19:00', $html2);
        }else if ($horafin["horafin"]==20) {
        	$html2 = str_replace('{hasta}', '20:00', $html2);
        }




        ////////////////////////////////////////////////////////


		if ($data[$i]["inversion"]>0) {
			$html3 = '<span class="fa fa-money"></span> Bs.'.$data[$i]["inversion"].' ';
			$html2 = str_replace('{participacion}', $html3, $html2);
		}else{
			$html3 = 'Entrada Libre';
			$html2 = str_replace('{participacion}', $html3, $html2);
		}

			$modelos = new Models();
			$modelos->buscarDatosPorId("evento_tipo", "id_tipo");
			$tipos = $modelos->filas;

			$num_tip = count($tipos);

			for ($j=0; $j < $num_tip ; $j++) { 
				if ($tipos[$j]["id_tipo"]==$data[$i]["id_tipo"]) {
					$html2 = str_replace('{tipoevento}', $tipos[$j]["des_tipo"], $html2);
				}
			}

			$modelos2 = new Models();
			$modelos2->buscarDatosPorId("evento_publico", "id_publico");
			$tipopub = $modelos2->filas;

			
			$num_tipopub = count($tipopub);

			for ($j=0; $j < $num_tipopub ; $j++) { 
				if ($tipopub[$j]["id_publico"]==$data[$i]["id_publico"]) {
					
					$html2 = str_replace('{tipopublico}', $tipopub[$j]["des_publico"], $html2);
				}
			}

		

	    foreach ($data[$i] as $clave=>$valor) {
			$html2 = str_replace('{'.$clave.'}', $valor, $html2);
		}

	}



	$html = str_replace('{eventos}', $html2, $html);

	return $html;

}



function hacer_datos_dinamicos($html, $data) {


	foreach ($data as $clave=>$valor) {
		$html = str_replace('{'.$clave.'}', $valor, $html);
	}

	return $html;
}






function retornar_vista($vista, $data = array(), $parametros = array(), $id_espacio) {

foreach ($parametros as $campo => $value) {
	$$campo = $value;
}

global $diccionario;

$html = buscar_plantilla_main();

if ($id_espacio==1) {
	$html = str_replace('{titulo}', 'Eventos Auditorio', $html);
}else{
	$html = str_replace('{titulo}', 'Eventos Salón Usos Múltiples', $html);
}

$html = str_replace('{usuario}', $_SESSION['nombreUsuario'], $html);

$html = str_replace('{idUsuario}', $_SESSION['idUsuario'] , $html);


if ($_SESSION['modulo']=='001') {
	$html = str_replace('{sidebar}',  buscar_sidebar1(), $html);
}else if ($_SESSION['modulo']=='002') {
	$html = str_replace('{sidebar}',  buscar_sidebar2(), $html);
}else if ($_SESSION['modulo']=='003') {
	$html = str_replace('{sidebar}',  buscar_sidebar3(), $html);
}


if ($vista=='verEventos'){
	$html = str_replace('{contenido}',  buscar_plantilla('verEventos','eventos_pub'), $html);
	if ($id_espacio==1) {
		$html = str_replace('{subtitulo}', 'Eventos Auditorio', $html);
	}else{
		$html = str_replace('{subtitulo}', 'Eventos Salón Usos Múltiples', $html);
	}
	$html = llenar_eventos($html, $data);
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
