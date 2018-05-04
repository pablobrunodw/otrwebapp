<?php
	include_once "../../../Config/config.ini.php";
	include_once PATH_NEGOCIO."Usuarios/handlerusuarios.class.php";		

	if(isset($_POST['id']))
		$id= $_POST['id'];
	else
		$id= "";

	if(isset($_POST['nombre']))
		$nombre= $_POST['nombre'];
	else
		$nombre= "";

	if(isset($_POST['apellido']))
		$apellido= $_POST['apellido'];
	else
		$apellido= "";	

	if(isset($_FILES['foto']))
		$foto= $_FILES['foto'];
	else
		$foto= "";	

	
	$err = "../../../../index.php?view=perfil_usuario&err=";
	$info = "../../../../index.php?view=perfil_usuario&info=";

	try
	{		
		$handler = new HandlerUsuarios;		
		$handler->updatePerfil($id,$nombre,$apellido,$foto);

		$msj="Se actualizaron los datos de tu cuenta";
		header("Location: ".$info.$msj);

	}
	catch(Exception $e)
	{
		header("Location: ".$err.$e->getMessage());
	}
	
?>