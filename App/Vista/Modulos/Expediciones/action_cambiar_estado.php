<?php
	include_once "../../../Config/config.ini.php";	

	include_once PATH_NEGOCIO."Expediciones/handlerexpediciones.class.php"; 
	
	include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
	
	$f_fecha = new Fechas;	
	
	$id = (isset($_POST["id"])?$_POST["id"]:'');
	$estados = (isset($_POST["estados"])?$_POST["estados"]:'');
	$observaciones = (isset($_POST["observaciones"])?$_POST["observaciones"]:'');

	$origen = (isset($_POST["origen"])?$_POST["origen"]:'');
	
	if($origen=="CONTROL"){
		$err = "../../../../index.php?view=exp_control&err=";     		
		$info = "../../../../index.php?view=exp_control&info="; 
	}
	else{
		$err = "../../../../index.php?view=exp_seguimiento&err=";     		
		$info = "../../../../index.php?view=exp_seguimiento&info="; 
	}
    		
	try {
		$hanlder = new HandlerExpediciones();
		$hanlder->cambiarEstadoExpedicion($id, $estados, $observaciones);

		$msj="El estado fue cambiado con con éxito.";
		header("Location: ".$info.$msj);

	} catch (Exception $e) {
		header("Location: ".$err.$e->getMessage());
	}
	
?>