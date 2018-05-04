<?php
	include_once "../../../Config/config.ini.php";	

	include_once PATH_NEGOCIO."Modulos/handlerlegajos.class.php"; 
	
	$err = "../../../../index.php?view=legajos_control&err=";     		
	$info = "../../../../index.php?view=legajos_control&info=";    

	$handler = new HandlerLegajos();

	$id = (isset($_POST["id"])?$_POST["id"]:'');

	try {
		$handler->rechazarLegajo($id);

		$msj="Legajo Rechazado";
		header("Location: ".$info.$msj);
	} catch (Exception $e) {
		header("Location: ".$err.$e->getMessage());
	}
?>