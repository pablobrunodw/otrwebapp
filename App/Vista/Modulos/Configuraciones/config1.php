<?php
	include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";  
	include_once PATH_NEGOCIO."UploadFile/handleruploadfile.class.php";  

	$url_action = PATH_VISTA.'Modulos/Configuraciones/action_config1.php';  

	$handler = new HandlerSistema;
	$arrCliente = $handler->selectAllEmpresa();
?>

<div class='col-md-12'>
	<form action="<?php echo $url_action; ?>" method="post">
		<div class="box">
			<div class="box-header">
				<i class="fa fa-cog"></i>
			  	<h3 class="box-title">Subir Documentación por Servicios</h3>	
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
						      	<th>CATEGORIAS 
						      		<i class="fa fa-question-circle" data-toggle="tooltip" title="" data-original-title="Cargar las categorias separadas por coma (categoria1,caategoria2,etc)"></i>
						      	</th>					      	
						    </tr>
						</thead>
						<tbody>
							<?php
						    	if(!empty($arrCliente))
						    	{
						    		foreach ($arrCliente as $key => $value) {	

						    			$handlerUF = new HandlerUploadFile;
						    			$strCategoria = $handlerUF->stringCategoriasTemplate($value->EMPTT11_CODIGO);

						    			echo "
					    				<tr>
									    	<td>".$value->EMPTT21_NOMBREFA."</td>
									      	<td><input type='text' class='form-control' name='cat_".$value->EMPTT11_CODIGO."' style='width: 100%;' value='".$strCategoria."'></td>
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