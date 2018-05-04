<?php
	include_once "../../../Config/config.ini.php";	

	include_once PATH_NEGOCIO."Modulos/handlerlicencias.class.php"; 
	
	include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
	
	$f_fecha = new Fechas;
	$handler = new HandlerLicencias();
		
	$id = (isset($_POST["id"])?$_POST["id"]:'');

	$adjunto1 = (isset($_FILES["adjunto1"])?$_FILES["adjunto1"]:'');	
	
	$err = "../../../../index.php?view=licencias_carga&err=";     		
	$info = "../../../../index.php?view=licencias_carga&info=";     		

	try {
		$handler->guardarAdjunto1($id,$adjunto1);

		$msj="Adjunto 1 Cargado";
		header("Location: ".$info.$msj);

	} catch (Exception $e) {
		header("Location: ".$err.$e->getMessage());
	}
	
?>