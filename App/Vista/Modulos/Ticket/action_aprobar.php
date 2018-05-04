<?php
	include_once "../../../Config/config.ini.php";	

	include_once PATH_NEGOCIO."Modulos/handlertickets.class.php"; 
	
	$err = "../../../../index.php?view=tickets_aprobar&err=";     		
	$info = "../../../../index.php?view=tickets_aprobar&info=";    

	$handler = new HandlerTickets();

	$id = (isset($_POST["id"])?$_POST["id"]:'');
	$reintegro = (isset($_POST["reintegro"])?$_POST["reintegro"]:'');
	$aledanio = (isset($_POST["aledanio"])?$_POST["aledanio"]:'');
	$operaciones = (isset($_POST["operaciones"])?$_POST["operaciones"]:'');

	if($aledanio=="on")
		$aledanio_val = true;
	else
		$aledanio_val = false;

	try {
		$handler->aprobarTickets($id,$reintegro,$aledanio_val,$operaciones);

		$msj="Ticket Aprobado";
		header("Location: ".$info.$msj);
	} catch (Exception $e) {
		header("Location: ".$err.$e->getMessage());
	}
?>