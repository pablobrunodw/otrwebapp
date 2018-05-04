<?php
	include_once "../../../Config/config.ini.php";	

	include_once PATH_NEGOCIO."Importacion/handlerplazacp.class.php"; 
	
	$hanlder = new HandlerPlazaCP();

	$id = (isset($_POST["id"])?$_POST["id"]:'');
	$estado = (isset($_POST["estado"])?$_POST["estado"]:'');

	$cp = (isset($_POST["cp"])?$_POST["cp"]:'');
	$cp_nombre = (isset($_POST["cp_nombre"])?$_POST["cp_nombre"]:'');
	$plaza = (isset($_POST["plaza"])?$_POST["plaza"]:'');	
	
	$err = "../../../../index.php?view=cp_plaza&err=";     		
	$info = "../../../../index.php?view=cp_plaza&info=";     		

	try {

		$hanlder->guardarCpABM($id,$cp,$cp_nombre,$plaza,$estado);
		
		switch ($estado) {
			case 'NUEVO':
				$msj="El Codigo Postal se guardo con éxito.";
				break;
			case 'EDITAR':
				$msj="El Codigo Postal se actualizo con éxito.";
				break;
			case 'ELIMINAR':
				$msj="El Codigo Postal se elimino con éxito.";
				break;											
		}
		
		header("Location: ".$info.$msj);

	} catch (Exception $e) {
		header("Location: ".$err.$e->getMessage());
	}
	
?>