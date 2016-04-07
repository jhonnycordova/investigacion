<?php
session_start();

require('../core/logica.php');
require('../core/models.php');
include('../modelos/permisos.php');

$diccionario = array('titulos'=>array('registrar'=>'Agregar Nuevo Usuario',
									  'verdatos'=>'Tabla de Usuarios',
									  'modificar'=>'Modificación de Usuarios',
									  'perfil'=>'Perfil Usuario',
									  'asignarPermiso'=>'Asignación de Permisos',
									  'cambiarClave'=>'Cambio de Clave'));

function llenar_tabla($html, $data){
	$num_filas = count($data);


	for ($i=0; $i < $num_filas ; $i++) {
		$permiso = new Permisos();
		$permiso->VerificarAdmin($data[$i]);
		$dataPermi = $permiso->filas;
		
		if (count($dataPermi)==2 && $_SESSION["superusuario"]!='si') {
			
		}else{
			$html2.="<tr>
					<td style='text-align: center;'> <a href='/investigacion/usuarios/buscar/?id=".$data[$i]['id_usuario']."' class='btn btn-info btn-xs'><i class='fa fa-pencil'></i> Editar</a></td>
					<td style='text-align: center;'>{nom_usu} {ape_usu}</td>
					<td style='text-align: center;'>{email_usu}</td>
					<td style='text-align: center;'>{tel_usu}</td>
					<td style='text-align: center;'><span class='label label-primary'>{usuario}</span</td>";
					if($data[$i]['estado'] == 'A'){
						$html2 .= "<td style='text-align: center;'><span class='label label-success'>{estado}</span></td>";
					}else{
						$html2 .= "<td style='text-align: center;'><span class='label label-danger'>{estado}</span></td>";
					}
		
			$html2 .= "</tr>";

		
			foreach ($data[$i] as $clave=>$valor) {
				$modelos = new Models();
				$modelos->buscarDatosId2("usuario_email", "id_usuario", $data[$i]["id_usuario"]);
				$correos = $modelos->filas;

				$modelos2 = new Models();
				$modelos2->buscarDatosId2("usuario_tel", "id_usuario", $data[$i]["id_usuario"]);
				$telefonos = $modelos2->filas;

				if($clave == 'estado' && $valor == 'A'){
					$valor = 'Activo';
				}else if($clave == 'estado' && $valor == 'I'){
					$valor = 'Inactivo';
				}

				$num_email = count($correos);
				for ($j=0; $j < $num_email; $j++) { 
					if ($j==$num_email-1) {
						$email.= $correos[$j]["email_usu"];
					}else{
						$email.= $correos[$j]["email_usu"].",<br> ";
					}
				}

				$num_tel = count($telefonos);
				for ($j=0; $j < $num_tel; $j++) { 
					if ($j==$num_tel-1) {
						$tel.= $telefonos[$j]["tel_usu"];
					}else{
						$tel.= $telefonos[$j]["tel_usu"].",<br> ";
					}
				}
				
				$html2 = str_replace('{'.$clave.'}', $valor, $html2);
				$html2 = str_replace('{email_usu}', $email, $html2);
				$html2 = str_replace('{tel_usu}', $tel, $html2);

				
			}

			$email = "";
			$tel = "";
		}
		


	
	}


	$html = str_replace('{datosTabla}', $html2, $html);

	return $html;

}

