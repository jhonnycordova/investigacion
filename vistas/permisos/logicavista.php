<?php
session_start();

require('../core/logica.php');
require('../core/models.php');


$diccionario = array('titulos'=>array('asignarPermiso'=>'Asignación de Permisos'));


function llenar_tabla_permisos($html, $data){


	$num_filas = count($data);



	for ($i=0; $i < $num_filas ; $i++) {
			$permiso = new Permisos();
			$permiso->VerificarAdmin($data[$i]);
			$dataPermi = $permiso->filas;


			$html2.="<tr>
					
					<td style='text-align: center;'>{nom_usu} {ape_usu}</td>
					<td style='text-align: center;'><span class='label label-primary'>{usuario}</span></td>
					<td style='text-align: center;'>
							  <div class='btn-group'>
                                  <button data-toggle='dropdown' class='btn btn dropdown-toggle btn-xs' type='button'>&nbsp;&nbsp;&nbsp;<i class='fa fa-{icono1}' style='color:{color1};'></i> &nbsp;&nbsp;<span class='caret'></span></button>
                                  <ul role='menu' class='dropdown-menu' style='min-width:40px'>
                                      <li><a href='/investigacion/permisos/cambiarPermiso/?modulo=".'001'."&status=".'Si'."&id=".$data[$i]['id_usuario']."'><i class='fa fa-check' style='color:green;'></i></a></li>
                                      <li><a href='/investigacion/permisos/cambiarPermiso/?modulo=".'001'."&status=".'No'."&id=".$data[$i]['id_usuario']."'><i class='fa fa-times' style='color:red;'></i></a></li>
                                  </ul>
                              </div>
                    </td>
                    <td style='text-align: center;'>
							  <div class='btn-group'>
                                  <button data-toggle='dropdown' class='btn btn dropdown-toggle btn-xs' type='button'>&nbsp;&nbsp;&nbsp;<i class='fa fa-{icono2}' style='color:{color2};'></i> &nbsp;&nbsp; <span class='caret'></span></button>
                                  <ul role='menu' class='dropdown-menu' style='min-width:40px'>
                                      <li><a href='/investigacion/permisos/cambiarPermiso/?modulo=".'002'."&status=".'Si'."&id=".$data[$i]['id_usuario']."'><i class='fa fa-check' style='color:green;'></i></a></li>
                                      <li><a href='/investigacion/permisos/cambiarPermiso/?modulo=".'002'."&status=".'No'."&id=".$data[$i]['id_usuario']."'><i class='fa fa-times' style='color:red;'></i></a></li>
                                  </ul>
                              </div>
                    </td>
                     


                               ";
					
		
			$html2 .= "</tr>";


			foreach ($data[$i] as $clave=>$valor) {

				$html2 = str_replace('{'.$clave.'}', $valor, $html2);
				
			}

					$modelos = new Models();
					$modelos->buscarDatosId2("permisos", "id_usuario", $data[$i]["id_usuario"]);
					$dataPermi = $modelos->filas;



					$num_per = count($dataPermi);

					for ($j=0; $j < $num_per; $j++) { 
						
						if ($dataPermi[$j]["cod_mod"]=='001') {
							$modulo1="si";
						}

						if ($dataPermi[$j]["cod_mod"]=='002') {
							$modulo2="si";
						}

						
					

					}
					if ($modulo1=="si") {
						$html2 = str_replace('{icono1}', 'check', $html2);
						$html2 = str_replace('{color1}', 'green', $html2);
					}else{
						$html2 = str_replace('{icono1}', 'times', $html2);
						$html2 = str_replace('{color1}', 'red', $html2);
					}

					if ($modulo2=="si") {
						$html2 = str_replace('{icono2}', 'check', $html2);
						$html2 = str_replace('{color2}', 'green', $html2);
					}else{
						$html2 = str_replace('{icono2}', 'times', $html2);
						$html2 = str_replace('{color2}', 'red', $html2);
					}

					
					$modulo1="";
					$modulo2="";
					

	}


	$html = str_replace('{datosTabla}', $html2, $html);

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





if ($vista=='asignarPermiso'){
	$html = str_replace('{contenido}',  buscar_plantilla('asignarPermiso','permisos'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	$html = llenar_tabla_permisos($html, $data);
	
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
