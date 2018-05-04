<?php
	include_once "../../../Config/config.ini.php";	

	include_once PATH_NEGOCIO."Modulos/handlerayuda.class.php"; 
	
	$hanlder = new HandlerAyuda();

	$id = (isset($_POST["id"])?$_POST["id"]:'');
	$estado = (isset($_POST["estado"])?$_POST["estado"]:'');

	$nombre = (isset($_POST["nombre"])?$_POST["nombre"]:'');
	
	$err = "../../../../index.php?view=grupo_ayuda&err=";     		
	$info = "../../../../index.php?view=grupo_ayuda&info=";     		

	try {

		$hanlder->guardarGrupoABM($id,$nombre,$estado);
		
		$msj="El grupo de ayuda se guardo con éxito.";
		header("Location: ".$info.$msj);

	} catch (Exception $e) {
		header("Location: ".$err.$e->getMessage());
	}
	
?>