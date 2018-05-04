<?php
	include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";  
	include_once PATH_NEGOCIO."Importacion/handlerimportacion.class.php";  

	$url_action = PATH_VISTA.'Modulos/Configuraciones/action_config2.php';  

	$handler = new HandlerSistema;
	$arrCliente = $handler->selectAllEmpresa();

	$handlerTI = new HandlerImportacion;	
	$arrTipoImportacion = $handlerTI->TipoImportacionTodos();
?>

<div class='col-md-12'>
	<form action="<?php echo $url_action; ?>" method="post">
		<div class="box">
			<div class="box-header">
				<i class="fa fa-cog"></i>
			  	<h3 class="box-title">Importacion de servicios</h3>	
			  	<div class="form-group">
	            	<button type="submit" class="btn btn-success pull-right">Guardar</button>            
	            </div>  
			</div>
			<div class="box-body">
				<div class="box-body table-responsive">
				  	<table class="table table-striped table-condensed" id='tabla'>
					    <thead>
					    	<tr>
						    	<th style='width: 25%;'>EMPRESA</th>
						      	<th>TIPO IMPORTACION 
						      		<i class="fa fa-question-circle" data-toggle="tooltip" title="" data-original-title="Cargar las categorias separadas por coma (categoria1,caategoria2,etc)"></i>
						      	</th>					      	
						    </tr>
						</thead>
						<tbody>
							<?php
						    	if(!empty($arrCliente))
						    	{
						    		foreach ($arrCliente as $key => $value) {	

						    			
						    			$arrTI = $handlerTI->getTipoImortacionByEmpresa($value->EMPTT11_CODIGO);

						    			if(is_null($arrTI)){						    			
						    				$intTipo = 0;
						    				$strTipo = "";
						    			}
						    			else{
						    				$intTipo = $arrTI->getIdTipoImportacion()->getId();
						    				$strTipo = $arrTI->getIdTipoImportacion()->getNombre();	
						    			}


						    			echo "
					    				<tr>
									    	<td>".$value->EMPTT21_NOMBREFA."</td>
									      	<td>
									      		<select class='form-control' name='id_".$value->EMPTT11_CODIGO."'>";
													if($intTipo==0)
														echo "<option selected></option>";
													else
														echo "<option></option>";

									      			foreach ($arrTipoImportacion as $key1 => $value1) {

									      				if($value1->getId()==$intTipo)
									      					echo "<option value='".$value1->getId()."' selected>".$value1->getNombre()."</option>";
									      				else
									      					echo "<option value='".$value1->getId()."'>".$value1->getNombre()."</option>";
									      			}
									    echo "
									      		</select>
									      	</td>
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