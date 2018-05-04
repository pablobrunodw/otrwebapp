<?php
	include_once "../../../Config/config.ini.php";
	include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";  
	include_once PATH_NEGOCIO."Importacion/handlerimportacion.class.php"; 	

	$handler = new HandlerSistema;
	$arrCliente = $handler->selectAllEmpresa();
	
	$datos="";
	foreach ($arrCliente as $key => $value) {
		$datos[]= array('empresa' => $value->EMPTT11_CODIGO,
					  'id_tipo_importacion' => $_POST["id_".$value->EMPTT11_CODIGO]);	
	}

	$err = "../../../../index.php?view=configuraciones&config=config2&err=";
	$info = "../../../../index.php?view=configuraciones&config=config2&info=";	

	try
	{	
		if(!empty($datos)){

			$handlerTI = new HandlerImportacion;			
			$handlerTI->guardarTipoImportacionByEmpresa($datos);					

			$msj="Se actualizaron todos los tipos de importación";
			header("Location: ".$info.$msj);				
		}
	}
	catch(Exception $e)
	{
		header("Location: ".$err.$e->getMessage());
	}
?>