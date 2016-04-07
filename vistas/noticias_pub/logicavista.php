<?php
session_start();

require('../core/logica.php');
require('../core/models.php');


$diccionario = array('titulos'=>array('detalle'=>'Detalle de Noticia'));


function cargarNoticia($html, $data){



	foreach ($data as $clave=>$valor) {

		if ($clave =='titulo') {
			$html = str_replace('{titulo_not}', $valor, $html);
		}

		if ($clave =='fec_not') {
			
			$fecha = explode('-', $valor);
			$fecha2 = $fecha[2]."/".$fecha[1]."/".$fecha[0];

			$html = str_replace('{fecha}', $fecha2, $html);
		}

		$html = str_replace('{'.$clave.'}', $valor, $html);
	}

		  $modelo = new Models();
          $modelo->buscarImgNoticia($data["id_noticia"]);
          $imagenes = $modelo->filas;

          $num_img = count($imagenes);

          if ($num_img>0) {
          	$html2.= '<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="max-width:515px;margin-left:110px">
					  <!-- Indicators -->
					  <ol class="carousel-indicators">
					    {punticos}
					  </ol>

					  <!-- Wrapper for slides -->
					  <div class="carousel-inner" role="listbox">
					    	{imagenesnot}
					  </div>

					  <!-- Controls -->
					  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
					    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					    <span class="sr-only">Previous</span>
					  </a>
					  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
					    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					    <span class="sr-only">Next</span>
					  </a>
					</div>';

					for ($i=0; $i < $num_img; $i++) { 
			         	if ($i==0) {
			         		$punticos .= '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'" class="active"></li>';
			         		
			         		$imagenesnot .= '<div class="item active">
								      <img src="/investigacion/publico/admin/img/noticias/'.$imagenes[$i]['img_not'].'" alt="..." style="max-height:290px">
								      
								    </div>';
			         	}else{
			         		$punticos .= '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'" class=""></li>';
			         		
			         		$imagenesnot .= '<div class="item ">
								      <img src="/investigacion/publico/admin/img/noticias/'.$imagenes[$i]['img_not'].'" alt="..." style="max-height:290px">
								      
								    </div>';
			         	}
			         }

						$html = str_replace('{imagenes}', $html2, $html);
						$html = str_replace('{punticos}', $punticos, $html);
						$html = str_replace('{imagenesnot}', $imagenesnot, $html);

			         
          }else{
          		$html = str_replace('{imagenes}', '', $html);
          }

         



          
          

			

	return $html;


}


function retornar_vista($vista, $data = array(), $parametros = array()) {


	foreach ($parametros as $campo => $value) {
		$$campo = $value;
	}

	global $diccionario;

	$html = buscar_plantilla_main();


	if ($vista=='detalle'){
		
	$html = str_replace('{contenido}',  buscar_plantilla('detalle','noticias_pub'), $html);
	$html = str_replace('{titulo}', $diccionario['titulos'][$vista], $html);
	$html = cargarNoticia($html, $data);

}


	print $html;

}


 ?>