<?php
	include_once "../../../Config/config.ini.php";	

	include_once PATH_NEGOCIO."Modulos/handlerlicencias.class.php"; 
	
	$err = "../../../../index.php?view=licencias_carga&err=";     		
	$info = "../../../../index.php?view=licencias_carga&info=";    

	$handler = new HandlerLicencias();

	$id = (isset($_GET["id"])?$_GET["id"]:'');

	try {
			
		$handler->eliminarLicencias($id);

		$msj="Licencia Eliminada";
		header("Location: ".$info.$msj);
				
	} catch (Exception $e) {
		header("Location: ".$err.$e->getMessage());
	}
?>