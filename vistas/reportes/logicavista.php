<?php
session_start();

require('../core/logica.php');


$diccionario = array('titulos'=>array('movimientos'=>'Buscar Movimientos de Usuarios'));

function llenar_tabla($html, $data){

	$num_filas = count($data);

	for ($i=0; $i < $num_filas ; $i++) {
		$html2 .= "<tr>
					<td style='text-align: center;'>
					    <a href='/investigacion/cargos/buscar/?id=".$data[$i]['id_cargo']."' class='btn btn-info btn-xs'><i class='fa fa-pencil'></i> Editar</a>
					    <a href='#' id='".$data[$i]['id_cargo']."' class='btn btn-danger btn-xs'><i class='fa fa-eraser'></i> Eliminar</a>

					</td>
					<td >{des_cargo}</td>";
		$html2 .= "</tr>";

		$html2 .= "
						<script type='text/javascript'>

						        $('".$data[$i]['id_cargo']."').onclick = function () {
						            reset();
						            alertify.confirm('¿Desea Eliminar el Cargo?: <b>".$data[$i]['des_cargo']."?</b>', function (e) {
						                if (e) {
						                	location = '/investigacion/cargos/eliminar/?id=".$data[$i]['id_cargo']."';
						                } else {
						                	
						                }
						            });
						            return false;
						        };
						</script>";

	    foreach ($data[$i] as $clave=>$valor) {
			$html2 = str_replace('{'.$clave.'}', $valor, $html2);
		}

	}



	$html = str_replace('{datosTabla}', $html2, $html);

	return $html;

}

function pdf($data, $datos){

$actual= date('d-m-Y');
$pdf = new TCPDF("R", "mm", "A4", true, 'UTF-8', false);
$pdf->SetTitle('Movimientos de Usuario');
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->SetMargins('20', '10', '20'); 
$pdf->Addpage();

$modulo = $_SESSION["modulo"];

if ($modulo=='001') {
	$nombreModulo = 'Gestión de Contenido General';
}else if ($modulo=='002') {
	$nombreModulo = 'Gestión de Espacios';
}else if ($modulo=='003') {
	$nombreModulo = 'Gestión de Revista NEXOS';
}



	$html = '
			<table  cellspacing="2" cellpadding="2">
			       <tr>
			       		<td width="80px"><img style="width:80px;" src="../core/tcpdf/images/logo-unerg.jpg"></td><td align="center" width="80%"><br><br>Universidad Nacional Experimental Rómulo Gallegos<br>Decanato de Investigación y Extensión<br><br><b>'.$nombreModulo.'</b></td>
			       </tr>
			       <tr><td colspan="2" align="right" style="font-size:25px">Fecha: '.$actual.'</td></tr>
			       <tr>
			       		<br><br>
			       		<td colspan="2" align="center">Movimientos de Usuario Entre el <font color="red">'.$datos["fec_des"].' </font> Hasta el <font color="red">'.$datos["fec_has"].'</font></td>
			       </tr>
			       <tr>
			       		<td colspan="2">Usuario: <font color="red">'.$data[0]["usuario"].'</font></td>
			       </tr>
			        
			</table><br>';

	$html.='
			<table border="1" cellspacing="2" cellpadding="2">
			     <tr style="font-weight:bold;background-color:gray;color:white">
			     	
			     	<td width="200px" >Descripción</td>
			     	<td >Fecha</td>
			     	<td  width="135px">Hora</td>
			     </tr>
			    

			';

		$num_filas = count($data);

		for ($i=0; $i < $num_filas ; $i++) {
							
					
			$fecha_ini = explode('-', $data[$i]["fecha"]);
			$fec_ini_pro = $fecha_ini[2]."-".$fecha_ini[1]."-".$fecha_ini[0];

			$hora = explode('.', $data[$i]["hora"]);

			$hora2 = $hora[0];

		$html .= '  <tr>
			       
			          <td >'.$data[$i]['descripcion'].'</td>
			          
			          <td >'.$fec_ini_pro.'</td>
			          <td >'.$hora2.'</td>
			          
			        </tr>';

		}

		$html.= '</table><br></br>';


	$pdf->writeHTML($html, true, false, true, false, '');

	$pdf->Output('Movimientos.pdf', 'D');

   
}



function hacer_datos_dinamicos($html, $data) {


	foreach ($data as $clave=>$valor) {
		$html = str_replace('{'.$clave.'}', $valor, $html);
	}

	return $html;
}

function llenar_select_usuario($html, $datos_select_usuario){

	$num_filas = count($datos_select_usuario);

	for ($i=0; $i < $num_filas ; $i++) { 
		$html2 .= "<option value='".$datos_select_usuario[$i]['id_usuario']."'> ".$datos_select_usuario[$i]['nom_usu']." ".$datos_select_usuario[$i]['ape_usu']."</option>";
	}

	$html = str_replace('{usuarios}', $html2, $html);

	return $html;
}






function retornar_vista($vista, $data = array(), $parametros = array(), $datos_select_usuario, $datos) {


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



if ($vista=='movimientos'){
	$html = str_replace('{contenido}',  buscar_plantilla('movimientos','reportes'), $html);
	$html = str_replace('{subtitulo}', $diccionario['titulos'][$vista], $html);
	$html = llenar_select_usuario($html, $datos_select_usuario);
}

if ($vista=='pdf'){
	$html = pdf($data, $datos);
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
