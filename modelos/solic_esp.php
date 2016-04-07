<?php

include_once('../core/models.php');
include_once('../core/tcpdf/config/tcpdf_config.php');
include_once('../core/tcpdf/tcpdf.php');

class Solic_esp extends Models{


public function buscarSolicitudes(){
	$this->consulta = "SELECT a.*, b.nom_evento FROM solic_esp a, eventos b WHERE est_sol = 'E' and a.id_evento=b.id_evento ORDER BY fec_sol DESC";
	
	$this->traer_resultados_query_general();
}

public function cambiarInteres($datos = array()){
	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if ($confirmo=='Si') {
		$this->consulta = "UPDATE solic_esp SET interes = true WHERE cod_sol = '$cod_sol'";
		$this->ejecutar_simple_query('update', 'Solicitud');
	}else{
		$this->consulta = "UPDATE solic_esp SET interes = false WHERE cod_sol = '$cod_sol'";
		$this->ejecutar_simple_query('update', 'Solicitud');
	}
}

public function eliminarNoInteresadas(){
	$this->consulta = "SELECT a.*, b.nom_evento FROM solic_esp a, eventos b WHERE est_sol = 'E' and a.id_evento=b.id_evento ORDER BY fec_sol DESC";
	$this->traer_resultados_query_general();

	$dataSolicitudes = $this->filas;
	unset($this->filas);

	$cantidadSol = count($dataSolicitudes);
	$fechaactual = date('Y-m-d');
	
	for ($i=0; $i < $cantidadSol; $i++) { 
		$fechasol = $dataSolicitudes[$i]["fec_sol"];
		$nuevafecha = strtotime ( '-3 day' , strtotime ( $fechaactual ) ) ;
		$nuevafecha = date ( 'Y-m-d' , $nuevafecha );

		
		if (($fechasol<=$nuevafecha) && ($dataSolicitudes[$i]["interes"]=='f')) {

			$this->consulta = "DELETE FROM solic_esp WHERE cod_sol = '".$dataSolicitudes[$i]['cod_sol']."'";
			
			if ($this->ejecutar_simple_query('update', 'Solicitud')==true) {
				$this->consulta = "DELETE FROM evento_info WHERE id_evento = ".$dataSolicitudes[$i]['id_evento']."";
				$this->ejecutar_simple_query('update', 'Solicitud');

				$this->consulta = "DELETE FROM eventos WHERE id_evento = ".$dataSolicitudes[$i]['id_evento']."";
				$this->ejecutar_simple_query('update', 'Solicitud');
			}
		}else{
			
		}
	}

}

public function buscarSol($cod_sol){
	$this->consulta = "SELECT a.*, b.* from solic_esp a, eventos b WHERE cod_sol = '$cod_sol' AND a.id_evento = b.id_evento";

	$this->traer_resultados_query();
}

public function rechazar($datos){
	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	$this->consulta = "UPDATE eventos SET est_evento = 'R' WHERE id_evento = '$id_evento' ";

	if ($this->ejecutar_simple_query('update', 'Solicitud')==true) {
		$this->consulta = "UPDATE solic_esp SET est_sol = 'R', id_causa = $id_causa WHERE cod_sol = '$cod_sol' ";	
		if ($this->ejecutar_simple_query('update', 'Solicitud')==true) {
				$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('043', '$_SESSION[idUsuario]', current_date, localtime)";
				$this->ejecutar_simple_query('update', 'Solicitud');
				$this->mensaje = "Se Rechazó la Solicitud";
				$this->tipomsj = "info";
				
			}	
		
	}

	
}


public function aprobar($cod_sol){

	$this->consulta = "SELECT * FROM solic_esp WHERE cod_sol = '$cod_sol'";
	$this->traer_resultados_query();

	$datosSol = $this->filas;

	$id_evento = $datosSol["id_evento"];

	
	
	unset($this->filas);


	$this->buscarInfoEvento($id_evento);
	$dataInfoEvento = $this->filas;

	

	unset($this->filas);

	$this->consulta = "SELECT * FROM eventos WHERE id_evento = $id_evento";
	$this->traer_resultados_query();

	$dataEvento = $this->filas;
	unset($this->filas);

	$id_espacio = $dataEvento["id_espacio"];

	$sePuede = true;

	$cantidadFechas = count($dataInfoEvento);

	for ($i=0; $i < $cantidadFechas; $i++) { 
		//verifico que el evento no choque con otro
		$fecha = $dataInfoEvento[$i]["fecha"];
		
		for ($j=$dataInfoEvento[$i]["horainicio"]; $j <= $dataInfoEvento[$i]["horafin"]; $j++) { 
			
			$this->consulta = "SELECT * FROM eventos WHERE id_evento in (select id_evento from evento_info
								WHERE fecha = '$fecha' AND hora = $j) and est_evento = 'A' and id_espacio = '$id_espacio'";
			
			if ($this->traer_resultados_query_simple()) {
				$sePuede=false;
				$this->mensaje = "El Espacio Ya se Asignó para Otro Evento en esa fecha. Debe Rechazar Esta Solicitud Por Este Motivo o Cambiar La Fecha";
				$this->tipomsj = "danger";
				break;

			}else{
				
			}
		}
	}


