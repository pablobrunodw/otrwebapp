<?php
	include_once "../../../Config/config.ini.php";	

	include_once PATH_NEGOCIO."Expediciones/handlerexpediciones.class.php"; 
	

	$hanlder = new HandlerExpediciones();

	$id = (isset($_POST["id"])?$_POST["id"]:'');

	
	$err = "../../../../index.php?view=exp_solicitud&err=";     		
	$info = "../../../../index.php?view=exp_solicitud&info=";     		

	try {
		$hanlder->eliminarItemExpedicion($id);

		$msj="Item Borrado";
		header("Location: ".$info.$msj);

	} catch (Exception $e) {
		header("Location: ".$err.$e->getMessage());
	}
	
?>