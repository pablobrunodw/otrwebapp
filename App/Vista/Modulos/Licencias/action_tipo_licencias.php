<?php
	include_once "../../../Config/config.ini.php";	

	include_once PATH_NEGOCIO."Modulos/handlerlicencias.class.php"; 
	
	$hanlder = new HandlerLicencias();

	$id = (isset($_POST["id"])?$_POST["id"]:'');
	$estado = (isset($_POST["estado"])?$_POST["estado"]:'');

	$nombre = (isset($_POST["nombre"])?$_POST["nombre"]:'');
	$dias = (isset($_POST["dias"])?$_POST["dias"]:'');	
	
	$err = "../../../../index.php?view=tipo_licencias&err=";     		
	$info = "../../../../index.php?view=tipo_licencias&info=";     		

	try {

		$hanlder->guardarTipoABM($id,$nombre,$dias,$estado);
		
		$msj="El tipo para liquidaciones se guardo con éxito.";
		header("Location: ".$info.$msj);

	} catch (Exception $e) {
		header("Location: ".$err.$e->getMessage());
	}
	
?>