function llenar_tabla_permisos($html, $data){
	

	$num_filas = count($data[0]);

	for ($i=0; $i < $num_filas ; $i++) {
		
			$html2.="<tr>
					
					<td style='text-align: center;'>{nom_usu} {ape_usu}</td>
					<td style='text-align: center;'><span class='label label-primary'>{usuario}</span></td>
					<td style='text-align: center;'>
							  <div class='btn-group'>
                                  <button data-toggle='dropdown' class='btn btn-{color} dropdown-toggle btn-xs' type='button'>{status} <span class='caret'></span></button>
                                  <ul role='menu' class='dropdown-menu' style='min-width:40px'>
                                      <li><a href='/investigacion/usuarios/cambiarPermiso/?modulo=".'001'."&status=".'Si'."&id=".$data[$i]['id_usuario']."'><i class='fa fa-check' style='color:green;'></i></a></li>
                                      <li><a href='/investigacion/usuarios/cambiarPermiso/?modulo=".'001'."&status=".'No'."&id=".$data[$i]['id_usuario']."'><i class='fa fa-times' style='color:red;'></i></a></li>
                                  </ul>
                              </div>
                    </td>
                    <td style='text-align: center;'>
							  <div class='btn-group'>
                                  <button data-toggle='dropdown' class='btn btn-{color} dropdown-toggle btn-xs' type='button'>{status} <span class='caret'></span></button>
                                  <ul role='menu' class='dropdown-menu' style='min-width:40px'>
                                      <li><a href='/investigacion/usuarios/cambiarPermiso/?modulo=".'002'."&status=".'Si'."&id=".$data[$i]['id_usuario']."'><i class='fa fa-check' style='color:green;'></i></a></li>
                                      <li><a href='/investigacion/usuarios/cambiarPermiso/?modulo=".'002'."&status=".'No'."&id=".$data[$i]['id_usuario']."'><i class='fa fa-times' style='color:red;'></i></a></li>
                                  </ul>
                              </div>
                    </td>
                     <td style='text-align: center;'>
							  <div class='btn-group'>
                                  <button data-toggle='dropdown' class='btn btn-{color} dropdown-toggle btn-xs' type='button'>{status} <span class='caret'></span></button>
                                  <ul role='menu' class='dropdown-menu' style='min-width:40px'>
                                      <li><a href='/investigacion/usuarios/cambiarPermiso/?modulo=".'003'."&status=".'Si'."&id=".$data[$i]['id_usuario']."'><i class='fa fa-check' style='color:green;'></i></a></li>
                                      <li><a href='/investigacion/usuarios/cambiarPermiso/?modulo=".'003'."&status=".'No'."&id=".$data[$i]['id_usuario']."'><i class='fa fa-times' style='color:red;'></i></a></li>
                                  </ul>
                              </div>
                    </td>


                               ";
					
		
			$html2 .= "</tr>";


			foreach ($data[0][$i] as $clave=>$valor) {

				$html2 = str_replace('{'.$clave.'}', $valor, $html2);
				
			}

			foreach ($data[1][$i] as $clave => $valor) {
				if(($clave=='status')&&($valor=='Si')){
					$html2 = str_replace('{icono}', 'check', $html2);
					$html2 = str_replace('{color}', 'success', $html2);
					
				}

				if(($clave=='status')&&($valor=='No')){
					$html2 = str_replace('{icono}', 'times', $html2);
					$html2 = str_replace('{color}', 'danger', $html2);
				}
				$html2 = str_replace('{'.$clave.'}', $valor, $html2);
			}

	}


	$html = str_replace('{datosTabla}', $html2, $html);

	return $html;
}

function hacer_datos_dinamicos($html, $data) {

	foreach ($data as $clave=>$valor) {
			$modelos = new Models();
			$modelos->buscarDatosId2("usuario_email", "id_usuario", $data["id_usuario"]);
			$correos = $modelos->filas;
		

			$modelos2 = new Models();
			$modelos2->buscarDatosId2("usuario_tel", "id_usuario", $data["id_usuario"]);
			$telefonos = $modelos2->filas;


			$num_email = count($correos);
			if (count($correos)==0) {
						$html2 .= " <div class='form-group input-group col-lg-8'>

		                                            <input type='text' name='email_usu[]' id='email_usu[]' class='form-control' >
		                                              <span class='input-group-btn'><button type='button' class='btn btn-default btn-add'>+
		                                              </button></span>
		                           </div>";
			}else{
					for ($j=0; $j < $num_email; $j++) { 
						$html2 .= " <div class='form-group input-group col-lg-8'>

		                                            <input type='text' name='email_usu[]' id='email_usu[]' class='form-control' value=".$correos[$j]["email_usu"].">
		                                              <span class='input-group-btn'><button type='button' class='btn btn-default btn-add'>+
		                                              </button></span>
		                           </div>";
					}
			}
		

			$num_tel = count($telefonos);
			if (count($telefonos)==0) {
						$html3 .= "<div class='form-group input-group col-lg-8'>
                                              <input class='form-control' id='tel_usu[]' name='tel_usu[]' type='text'>   
                                              <span class='input-group-btn'><button type='button' class='btn btn-default btn-add'>+
                                              </button></span>
                           </div>";
			}else{
				for ($j=0; $j < $num_tel; $j++) { 

						$html3 .= "<div class='form-group input-group col-lg-8'>
		                                              <input class='form-control' id='tel_usu[]' name='tel_usu[]' type='text' value=".$telefonos[$j]["tel_usu"].">   
		                                              <span class='input-group-btn'><button type='button' class='btn btn-default btn-add'>+
		                                              </button></span>
		                           </div>";
				}
			}
			

			if($clave == 'estado' && $valor == 'A'){
				$valor = 'Activo';
				$html = str_replace('{Ac}', 'selected', $html);
			}else if($clave == 'estado' && $valor == 'I'){
				$valor = 'Inactivo';
				$html = str_replace('{In}', 'selected', $html);
			}
		$html = str_replace('{'.$clave.'}', $valor, $html);

		$html = str_replace('{correos}', $html2, $html);

		$html = str_replace('{telefonos}', $html3, $html);
		
	}
	return $html;
}

