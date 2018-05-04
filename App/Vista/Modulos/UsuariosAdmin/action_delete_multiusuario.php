<?php
	include_once "../../../Config/config.ini.php";
	include_once PATH_NEGOCIO."Usuarios/handlerusuarios.class.php";	
	include_once PATH_NEGOCIO."Usuarios/handlermultiusuarios.class.php";		
	include_once PATH_NEGOCIO."Usuarios/handlertipousuarios.class.php";		
	include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";		

	$id= (isset($_POST['id'])? $_POST['id']:'');		
	$usuario = (isset($_POST['usuario'])? $_POST['usuario']:'');		

	$err = "../../../../index.php?view=usuarioABM_multiuser&id=".$usuario."&err=";     		
	$info = "../../../../index.php?view=usuarioABM_multiuser&id=".$usuario."&info=";     		

	try
	{							
        $handler = new HandlerMultiusuarios;        
        $handler->delete($id, $usuario);		

		$msj="Se elimino la asociación con el usuario";
		header("Location: ".$info.$msj);
	}
	catch(Exception $e)
	{
		header("Location: ".$err.$e->getMessage());
	}
	
?>