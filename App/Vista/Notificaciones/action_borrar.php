<?php	
	include_once "../../Config/config.ini.php";	

	include_once PATH_NEGOCIO."Notificaciones/handlerNotificaciones.class.php"; 
		

	$hanlder = new handlerNotificaciones();
	
	$id = (isset($_GET["id"])?$_GET["id"]:'');
	$view = (isset($_GET["vista"])?$_GET["vista"]:'');
		
	$url = "../../../index.php?view=".$view;

	try {
		$hanlder->borrarNotificacion($id);
		
		header("Location: ".$url);

	} catch (Exception $e) {
		header("Location: ".$url);
	}
	
?>