<?php
	include_once "../../../Config/config.ini.php";	

	include_once PATH_NEGOCIO."Modulos/handlerlicencias.class.php"; 
	
	include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
	
	$f_fecha = new Fechas;
	$handler = new HandlerLicencias();
		
	$id = (isset($_POST["id"])?$_POST["id"]:'');

	$adjunto2 = (isset($_FILES["adjunto2"])?$_FILES["adjunto2"]:'');	
	
	$err = "../../../../index.php?view=licencias_carga&err=";     		
	$info = "../../../../index.php?view=licencias_carga&info=";     		

	try {
		$handler->guardarAdjunto2($id,$adjunto2);

		$msj="Adjunto 2 Cargado";
		header("Location: ".$info.$msj);

	} catch (Exception $e) {
		header("Location: ".$err.$e->getMessage());
	}
	
?>