	//Si todo anda bien,apruebo
		if ($sePuede) {
					
			$this->consulta = "UPDATE eventos SET est_evento = 'A' WHERE id_evento = '$id_evento'";

			if ($this->ejecutar_simple_query('update' , 'Evento')==true) {
				
				$this->consulta = "UPDATE solic_esp SET est_sol = 'A' WHERE cod_sol = '$cod_sol'";
				$this->ejecutar_simple_query('update', 'Evento');
				$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('042', '$_SESSION[idUsuario]', current_date, localtime)";
				$this->ejecutar_simple_query('update', 'Solicitud');

			}
			$this->mensaje = "Evento Aprobado con Éxito";
			$this->tipomsj = "info";
			return true;
		}else{
			return false;
		}

}

public function editar($datos = array()){

	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if (empty($inversion)) {
		$inversion = 0;
	}

	$sePuede = true;
	$horasBien = true;
	$fechasBien = true;
	$fechaPasada = false;
	$fechacontinua = true;

	$fechaactual = date('Y-m-d');

	if ($id_area!='') {

		$cantidadFechas = count($fecha);
		for ($i=0; $i < $cantidadFechas; $i++) { 

			//Verifico que las horas ingresadas sean correctas

			if ($hora_hasta[$i]<=$hora_desde[$i]) {
				$this->mensaje = "La Hora de Fin, Siempre tiene que ser despúes que la de Inicio. Revise";
				$this->tipomsj = "danger";
				$horasBien = false;
				break;
			}else{

			}

			//Verifico que No sea una fecha pasada
			if ($fecha[$i]<=$fechaactual) {
				$this->mensaje = "No puede Agregar Un Evento en el Pasado! Error, Intente de Nuevo";
				$this->tipomsj = "danger";
				$fechaPasada = true;
				break;
			}else{

			}

			//verificar continuidad de fechas
			if ($cantidadFechas>1) {
				if ($i>0) {
					$diaAnterior = $fecha[$i-1];
					
					$diaValido = strtotime ( '+1 day' , strtotime ( $diaAnterior ) ) ;
					$diaValido = date ( 'Y-m-d' , $diaValido);
					
					if ($fecha[$i]!=$diaValido) {
						$this->mensaje = "Error, las fechas deben ser seguidas, continuas. Intente de Nuevo!";
						$this->tipomsj = "danger";
						$fechacontinua = false;
						break;
					}else{

					}

				}
			}

		}

		//Si todo anda bien, ingreso la informacion
		if ($sePuede==true && $horasBien==true && $fechaPasada==false && $fechacontinua==true) {
			$this->consulta = "UPDATE eventos SET nom_evento = '$nom_evento', obj_evento = '$obj_evento', pon_evento = '$pon_evento', inversion = $inversion, id_tipo = $id_tipo, id_publico = $id_publico, id_espacio = $id_espacio, id_area = $id_area WHERE id_evento = '$id_evento'";

	
			if ($this->ejecutar_simple_query('insert' , 'Error Al Registrar Datos Eventos')==true) {
				
				$this->consulta = "DELETE FROM evento_info WHERE id_evento = '$id_evento'";

				if ($this->ejecutar_simple_query('update', 'Evento')==true) {
					$cantidadFechas = count($fecha);
						for ($i=0; $i < $cantidadFechas; $i++) { 
							
							for ($j=$hora_desde[$i]; $j <= $hora_hasta[$i]; $j++) { 
								$this->consulta = "INSERT INTO evento_info (id_evento, fecha, hora) VALUES ('$id_evento', '$fecha[$i]', $j)";				
								$this->ejecutar_simple_query('insert' , 'Error Al Registrar Datos Eventos');
							}

						}
					//$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('040', '$_SESSION[idUsuario]', current_date, localtime)";
					//$this->ejecutar_simple_query('update', 'Evento');
				}
				
				

			}
			$this->mensaje = "Solicitud Actualizada con éxito";
			$this->tipomsj = "info";
			
		}else{
			
		}
		

		
	}else{
		

		$cantidadFechas = count($fecha);
		for ($i=0; $i < $cantidadFechas; $i++) { 

			//Verifico que las horas ingresadas sean correctas

			if ($hora_hasta[$i]<=$hora_desde[$i]) {
				$this->mensaje = "La Hora de Fin, Siempre tiene que ser despúes que la de Inicio. Revise";
				$this->tipomsj = "danger";
				$horasBien = false;
				break;
			}else{

			}

			//Verifico que No sea una fecha pasada
			if ($fecha[$i]<=$fechaactual) {
				$this->mensaje = "No puede Agregar Un Evento en el Pasado! Error, Intente de Nuevo";
				$this->tipomsj = "danger";
				$fechaPasada = true;
				break;
			}else{

			}

			//verificar continuidad de fechas
			if ($cantidadFechas>1) {
				if ($i>0) {
					$diaAnterior = $fecha[$i-1];
					
					$diaValido = strtotime ( '+1 day' , strtotime ( $diaAnterior ) ) ;
					$diaValido = date ( 'Y-m-d' , $diaValido);
					
					if ($fecha[$i]!=$diaValido) {
						$this->mensaje = "Error, las fechas deben ser seguidas, continuas. Intente de Nuevo!";
						$this->tipomsj = "danger";
						$fechacontinua = false;
						break;
					}else{

					}

				}
			}

		}

		//Si todo anda bien, ingreso la informacion
		if ($sePuede==true && $horasBien==true && $fechaPasada==false && $fechacontinua==true) {
			$this->consulta = "UPDATE eventos SET nom_evento = '$nom_evento', obj_evento = '$obj_evento', pon_evento = '$pon_evento', inversion = $inversion, id_tipo = $id_tipo, id_publico = $id_publico, id_espacio = $id_espacio WHERE id_evento = '$id_evento'";
	
			if ($this->ejecutar_simple_query('insert' , 'Error Al Registrar Datos Eventos')==true) {
				
				$this->consulta = "DELETE FROM evento_info WHERE id_evento = '$id_evento'";

				if ($this->ejecutar_simple_query('update', 'Evento')==true) {
					$cantidadFechas = count($fecha);
						for ($i=0; $i < $cantidadFechas; $i++) { 
							
							for ($j=$hora_desde[$i]; $j <= $hora_hasta[$i]; $j++) { 
								$this->consulta = "INSERT INTO evento_info (id_evento, fecha, hora) VALUES ('$id_evento', '$fecha[$i]', $j)";				
								$this->ejecutar_simple_query('insert' , 'Error Al Registrar Datos Eventos');
							}

						}
					//$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('040', '$_SESSION[idUsuario]', current_date, localtime)";
					//$this->ejecutar_simple_query('update', 'Evento');
				}
				
				

			}
			$this->mensaje = "Solicitud Actualizada con éxito";
			$this->tipomsj = "info";
			
		}else{
			
		}
		

	}


}

