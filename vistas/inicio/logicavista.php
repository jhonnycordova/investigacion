<?php
session_start();

require('../core/logica.php');
require('../core/models.php');


$diccionario = array('titulos'=>array('index'=>'Bienvenidos'));


function llenar_carousel($html, $data){

	$num_filas = count($data);

	for ($i=0; $i < $num_filas ; $i++) {
		$html2 .= "<div class='item {active}'>
                    <img src='/investigacion/publico/admin/img/carousel/{imagen}'>
                    <div class='carousel-caption'>
                        <h1 class='carousel-caption-header'>{des_img}</h1>
                        
                    </div>
                </div>";
		$html2 .= "</tr>";

		$html3.= '<li data-target="#transition-timer-carousel" data-slide-to="'.$i.'" class="{active}"></li>';

	

	    foreach ($data[$i] as $clave=>$valor) {
			$html2 = str_replace('{'.$clave.'}', $valor, $html2);

		}
		if ($i==0) {
			$html2 = str_replace('{active}', 'active', $html2);
		}else{
			$html2 = str_replace('{active}', '', $html2);
		}

	}

	$html = str_replace('{carousel}', $html2, $html);
	$html = str_replace('{punticos}', $html3, $html);

	return $html;
}


function llenar_noticias($html, $data_noticias){

	$num_filas = count($data_noticias);



	for ($i=0; $i < $num_filas ; $i++) {
		$html2 .= '<div class="row carousel-row">
                                <div class="col-xs-10 slide-row">
                                    <div id="carousel-'.$i.'" class="carousel slide slide-carousel" data-ride="carousel">
                                      <!-- Indicators -->
                                      <ol class="carousel-indicators">
                                        {punticos}
                                      </ol>
                                    
                                      <!-- Wrapper for slides -->
                                      <div class="carousel-inner">
                                        {imagenes}
                                      </div>
                                    </div>
                                    <div class="slide-content">
                                        <h4>{titulo}</h4>
                                        <p>
                                            {des_not}
                                        </p>
                                    </div>
                                    <div class="slide-footer">
                                        <span class="pull-right buttons">
                                            <a class="btn btn-sm btn-primary" href="/investigacion/noticias_pub/detalle/?id_noticia={id_noticia}">Leer más</a>
                                        </span>
                                    </div>
                            </div>
                       </div>';
		
         $modelo = new Models();
          $modelo->buscarImgNoticia($data_noticias[$i]["id_noticia"]);
          $imagenes = $modelo->filas;

          $num_img = count($imagenes);

          for ($j=0; $j < $num_img; $j++) { 
          	
          	$html4 .= '<div class="item {active}">
                                             <img src="/investigacion/publico/admin/img/noticias/'.$imagenes[$j]["img_not"].'">
                                       </div>';
            $html3 .= '<li data-target="#carousel-'.$i.'" data-slide-to="'.$j.'" class="{active}"></li>';

            if ($j==0) {
					$html4 = str_replace('{active}', 'active', $html4);
					$html3 = str_replace('{active}', 'active', $html3);
				}else{
					$html4 = str_replace('{active}', '', $html4);
					$html3 = str_replace('{active}', '', $html3);
				}
            
          }
			
			$html2 =  str_replace('{punticos}', $html3, $html2);
            $html2 =  str_replace('{imagenes}', $html4, $html2);

			$html3="";
			$html4="";

	    foreach ($data_noticias[$i] as $clave=>$valor) {
			$html2 = str_replace('{'.$clave.'}', $valor, $html2);

		}
		

		
	}

		$html = str_replace('{noticias}', $html2, $html);
		
	

	return $html;
}


function retornar_vista($vista, $data = array(), $parametros = array(), $data_noticias) {

	foreach ($parametros as $campo => $value) {
		$$campo = $value;
	}

	global $diccionario;

	$html = buscar_plantilla_main();


	if ($vista=='index'){
		
	$html = str_replace('{contenido}',  buscar_plantilla('index','inicio'), $html);
	$html = str_replace('{titulo}', $diccionario['titulos'][$vista], $html);
	$html = llenar_carousel($html, $data);
	$html = llenar_noticias($html, $data_noticias);
}


	print $html;

}


 ?>