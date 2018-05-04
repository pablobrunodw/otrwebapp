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
  	$arrNiveles = ['EMPRESAS','GERENTES','COORDINADORES','GESTORES'];

	$fdesde = (isset($_GET["fdesde"])?$_GET["fdesde"]:date("Y-m-d", strtotime ( '-30 day' , strtotime($dFecha->FechaActual()))));	
	$fhasta = (isset($_GET["fhasta"])?$_GET["fhasta"]:$dFecha->FechaActual());	    

    $festado=(isset($_GET["festado"])?$_GET["festado"]:0);    
    $fcliente=(isset($_GET["fcliente"])?$_GET["fcliente"]:'');
    $fgerente=(isset($_GET["fgerente"])?$_GET["fgerente"]:'');    
    $fcoordinador=(isset($_GET["fcoordinador"])?$_GET["fcoordinador"]:'');
    $fgestor=(isset($_GET["fgestor"])?$_GET["fgestor"]:'');
    $foperador=(isset($_GET["foperador"])?$_GET["foperador"]:'');

    $fniveles=(isset($_GET["fniveles"])?$_GET["fniveles"]:'EMPRESAS');

	$handler =  new HandlerConsultas;
	$consulta_gestiones = $handler->consultaGeneralGestiones($fdesde, $fhasta, $festado, $fcliente, $fgerente, $fcoordinador, $fgestor, $foperador, $fniveles);
	$consulta_servicios = $handler->consultaGeneralServicios($fdesde, $fhasta, $festado, $fcliente, $fgerente, $fcoordinador, $fgestor, $foperador, $fniveles);

	$handler_sist = new HandlerSistema;
	$cant_dias = $handler_sist->selectCountFechasServicios($fdesde,$fhasta,null,null,null,null,null,null);
	$cant_dias = $cant_dias[0]->CANTIDAD_DIAS;

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

					<div class="col-md-3" >
					  <label>Nivel </label>                
					  <select id="slt_nivel" class="form-control" style="width: 100%" name="slt_nivel" onchange="crearHref()">                              					    					   
					    <?php
					      if(!empty($arrNiveles))
					      {                        
					        foreach ($arrNiveles as $key => $value) {                                                  
					          if($fniveles==$value)
					            echo "<option value='".trim($value)."' selected>".$value."</option>";
					          else
					            echo "<option value='".trim($value)."'>".$value."</option>";
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
		  <h3 class="box-title">General - <?php echo "desde <b>".$dFecha->FormatearFechas($fdesde,'Y-m-d','d/m/Y')."</b> hasta <b>".$dFecha->FormatearFechas($fhasta,'Y-m-d','d/m/Y')."</b>"; ?></h3>	  
		</div>

		<div class="box-body table-responsive">
		  	<table class="table table-bordered table-condensed table-striped table-striped" id="tabla">
			    <thead>
			    	<tr>
			    		<th class=""><?php echo $fniveles; ?></th>			    				    
				      	<th class='text-center'>GESTIONES TOTALES</th>				      					      	
				      	<th class='text-center'>GESTIONES PROMEDIO</th>				      					      	
				      	<th class='text-center'>GESTIONES CERRADOS</th>				      					      	
				      	<th class='text-center'>GESTIONES EFECTIVIDAD</th>				      	
				    </tr>
				</thead>
				<tbody>
				    <?php
				       				        
				      	$total_gestiones=0;
				      	$total_gestiones_promedio=0;
				      	$total_gestiones_cerrados=0;
				      	$total_gestiones_efectividad=0;

				    	if(!empty($consulta))
				    	{
				    		
				    		foreach ($consulta_gestiones as $key => $value) {
				    			
				    			$data=null;
				    			$f_array = new FuncionesArray;				    			
				    			switch ($fniveles) {
				    				case 'EMPRESAS':		
				    					$_arrCliente = $handler_sist->selectAllEmpresaArray();
				    					$cod_empresa = $f_array->buscarValor($_arrCliente,'EMPTT21_NOMBREFA',$value->NOMBRE,'EMPTT11_CODIGO');				    					
				    					$data = $handler_sist->selectCountServiciosGestion($fdesde,$fhasta,200,$cod_empresa,null,null,null,null);				    					
				    					break;

				    				case 'GERENTES':
				    					$data = $handler_sist->selectCountServiciosGestion($fdesde,$fhasta,200,null,null,$value->NOMBRE,null,null);
				    					break;
				    				
				    				case 'COORDINADORES':
				    					$data = $handler_sist->selectCountServiciosGestion($fdesde,$fhasta,200,null,null,null,$value->NOMBRE,null);
				    					break;
				    				
				    				case 'GESTORES':
				    					$_arrGestor = $handler_sist->selectAllGestorArray();
				    					$cod_gestor = $f_array->buscarValor($_arrGestor,'GESTOR21_ALIAS',$value->NOMBRE,'GESTOR11_CODIGO');				    					
				    					$data = $handler_sist->selectCountServiciosGestion($fdesde,$fhasta,200,null,$cod_gestor,null,null,null);
				    					break;
				    			}				    			

				    			if(!empty($data))
				    				$gestiones_cerradas = $data[0]->CANTIDAD_SERVICIOS;
				    			else
				    				$gestiones_cerradas = 0;


				    			$total_gestiones = $total_gestiones + $value->TOTAL_SERVICIOS;
				    			$total_gestiones_cerrados = $total_gestiones_cerrados + $gestiones_cerradas;

								if(!empty($cant_dias))		
									$total_gestiones_promedio = round($total_gestiones / $cant_dias,0);
								
								if(!empty($value->TOTAL_SERVICIOS))
									$total_gestiones_efectividad = round(($total_gestiones_cerrados / $total_gestiones)*100,0);

				    			echo 
					    			"<tr>
					    				<td>".$value->NOMBRE."</td>					    				
					    				<td class='text-center' style='background:#f39c12; font-size:15px; color:white; font-weight:bold;'>".$value->TOTAL_SERVICIOS."</td>";

					    				if(!empty($cant_dias))
					    					echo "<td class='text-center' style='background:#dd4b39; font-size:15px; color:white; font-weight:bold;'>".round($value->TOTAL_SERVICIOS / $cant_dias,0)."</td>";
					    				else
					    					echo "<td class='text-center' style='background:#dd4b39; font-size:15px; color:white; font-weight:bold;'>0</td>";

					    				echo "<td class='text-center' style='background:#0073b7; font-size:15px; color:white; font-weight:bold;'>".$gestiones_cerradas."</td>";

					    				if(!empty($value->TOTAL_SERVICIOS))
					    					echo "<td class='text-center' style='background:#00a65a; font-size:15px; color:white; font-weight:bold;'>".round(($gestiones_cerradas / $value->TOTAL_SERVICIOS)*100,0)." %</td>";
					    				else
					    					echo "<td class='text-center' style='background:#00a65a; font-size:15px; color:white; font-weight:bold;'>0</td>";
					    		echo 
					    			"</tr>";
				    		}
				    	}
				    ?>
				</tbody>
				<tfoot>
			   		<tr>
			      		<th class='text-right' style='background: orange;'>Totales</th>
			      		<th class='text-center'><?php echo $total_gestiones; ?></th>
			      		<th class='text-center'><?php echo $total_gestiones_promedio; ?></th>
			      		<th class='text-center'><?php echo $total_gestiones_cerrados; ?></th>
			      		<th class='text-center'><?php echo $total_gestiones_efectividad; ?> %</th>
			      	</tr>
			    </tfoot>						  	  	
			</table>

			<table class="table table-bordered table-condensed table-striped table-striped" id="tabla1">
			    <thead>
			    	<tr>
			    		<th class=""><?php echo $fniveles; ?></th>			    				    
				      	<th class='text-center'>SERVICIOS TOTALES</th>				      					      	
				      	<th class='text-center'>SERVICIOS PROMEDIO</th>				      					      	
				      	<th class='text-center'>SERVICIOS CERRADOS</th>				      					      	
				      	<th class='text-center'>SERVICIOS EFECTIVIDAD</th>				      	
				    </tr>
				</thead>
				<tbody>
				    <?php
				       				        
				       	$total_servicios=0;
				      	$total_servicios_promedio=0;
				      	$total_servicios_cerrados=0;
				      	$total_servicios_efectividad=0;

				    	if(!empty($consulta))
				    	{
				    		
				    		foreach ($consulta_servicios as $key => $value) {

				    			$total_servicios = $total_servicios + $value->TOTAL_SERVICIOS;
				    			$total_servicios_cerrados = $total_servicios_cerrados + $value->TOTAL_SERVICIOS_CERRADOS;

								if(!empty($cant_dias))		
									$total_servicios_promedio = round($total_servicios / $cant_dias,0);
								
								if(!empty($value->TOTAL_SERVICIOS))
									$total_servicios_efectividad = round(($total_servicios_cerrados / $total_servicios)*100,0);

				    			echo 
					    			"<tr>
					    				<td>".$value->NOMBRE."</td>					    				
					    				<td class='text-center' style='background:#f39c12; font-size:15px; color:white; font-weight:bold;'>".$value->TOTAL_SERVICIOS."</td>";

					    				if(!empty($cant_dias))
					    					echo "<td class='text-center' style='background:#dd4b39; font-size:15px; color:white; font-weight:bold;'>".round($value->TOTAL_SERVICIOS / $cant_dias,0)."</td>";
					    				else
					    					echo "<td class='text-center' style='background:#dd4b39; font-size:15px; color:white; font-weight:bold;'>0</td>";

					    				echo "<td class='text-center' style='background:#0073b7; font-size:15px; color:white; font-weight:bold;'>".$value->TOTAL_SERVICIOS_CERRADOS."</td>";

					    				if(!empty($value->TOTAL_SERVICIOS))
					    					echo "<td class='text-center' style='background:#00a65a; font-size:15px; color:white; font-weight:bold;'>".round(($value->TOTAL_SERVICIOS_CERRADOS / $value->TOTAL_SERVICIOS)*100,0)." %</td>";
					    				else
					    					echo "<td class='text-center' style='background:#00a65a; font-size:15px; color:white; font-weight:bold;'>0</td>";
					    		echo 
					    			"</tr>";
				    		}
				    	}
				    ?>
				</tbody>		
				<tfoot>
			   		<tr>
			      		<th class='text-right' style='background: orange;'>Totales</th>
			      		<th class='text-center'><?php echo $total_servicios; ?></th>
			      		<th class='text-center'><?php echo $total_servicios_promedio; ?></th>
			      		<th class='text-center'><?php echo $total_servicios_cerrados; ?></th>
			      		<th class='text-center'><?php echo $total_servicios_efectividad; ?> %</th>
			      	</tr>
			    </tfoot>					  	  	
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
    	$("#slt_nivel").select2({
        	placeholder: "Seleccionar un Nivel de consulta",                  
    	});
  	});

	$(document).ready(function() {
	    $('#tabla').DataTable({

	      "aoColumns": [
                  { sWidth: "`30%", bSearchable: true, bSortable: true },                  
                  { sWidth: "15%", bSearchable: false, bSortable: false },
                  { sWidth: "15%", bSearchable: false, bSortable: false },
                  { sWidth: "15%", bSearchable: false, bSortable: false },
                  { sWidth: "15%", bSearchable: false, bSortable: false }                  
            ],
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

	   	$('#tabla1').DataTable({

	      "aoColumns": [
                  { sWidth: "`30%", bSearchable: true, bSortable: true },                  
                  { sWidth: "15%", bSearchable: false, bSortable: false },
                  { sWidth: "15%", bSearchable: false, bSortable: false },
                  { sWidth: "15%", bSearchable: false, bSortable: false },
                  { sWidth: "15%", bSearchable: false, bSortable: false }                  
            ],
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
	    f_nivel = $("#slt_nivel").val();     
	    
	    url_filtro_reporte="index.php?view=estadisticas&consulta=cons6&fdesde="+f_inicio+"&fhasta="+f_fin

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

	    if(f_nivel!=undefined)
	      if(f_nivel!='')
	        url_filtro_reporte= url_filtro_reporte + "&fniveles="+f_nivel  

	    $("#filtro_reporte").attr("href", url_filtro_reporte);
	} 

</script>
<script type="text/javascript">        
  $(document).ready(function(){                
    $("#mnu_estadisticas").addClass("active");
  });
</script>