<?php
	include_once "../../../Config/config.ini.php";
	include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";  
	include_once PATH_NEGOCIO."UploadFile/handleruploadfile.class.php"; 	

	$handler = new HandlerSistema;
	$arrCliente = $handler->selectAllEmpresaFiltro(null,null,null,null,null);
	
	$datos="";
	foreach ($arrCliente as $key => $value) {
		$datos[]= array('empresa' => $value->EMPTT11_CODIGO,
					  'categorias' => $_POST["cat_".$value->EMPTT11_CODIGO]);	
	}

	$err = "../../../../index.php?view=configuraciones&config=config1&err=";
	$info = "../../../../index.php?view=configuraciones&config=config1&info=";	

	try
	{	
		if(!empty($datos)){

			$handlerUF = new HandlerUploadFile;			
			$handlerUF->guardarCategoriasTemplate($datos);					

			$msj="Se actualizaron todas las categorias";
			header("Location: ".$info.$msj);				
		}
	}
	catch(Exception $e)
	{
		header("Location: ".$err.$e->getMessage());
	}
?>