<?php
	include_once "../../../Config/config.ini.php";	

	include_once PATH_NEGOCIO."Modulos/handlertickets.class.php"; 
	
	$err = "../../../../index.php?view=tickets_carga&err=";     		
	$info = "../../../../index.php?view=tickets_carga&info=";    

	$handler = new HandlerTickets();

	$id = (isset($_GET["id"])?$_GET["id"]:'');

	try {
			
		$handler->eliminarTickets($id);

		$msj="Ticket Eliminado";
		header("Location: ".$info.$msj);
				
	} catch (Exception $e) {
		header("Location: ".$err.$e->getMessage());
	}
?>