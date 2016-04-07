<?php
session_start();

require('../core/logica.php');
require('../core/models.php');


$diccionario = array('titulos'=>array('auditorio'=>'Eventos Auditorio "Hugo Rafael Chávez Frías"',
									  'salon'=>'Eventos Salón de Usos Múltiples',
									  'modificar'=>'Modificar Área '));

function llenar_tabla($html, $data){

	$num_filas = count($data);

	for ($i=0; $i < $num_filas ; $i++) {
		$html2 .= "<tr>
					<td style='text-align: center;'>
					    <a href='/investigacion/areas/buscar/?id=".$data[$i]['id_area']."' class='btn btn-info btn-xs'><i class='fa fa-pencil'></i> Editar</a>
					    <a href='#' id='".$data[$i]['id_area']."' class='btn btn-danger btn-xs'><i class='fa fa-eraser'></i> Eliminar</a>

					</td>
					<td >{des_area}</td>";
		$html2 .= "</tr>";

		$html2 .= "
						<script type='text/javascript'>

						        $('".$data[$i]['id_area']."').onclick = function () {
						            reset();
						            alertify.confirm('¿Desea Eliminar Esta Área?: <b>".$data[$i]['des_area']."</b>', function (e) {
						                if (e) {
						                	location = '/investigacion/areas/eliminar/?id=".$data[$i]['id_area']."';
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



	$html2 = str_replace('{datosTabla}', $html2, $html);

	return $html;

}

function llenar_calendario($html, $data){



	$html2 = "<script>

			var Script = function () {



    $('#external-events div.external-event').each(function() {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
            title: $.trim($(this).text()) // use the element's text as the event title
        };

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);

        // make the event draggable using jQuery UI
        $(this).draggable({
            zIndex: 999,
            revert: true,      // will cause the event to go back to its
            revertDuration: 0  //  original position after the drag
        });

    });


    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        editable: false,
        droppable: true, // this allows things to be dropped onto the calendar !!!
        drop: function(date, allDay) { // this function is called when something is dropped

            // retrieve the dropped element's stored Event Object
            var originalEventObject = $(this).data('eventObject');

            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);

            // assign it the date that was reported
            copiedEventObject.start = date;
            copiedEventObject.allDay = allDay;

            // render the event on the calendar
            // the last `true` argument determines if the event 'sticks' (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

            // is the 'remove after drop' checkbox checked?
            if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the 'Draggable Events' list
                $(this).remove();
            }

        },
        events: [";

        $num_filas = count($data);

		for ($i=0; $i < $num_filas ; $i++) {

			$modelos3 = new Models();
	        $modelos3->buscarHoraInicio($data[$i]["evento"], $data[$i]["fechainicio"]);
	        $horainicio = $modelos3->filas;

	        $modelos4 = new Models();
	        $modelos4->buscarHoraFin($data[$i]["evento"], $data[$i]["fechafin"]);
	        $horafin = $modelos4->filas;

			$fechaini = explode('-', $data[$i]['fechainicio']);
			$fechafin = explode('-', $data[$i]['fechafin']);

			if ($i == $num_filas-1) {
				 $html2 .="
						            {	
						            	id:'".$data[$i]['evento']."',
						                title: '".$data[$i]['nom_evento']."',
						                start: new Date(".$fechaini[0].", ".($fechaini[1]-1).",".$fechaini[2].",".$horainicio["horainicio"]."),
		                				end: new Date(".$fechafin[0].",".($fechafin[1]-1).",".$fechafin[2].",".$horafin["horafin"]."),
		                				allDay: false,
		                				
						                
						            }";
			}else{
		        $html2 .="
						            {	
						            	id:'".$data[$i]['evento']."',
						                title: '".$data[$i]['nom_evento']."',
						                start: new Date(".$fechaini[0].", ".($fechaini[1]-1).",".$fechaini[2].",".$horainicio["horainicio"]."),
		                				end: new Date(".$fechafin[0].",".($fechaini[1]-1).",".$fechafin[2].",".$horafin["horafin"]."),
		                				allDay: false,
		                				
						                
						            },";
			}

		}
	

		$html2 .="	]
				    });


				}();

					</script>";

	$html = str_replace('{calendario}', $html2, $html);
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
	$html = str_replace('{titulo}', 'Calendario Auditorio', $html);
}else{
	$html = str_replace('{titulo}', 'Calendario Salón Usos Múltiples', $html);
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






if ($vista=='ver'){
	$html = str_replace('{contenido}',  buscar_plantilla('ver','calendarios_pub'), $html);
	if ($id_espacio==1) {
		$html = str_replace('{subtitulo}', 'Calendario Auditorio', $html);
	}else{
		$html = str_replace('{subtitulo}', 'Calendario Salón Usos Múltiples', $html);
	}
	$html = llenar_calendario($html, $data);
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