function hacer_datos_dinamicos_permisos($html, $data) {

	
	foreach ($data as $clave=>$valor) {
			$modelos = new Models();
			$modelos->buscarDatosId2("usuario_email", "id_usuario", $data["id_usuario"]);
			$correos = $modelos->filas;
		

			$modelos2 = new Models();
			$modelos2->buscarDatosId2("usuario_tel", "id_usuario", $data["id_usuario"]);
			$telefonos = $modelos2->filas;


			$num_email = count($correos);
			if (count($correos)==0) {
						$html2 .= " <div class='form-group input-group col-lg-8'>

		                                            <input type='text' name='email_usu[]' id='email_usu[]' class='form-control' >
		                                              <span class='input-group-btn'><button type='button' class='btn btn-default btn-add'>+
		                                              </button></span>
		                           </div>";
			}else{
					for ($j=0; $j < $num_email; $j++) { 
						$html2 .= " <div class='form-group input-group col-lg-8'>

		                                            <input type='text' name='email_usu[]' id='email_usu[]' class='form-control' value=".$correos[$j]["email_usu"].">
		                                              <span class='input-group-btn'><button type='button' class='btn btn-default btn-add'>+
		                                              </button></span>
		                           </div>";
					}
			}
		

			$num_tel = count($telefonos);
			if (count($telefonos)==0) {
						$html3 .= "<div class='form-group input-group col-lg-8'>
                                              <input class='form-control' id='tel_usu[]' name='tel_usu[]' type='text'>   
                                              <span class='input-group-btn'><button type='button' class='btn btn-default btn-add'>+
                                              </button></span>
                           </div>";
			}else{
				for ($j=0; $j < $num_tel; $j++) { 

						$html3 .= "<div class='form-group input-group col-lg-8'>
		                                              <input class='form-control' id='tel_usu[]' name='tel_usu[]' type='text' value=".$telefonos[$j]["tel_usu"].">   
		                                              <span class='input-group-btn'><button type='button' class='btn btn-default btn-add'>+
		                                              </button></span>
		                           </div>";
				}
			}
			

			if($clave == 'estado' && $valor == 'A'){
				$valor = 'Activo';
				$html = str_replace('{Ac}', 'selected', $html);
			}else if($clave == 'estado' && $valor == 'I'){
				$valor = 'Inactivo';
				$html = str_replace('{In}', 'selected', $html);
			}
		$html = str_replace('{'.$clave.'}', $valor, $html);

		$html = str_replace('{correos}', $html2, $html);

		$html = str_replace('{telefonos}', $html3, $html);
		
	}
	return $html;
}




function retornar_vista($vista, $data = array(), $parametros = array()) {

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
	$html = str_replace('{contenido}',  buscar_plantilla('registrar','usuarios'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);

}

if ($vista=='verdatos'){
	$html = str_replace('{contenido}',  buscar_plantilla('verdatos','usuarios'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	$html = llenar_tabla($html, $data);
}

if ($vista=='modificar'){
	$html = str_replace('{contenido}',  buscar_plantilla('modificar','usuarios'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	$html = hacer_datos_dinamicos($html, $data);
}

if ($vista=='asignarPermiso'){
	$html = str_replace('{contenido}',  buscar_plantilla('asignarPermiso','usuarios'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	$html = llenar_tabla_permisos($html, $data);
	//$html = hacer_datos_dinamicos_permisos($html, $data);
}

if ($vista=='cambiarClave'){
	$html = str_replace('{contenido}',  buscar_plantilla('cambiarClave','usuarios'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	$html = str_replace('{idUsuario}', $_SESSION["idUsuario"], $html);
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
