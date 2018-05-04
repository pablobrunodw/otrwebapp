<?php
	include_once "../../../Config/config.ini.php";
	include_once PATH_NEGOCIO."Importacion/handlerimportacion.class.php";		

	$id= (isset($_GET['id'])? $_GET['id']:'');			

	$err = "../../../../index.php?view=importacion&err=";     		
	$info = "../../../../index.php?view=importacion&info=";     		
	
	try
	{							
        $handler = new HandlerImportacion;        
        $handler->deleteImportacionById($id);		

		$msj="Se elimino la importación seleccionada";
		header("Location: ".$info.$msj);
	}
	catch(Exception $e)
	{
		header("Location: ".$err.$e->getMessage());
	}
	
?>