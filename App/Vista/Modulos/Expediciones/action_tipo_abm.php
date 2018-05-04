<?php
	include_once "../../../Config/config.ini.php";	

	include_once PATH_NEGOCIO."Expediciones/handlerexpediciones.class.php"; 
	
	$hanlder = new HandlerExpediciones();

	$id = (isset($_POST["id"])?$_POST["id"]:'');
	$estado = (isset($_POST["estado"])?$_POST["estado"]:'');

	$grupo = (isset($_POST["grupo"])?$_POST["grupo"]:'');
	$nombre = (isset($_POST["nombre"])?$_POST["nombre"]:'');	
	
	$err = "../../../../index.php?view=exp_tipo_abm&err=";     		
	$info = "../../../../index.php?view=exp_tipo_abm&info=";     		

	try {

		$hanlder->guardarTipoABM($grupo,$nombre,$estado,$id);
		
		$msj="El tipo para expediciones se guardo con éxito.";
		header("Location: ".$info.$msj);

	} catch (Exception $e) {
		header("Location: ".$err.$e->getMessage());
	}
	
?>