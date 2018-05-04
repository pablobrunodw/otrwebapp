<?php
	include_once "../../../../Config/config.ini.php";
	include_once PATH_NEGOCIO."UploadFile/handleruploadfile.class.php";		

	$nroing = (isset($_POST['servicio'])? $_POST['servicio']:''); 
	$fechaing = (isset($_POST['fecha'])? $_POST['fecha']:'');	
		
	$err = "../../../../../../index.php?view=upload_file&fechaing=".$fechaing."&nroing=".$nroing."&err=";     		
	$info = "../../../../../../index.php?view=upload_file&fechaing=".$fechaing."&nroing=".$nroing."&info=";

	try
	{			
		$handlerUF = new HandlerUploadFile;
		$handlerUF->despublicar($fechaing,$nroing);
		
		$msj="Servicio despublicado";
		header("Location: ".$info.$msj);
	}
	catch(Exception $e)
	{
		header("Location: ".$err.$e->getMessage());
	}
	
?>