public function crear($datos = array()){


	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if (empty($inversion)) {
		$inversion = 0;
	}
	
	
	
	$sePuede = true;
	$horasBien = true;
	$fechasBien = true;
	$procesada = false;
	$yahizo = false;
	$anticipacion = true;
	$fechacontinua = true;

	$fechaactual = date('Y-m-d');
	$nuevafecha = strtotime ( '+15 day' , strtotime ( $fechaactual ) ) ;
	$nuevafecha = date ( 'Y-m-d' , $nuevafecha );

	

	if ($id_area!='') {
 	
 	
		$this->consulta = "SELECT * FROM solic_esp WHERE ced_solicitante = '$ced_solicitante' AND fec_sol = current_date";
		if ($this->traer_resultados_query_simple()) {
			$yahizo = true;
			
			$this->mensaje = "Usted ya realizó una Solicitud. No puede hacer otra";
			$this->tipomsj = "danger";
			
		}else{

		}
		

		$cantidadFechas = count($fecha);
		for ($i=0; $i < $cantidadFechas; $i++) { 

			//Verifico que las horas ingresadas sean correctas

			if ($hora_hasta[$i]<=$hora_desde[$i]) {
				$this->mensaje = "La Hora del Fin del Evento, Siempre tiene que ser después que la de Inicio. Inténtelo de Nuevo";
				$this->tipomsj = "danger";
				$horasBien = false;
				break;
			}else{

			}

			//verifico que el evento no choque con otro
			for ($j=$hora_desde[$i]; $j <= $hora_hasta[$i]; $j++) { 
				$this->consulta = "SELECT * FROM eventos WHERE id_evento in (select id_evento from evento_info
									WHERE fecha = '$fecha[$i]' AND hora = $j) and est_evento = 'A' and id_espacio = '$id_espacio'";
				if ($this->traer_resultados_query_simple()) {
					$sePuede=false;
					$this->mensaje = "El Espacio esta ocupado para ese día. Vaya al Calendario y Observe las Fechas Disponibles";
					$this->tipomsj = "danger";
					break;

				}else{
					
				}
			}

			//Verifico que tenga quince días de anticipación
			if ($fecha[$i]<$nuevafecha) {
				$anticipacion=false;
				$this->mensaje = "El Espacio debe solicitarse con más de 15 días de Anticipación.";
				$this->tipomsj = "danger";
				break;
			}else{

			}

			//verificar continuidad de fechas
			if ($cantidadFechas>1) {
				if ($i>0) {
					$diaAnterior = $fecha[$i-1];
					
					$diaValido = strtotime ( '+1 day' , strtotime ( $diaAnterior ) ) ;
					$diaValido = date ( 'Y-m-d' , $diaValido);
					
					if ($fecha[$i]!=$diaValido) {
						$this->mensaje = "Error, las fechas deben ser seguidas, continuas. Intente de Nuevo!";
						$this->tipomsj = "danger";
						$fechacontinua = false;
						break;
					}else{

					}

				}
			}

		}

		//Si todo anda bien, ingreso la informacion
		if ($sePuede==true && $horasBien==true && $yahizo==false && $anticipacion==true && $fechacontinua==true) {
			$this->consulta = "INSERT INTO eventos (nom_evento, obj_evento, pon_evento, inversion, id_tipo, id_publico, id_espacio, id_area, est_evento) VALUES ('$nom_evento', '$obj_evento', '$pon_evento', $inversion, '$id_tipo', '$id_publico', '$id_espacio', $id_area, 'E' )";

			if ($this->ejecutar_simple_query('insert' , 'Error Al Registrar Datos Eventos')==true) {
				
				$cantidadFechas = count($fecha);
				for ($i=0; $i < $cantidadFechas; $i++) { 
					
					for ($j=$hora_desde[$i]; $j <= $hora_hasta[$i]; $j++) { 
						$this->consulta = "INSERT INTO evento_info (id_evento, fecha, hora) VALUES ((SELECT max(id_evento) from eventos), '$fecha[$i]', $j)";				
						$this->ejecutar_simple_query('insert' , 'Error Al Registrar Datos Eventos');
					}

				}

				$cod_sol = $this->generarCodigo($id_espacio);
				
				$this->consulta = "INSERT INTO solic_esp (cod_sol, nom_solicitante, ape_solicitante, ced_solicitante, tel_solicitante, est_sol, id_evento, fec_sol, interes) VALUES ('$cod_sol', '$nom_solicitante', '$ape_solicitante', '$ced_solicitante', '$tel_solicitante', 'E', (SELECT max(id_evento) FROM eventos), current_date, false)";
				if ($this->ejecutar_simple_query('insert' , 'Solicitud')==true) {
					$procesada = true;
					$this->mensaje = "Solicitud Enviada con Éxito. Consigne el Documento en el Decanato de Investigación";
					$this->tipomsj = "success";
				}

			}

			
		}
	
		

		
	}else{
		
		
		$this->consulta = "SELECT * FROM solic_esp WHERE ced_solicitante = '$ced_solicitante' AND fec_sol = current_date";
		if ($this->traer_resultados_query_simple()) {
			$yahizo = true;
			$this->mensaje = "Usted ya realizó una Solicitud. No puede hacer otra";
			$this->tipomsj = "danger";
			
		}else{
			
		}
		
		

		$cantidadFechas = count($fecha);
		for ($i=0; $i < $cantidadFechas; $i++) { 

			//Verifico que las horas ingresadas sean correctas

			if ($hora_hasta[$i]<=$hora_desde[$i]) {
				$this->mensaje = "La Hora de Fin, Siempre tiene que ser despúes que la de Inicio. Revise";
				$this->tipomsj = "danger";
				$horasBien = false;
				break;
			}else{

			}

			//verifico que el evento no choque con otro
			for ($j=$hora_desde[$i]; $j <= $hora_hasta[$i]; $j++) { 
				$this->consulta = "SELECT * FROM eventos WHERE id_evento in (select id_evento from evento_info
									WHERE fecha = '$fecha[$i]' AND hora = $j) and est_evento = 'A' and id_espacio = '$id_espacio'";
				if ($this->traer_resultados_query_simple()) {
					$sePuede=false;
					$this->mensaje = "No se puede Generar la Solicitud en Esa Fecha. Vaya al Calendario y Observe las Fechas Disponibles";
					$this->tipomsj = "danger";
					break;

				}else{
					
				}
			}

			//Verifico que tenga quince días de anticipación
			if ($fecha[$i]<$nuevafecha) {
				$anticipacion=false;
				$this->mensaje = "El Espacio debe solicitarse con más de 15 días de Anticipación.";
				$this->tipomsj = "danger";
				break;
			}else{

			}

			//verificar continuidad de fechas
			if ($cantidadFechas>1) {
				if ($i>0) {
					$diaAnterior = $fecha[$i-1];
					
					$diaValido = strtotime ( '+1 day' , strtotime ( $diaAnterior ) ) ;
					$diaValido = date ( 'Y-m-d' , $diaValido);
					
					if ($fecha[$i]!=$diaValido) {
						$this->mensaje = "Error, las fechas deben ser seguidas, continuas. Intente de Nuevo!";
						$this->tipomsj = "danger";
						$fechacontinua = false;
						break;
					}else{

					}

				}
			}

		}

		//Si todo anda bien, ingreso la informacion
		if ($sePuede==true && $horasBien==true && $yahizo==false && $anticipacion==true && $fechacontinua==true) {
			$this->consulta = "INSERT INTO eventos (nom_evento, obj_evento, pon_evento, inversion, id_tipo, id_publico, id_espacio,  est_evento) VALUES ('$nom_evento', '$obj_evento', '$pon_evento', $inversion, '$id_tipo', '$id_publico', '$id_espacio',  'E' )";

			if ($this->ejecutar_simple_query('insert' , 'Error Al Registrar Datos Eventos')==true) {
				
				$cantidadFechas = count($fecha);
				for ($i=0; $i < $cantidadFechas; $i++) { 
					
					for ($j=$hora_desde[$i]; $j <= $hora_hasta[$i]; $j++) { 
						$this->consulta = "INSERT INTO evento_info (id_evento, fecha, hora) VALUES ((SELECT max(id_evento) from eventos), '$fecha[$i]', $j)";				
						$this->ejecutar_simple_query('insert' , 'Error Al Registrar Datos Eventos');
					}

				}
				$cod_sol = $this->generarCodigo($id_espacio);
				$this->consulta = "INSERT INTO solic_esp (cod_sol, nom_solicitante, ape_solicitante, ced_solicitante, tel_solicitante, est_sol, id_evento, fec_sol, interes) VALUES ('$cod_sol', '$nom_solicitante', '$ape_solicitante', '$ced_solicitante', '$tel_solicitante', 'E', (SELECT max(id_evento) FROM eventos), current_date, false)";
				if ($this->ejecutar_simple_query('insert' , 'Solicitud')==true) {
					$procesada = true;
					$this->mensaje = "Solicitud Enviada con Éxito. Consigne el Documento en el Decanato de Investigación";
					$this->tipomsj = "success";
				}

			}

			
		}

	}

	

	if ($procesada==true) {
		$this->generarSolicitud($datos, $cod_sol);
		echo "string";
		exit();

		
	}else{
		header('Location: /investigacion/solic_esp_pub/solicitud/?mensaje='.$this->mensaje.'&tipomsj='.$this->tipomsj);
	}
	





}

