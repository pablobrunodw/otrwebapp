<?php
	include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";  
	include_once PATH_NEGOCIO."Modulos/handlerpuntaje.class.php";  

	$url_action = PATH_VISTA.'Modulos/Configuraciones/action_config4.php';  

	$handler = new HandlerSistema;
	$arrGestores = $handler->selectAllGestor(null);
?>

<div class='col-md-12'>
	<form action="<?php echo $url_action; ?>" method="post">
		<div class="box">
			<div class="box-header">
				<i class="fa fa-cog"></i>
			  	<h3 class="box-title">Objetivos por gestores</h3>	
			  	<div class="form-group">
	            	<button type="submit" class="btn btn-success pull-right">Guardar</button>            
	            </div>  
			</div>
			<div class="box-body">
				<div class="box-body table-responsive">
				  	<table class="table table-striped table-condensed" id='tabla'>
					    <thead>
					    	<tr>
						    	<th style='width: 25%;'>GESTORES</th>
						      	<th>OBJETIVO
						      		<i class="fa fa-question-circle" data-toggle="tooltip" title="" data-original-title="Objetivo para cálculo en puntajes del gestor"></i>
						      	</th>					      	
						    </tr>
						</thead>
						<tbody>
							<?php
						    	if(!empty($arrGestores))
						    	{						    		
						    		foreach ($arrGestores as $key => $value) {	

						    			$handlerP = new HandlerPuntaje;
						    			$objetivo = $handlerP->buscarObjetivo($value->GESTOR11_CODIGO);

						    			echo "
					    				<tr>
									    	<td>".$value->GESTOR21_ALIAS."</td>
											<td><input type='number' step='0.01' class='form-control' name='id_".$value->GESTOR11_CODIGO."' style='width: 100%;' value='".$objetivo."'></td>
									    </tr>";
						    		}
						    	}
						    ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="box-footer">
				<div class="form-group">
	            	<button type="submit" class="btn btn-success pull-right">Guardar</button>            
	            </div>
			</div>
		</div>
	</form>
</div>