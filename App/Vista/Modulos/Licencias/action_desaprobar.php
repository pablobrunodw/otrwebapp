<?php
	include_once "../../../Config/config.ini.php";	

	include_once PATH_NEGOCIO."Modulos/handlerlicencias.class.php"; 
	
	$err = "../../../../index.php?view=licencias_control&err=";     		
	$info = "../../../../index.php?view=licencias_control&info=";    

	$handler = new HandlerLicencias();

	$id = (isset($_GET["id"])?$_GET["id"]:'');

	try {
		$handler->desaprobarLicencias($id);

		$msj="Licencia Desaprobada";
		header("Location: ".$info.$msj);
	} catch (Exception $e) {
		header("Location: ".$err.$e->getMessage());
	}
?>