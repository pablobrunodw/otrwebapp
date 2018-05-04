<?php
	include_once "../../../Config/config.ini.php";
	include_once PATH_NEGOCIO."AccesoSistema/accesosistema.class.php";		

	if(isset($_POST['id']))
		$id= $_POST['id'];
	else
		$id= "";

	if(isset($_POST['password']))
		$password= $_POST['password'];
	else
		$password= "";
	
	$err = "../../../../index.php?view=password_usuario&err=";
	$info = "../../../../index.php?view=perfil_usuario&info=";

	try
	{		
		$acceso = new AccesoSistema;
		$acceso->cambiarPassword($id,$password);

		$msj="Se cambio tu contraseña";
		header("Location: ".$info.$msj);

	}
	catch(Exception $e)
	{
		header("Location: ".$err.$e->getMessage());
	}
	
?>