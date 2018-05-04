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

	$fdesde = (isset($_GET["fdesde"])?$_GET["fdesde"]:$dFecha->FechaActual());
	$fhasta = (isset($_GET["fhasta"])?$_GET["fhasta"]:$dFecha->FechaActual());	
    
    $festado=(isset($_GET["festado"])?$_GET["festado"]:0);    
    $fcliente=(isset($_GET["fcliente"])?$_GET["fcliente"]:'');
    $fgerente=(isset($_GET["fgerente"])?$_GET["fgerente"]:'');    
    $fcoordinador=(isset($_GET["fcoordinador"])?$_GET["fcoordinador"]:'');
    $fgestor=(isset($_GET["fgestor"])?$_GET["fgestor"]:'');
    $foperador=(isset($_GET["foperador"])?$_GET["foperador"]:'');

    $fniveles=(isset($_GET["fniveles"])?$_GET["fniveles"]:'EMPRESAS');

	$handler =  new HandlerConsultas;
	$consulta = $handler->consultaComparativa($fdesde, $fhasta, $festado, $fcliente, $fgerente, $fcoordinador, $fgestor, $foperador, $fniveles);
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
		  <h3 class="box-title">Comparativas - <?php echo "desde <b>".$dFecha->FormatearFechas($fdesde,'Y-m-d','d/m/Y')."</b> hasta <b>".$dFecha->FormatearFechas($fhasta,'Y-m-d','d/m/Y')."</b>"; ?></h3>	  
		</div>

		<div class="box-body table-responsive">
		  	<table class="table table-bordered table-condensed table-striped table-striped" id="tabla">
			    <thead>
			    	<tr>
				    	<th class=""><?php echo $fniveles; ?></th>
				      	<th class='text-center' style='font-size: 13px;' colspan="2">CERRADO</th>				      					      	
				      	<th class='text-center' style='font-size: 13px;' colspan="2">CERRADO PARCIAL</th>				      	
				      	<th class='text-center' style='font-size: 13px;' colspan="2">RE LLAMAR</th>				      	
				      	<th class='text-center' style='font-size: 13px;' colspan="2">RE PACTADO</th>					      					      	
				      	<th class='text-center' style='font-size: 13px;' colspan="2">NEGATIVO</th>					      	
				      	<th class='text-center' style='font-size: 13px;' colspan="2">PROBLEMAS</th>					      	
				      	<th class='text-center' style='font-size: 13px;' colspan="2">ENVIADO</th>					      	
				      	<th class='text-center' style='font-size: 13px;' colspan="2">A LIQUIDAR</th>					      	
				      	<th class='text-center' style='font-size: 13px;' colspan="2">NEGATIVO BO</th>					      	
				      	<th class='text-center' style='font-size: 13px;' colspan="2">PROBLEMAS BO</th>					      	
				      	<th class='text-center' style='font-size: 13px;' colspan="2">CANCELADO</th>	
				      	<th class='text-center' style='font-size: 13px;' colspan="2">LIQUIDAR C PARCIAL</th>					      	
				      	<th class='text-center' style='font-size: 13px;' colspan="2">NO EFECTIVAS</th>						      	
				      	
				      	<th class='text-center'>TOTAL</th>	

				      	<th class='text-center' colspan="2">CIERRE REAL</th>					      	
				    </tr>
				</thead>
				<tbody>
				    <?php

			            $cerrado_total = 0;
          				$cerrado_porc = 0;
          				$cerrado_parcial_total = 0;
          				$cerrado_parcial_porc = 0;
          				$rellamar_total = 0;
          				$rellamar_porc = 0;
          				$repactar_total = 0;
          				$repactar_porc = 0;
          				$negativo_total = 0;
          				$negativo_porc = 0;
          				$problemas_total = 0;
          				$problemas_porc = 0;
          				$enviado_total = 0;
          				$enviado_porc = 0;
          				$aliquidar_total = 0;
          				$aliquidar_porc = 0;
          				$negativobo_total = 0;
          				$negativobo_porc = 0;
          				$problemasbo_total = 0;
          				$problemasbo_porc = 0;
          				$cancelado_total = 0;
          				$cancelado_porc = 0;
          				$liquidarcparcial_total = 0;
          				$liquidarcparcial_porc = 0;
          				$noefectivas_total = 0;
          				$noefectivas_porc = 0;     

          				$total_total = 0;
          				$total_parcial_total = 0;
          				$total_parcial_porc = 0;

				    	if(!empty($consulta))
				    	{
				    		$f_array = new FuncionesArray;
              				$class_cerrado_parcial = $f_array->buscarValor($arrEstados,"1",'Cerrado Parcial',"4");
              				$class_cerrado = $f_array->buscarValor($arrEstados,"1",'Cerrado',"4");
              				$class_repactar = $f_array->buscarValor($arrEstados,"1",'Re Pactado',"4");
              				$class_rellamar = $f_array->buscarValor($arrEstados,"1",'Re Llamar',"4");
              				$class_negativo = $f_array->buscarValor($arrEstados,"1",'Negativo',"4");
              				$class_problemas = $f_array->buscarValor($arrEstados,"1",'Cerrado en Problemas',"4");
              				$class_enviado = $f_array->buscarValor($arrEstados,"1",'Enviado',"4");
              				$class_aliquidar = $f_array->buscarValor($arrEstados,"1",'A Liquidar',"4");
              				$class_negativobo = $f_array->buscarValor($arrEstados,"1",'Negativo B.O.',"4");
              				$class_problemasbo = $f_array->buscarValor($arrEstados,"1",'Problemas B.O.',"4");
              				$class_cancelado = $f_array->buscarValor($arrEstados,"1",'Cancelado',"4");
              				$class_liquidarcparcial = $f_array->buscarValor($arrEstados,"1",'Liquidar C Parcial',"4");
              				$class_noefectivas = $f_array->buscarValor($arrEstados,"1",'No Efectivas',"4");

              				$class_total = "background:#fdfbcb;";
              				$class_totalparcial= "background:#fcfea0;";

				    		foreach ($consulta as $key => $value) {		

				    			if(!empty($value->TOTAL))
				    			{
					    			$cerrado_total = $cerrado_total + $value->CERRADO;					    			
					    			$cerrado_parcial_total = $cerrado_parcial_total + $value->CERRADO_PARCIAL;					    			
					    			$repactar_total = $repactar_total + $value->RE_PACTADO;					    			
					    			$rellamar_total = $rellamar_total + $value->RE_LLAMAR;					    			
					    			$negativo_total = $negativo_total + $value->NEGATIVO;					    			
					    			$problemas_total = $problemas_total + $value->PROBLEMAS;					    			
					    			$enviado_total = $enviado_total + $value->ENVIADO;					    			
					    			$aliquidar_total = $aliquidar_total + $value->A_LIQUIDAR;					    			
					    			$negativobo_total = $negativobo_total + $value->NEGATIVO_BO;					    			
					    			$problemasbo_total = $problemasbo_total + $value->PROBLEMAS_BO;					    			
					    			$cancelado_total = $cancelado_total + $value->CANCELADO;		
					    			$liquidarcparcial_total = $liquidarcparcial_total + $value->LIQUIDAR_C_PARCIAL;					    			
					    			$noefectivas_total = $noefectivas_total + $value->NO_EFECTIVAS;						    						    			
					    			$total_total = $total_total + $value->TOTAL;				    			
					    			$total_parcial_total = $total_parcial_total + $value->TOTAL_PARCIAL;					    			

					    			echo 
						    			"<tr>
						    				<td>".$value->NOMBRE."</td>
						    				<td class='text-center' style='$class_cerrado font-size: 13px;'>".$value->CERRADO."</td>
						    				<td class='text-center' style='$class_cerrado font-size: 13px;'>".ROUND(($value->CERRADO / $value->TOTAL)*100,2)." </td>

						    				<td class='text-center' style='$class_cerrado_parcial font-size: 13px;'>".$value->CERRADO_PARCIAL."</td>
						    				<td class='text-center' style='$class_cerrado_parcial font-size: 13px;'>".ROUND(($value->CERRADO_PARCIAL / $value->TOTAL)*100,2)." </td>

						    				<td class='text-center' style='$class_rellamar font-size: 13px;'>".$value->RE_LLAMAR."</td>
						    				<td class='text-center' style='$class_rellamar font-size: 13px;'>".ROUND(($value->RE_LLAMAR / $value->TOTAL)*100,2)." </td>

						    				<td class='text-center' style='$class_repactar font-size: 13px;'>".$value->RE_PACTADO."</td>
						    				<td class='text-center' style='$class_repactar font-size: 13px;'>".ROUND(($value->RE_PACTADO / $value->TOTAL)*100,2)." </td>

						    				<td class='text-center' style='$class_negativo font-size: 13px;'>".$value->NEGATIVO."</td>
						    				<td class='text-center' style='$class_negativo font-size: 13px;'>".ROUND(($value->NEGATIVO / $value->TOTAL)*100,2)." </td>

						    				<td class='text-center' style='$class_problemas font-size: 13px;'>".$value->PROBLEMAS."</td>
						    				<td class='text-center' style='$class_problemas font-size: 13px;'>".ROUND(($value->PROBLEMAS / $value->TOTAL)*100,2)." </td>

						    				<td class='text-center' style='$class_enviado font-size: 13px;'>".$value->ENVIADO."</td>
						    				<td class='text-center' style='$class_enviado font-size: 13px;'>".ROUND(($value->ENVIADO / $value->TOTAL)*100,2)." </td>

						    				<td class='text-center' style='$class_aliquidar font-size: 13px;'>".$value->A_LIQUIDAR."</td>
						    				<td class='text-center' style='$class_aliquidar font-size: 13px;'>".ROUND(($value->A_LIQUIDAR / $value->TOTAL)*100,2)." </td>

						    				<td class='text-center' style='$class_negativobo font-size: 13px;'>".$value->NEGATIVO_BO."</td>
						    				<td class='text-center' style='$class_negativobo font-size: 13px;'>".ROUND(($value->NEGATIVO_BO / $value->TOTAL)*100,2)." </td>

						    				<td class='text-center' style='$class_problemasbo font-size: 13px;'>".$value->PROBLEMAS_BO."</td>
						    				<td class='text-center' style='$class_problemasbo font-size: 13px;'>".ROUND(($value->PROBLEMAS_BO / $value->TOTAL)*100,2)." </td>

						    				<td class='text-center' style='$class_cancelado font-size: 13px;'>".$value->CANCELADO."</td>
						    				<td class='text-center' style='$class_cancelado font-size: 13px;'>".ROUND(($value->CANCELADO / $value->TOTAL)*100,2)." </td>

						    				<td class='text-center' style='$class_liquidarcparcial font-size: 13px;'>".$value->LIQUIDAR_C_PARCIAL."</td>
						    				<td class='text-center' style='$class_liquidarcparcial font-size: 13px;'>".ROUND(($value->LIQUIDAR_C_PARCIAL / $value->TOTAL)*100,2)." </td>

						    				<td class='text-center' style='$class_noefectivas font-size: 13px;'>".$value->NO_EFECTIVAS."</td>
						    				<td class='text-center' style='$class_noefectivas font-size: 13px;'>".ROUND(($value->NO_EFECTIVAS / $value->TOTAL)*100,2)." </td>						    				

						    				<td class='text-center' style='$class_total font-size: 13px;'>".$value->TOTAL."</td>

						    				<td class='text-center' style='$class_totalparcial font-size: 13px;'>".$value->TOTAL_PARCIAL."</td>
						    				<td class='text-center' style='$class_totalparcial font-size: 13px;'>".ROUND(($value->TOTAL_PARCIAL / $value->TOTAL)*100,2)." </td>
						    			</tr>";
						    	}
				    		}
				    	}
				    ?>
				</tbody>				
		  	  	<tfoot>
			    	<tr>
			      		<th class='text-right' style='background: orange;'>Totales</th>
			      		<th class='text-center'><?php echo $cerrado_total; ?></th>
			      		<th class='text-center'><?php echo ROUND(($cerrado_total / $total_total)*100,2); ?></th>

			      		<th class='text-center'><?php echo $cerrado_parcial_total; ?></th>
			      		<th class='text-center'><?php echo ROUND(($cerrado_parcial_total / $total_total)*100,2); ?></th>

			      		<th class='text-center'><?php echo $rellamar_total; ?></th>
			      		<th class='text-center'><?php echo ROUND(($rellamar_total / $total_total)*100,2); ?></th>

			      		<th class='text-center'><?php echo $repactar_total; ?></th>
			      		<th class='text-center'><?php echo ROUND(($repactar_total / $total_total)*100,2); ?></th>

			      		<th class='text-center'><?php echo $negativo_total; ?></th>
			      		<th class='text-center'><?php echo ROUND(($negativo_total / $total_total)*100,2); ?></th>

			      		<th class='text-center'><?php echo $problemas_total; ?></th>
			      		<th class='text-center'><?php echo ROUND(($problemas_total / $total_total)*100,2); ?></th>

			      		<th class='text-center'><?php echo $enviado_total; ?></th>
			      		<th class='text-center'><?php echo ROUND(($enviado_total / $total_total)*100,2); ?></th>

			      		<th class='text-center'><?php echo $aliquidar_total; ?></th>
			      		<th class='text-center'><?php echo ROUND(($aliquidar_total / $total_total)*100,2); ?></th>

			      		<th class='text-center'><?php echo $negativobo_total; ?></th>
			      		<th class='text-center'><?php echo ROUND(($negativobo_total / $total_total)*100,2); ?></th>

			      		<th class='text-center'><?php echo $problemasbo_total; ?></th>
			      		<th class='text-center'><?php echo ROUND(($problemasbo_total / $total_total)*100,2); ?></th>

			      		<th class='text-center'><?php echo $cancelado_total; ?></th>
			      		<th class='text-center'><?php echo ROUND(($cancelado_total / $total_total)*100,2); ?></th>

			      		<th class='text-center'><?php echo $liquidarcparcial_total; ?></th>
			      		<th class='text-center'><?php echo ROUND(($liquidarcparcial_total / $total_total)*100,2); ?></th>

			      		<th class='text-center'><?php echo $noefectivas_total; ?></th>
			      		<th class='text-center'><?php echo ROUND(($noefectivas_total / $total_total)*100,2); ?></th>

			      		<th class='text-center'><?php echo $total_total; ?></th>			      		

			      		<th class='text-center'><?php echo $total_parcial_total; ?></th>
			      		<th class='text-center'><?php echo ROUND(($total_parcial_total / $total_total)*100,2); ?></th>
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
                  { sWidth: "100%", bSearchable: true, bSortable: true },
                  { sWidth: "100%", bSearchable: false, bSortable: false },
                  { sWidth: "100%", bSearchable: false, bSortable: false },
                  { sWidth: "100%", bSearchable: false, bSortable: false },
                  { sWidth: "100%", bSearchable: false, bSortable: false },
                  { sWidth: "100%", bSearchable: false, bSortable: false },
                  { sWidth: "100%", bSearchable: false, bSortable: false },
                  { sWidth: "100%", bSearchable: false, bSortable: false },
                  { sWidth: "100%", bSearchable: false, bSortable: false },
                  { sWidth: "100%", bSearchable: false, bSortable: false },
                  { sWidth: "100%", bSearchable: false, bSortable: false },
                  { sWidth: "100%", bSearchable: false, bSortable: false },
                  { sWidth: "100%", bSearchable: false, bSortable: false },
                  { sWidth: "100%", bSearchable: false, bSortable: false },
                  { sWidth: "100%", bSearchable: false, bSortable: false },
                  { sWidth: "100%", bSearchable: false, bSortable: false },
                  { sWidth: "100%", bSearchable: false, bSortable: false },
                  { sWidth: "100%", bSearchable: false, bSortable: false },                 
                  { sWidth: "100%", bSearchable: false, bSortable: false },
                  { sWidth: "100%", bSearchable: false, bSortable: false },
                  { sWidth: "100%", bSearchable: false, bSortable: false },
                  { sWidth: "100%", bSearchable: false, bSortable: false },
                  { sWidth: "100%", bSearchable: false, bSortable: false },
                  { sWidth: "100%", bSearchable: false, bSortable: false },
                  { sWidth: "100%", bSearchable: false, bSortable: false },
                  { sWidth: "100%", bSearchable: false, bSortable: false },                  
				  { sWidth: "100%", bSearchable: false, bSortable: false },
                  { sWidth: "100%", bSearchable: false, bSortable: false }
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
	    
	    url_filtro_reporte="index.php?view=estadisticas&consulta=cons4&fdesde="+f_inicio+"&fhasta="+f_fin

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