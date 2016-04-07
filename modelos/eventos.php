<?php

include_once('../core/models.php');
include_once('../core/tcpdf/config/tcpdf_config.php');
include_once('../core/tcpdf/tcpdf.php');

class Eventos extends Models{


//Busca todos los eventos que se encuentren en la base de datos
public function buscarTodos(){
	$this->consulta = "select * from eventos where id_evento not in (select id_evento from solic_esp where est_sol = 'E' or est_sol = 'R')";
	$this->traer_resultados_query_general();
}

//Busca todos los eventos dependiendo del espacio, recibe el identificador del espacio
public function buscarEventos($id_espacio){
	$this->consulta = "SELECT a.id_evento, a.nom_evento, a.id_area, a.id_tipo, a.id_publico, a.inversion, min(fecha) as fechainicio, max(fecha) as fechafin, min(hora) as horainicio, max(hora) as horafin
						FROM eventos a, evento_info b WHERE est_evento = 'A' AND id_espacio = '$id_espacio' AND a.id_evento in 
						(SELECT id_evento FROM evento_info WHERE fecha >= current_date) AND a.id_evento = b.id_evento
						GROUP BY a.id_evento, a.nom_evento, a.id_area, a.id_tipo, a.id_publico, a.inversion ORDER BY fechainicio ASC";
	$this->traer_resultados_query_general();
}

public function buscarEventosIni(){
	$this->consulta = "SELECT a.id_evento, a.nom_evento, a.id_area, a.id_tipo, a.id_publico, a.inversion, min(fecha) as fechainicio, max(fecha) as fechafin, min(hora) as horainicio, max(hora) as horafin
						FROM eventos a, evento_info b WHERE est_evento = 'A'   AND a.id_evento = b.id_evento
						GROUP BY a.id_evento, a.nom_evento, a.id_area, a.id_tipo, a.id_publico, a.inversion ORDER BY fechainicio ASC";
	$this->traer_resultados_query_general();
}


public function buscar($id){

	$this->buscarDatosPorId3('eventos','id_evento', $id);
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

		//Si el evento es para que se apruebe de inmediato
		if ($est_evento=='A') {

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
					if ($fecha[$i]<$fechaactual) {
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
					
					$this->consulta = "DELETE FROM evento_info WHERE id_evento = '$id_evento'";
					$this->ejecutar_simple_query('delete', 'Info Evento');

					//verifico que el evento no choque con otro
					for ($j=$hora_desde[$i]; $j <= $hora_hasta[$i]; $j++) { 
						$this->consulta = "SELECT * FROM eventos WHERE id_evento in (select id_evento from evento_info
											WHERE fecha = '$fecha[$i]' AND hora = $j) and est_evento = 'A' and id_espacio = '$id_espacio'";
						if ($this->traer_resultados_query_simple()) {
							$cantidadFechas = count($fecha);
							for ($i=0; $i < $cantidadFechas; $i++) { 
								
								for ($j=$hora_desde[$i]; $j <= $hora_hasta[$i]; $j++) { 
									$this->consulta = "INSERT INTO evento_info (id_evento, fecha, hora) VALUES ('$id_evento', '$fecha[$i]', $j)";				
									$this->ejecutar_simple_query('insert' , 'Error Al Registrar Datos Eventos');
								}

							}
							$sePuede=false;
							$this->mensaje = "No se puede Agregar el Evento. Choca con Otro. Revise";
							$this->tipomsj = "danger";
							break;

						}else{
							
						}
					}

				}

				//Si todo anda bien, actualizo la informacion
				if ($sePuede==true && $horasBien==true && $fechaPasada==false && $fechacontinua==true) {
					
					$this->consulta = "UPDATE eventos SET nom_evento = '$nom_evento', obj_evento = '$obj_evento', pon_evento = '$pon_evento', inversion = $inversion, id_tipo = $id_tipo, id_publico = $id_publico, id_espacio = $id_espacio, id_area = $id_area, est_evento = '$est_evento' WHERE id_evento = '$id_evento'";
		
					if ($this->ejecutar_simple_query('update' , 'Evento')==true) {
						
						$this->consulta = "DELETE FROM evento_info WHERE id_evento = '$id_evento'";

						if ($this->ejecutar_simple_query('update', 'Evento')==true) {
							$cantidadFechas = count($fecha);
							for ($i=0; $i < $cantidadFechas; $i++) { 
								
								for ($j=$hora_desde[$i]; $j <= $hora_hasta[$i]; $j++) { 
									$this->consulta = "INSERT INTO evento_info (id_evento, fecha, hora) VALUES ('$id_evento', '$fecha[$i]', $j)";				
									$this->ejecutar_simple_query('insert' , 'Error Al Registrar Datos Eventos');
								}

							}

							$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('040', '$_SESSION[idUsuario]', current_date, localtime)";
							$this->ejecutar_simple_query('update', 'Evento');
						}

					}
					$this->mensaje = "Evento Actualizado con éxito";
					$this->tipomsj = "info";
				}
			
		}else if ($est_evento=='E') {
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
					if ($fecha[$i]<$fechaactual) {
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
					$this->consulta = "UPDATE eventos SET nom_evento = '$nom_evento', obj_evento = '$obj_evento', pon_evento = '$pon_evento', inversion = $inversion, id_tipo = $id_tipo, id_publico = $id_publico, id_espacio = $id_espacio, id_area = $id_area, est_evento = '$est_evento' WHERE id_evento = '$id_evento'";
			
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
							$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('040', '$_SESSION[idUsuario]', current_date, localtime)";
							$this->ejecutar_simple_query('update', 'Evento');
						}
						
						

					}
					$this->mensaje = "Evento Actualizado con éxito";
					$this->tipomsj = "info";
				}
		}

		
	}else{
		
		//Si el evento es para que se apruebe de inmediato
		if ($est_evento=='A') {

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
					if ($fecha[$i]<$fechaactual) {
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

					$this->consulta = "DELETE FROM evento_info WHERE id_evento = '$id_evento'";
					$this->ejecutar_simple_query('delete', 'Info Evento');

					//verifico que el evento no choque con otro
					for ($j=$hora_desde[$i]; $j <= $hora_hasta[$i]; $j++) { 
						$this->consulta = "SELECT * FROM eventos WHERE id_evento in (select id_evento from evento_info
											WHERE fecha = '$fecha[$i]' AND hora = $j) and est_evento = 'A' and id_espacio = '$id_espacio'";
						if ($this->traer_resultados_query_simple()) {
							$cantidadFechas = count($fecha);
							for ($i=0; $i < $cantidadFechas; $i++) { 
								
								for ($j=$hora_desde[$i]; $j <= $hora_hasta[$i]; $j++) { 
									$this->consulta = "INSERT INTO evento_info (id_evento, fecha, hora) VALUES ('$id_evento', '$fecha[$i]', $j)";				
									$this->ejecutar_simple_query('insert' , 'Error Al Registrar Datos Eventos');
								}

							}
							$sePuede=false;
							$this->mensaje = "No se puede Agregar el Evento. Choca con Otro. Revise";
							$this->tipomsj = "danger";
							break;

						}else{
							
						}
					}

				}

				//Si todo anda bien, actualizo la informacion
				if ($sePuede==true && $horasBien==true && $fechaPasada==false && $fechacontinua==true) {
					
					$this->consulta = "UPDATE eventos SET nom_evento = '$nom_evento', obj_evento = '$obj_evento', pon_evento = '$pon_evento', inversion = $inversion, id_tipo = $id_tipo, id_publico = $id_publico, id_espacio = $id_espacio,  est_evento = '$est_evento' WHERE id_evento = '$id_evento'";
		
					if ($this->ejecutar_simple_query('update' , 'Evento')==true) {
						
						$this->consulta = "DELETE FROM evento_info WHERE id_evento = '$id_evento'";

						if ($this->ejecutar_simple_query('update', 'Evento')==true) {
							$cantidadFechas = count($fecha);
							for ($i=0; $i < $cantidadFechas; $i++) { 
								
								for ($j=$hora_desde[$i]; $j <= $hora_hasta[$i]; $j++) { 
									$this->consulta = "INSERT INTO evento_info (id_evento, fecha, hora) VALUES ('$id_evento', '$fecha[$i]', $j)";				
									$this->ejecutar_simple_query('insert' , 'Error Al Registrar Datos Eventos');
								}

							}
							$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('040', '$_SESSION[idUsuario]', current_date, localtime)";
							$this->ejecutar_simple_query('update', 'Evento');
						}

					}
					$this->mensaje = "Evento Actualizado con éxito";
					$this->tipomsj = "info";
				}
			
		}else if ($est_evento=='E') {
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
					if ($fecha[$i]<$fechaactual) {
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
					$this->consulta = "UPDATE eventos SET nom_evento = '$nom_evento', obj_evento = '$obj_evento', pon_evento = '$pon_evento', inversion = $inversion, id_tipo = $id_tipo, id_publico = $id_publico, id_espacio = $id_espacio,  est_evento = '$est_evento' WHERE id_evento = '$id_evento'";
			
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
							$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('040', '$_SESSION[idUsuario]', current_date, localtime)";
							$this->ejecutar_simple_query('update', 'Evento');
						}
						
						

					}
					$this->mensaje = "Evento Actualizado con éxito";
					$this->tipomsj = "info";
				}
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
	$fechaPasada = false;
	$fechacontinua = true;

	$fechaactual = date('Y-m-d');
	$nuevafecha = strtotime ( '+15 day' , strtotime ( $fechaactual ) ) ;
	$nuevafecha = date ( 'Y-m-d' , $nuevafecha );


	if ($id_area!='') {

		//Si el evento es para que se apruebe de inmediato
		if ($est_evento=='A') {

				$cantidadFechas = count($fecha);

				for ($i=0; $i < $cantidadFechas; $i++) { 

					//Verifico que No sea una fecha pasada
					if ($fecha[$i]<$fechaactual) {
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
							$this->mensaje = "No se puede Agregar el Evento. Choca con Otro. Revise";
							$this->tipomsj = "danger";
							break;

						}else{
							
						}
					}

				}

				//Si todo anda bien, ingreso la informacion
				if ($sePuede==true && $horasBien==true && $fechaPasada==false && $fechacontinua==true) {
					$this->consulta = "INSERT INTO eventos (nom_evento, obj_evento, pon_evento, inversion, id_tipo, id_publico, id_espacio, id_area, est_evento) VALUES ('$nom_evento', '$obj_evento', '$pon_evento', $inversion, '$id_tipo', '$id_publico', '$id_espacio', $id_area, '$est_evento' )";
		
					if ($this->ejecutar_simple_query('insert' , 'Error Al Registrar Datos Eventos')==true) {
						
						$cantidadFechas = count($fecha);
						for ($i=0; $i < $cantidadFechas; $i++) { 
							
							for ($j=$hora_desde[$i]; $j <= $hora_hasta[$i]; $j++) { 
								$this->consulta = "INSERT INTO evento_info (id_evento, fecha, hora) VALUES ((SELECT max(id_evento) from eventos), '$fecha[$i]', $j)";				
								$this->ejecutar_simple_query('insert' , 'Error Al Registrar Datos Eventos');
							}

						}
						
						$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('039', '$_SESSION[idUsuario]', current_date, localtime)";
						$this->ejecutar_simple_query('update', 'Evento');

					}
					$this->mensaje = "Evento Creado con éxito";
					$this->tipomsj = "success";
				}

		}else if ($est_evento=='E') {
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
					if ($fecha[$i]<$fechaactual) {
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
					$this->consulta = "INSERT INTO eventos (nom_evento, obj_evento, pon_evento, inversion, id_tipo, id_publico, id_espacio, id_area, est_evento) VALUES ('$nom_evento', '$obj_evento', '$pon_evento', $inversion, '$id_tipo', '$id_publico', '$id_espacio', $id_area, '$est_evento' )";
		
					if ($this->ejecutar_simple_query('insert' , 'Error Al Registrar Datos Eventos')==true) {
						
						$cantidadFechas = count($fecha);
						for ($i=0; $i < $cantidadFechas; $i++) { 
							
							for ($j=$hora_desde[$i]; $j <= $hora_hasta[$i]; $j++) { 
								$this->consulta = "INSERT INTO evento_info (id_evento, fecha, hora) VALUES ((SELECT max(id_evento) from eventos), '$fecha[$i]', $j)";				
								$this->ejecutar_simple_query('insert' , 'Error Al Registrar Datos Eventos');
							}

						}
						$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('039', '$_SESSION[idUsuario]', current_date, localtime)";
						$this->ejecutar_simple_query('update', 'Evento');

					}
					$this->mensaje = "Evento Creado con éxito";
					$this->tipomsj = "success";
				}
		}

		
	}else{
		
		//Si el evento es para que se apruebe de inmediato
		if ($est_evento=='A') {

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
					if ($fecha[$i]<$fechaactual) {
						$this->mensaje = "No puede Agregar Un Evento en el Pasado! Error, Intente de Nuevo";
						$this->tipomsj = "danger";
						$fechaPasada = true;
						break;
					}else{

					}

					//verifico que el evento no choque con otro
					for ($j=$hora_desde[$i]; $j <= $hora_hasta[$i]; $j++) { 
						$this->consulta = "SELECT * FROM eventos WHERE id_evento in (select id_evento from evento_info
											WHERE fecha = '$fecha[$i]' AND hora = $j) and est_evento = 'A' and id_espacio = '$id_espacio'";
						if ($this->traer_resultados_query_simple()) {
							$sePuede=false;
							$this->mensaje = "No se puede Agregar el Evento. Choca con Otro. Revise";
							$this->tipomsj = "danger";
							break;

						}else{
							
						}
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
					$this->consulta = "INSERT INTO eventos (nom_evento, obj_evento, pon_evento, inversion, id_tipo, id_publico, id_espacio,  est_evento) VALUES ('$nom_evento', '$obj_evento', '$pon_evento', $inversion, '$id_tipo', '$id_publico', '$id_espacio',  '$est_evento' )";
		
					if ($this->ejecutar_simple_query('insert' , 'Error Al Registrar Datos Eventos')==true) {
						
						$cantidadFechas = count($fecha);
						for ($i=0; $i < $cantidadFechas; $i++) { 
							
							for ($j=$hora_desde[$i]; $j <= $hora_hasta[$i]; $j++) { 
								$this->consulta = "INSERT INTO evento_info (id_evento, fecha, hora) VALUES ((SELECT max(id_evento) from eventos), '$fecha[$i]', $j)";				
								$this->ejecutar_simple_query('insert' , 'Error Al Registrar Datos Eventos');
							}

						}
						$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('039', '$_SESSION[idUsuario]', current_date, localtime)";
						$this->ejecutar_simple_query('update', 'Evento');

					}
					$this->mensaje = "Evento Creado con éxito";
					$this->tipomsj = "success";
				}
			
		}else if ($est_evento=='E') {
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
					if ($fecha[$i]<$fechaactual) {
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
					$this->consulta = "INSERT INTO eventos (nom_evento, obj_evento, pon_evento, inversion, id_tipo, id_publico, id_espacio,  est_evento) VALUES ('$nom_evento', '$obj_evento', '$pon_evento', $inversion, '$id_tipo', '$id_publico', '$id_espacio',  '$est_evento' )";
		
					if ($this->ejecutar_simple_query('insert' , 'Error Al Registrar Datos Eventos')==true) {
						
						$cantidadFechas = count($fecha);
						for ($i=0; $i < $cantidadFechas; $i++) { 
							
							for ($j=$hora_desde[$i]; $j <= $hora_hasta[$i]; $j++) { 
								$this->consulta = "INSERT INTO evento_info (id_evento, fecha, hora) VALUES ((SELECT max(id_evento) from eventos), '$fecha[$i]', $j)";				
								$this->ejecutar_simple_query('insert' , 'Error Al Registrar Datos Eventos');
							}

						}
						$this->consulta	= "INSERT INTO movimiento_usuario (cod_mov, id_usuario, fec_mov, hor_mov) VALUES ('039', '$_SESSION[idUsuario]', current_date, localtime)";
						$this->ejecutar_simple_query('update', 'Evento');

					}
					$this->mensaje = "Evento Creado con éxito";
					$this->tipomsj = "success";
				}
		}

	}

	
	


}

public function eliminar($id){
	$this->delete('eventos', $id);
}

public function buscarEspacios(){
	$this->consulta = "SELECT * FROM evento_espacio";
	$this->traer_resultados_query_general();
}





}

 ?>