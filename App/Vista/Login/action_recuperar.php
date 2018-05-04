<?php
	include_once "../../Config/config.ini.php";	
	include_once PATH_NEGOCIO."AccesoSistema/accesosistema.class.php";	

	if(isset($_POST['email']))
		$email= $_POST['email'];
	else
		$email= "";

	$url = "../../../index.php?view=login&info=";
	$err = "../../../index.php?view=login_recuperar&err=";

	try
	{
		$acceso = new AccesoSistema();		
		$acceso->recuperar($email);

		$msj="Se envió un email a tu correo con una nueva contraseña";
		header("Location: ".$url.$msj);

	}
	catch(Exception $e)
	{
		header("Location: ".$err.$e->getMessage());
	}
	
?>