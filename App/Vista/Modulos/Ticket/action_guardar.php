<?php
	include_once "../../../Config/config.ini.php";	

	include_once PATH_NEGOCIO."Modulos/handlertickets.class.php"; 
	
	$handler = new HandlerTickets();
		
	$usuario = (isset($_POST["usuario"])?$_POST["usuario"]:'');
	$fecha_hora = (isset($_POST["fecha_hora"])?$_POST["fecha_hora"]:'');	
	$tipo = (isset($_POST["tipo"])?$_POST["tipo"]:'');	
	$punto_venta = (isset($_POST["punto_venta"])?$_POST["punto_venta"]:'');	
	$numero = (isset($_POST["numero"])?$_POST["numero"]:'');	
	$razon_social = (isset($_POST["razon_social"])?$_POST["razon_social"]:'');	
	$cuit = (isset($_POST["cuit"])?$_POST["cuit"]:'');	
	$iibb = (isset($_POST["iibb"])?$_POST["iibb"]:'');	
	$domicilio = (isset($_POST["domicilio"])?$_POST["domicilio"]:'');	
	$condicion_fiscal = (isset($_POST["condicion_fiscal"])?$_POST["condicion_fiscal"]:'');	
	$importe = (isset($_POST["importe"])?$_POST["importe"]:'');	
	$adjunto = (isset($_FILES["adjunto"])?$_FILES["adjunto"]:'');	
	$concepto = (isset($_POST["concepto"])?$_POST["concepto"]:'');	
	$concepto = (isset($_POST["concepto"])?$_POST["concepto"]:'');	
	
	try {
		
		$err = "../../../../index.php?view=tickets_carga&err=";     		
		$info = "../../../../index.php?view=tickets_carga&info=";     		

		$handler->guardarTickets($usuario,$fecha_hora,$tipo,$punto_venta,$numero,$razon_social,$cuit,$iibb,$domicilio,$condicion_fiscal,$importe,$adjunto,$concepto);
		
		$msj="Tickets Guardado";
		header("Location: ".$info.$msj);																						
		
	} catch (Exception $e) {
		header("Location: ".$err.$e->getMessage());
	}
	
?>