public function eliminar($id){
	$this->delete('solic_esp', $id);
}

public function generarCodigo($id_espacio){

	if ($id_espacio==1) {
		$esp = "AUD";
	}else{
		$esp = "SAL";
	}

	$fecha = date('Y-m-d');

	$hora = time();

	$x = explode('-', $fecha);

	$x[1] = $x[1]+$x[2];

	$x[2] = $x[3]+$x[2];

	$x[3] = $x[2]+$x[1];

	$x = $x[1]+$x[2]*$x[3];

	$x = $x*$x;

	$x = $x+$hora;

	$x = strrev($x);

	$codigo = $esp.'-'.$x;

	return $codigo;


}

public function buscarEstadoSol($cod_sol){
	$this->consulta = "SELECT a.*, b.nom_evento, b.id_espacio FROM solic_esp a, eventos b WHERE cod_sol = upper('$cod_sol') AND a.id_evento=b.id_evento";

	$this->traer_resultados_query();
}

public function generarEstadoSolicitud($datos){
	$actual= date('d-m-Y');

	
	$pdf = new TCPDF("R", "mm", "Letter", true, 'UTF-8', false);
	$pdf->SetTitle('Solicitud de Espacios');
	$pdf->SetPrintHeader(false);
	$pdf->SetPrintFooter(false);
	$pdf->SetMargins('20', '10', '20'); 
	$pdf->Addpage();

	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if (empty($inversion)) {
		$inversion = 0;
	}

	if ($datos["id_espacio"]==1) {
		$nom_espacio = "Auditorio";
	}else{
		$nom_espacio = "Salón de Usos Múltiples";
	}

	$fechasol = explode("-", $fec_sol);
	$fechasol2 = $fechasol[2]."-".$fechasol[1]."-".$fechasol[0];

		$html = '
				<table  cellspacing="2" cellpadding="2">
				       <tr>
				       		<td width="80px"><img style="width:80px;" src="../core/tcpdf/images/logo-unerg.jpg"></td><td align="center" width="80%">Universidad Nacional Experimental Rómulo Gallegos<br>Decanato de Investigación y Extensión<br><br><b>Gestión de Espacios</b></td>
				       </tr>
				       <tr><td colspan="2" align="center" style="font-size:40px"><br><br>Estado de Solicitud </td></tr>
				       <tr><td colspan="1" align="left" style="font-size:30px">Fecha: '.$actual.'</td><td align="right" style="font-size:30px">Código: <font color="red">'.$cod_sol.'</font></td></tr>
				     	

				        
				</table><br>';

		if ($est_sol=='E') {
			$html.='
				<table  cellspacing="2" cellpadding="2">
				    	<tr>
				    		<td>Estimado (a);</td>
				    	</tr>   

				       <tr>
				       		<td>'.$nom_solicitante.' '.$ape_solicitante.'</td>
				       </tr>

				       <tr>
				       		<td style="text-align:justify;"><br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;El Decanato de Investigación y Extensión de la Universidad Rómulo Gallegos le notifica que la solicitud
				       		enviada la fecha  <font color="red">'.$fechasol2.'</font> para realizar el evento o actividad: <font color="red">'.$nom_evento.'</font> en el <font color="red">'.$nom_espacio.'</font>
				       		se encuentra <font color="red">En Evaluación</font> por la gestión del Decanato.<br>
				       		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Le Invitamos que si aún no ha consignado la Solicitud ante el Decanato, lo haga para formalizar la misma.
				       		</td>
				       </tr>
				       <br><br><br><br><br><br><br><br><br><br>
				       <tr>
				       		<td style="text-align:center;font-size:25px">Decanato de Investigación y Extensión</td>

				       </tr>
				         <tr>
				       		<td style="text-align:center;font-size:25px">Gestión de Espacios</td>
				       		
				       </tr>
				       
				     	
				       
				        
				</table>
				';
		}else if ($est_sol=='A') {
			$html.='
				<table  cellspacing="2" cellpadding="2">
				    	<tr>
				    		<td>Estimado (a);</td>
				    	</tr>   

				       <tr>
				       		<td>'.$nom_solicitante.' '.$ape_solicitante.'</td>
				       </tr>

				       <tr>
				       		<td style="text-align:justify;"><br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;El Decanato de Investigación y Extensión de la Universidad Rómulo Gallegos le notifica que la solicitud
				       		enviada la fecha  <font color="red">'.$fechasol2.'</font> para realizar el evento o actividad: <font color="red">'.$nom_evento.'</font> en el <font color="red">'.$nom_espacio.'</font>
				       		se encuentra <font color="green">Aprobada</font> por la gestión del Decanato.<br>
				       		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;La actividad ya se encuentra fijada en el calendario y tiene todo el consentimiento por parte de esta gestión para su realización.
				       		</td>
				       </tr>
				       <br><br><br><br><br><br><br><br><br><br>
				       <tr>
				       		<td style="text-align:center;font-size:25px">Decanato de Investigación y Extensión</td>

				       </tr>
				         <tr>
				       		<td style="text-align:center;font-size:25px">Gestión de Espacios</td>
				       		
				       </tr>
				       
				     	
				       
				        
				</table>
				';
		}else if ($est_sol=='R') {
			$modelos = new Models();
			$modelos->buscarDatosPorId("noaprob_causa", "id_causa");
			$causas = $modelos->filas;

			

			$num_cau = count($causas);

			for ($j=0; $j < $num_cau ; $j++) { 
				if ($causas[$j]["id_causa"]==$id_causa) {
					$causa = $causas[$j]["des_causa"];
				}
			}

			$html.='
				<table  cellspacing="2" cellpadding="2">
				    	<tr>
				    		<td>Estimado (a);</td>
				    	</tr>   

				       <tr>
				       		<td>'.$nom_solicitante.' '.$ape_solicitante.'</td>
				       </tr>

				       <tr>
				       		<td style="text-align:justify;"><br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;El Decanato de Investigación y Extensión de la Universidad Rómulo Gallegos le notifica que la solicitud
				       		enviada la fecha  <font color="red">'.$fechasol2.'</font> para realizar el evento o actividad: <font color="red">'.$nom_evento.'</font> en el <font color="red">'.$nom_espacio.'</font>
				       		se encuentra <font color="red"><b>Rechazada</b></font> por la gestión del Decanato porque <font color="red">'.$causa.'</font>.<br>
				       		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Le invitamos dirigirse al Decanato de Investigación y Extensión ante cualquier duda.	
				       		</td>
				       </tr>
				       <br><br><br><br><br><br><br><br><br><br>
				       <tr>
				       		<td style="text-align:center;font-size:25px">Decanato de Investigación y Extensión</td>

				       </tr>
				         <tr>
				       		<td style="text-align:center;font-size:25px">Gestión de Espacios</td>
				       		
				       </tr>
				       
				     	
				       
				        
				</table>
				';
		}

		


		$pdf->writeHTML($html, true, false, true, false, '');

		$pdf->Output('EstadoSolicitud'.$cod_sol.'.pdf', 'D');
}



