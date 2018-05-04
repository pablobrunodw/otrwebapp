<?php
	include_once PATH_NEGOCIO."Sistema/handlerconsultas.class.php";  	
    include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
    include_once PATH_NEGOCIO."Funciones/Array/funcionesarray.class.php"; 
    
    $dFecha = new Fechas;

	$fdesde = (isset($_GET["fdesde"])?$_GET["fdesde"]:$dFecha->FechaActual());
	$fhasta = (isset($_GET["fhasta"])?$_GET["fhasta"]:$dFecha->FechaActual());	

	$handler =  new HandlerConsultas;
	$consulta = $handler->consultaCierreByLocalidad($fdesde, $fhasta);
	$total = $handler->consultaCierreTotal($fdesde, $fhasta);
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

				<div class='col-md-3 col-md-offset-6'>                
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
		  <h3 class="box-title">Cierre por Localidad - <?php echo "desde <b>".$dFecha->FormatearFechas($fdesde,'Y-m-d','d/m/Y')."</b> hasta <b>".$dFecha->FormatearFechas($fhasta,'Y-m-d','d/m/Y')."</b>"; ?></h3>	  
		</div>

		<div class="box-body table-responsive">
		  	<table class="table table-striped" id='tabla'>
			    <thead>
			    	<tr>
				    	<th>LOCALIDAD</th>
				      	<th class='text-center' colspan="2">CIERRES</th>				      					      	 
				    </tr>
				</thead>
				<tbody>
				    <?php
				    	if(!empty($consulta))
				    	{
			    			$final_cierre = 0;			    			

				    		foreach ($consulta as $key => $value) {		

				    			$final_cierre = $final_cierre + $value->CERRADOS;				    			

				    			echo "
				    				<tr>
								    	<td>".$value->LOCALIDAD."</td>
								      	<td class='text-center success'>".$value->CERRADOS."</td>
								      	<td class='text-center success'>".round((($value->CERRADOS/$total[0]->CERRADOS)*100),2)."%</td>								      	
								    </tr>	    
				    			";
				    		}

				    		echo "
			    				<tr style='font-weight: bold;'>
							    	<td class='text-right' style='background: orange;'>TOTAL</td>
							      	<td class='text-center'>".$final_cierre."</td>							      	
							      	<td class='text-center'>".round((($final_cierre/$total[0]->CERRADOS)*100),2)."%</td>								      	
							    </tr>	    
			    			";
				    	}
				    ?>
			  	</tbody>
		 	</table>
		</div>
	</div>
</div>

<script type="text/javascript">	
	$(document).ready(function() {
	    $("#slt_cliente").select2({
	        placeholder: "Seleccionar un Cliente",                  
	    });
	});

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

	crearHref();
	function crearHref()
	{
	    aStart = $("#start").val().split('/');
	    aEnd = $("#end").val().split('/');

	    f_inicio = aStart[2] +"-"+ aStart[1] +"-"+ aStart[0];
	    f_fin = aEnd[2] +"-"+ aEnd[1] +"-"+ aEnd[0];                      	    	   
	    
	    url_filtro_reporte="index.php?view=estadisticas&consulta=cons2&fdesde="+f_inicio+"&fhasta="+f_fin	    

	    $("#filtro_reporte").attr("href", url_filtro_reporte);
	} 

</script>
<script type="text/javascript">        
  $(document).ready(function(){                
    $("#mnu_estadisticas").addClass("active");
  });
</script>