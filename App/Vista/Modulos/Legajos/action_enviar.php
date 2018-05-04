<?php
	include_once "../../../Config/config.ini.php";	

	include_once PATH_NEGOCIO."Modulos/handlerlegajos.class.php"; 
	
	$err = "../../../../index.php?view=legajos_carga&err=";     		
	$info = "../../../../index.php?view=legajos_carga&info=";    

	$handler = new HandlerLegajos();

	$id = (isset($_POST["id"])?$_POST["id"]:'');

	try {
		$handler->enviarLegajo($id);

		$msj="Información Enviada";
		header("Location: ".$info.$msj);
	} catch (Exception $e) {
		header("Location: ".$err.$e->getMessage());
	}
?>