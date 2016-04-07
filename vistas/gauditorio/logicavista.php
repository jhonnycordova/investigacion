<?php
session_start();

require('../core/logica.php');

$diccionario = array('titulos'=>array('index'=>'Gestión de Espacios'));


function llenar_grafico($html, $dataEventos){

	$cantidadEve = count($dataEventos);

	$cantidadEne= 0;
	$multiEne = 0;
	$totalEne = 0;

	$cantidadFeb= 0;
	$multiFeb = 0;
	$totalFeb = 0;

	$cantidadMar= 0;
	$multiMar = 0;
	$totalMar = 0;

	$cantidadAbr= 0;
	$multiAbr = 0;
	$totalAbr = 0;

	$cantidadMay= 0;
	$multiMay = 0;
	$totalMay = 0;

	$cantidadJun= 0;
	$multiJun = 0;
	$totalJun = 0;

	$cantidadJul= 0;
	$multiJul = 0;
	$totalJul = 0;

	$cantidadAgo= 0;
	$multiAgo = 0;
	$totalAgo = 0;

	$cantidadSep= 0;
	$multiSep = 0;
	$totalSep = 0;

	$cantidadOct= 0;
	$multiOct = 0;
	$totalOct = 0;

	$cantidadNov= 0;
	$multiNov = 0;
	$totalNov = 0;

	$cantidadDic= 0;
	$multiDic = 0;
	$totalDic = 0;




	$fechaactual = date('Y-m-d');
	for ($i=0; $i < $cantidadEve; $i++) { 
		
		$fecha = $dataEventos[$i]["fechafin"];
		$fecha2 = explode("-", $fecha);	
		
		if (($fecha2[1]=='01') && ($fecha<$fechaactual)) {
			$cantidadEne++;
			$multiEne = $cantidadEne*100;
			$totalEne = $multiEne/25;
		}else if (($fecha2[1]=='02') && ($fecha<$fechaactual)) {
			$cantidadFeb++;
			$multiFeb = $cantidadFeb*100;
			$totalFeb = $multiFeb/25;
		}else if (($fecha2[1]=='03') && ($fecha<$fechaactual)) {
			$cantidadMar++;
			$multiMar = $cantidadMar*100;
			$totalMar = $multiMar/25;
		}else if (($fecha2[1]=='04') && ($fecha<$fechaactual)) {
			$cantidadAbr++;
			$multiAbr = $cantidadAbr*100;
			$totalAbr = $multiAbr/25;
		}else if (($fecha2[1]=='05') && ($fecha<$fechaactual)) {
			$cantidadMay++;
			$multiMay = $cantidadMay*100;
			$totalMay = $multiMay/25;
		}else if (($fecha2[1]=='06') && ($fecha<$fechaactual)) {
			$cantidadJun++;
			$multiJun = $cantidadJun*100;
			$totalJun = $multiJun/25;
		}else if (($fecha2[1]=='07') && ($fecha<$fechaactual)) {
			$cantidadJul++;
			$multiJul = $cantidadJul*100;
			$totalJul = $multiJul/25;
		}else if (($fecha2[1]=='08') && ($fecha<$fechaactual)) {
			$cantidadAgo++;
			$multiAgo = $cantidadAgo*100;
			$totalAgo = $multiAgo/25;
		}else if (($fecha2[1]=='09') && ($fecha<$fechaactual)) {
			$cantidadSep++;
			$multiSep = $cantidadSep*100;
			$totalSep = $multiSep/25;
		}else if (($fecha2[1]=='10') && ($fecha<$fechaactual)) {
			$cantidadOct++;
			$multiOct = $cantidadOct*100;
			$totalOct = $multiOct/25;
		}else if (($fecha2[1]=='11') && ($fecha<$fechaactual)) {
			$cantidadNov++;
			$multiNov = $cantidadNov*100;
			$totalNov = $multiNov/25;
		}else if (($fecha2[1]=='12') && ($fecha<$fechaactual)) {
			$cantidadDic++;
			$multiDic = $cantidadDic*100;
			$totalDic = $multiDic/25;
		}

		

	}

	

	$html = str_replace('{cantidadEne}', $cantidadEne, $html);
	$html = str_replace('{cantidadEne2}', $totalEne, $html);
	$html = str_replace('{cantidadFeb}', $cantidadFeb, $html);
	$html = str_replace('{cantidadFeb2}', $totalFeb, $html);
	$html = str_replace('{cantidadMar}', $cantidadMar, $html);
	$html = str_replace('{cantidadMar2}', $totalMar, $html);
	$html = str_replace('{cantidadAbr}', $cantidadAbr, $html);
	$html = str_replace('{cantidadAbr2}', $totalAbr, $html);
	$html = str_replace('{cantidadMay}', $cantidadMay, $html);
	$html = str_replace('{cantidadMay2}', $totalMay, $html);
	$html = str_replace('{cantidadJun}', $cantidadJun, $html);
	$html = str_replace('{cantidadJun2}', $totalJun, $html);
	$html = str_replace('{cantidadJul}', $cantidadJul, $html);
	$html = str_replace('{cantidadJul2}', $totalJul, $html);
	$html = str_replace('{cantidadAgo}', $cantidadAgo, $html);
	$html = str_replace('{cantidadAgo2}', $totalAgo, $html);
	$html = str_replace('{cantidadSep}', $cantidadSep, $html);
	$html = str_replace('{cantidadSep2}', $totalSep, $html);
	$html = str_replace('{cantidadOct}', $cantidadOct, $html);
	$html = str_replace('{cantidadOct2}', $totalOct, $html);
	$html = str_replace('{cantidadNov}', $cantidadNov, $html);
	$html = str_replace('{cantidadNov2}', $totalNov, $html);
	$html = str_replace('{cantidadDic}', $cantidadDic, $html);
	$html = str_replace('{cantidadDic2}', $totalDic, $html);

	return $html;
}


function retornar_vista($vista, $data = array(), $parametros = array(), $dataEventos) {

	foreach ($parametros as $campo => $value) {
		$$campo = $value;
	}

	global $diccionario;

	$html = buscar_plantilla_main_admin();

	$html = str_replace('{titulo}', $diccionario['titulos'][$vista], $html);

	$html = str_replace('{modulo}', 'Gestión de Espacios', $html);

	$html = str_replace('{sidebar}', buscar_sidebar2(), $html);

	$html = str_replace('{contenido}',  buscar_plantilla('index','gauditorio'), $html);

	$html = str_replace('{usuario}', $_SESSION['nombreUsuario'], $html);

	$html = str_replace('{modelo}', 'gauditorio', $html);

	$html = str_replace('{idUsuario}', $_SESSION['idUsuario'] , $html);
	$html = str_replace('{cantidadsol}', $data["count"] , $html);

	$html = llenar_grafico($html, $dataEventos);

	if ($_SESSION["superusuario"]=='si') {
		$html = str_replace('{super}', '', $html);
		$html = str_replace('{nosuper}', 'none', $html);
	}else{
		$html = str_replace('{nosuper}', '', $html);
		$html = str_replace('{super}', 'none', $html);
	}


	print $html;

}


 ?>