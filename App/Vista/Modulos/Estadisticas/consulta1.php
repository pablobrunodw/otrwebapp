<?php
	include_once PATH_NEGOCIO."Sistema/handlerconsultas.class.php";  
	include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";  
    include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
    include_once PATH_NEGOCIO."Funciones/Array/funcionesarray.class.php"; 
    
    $dFecha = new Fechas;

	$handler = new HandlerSistema;
	$arrCliente = $handler->selectAllEmpresaFiltro(null,null,null,null,null);
	$arrCoordinador = $handler->selectAllCoordinadorFiltro(null,null,null,null,null);
  	$arrGestor = $handler->selectAllGestorFiltro(null,null,null,null,null);
  	$arrGerente = $handler->selectAllGerenteFiltro(null,null,null,null,null);
  	$arrOperador = $handler->selectAllOperadorFiltro(null,null,null,null,null);
  	$arrEstados = $handler->selectAllEstados();    

	$fdesde = (isset($_GET["fdesde"])?$_GET["fdesde"]:$dFecha->FechaActual());
	$fhasta = (isset($_GET["fhasta"])?$_GET["fhasta"]:$dFecha->FechaActual());	
    
    $festado=(isset($_GET["festado"])?$_GET["festado"]:0);    
    $fcliente=(isset($_GET["fcliente"])?$_GET["fcliente"]:'');
    $fgerente=(isset($_GET["fgerente"])?$_GET["fgerente"]:'');    
    $fcoordinador=(isset($_GET["fcoordinador"])?$_GET["fcoordinador"]:'');
    $fgestor=(isset($_GET["fgestor"])?$_GET["fgestor"]:'');
    $foperador=(isset($_GET["foperador"])?$_GET["foperador"]:'');

	$handler =  new HandlerConsultas;
	$consulta = $handler->consultaReTrabajo($fdesde, $fhasta, $festado, $fcliente, $fgerente, $fcoordinador, $fgestor, $foperador);
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
        		<div class="col-md-10">     
					<div class="col-md-3" id='sandbox-container'>
						<label>Fecha Desde - Hasta </label>                
						<div class="input-daterange input-group" id="datepicker">
					    	<input type="text" class="input-sm form-control" onchange="crearHref()" id="start" name="start" value="<?php echo $dFecha->FormatearFechas($fdesde,'Y-m-d','d/m/Y'); ?>"/>
					     	<span class="input-group-addon">a</span>
					      	<input type="text" class="input-sm form-control" onchange="crearHref()" id="end" name="end" value="<?php echo $dFecha->FormatearFechas($fhasta,'Y-m-d','d/m/Y'); ?>"/>
					  	</div>  
					</div>

					<div class="col-md-2">
					  <label>Estados </label>                
					  <select id="slt_estados" class="form-control" style="width: 100%" name="slt_estados" onchange="crearHref()">                    
					    <option value=''></option>
					    <option value='0'>TODOS</option>
					    <?php
					      if(!empty($arrEstados))
					      {                        
					        foreach ($arrEstados as $key => $value) {                                                  
					          if($festado==$value[0])
					            echo "<option value='".$value[0]."' selected>".$value[1]."</option>";
					          else
					            echo "<option value='".$value[0]."'>".$value[1]."</option>";
					        }
					      }                      
					    ?>
					  </select>
					</div>

					<div class="col-md-2">
					  <label>Clientes </label>                
					  <select id="slt_cliente" class="form-control" style="width: 100%" name="slt_cliente" onchange="crearHref()">                              
					    <option value=''></option>
					    <option value='0'>TODOS</option>
					    <?php
					      if(!empty($arrCliente))
					      {                        
					        foreach ($arrCliente as $key => $value) {                                                  
					          if($fcliente==$value->EMPTT11_CODIGO)
					            echo "<option value='".trim($value->EMPTT11_CODIGO)."' selected>".$value->EMPTT21_NOMBREFA."</option>";
					          else
					            echo "<option value='".trim($value->EMPTT11_CODIGO)."'>".$value->EMPTT21_NOMBREFA."</option>";
					        }
					      }                      
					    ?>
					  </select>
					</div>
				
					<div class="col-md-2">
					  <label>Gerente </label>                
					  <select id="slt_gerente" class="form-control" style="width: 100%" name="slt_gerente" onchange="crearHref()">                              
					    <option value=''></option>
					    <option value='0'>TODOS</option>
					    <?php
					      if(!empty($arrGerente))
					      {                        
					        foreach ($arrGerente as $key => $value) {                                                  
					          if($fgerente==$value->SERTT91_GTEALIAS)
					            echo "<option value='".trim($value->SERTT91_GTEALIAS)."' selected>".$value->SERTT91_GTEALIAS."</option>";
					          else
					            echo "<option value='".trim($value->SERTT91_GTEALIAS)."'>".$value->SERTT91_GTEALIAS."</option>";
					        }
					      }                      
					    ?>
					  </select>
					</div>

					<div class="col-md-2">
					  <label>Coordinador </label>                
					  <select id="slt_coordinador" class="form-control" style="width: 100%" name="slt_coordinador" onchange="crearHref()">                              
					    <option value=''></option>
					    <option value='0'>TODOS</option>
					    <?php
					      if(!empty($arrCoordinador))
					      {                        
					        foreach ($arrCoordinador as $key => $value) {                                                  
					          if($fcoordinador==$value->SERTT91_COOALIAS)
					            echo "<option value='".trim($value->SERTT91_COOALIAS)."' selected>".$value->SERTT91_COOALIAS."</option>";
					          else
					            echo "<option value='".trim($value->SERTT91_COOALIAS)."'>".$value->SERTT91_COOALIAS."</option>";
					        }
					      }                      
					    ?>
					  </select>
					</div>

					<div class="col-md-2">
					  <label>Gestor </label>                
					  <select id="slt_gestor" class="form-control" style="width: 100%" name="slt_gestor" onchange="crearHref()">                              
					    <option value=''></option>
					    <option value='0'>TODOS</option>
					    <?php
					      if(!empty($arrGestor))
					      {                        
					        foreach ($arrGestor as $key => $value) {                                                  
					          if($fgestor==$value->GESTOR11_CODIGO)
					            echo "<option value='".trim($value->GESTOR11_CODIGO)."' selected>".$value->GESTOR21_ALIAS."</option>";
					          else
					            echo "<option value='".trim($value->GESTOR11_CODIGO)."'>".$value->GESTOR21_ALIAS."</option>";
					        }
					      }                      
					    ?>
					  </select>
					</div>

					<div class="col-md-2" style="display: none;">
					  <label>Operador </label>                
					  <select id="slt_operador" class="form-control" style="width: 100%" name="slt_operador" onchange="crearHref()">                              
					    <option value=''></option>
					    <option value='0'>TODOS</option>
					    <?php
					      if(!empty($arrOperador))
					      {                        
					        foreach ($arrOperador as $key => $value) {                                                  
					          if($foperador==$value->SERTT91_OPERAD)
					            echo "<option value='".trim($value->SERTT91_OPERAD)."' selected>".$value->SERTT91_OPERAD."</option>";
					          else
					            echo "<option value='".trim($value->SERTT91_OPERAD)."'>".$value->SERTT91_OPERAD."</option>";
					        }
					      }                      
					    ?>
					  </select>
					</div>
				</div>
				<div class="col-md-2">     					
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
		  <h3 class="box-title">Re Trabajo - <?php echo "desde <b>".$dFecha->FormatearFechas($fdesde,'Y-m-d','d/m/Y')."</b> hasta <b>".$dFecha->FormatearFechas($fhasta,'Y-m-d','d/m/Y')."</b>"; ?></h3>	  
		</div>

		<div class="box-body table-responsive">
		  	<table class="table table-striped table-condensed" id='tabla'>
			    <thead>
			    	<tr>
				    	<th>EMPRESA</th>
				      	<th class='text-center' colspan="2">1ra VISITAS</th>
				      	<th class='text-center' colspan="2">2da VISITAS</th>
				      	<th class='text-center' colspan="2">3era VISITAS</th>
				      	<th class='text-center' colspan="2">4 O MAS VISITAS</th>	
				      	<th class='text-center'>TOTAL</th>		      	
				    </tr>
				</thead>
				<tbody>
				    <?php
				    	if(!empty($consulta))
				    	{
			    			$final_uno = 0;
			    			$final_dos = 0;
			    			$final_tres = 0;
			    			$final_masdetres = 0;
			    			$final_total = 0;

				    		foreach ($consulta as $key => $value) {		

				    			$final_uno = $final_uno + $value->UNO;
				    			$final_dos = $final_dos + $value->DOS;
				    			$final_tres = $final_tres + $value->TRES;
				    			$final_masdetres = $final_masdetres + $value->MASDETRES;
				    			$final_total = $final_total + $value->TOTAL;

				    			echo "
				    				<tr>
								    	<td>".$value->EMPRESA."</td>
								      	<td class='text-center success'>".$value->UNO."</td>
								      	<td class='text-center success'>".round((($value->UNO/$value->TOTAL)*100),2)."%</td>
								      	<td class='text-center info'>".$value->DOS."</td>
								      	<td class='text-center info'>".round((($value->DOS/$value->TOTAL)*100),2)."%</td>
								      	<td class='text-center warning'>".$value->TRES."</td>
								      	<td class='text-center warning'>".round((($value->TRES/$value->TOTAL)*100),2)."%</td>
								      	<td class='text-center danger'>".$value->MASDETRES."</td>
								      	<td class='text-center danger'>".round((($value->MASDETRES/$value->TOTAL)*100),2)."%</td>
								      	<td class='text-center' style='font-weight: bold;'>".$value->TOTAL."</td>
								    </tr>	    
				    			";
				    		}

				    		echo "
			    				<tr style='font-weight: bold;'>
							    	<td class='text-right' style='background: orange;'>TOTAL</td>
							      	<td class='text-center'>".$final_uno."</td>
							      	<td class='text-center'>".round((($final_uno/$final_total)*100),2)."%</td>
							      	<td class='text-center'>".$final_dos."</td>
							      	<td class='text-center'>".round((($final_dos/$final_total)*100),2)."%</td>
							      	<td class='text-center'>".$final_tres."</td>
							      	<td class='text-center'>".round((($final_tres/$final_total)*100),2)."%</td>
							      	<td class='text-center'>".$final_masdetres."</td>
							      	<td class='text-center'>".round((($final_masdetres/$final_total)*100),2)."%</td>
							      	<td class='text-center'>".$final_total."</td>
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
    	$("#slt_estados").select2({
        	placeholder: "Seleccionar un Estado",                  
    	});
  	});

  	$(document).ready(function() {
    	$("#slt_cliente").select2({
        	placeholder: "Seleccionar un Cliente",                  
    	});
  	});

  	$(document).ready(function() {
    	$("#slt_gerente").select2({
        	placeholder: "Seleccionar un Gerente",                  
    	});
  	});

  	$(document).ready(function() {
    	$("#slt_coordinador").select2({
        	placeholder: "Seleccionar un Coordinador",                  
    	});
  	});

  	$(document).ready(function() {
    	$("#slt_gestor").select2({
        	placeholder: "Seleccionar un Gestor",                  
    	});	
  	});	

  	$(document).ready(function() {
    	$("#slt_operador").select2({
        	placeholder: "Seleccionar un Operador",                  
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
	    f_estado = $("#slt_estados").val();
	    f_equipoventa = $("#slt_equipoventa").val();        
	    f_cliente = $("#slt_cliente").val();     
	    f_gerente = $("#slt_gerente").val();   
	    f_coordinador = $("#slt_coordinador").val();   
	    f_gestor = $("#slt_gestor").val();     
	    f_operador = $("#slt_operador").val();     
	    
	    url_filtro_reporte="index.php?view=estadisticas&consulta=cons1&fdesde="+f_inicio+"&fhasta="+f_fin

	    if(f_estado!=undefined)
	      if(f_estado>0)          
	        url_filtro_reporte= url_filtro_reporte + "&festado="+f_estado

	    if(f_cliente!=undefined)
	      if(f_cliente>0)
	        url_filtro_reporte= url_filtro_reporte + "&fcliente="+f_cliente      

	    if(f_gerente!=undefined)
	      if(f_gerente!='')
	        url_filtro_reporte= url_filtro_reporte + "&fgerente="+f_gerente

	    if(f_coordinador!=undefined)
	      if(f_coordinador!='')
	        url_filtro_reporte= url_filtro_reporte + "&fcoordinador="+f_coordinador  

	    if(f_gestor!=undefined)
	      if(f_gestor>0)
	        url_filtro_reporte= url_filtro_reporte + "&fgestor="+f_gestor   

	    if(f_operador!=undefined)
	      if(f_operador!='')
	        url_filtro_reporte= url_filtro_reporte + "&foperador="+f_operador  

	    $("#filtro_reporte").attr("href", url_filtro_reporte);
	} 

</script>
<script type="text/javascript">        
  $(document).ready(function(){                
    $("#mnu_estadisticas").addClass("active");
  });
</script>