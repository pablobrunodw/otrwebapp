<?php
	include_once "../../../Config/config.ini.php";
	include_once PATH_NEGOCIO."Usuarios/handlerusuarios.class.php";		
	include_once PATH_NEGOCIO."Usuarios/handlertipousuarios.class.php";	
	include_once PATH_NEGOCIO."Usuarios/handlerperfiles.class.php";			
	include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";		
	
	$usuario = (isset($_POST['usuario'])? $_POST['usuario']:'');			
	$perfil = (isset($_POST['slt_perfil'])? $_POST['slt_perfil']:'');		
  
	$err = "../../../../index.php?view=cambioRol";     		
	$info = "../../../../index.php?view=cambioRol";     		

	try
	{	
		$handler = new HandlerUsuarios;     
        $handler->updatePerfilUsuario($usuario,$perfil);		

		//$msj="Se actualizo la configuracion del usuario. <b>".$nombre." ".$apellido."</b>";
		header("Location: ".$info);
	}
	catch(Exception $e)
	{
		header("Location: ".$err);
	}
	
?>