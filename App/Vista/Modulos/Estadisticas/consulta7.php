<?php
	include_once PATH_NEGOCIO."Sistema/handlerconsultascontrol.class.php";  	
    include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
    include_once PATH_NEGOCIO."Funciones/Array/funcionesarray.class.php"; 
    include_once PATH_NEGOCIO."Usuarios/handlerusuarios.class.php";  	    
    include_once PATH_NEGOCIO."Parametros/handlerparametros.class.php";        

    $dFecha = new Fechas;

	$fdesde = (isset($_GET["fdesde"])?$_GET["fdesde"]:$dFecha->FechaActual());
	$fhasta = (isset($_GET["fhasta"])?$_GET["fhasta"]:$dFecha->FechaActual());	
	
	$fusuario=(isset($_GET["fusuario"])?$_GET["fusuario"]:'');

	$handlerUsuarios = new HandlerUsuarios;
	$arrUsuarios = $handlerUsuarios->selectTodos();

	$handler =  new HandlerConsultasControl;
	$consulta = $handler->controlInicioSesion($fdesde, $fhasta, $fusuario);	

	$p_handler = new HandlerParametros;
	$hora_limite = $p_handler->seleccionarById(1)["valor_time"]->format('H:i:s');	
?>

<div class='col-md-12'>
    <div class="box box-solid">
      	<div class="box-header with-border">
        	<i class="fa fa-filter"></i>
        	<h3 class="box-title">Filtros Disponibles</h3>
        	<button type="button" class="btn btn-box-tool pull-right bg-red" data-widget="collapse"><i class="fa fa-minus"></i></button>
      	</div>
      	<div class="box-body">
        	<div class='row'>  
				<div class="col-md-3" id='sandbox-container'>
				  	<label>Fecha Desde - Hasta </label>                
				  	<div class="input-daterange input-group" id="datepicker">
				     	<input type="text" class="input-sm form-control" onchange="crearHref()" id="start" name="start" value="<?php echo $dFecha->FormatearFechas($fdesde,'Y-m-d','d/m/Y'); ?>"/>
				      	<span class="input-group-addon">a</span>
				      	<input type="text" class="input-sm form-control" onchange="crearHref()" id="end" name="end" value="<?php echo $dFecha->FormatearFechas($fhasta,'Y-m-d','d/m/Y'); ?>"/>
				  	</div>
				</div>
			  	<div class="col-md-3">
				  	<label>Usuarios </label>                
				  	<select id="slt_usuario" class="form-control" style="width: 100%" name="slt_usuario" onchange="crearHref()">
				    	<option value=''></option>
				    	<option value='0'>TODOS</option>
					    <?php
					      if(!empty($arrUsuarios))
					      {   					      	
					      					      	
					        foreach ($arrUsuarios as $key => $value) {  					        	

					          if($fusuario == $value->getId())
					            echo "<option value='".$value->getId()."' selected>".$value->getNombre()."</option>";
					          else
					            echo "<option value='".$value->getId()."'>".$value->getNombre()."</option>";					        
					            
					        }
					        
					      }                      
					    ?>
					</select>
				</div>				
				<div class='col-md-3 col-md-offset-3'>                
				  <label></label>                
				  <a class="btn btn-block btn-success" id="filtro_reporte" onclick="crearHref()"><i class='fa fa-filter'></i> Filtrar</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class='col-md-12'>
	<div class="box">
		<div class="box-header">
		  <h3 class="box-title">Inicios de Sesión - <?php echo "desde <b>".$dFecha->FormatearFechas($fdesde,'Y-m-d','d/m/Y')."</b> hasta <b>".$dFecha->FormatearFechas($fhasta,'Y-m-d','d/m/Y')."</b>"; ?></h3>	  
		  <span class="pull-right label label-warning" style="font-size: 12px;">Tiempo hasta las <?php echo $hora_limite; ?> HS para iniciar sesión</span>
		</div>

		<div class="box-body table-responsive">
		  	<table class="table table-striped" id='tabla'>
			    <thead>
			    	<tr>
				    	<th>FECHA</th>
				    	<th>HORA</th>				    	
				    	<th>USUARIO</th>
				    	<th>IP</th>				    	
				    	<th>UBICACION</th>
				    	<th>GEO</th>				      	
				    	<th>ESTADO</th>				      	
				    </tr>
				</thead>
				<tbody>
				    <?php

				    	if(!empty($consulta))
				    	{				    		

				    		foreach ($consulta as $key => $value) {			
				 				
				 				if($value->getFechaHora()->format('H:s:i')>$hora_limite)
		                        	$estado = "<span class='label label-danger'>TARDE</span>";
		                        else
		                           	$estado = "<span class='label label-success'>A TIEMPO</span>";   

				    			echo "
				    				<tr>
								    	<td>".$value->getFechaHora()->format('d/m/Y')."</td>
								    	<td>".$value->getFechaHora()->format('H:i:s')."</td>								    	
								      	<td>".$value->getUsuarioId()->getNombre()."</td>
								      	<td>".$value->getIp()."</td>								      	
										<td><a target='_blank' href='http://maps.google.com/?q=".$value->getLatitud().",".$value->getLongitud()."'>Mapa</a></td>
								      	<td>".$value->getDetalle()."</td>	
								      	<td>".$estado."</td>                                        
								    </tr>	    
				    			";
				    		}
				    	}
				    ?>
			  	</tbody>
		 	</table>
		</div>
	</div>
