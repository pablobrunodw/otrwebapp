<?php
	include_once "../../Config/config.ini.php";
	include_once PATH_NEGOCIO."AccesoSistema/accesosistema.class.php";		
	include_once PATH_NEGOCIO."Usuarios/handlerusuarios.class.php";		


	if(isset($_POST['nombre']))
		$nombre= $_POST['nombre'];
	else
		$nombre= "";

	if(isset($_POST['apellido']))
		$apellido= $_POST['apellido'];
	else
		$apellido= "";

	if(isset($_POST['empresa']))
		$empresa= $_POST['empresa'];
	else
		$empresa= "";

	if(isset($_POST['email']))
		$email= $_POST['email'];
	else
		$email= "";

	if(isset($_POST['password']))
		$password= $_POST['password'];
	else
		$password= "";


	$url = "action_login.php?email=".$email."&password=".$password;
	$err = "../../../index.php?view=login_registrar&err=";

	try
	{				
		$acceso = new AccesoSistema();
		$acceso->registrar($nombre,$apellido,$email,$password);
		
		header("Location: ".$url);

	}
	catch(Exception $e)
	{
		header("Location: ".$err.$e->getMessage());
	}
	
?>