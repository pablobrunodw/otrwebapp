<?php
	include_once "../../../Config/config.ini.php";	

	include_once PATH_NEGOCIO."Importacion/handlerimportacion.class.php"; 
	
	$hanlder = new HandlerImportacion();

	$id = (isset($_POST["id"])?$_POST["id"]:'');
	$estado = (isset($_POST["estado"])?$_POST["estado"]:'');

	$err = "../../../../index.php?view=importaciones_sin_plaza&err=";     		
	$info = "../../../../index.php?view=importaciones_sin_plaza&info=";     		

	try {		
		
		switch ($estado) {
			case 'ASIGNAR':
				$hanlder->asignarPlaza($id);
				$msj="El registro se asignó con éxito.";
				break;

			case 'ELIMINAR':
				$hanlder->eliminarServicioImportado($id);
				$msj="El registro se elimino con éxito.";
				break;											
		}
		
		header("Location: ".$info.$msj);

	} catch (Exception $e) {
		header("Location: ".$err.$e->getMessage());
	}
	
?>