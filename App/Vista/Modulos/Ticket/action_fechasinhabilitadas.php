<?php
	include_once "../../../Config/config.ini.php";	

	include_once PATH_NEGOCIO."Modulos/handlertickets.class.php"; 
	
	$hanlder = new HandlerTickets();

	$id = (isset($_POST["id"])?$_POST["id"]:'');
	$estado = (isset($_POST["estado"])?$_POST["estado"]:'');

	$fecha = (isset($_POST["fecha"])?$_POST["fecha"]:'');
	$motivo = (isset($_POST["motivo"])?$_POST["motivo"]:'');
	
	$err = "../../../../index.php?view=tickets_fechas_inhabilitadas&err=";     		
	$info = "../../../../index.php?view=tickets_fechas_inhabilitadas&info=";     		

/*
	var_dump($id);
	var_dump($estado);
	var_dump($fecha);
	var_dump($motivo);
	exit();
*/

	try {

		$hanlder->guardarFechasInhabilitadasABM($id,$fecha,$motivo,$estado);
		
		$msj="La fecha se guardo con éxito.";
		header("Location: ".$info.$msj);

	} catch (Exception $e) {
		header("Location: ".$err.$e->getMessage());
	}
	
?>