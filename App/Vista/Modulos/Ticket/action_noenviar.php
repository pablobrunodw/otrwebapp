<?php
	include_once "../../../Config/config.ini.php";	

	include_once PATH_NEGOCIO."Modulos/handlertickets.class.php"; 
	
	$err = "../../../../index.php?view=tickets_control&err=";     		
	$info = "../../../../index.php?view=tickets_control&info=";    

	$handler = new HandlerTickets();

	$id = (isset($_GET["id"])?$_GET["id"]:'');

	try {
		$handler->rechazarTickets($id);

		$msj="Ticket No Enviado";
		header("Location: ".$info.$msj);
	} catch (Exception $e) {
		header("Location: ".$err.$e->getMessage());
	}
?>