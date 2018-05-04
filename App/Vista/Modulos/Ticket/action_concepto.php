<?php
	include_once "../../../Config/config.ini.php";	

	include_once PATH_NEGOCIO."Modulos/handlertickets.class.php"; 
	
	$hanlder = new HandlerTickets();

	$id = (isset($_POST["id"])?$_POST["id"]:'');
	$estado = (isset($_POST["estado"])?$_POST["estado"]:'');

	$nombre = (isset($_POST["nombre"])?$_POST["nombre"]:'');
	
	$err = "../../../../index.php?view=tickets_conceptos&err=";     		
	$info = "../../../../index.php?view=tickets_conceptos&info=";     		

	try {

		$hanlder->guardarConceptosABM($id,$nombre,$estado);
		
		$msj="El concepto se guardo con éxito.";
		header("Location: ".$info.$msj);

	} catch (Exception $e) {
		header("Location: ".$err.$e->getMessage());
	}
	
?>