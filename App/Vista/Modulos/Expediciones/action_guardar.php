<?php
	include_once "../../../Config/config.ini.php";	

	include_once PATH_NEGOCIO."Expediciones/handlerexpediciones.class.php"; 
	
	include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
	
	$f_fecha = new Fechas;
	$hanlder = new HandlerExpediciones();

	$fecha = $f_fecha->FechaActual();
	$usuario = (isset($_POST["usuario"])?$_POST["usuario"]:'');
	$detalle = (isset($_POST["detalle"])?$_POST["detalle"]:'');
	$observaciones = "";
	$tipo = (isset($_POST["slt_tipo"])?$_POST["slt_tipo"]:'');
	$cant = (isset($_POST["cantidad"])?$_POST["cantidad"]:'');
	$estados = 0;
	
	$err = "../../../../index.php?view=exp_solicitud&err=";     		
	$info = "../../../../index.php?view=exp_solicitud&info=";     		

	try {
		$hanlder->guardarItemExpedicion($fecha,$usuario,$detalle,$observaciones,$tipo,$cant,$estados);

		$msj="Item Cargado";
		header("Location: ".$info.$msj);

	} catch (Exception $e) {
		header("Location: ".$err.$e->getMessage());
	}
	
?>