</div>

<script type="text/javascript">	

	$(document).ready(function() {
	    $('#tabla').DataTable({
	      "dom": 'Bfrtip',
	      "buttons": ['copy', 'csv', 'excel', 'print'],
	      "iDisplayLength":100,
	      "language": {
	          "sProcessing":    "Procesando...",
	          "sLengthMenu":    "Mostrar _MENU_ registros",
	          "sZeroRecords":   "No se encontraron resultados",
	          "sEmptyTable":    "Ningún dato disponible en esta tabla",
	          "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
	          "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
	          "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
	          "sInfoPostFix":   "",
	          "sSearch":        "Buscar:",
	          "sUrl":           "",
	          "sInfoThousands":  ",",
	          "sLoadingRecords": "Cargando...",
	          "oPaginate": {
	              "sFirst":    "Primero",
	              "sLast":    "Último",
	              "sNext":    "Siguiente",
	              "sPrevious": "Anterior"
	          },
	          "oAria": {
	              "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
	              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
	          }
	        }                                
	    });
	});

	$('#sandbox-container .input-daterange').datepicker({
	    format: "dd/mm/yyyy",
	    clearBtn: false,
	    language: "es",
	    keyboardNavigation: false,
	    forceParse: false,
	    autoclose: true,
	    todayHighlight: true,                                                                        
	    multidate: false,
	    todayBtn: "linked",  
	});

  	$(document).ready(function() {
    	$("#slt_usuario").select2({
        	placeholder: "Seleccionar un Usuario",                  
    	});
  	});	

	crearHref();
	function crearHref()
	{
	    aStart = $("#start").val().split('/');
	    aEnd = $("#end").val().split('/');

	    f_inicio = aStart[2] +"-"+ aStart[1] +"-"+ aStart[0];
	    f_fin = aEnd[2] +"-"+ aEnd[1] +"-"+ aEnd[0];                      	    	   

	    f_usuario = $("#slt_usuario").val();     
	    
	    url_filtro_reporte="index.php?view=estadisticas&consulta=cons7&fdesde="+f_inicio+"&fhasta="+f_fin	 

	  	if(f_usuario!=undefined)
	      if(f_usuario>0)
	        url_filtro_reporte= url_filtro_reporte + "&fusuario="+f_usuario

	    $("#filtro_reporte").attr("href", url_filtro_reporte);
	} 

</script>
<script type="text/javascript">        
  $(document).ready(function(){                
    $("#mnu_estadisticas").addClass("active");
  });
</script>