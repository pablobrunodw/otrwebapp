<?php
	include_once "../../../Config/config.ini.php";
	include_once PATH_NEGOCIO."Usuarios/handlerusuarios.class.php";		
	include_once PATH_NEGOCIO."Usuarios/handlertipousuarios.class.php";		
	include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";		

	$id= (isset($_POST['id'])? $_POST['id']:'');		
	$nombre = (isset($_POST['nombre'])? $_POST['nombre']:'');
	$apellido = (isset($_POST['apellido'])? $_POST['apellido']:'');

	$err = "../../../../index.php?view=usuarioABM&id=".$id."&err=";     		
	$info = "../../../../index.php?view=usuarioABM&info=";     		

	try
	{							
        $handler = new HandlerUsuarios;        
        $handler->delete($id);		

		$msj="Se elimino el usuario. <b>".$nombre." ".$apellido."</b>";
		header("Location: ".$info.$msj);
	}
	catch(Exception $e)
	{
		header("Location: ".$err.$e->getMessage());
	}
	
?>