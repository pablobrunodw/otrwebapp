<?php
	include_once "../../../Config/config.ini.php";
	include_once PATH_NEGOCIO."Importacion/handlerimportacion.class.php";		
	
	$impo= (isset($_POST['impo'])? $_POST['impo']:'');	
	$reg= (isset($_POST['reg'])? $_POST['reg']:'');			


	$err = "../../../../index.php?view=importacion_detalle&importacion_id=".$impo."&err=";     		
	$info = "../../../../index.php?view=importacion_detalle&importacion_id=".$impo."&info=";     		
	
	try
	{							
        $handler = new HandlerImportacion;        
        $handler->deleteRegistroImportacion($impo, $reg);		

		$msj="Se elimino el registro de importación seleccionado";
		header("Location: ".$info.$msj);
	}
	catch(Exception $e)
	{
		header("Location: ".$err.$e->getMessage());
	}
	
?>