public function generarSolicitud($datos = array(), $cod_sol){
	$actual= date('d-m-Y');
	$pdf = new TCPDF("R", "mm", "Letter", true, 'UTF-8', false);
	$pdf->SetTitle('Solicitud de Espacios');
	$pdf->SetPrintHeader(false);
	$pdf->SetPrintFooter(false);
	$pdf->SetMargins('20', '10', '20'); 
	$pdf->Addpage();

	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if (empty($inversion)) {
		$inversion = 0;
	}

	if ($datos["id_espacio"]==1) {
		$nom_espacio = "Auditorio";
	}else{
		$nom_espacio = "Salón de Usos Múltiples";
	}



		$html = '
				<table  cellspacing="2" cellpadding="2">
				       <tr>
				       		<td width="80px"><img style="width:80px;" src="../core/tcpdf/images/logo-unerg.jpg"></td><td align="center" width="80%">Universidad Nacional Experimental Rómulo Gallegos<br>Decanato de Investigación y Extensión<br><br><b>Gestión de Espacios</b></td>
				       </tr>
				       <tr><td colspan="2" align="center" style="font-size:40px"><br><br>Comprobante de Solicitud del '.$nom_espacio.'</td></tr>
				       <tr><td colspan="1" align="left" style="font-size:30px">Fecha: '.$actual.'</td><td align="right" style="font-size:30px">Código: <font color="red">'.$cod_sol.'</font></td></tr>
				     	

				        
				</table><br>';

		$html.='
				<table border="1" cellspacing="2" cellpadding="2">
				    	<tr>
				    		<td colspan="6" align="center" style="background-color:#424242;color:white;font-size:30px;font-weight:bold;">Datos del Solicitante</td>
				    	</tr>   

				       <tr>
				       		<td style="background-color:gray;color:white;font-weight:bold;font-size:30px;" width="15%">Solicitante:</td>
				       		<td width="33%" style="font-size:30px;">'.$datos["nom_solicitante"].' '.$datos["ape_solicitante"].'</td>
				       		<td style="background-color:gray;color:white;font-weight:bold;font-size:30px;" width="10%">Cédula:</td>
				       		<td width="12%" style="font-size:30px;">'.$datos["ced_solicitante"].'</td>
				       		<td style="background-color:gray;color:white;font-weight:bold;font-size:30px;" width="11%">Teléfono:</td>
				       		<td width="19%" style="font-size:30px;">'.$datos["tel_solicitante"].'</td>
				       </tr>
				       
				     	
				       
				        
				</table>
				';


		$html.='
				<br><table border="1" cellspacing="2" cellpadding="2">
				    	<tr>
				    		<td colspan="6" align="center" style="background-color:#424242;color:white;font-size:30px;font-weight:bold;">Datos del Evento Propuesto</td>
				    	</tr>   

				       <tr>
				       		<td style="background-color:gray;color:white;font-weight:bold;font-size:30px;" width="20%">Nombre del Evento:</td>
				       		<td colspan="1" width="82%" style="font-size:30px;">'.$datos["nom_evento"].' </td>
				       		
				       </tr>
				';


		$num_fechas = count($fecha);
		
		for ($i=0; $i < $num_fechas; $i++) {

			if ($hora_desde[$i]==6) {
				$horadesde = "06:00";
			}else if ($hora_desde[$i]==7) {
				$horadesde = "07:00";
			}else if ($hora_desde[$i]==8) {
				$horadesde = "08:00";
			}else if ($hora_desde[$i]==9) {
				$horadesde = "09:00";
			}else if ($hora_desde[$i]==10) {
				$horadesde = "10:00";
			}else if ($hora_desde[$i]==11) {
				$horadesde = "11:00";
			}else if ($hora_desde[$i]==12) {
				$horadesde = "12:00";
			}else if ($hora_desde[$i]==13) {
				$horadesde = "13:00";
			}else if ($hora_desde[$i]==14) {
				$horadesde = "14:00";
			}else if ($hora_desde[$i]==15) {
				$horadesde = "15:00";
			}else if ($hora_desde[$i]==16) {
				$horadesde = "16:00";
			}else if ($hora_desde[$i]==17) {
				$horadesde = "17:00";
			}else if ($hora_desde[$i]==18) {
				$horadesde = "18:00";
			}else if ($hora_desde[$i]==19) {
				$horadesde = "19:00";
			}else if ($hora_desde[$i]==20) {
				$horadesde = "20:00";
			}

			if ($hora_hasta[$i]==6) {
				$horahasta = "06:00";
			}else if ($hora_hasta[$i]==7) {
				$horahasta = "07:00";
			}else if ($hora_hasta[$i]==8) {
				$horahasta = "08:00";
			}else if ($hora_hasta[$i]==9) {
				$horahasta = "09:00";
			}else if ($hora_hasta[$i]==10) {
				$horahasta = "10:00";
			}else if ($hora_hasta[$i]==11) {
				$horahasta = "11:00";
			}else if ($hora_hasta[$i]==12) {
				$horahasta = "12:00";
			}else if ($hora_hasta[$i]==13) {
				$horahasta = "13:00";
			}else if ($hora_hasta[$i]==14) {
				$horahasta = "14:00";
			}else if ($hora_hasta[$i]==15) {
				$horahasta = "15:00";
			}else if ($hora_hasta[$i]==16) {
				$horahasta = "16:00";
			}else if ($hora_hasta[$i]==17) {
				$horahasta = "17:00";
			}else if ($hora_hasta[$i]==18) {
				$horahasta = "18:00";
			}else if ($hora_hasta[$i]==19) {
				$horahasta = "19:00";
			}else if ($hora_hasta[$i]==20) {
				$horahasta = "20:00";
			}


			$date = explode("-", $fecha[$i]);
			
			$date2 = $date[2]."-".$date[1]."-".$date[0];

			if ($i==0) {

				$html.= '<tr>
						<td style="background-color:gray;color:white;font-weight:bold;font-size:30px;" width="20%">Fecha:</td> 
						<td width="20%" style="font-size:30px;">'.$date2.'</td>
						<td style="background-color:gray;color:white;font-weight:bold;font-size:30px;" width="13%">Desde las:</td> 
						<td width="15%" style="font-size:30px;">'.$horadesde.'</td>
						<td style="background-color:gray;color:white;font-weight:bold;font-size:30px;" width="13%">Hasta las:</td> 
						<td width="19%" style="font-size:30px;">'.$horahasta.'</td>

					</tr>';
			}else{
				$dia = $i + 1;
				$html.= '<tr>
						<td style="background-color:gray;color:white;font-weight:bold;font-size:30px;" width="20%">Fecha '.$dia.':</td> 
						<td width="20%" style="font-size:30px;">'.$date2.'</td>
						<td style="background-color:gray;color:white;font-weight:bold;font-size:30px;" width="13%">Desde las:</td> 
						<td width="15%" style="font-size:30px;">'.$horadesde.'</td>
						<td style="background-color:gray;color:white;font-weight:bold;font-size:30px;" width="13%">Hasta las:</td> 
						<td width="19%" style="font-size:30px;">'.$horahasta.'</td>
					</tr>';
			}
			
			
		}

		$html.= '<tr>
					<td style="background-color:gray;color:white;font-weight:bold;font-size:30px;" width="20%">Objetivos del Evento:</td>
					<td width="82%" style="font-size:30px;">'.$datos["obj_evento"].'</td>
					
				</tr> 
				<tr>
					<td style="background-color:gray;color:white;font-weight:bold;font-size:30px;" width="20%">Ponentes del Evento:</td>
					<td width="82%" style="font-size:30px;">'.$datos["pon_evento"].'</td>
				</tr>
				';
		
		if ($inversion==0) {
			$html.= '<tr>
						<td style="background-color:gray;color:white;font-weight:bold;font-size:30px;" width="20%">Participación: </td>
						<td width="82%" style="font-size:30px;">Entrada Libre</td>
					</tr>';
		}else{
			$html.= '<tr>
						<td style="background-color:gray;color:white;font-weight:bold;font-size:30px;" width="20%">Participación: </td>
						<td width="40%" style="font-size:30px;">Con Inversión</td>
						<td style="background-color:gray;color:white;font-weight:bold;font-size:30px;" width="24%">Monto Inversión Bs.: </td>
						<td width="17%" style="font-size:30px;">'.$inversion.'</td>
					</tr>';
		}


		$modelos = new Models();
		$modelos->buscarDatosPorId("evento_tipo", "id_tipo");
		$tipos = $modelos->filas;

		$num_tip = count($tipos);

		for ($j=0; $j < $num_tip ; $j++) { 
			if ($tipos[$j]["id_tipo"]==$datos["id_tipo"]) {
				$tipo = $tipos[$j]["des_tipo"];
			}
		}

		$modelos2 = new Models();
		$modelos2->buscarDatosPorId("evento_publico", "id_publico");
		$publico = $modelos2->filas;

		$num_pub = count($publico);

		for ($j=0; $j < $num_pub ; $j++) { 
			if ($publico[$j]["id_publico"]==$datos["id_publico"]) {
				$tipo_pub = $publico[$j]["des_publico"];
			}
		}


		$html.='<tr>
					<td style="background-color:gray;color:white;font-weight:bold;font-size:30px;" width="20%">Tipo de Evento:</td>
					<td width="82%" style="font-size:30px;">'.$tipo.'</td>
				</tr>
				<tr>
					<td style="background-color:gray;color:white;font-weight:bold;font-size:30px;" width="20%">Tipo de Público:</td>
					<td width="82%" style="font-size:30px;">'.$tipo_pub.'</td>
				</tr>
				';

		if ($id_area!='') {
			$modelos3 = new Models();
			$modelos3->buscarDatosPorId("evento_area", "id_area");
			$areas = $modelos3->filas;

			$num_areas = count($areas);

			for ($j=0; $j < $num_areas ; $j++) { 
				if ($areas[$j]["id_area"]==$datos["id_area"]) {
					$area= $areas[$j]["des_area"];
				}
			}
			$html.='<tr>
					<td style="background-color:gray;color:white;font-weight:bold;font-size:30px;" width="20%">Area Responsable:</td>
					<td width="82%" style="font-size:30px;">'.$area.'</td>
				</tr>
				
				';

		}
		$html.='</table>';

		/*

		$html.='<br><br><br><br><br><br><br>
				<table  cellspacing="2" cellpadding="2">
				       <tr>
				       		<td align="center">____________________________</td>
				       		
				       </tr>
				       <tr>
				       		<td align="center">Firma Solicitante</td>
				       </tr>
				       <br><br>
				       <tr>
				       		<td align="center" style="font-size:20px;">Debe Consigar este documento ante el Decanato de Investigación y Extensión para formalizar la solicitud. Caduca en 15 días</td>
				       </tr>
				       
				     	

				        
				</table>
				';
		*/

		$html.='<br><br><br>
				<table cellspacing="2" cellpadding="2">
					<tr>
						<td><font color="red"><b>IMPORTANTE:</b></font> En los próximos 3 días Usted deberá mostrar interés con el Decanato de Investigación
						de realizar la actividad. Esto puede hacerlo comunicándose vía Telefónica al Número 0412-366-1234
						o consignando este comprobante en nuestras instalaciones. Si esto no ocurre el sistema descartará su solicitud automáticamente.
						</td>
					</tr>
				</table>';

			


		$pdf->writeHTML($html, true, false, true, false, '');

		$pdf->Output('Solicitud'.$cod_sol.'.pdf', 'I');
		
		

}





}

 ?>