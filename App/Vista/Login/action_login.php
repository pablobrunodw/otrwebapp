<?php
	include_once "../../Config/config.ini.php";	
	include_once PATH_NEGOCIO."AccesoSistema/accesosistema.class.php";
	

	$url = "../../../index.php?view=panelcontrol";
	$err = "../../../index.php?view=login&err=";

	if(isset($_REQUEST['email']))
		$email= $_REQUEST['email'];
	else
		$email= "";

	if(isset($_REQUEST['password']))
		$password= $_REQUEST['password'];
	else
		$password= "";

	try 
	{	
		$login = new AccesoSistema();
		$login->autentificar($email, $password);			

		header("Location: ".$url);

	} catch (Exception $e) {		
        header("Location: ".$err.$e->getMessage());
	}
	
?>