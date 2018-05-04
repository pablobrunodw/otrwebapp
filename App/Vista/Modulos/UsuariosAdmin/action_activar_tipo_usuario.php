<?php
	include_once "../../../Config/config.ini.php";
	include_once PATH_NEGOCIO."Usuarios/handlerusuarios.class.php";		
	include_once PATH_NEGOCIO."Usuarios/handlertipousuarios.class.php";	
	include_once PATH_NEGOCIO."Usuarios/handlerperfiles.class.php";			
	include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";		
	
	$usuario = (isset($_POST['usuario'])? $_POST['usuario']:'');		
	$tipo_usuario = (isset($_POST['tipo_usuario'])? $_POST['tipo_usuario']:'');		
	$id_usuario_sistema = (isset($_POST['id_usuario_sistema'])? $_POST['id_usuario_sistema']:'');		
	$alias_usuario_sistema = (isset($_POST['alias_usuario_sistema'])? $_POST['alias_usuario_sistema']:'');		
  
	$err = "../../../../index.php?view=panelcontrol";     		
	$info = "../../../../index.php?view=panelcontrol";     		

	try
	{	
		$handlerTipoUsuarios = new HandlerTipoUsuarios;
		$objTipoUsuario=$handlerTipoUsuarios->selectById($tipo_usuario);		
		
		$handler = new HandlerUsuarios;     
        $handler->updateUsuarioSistemaActivo($usuario,$objTipoUsuario,$id_usuario_sistema,$alias_usuario_sistema);		

		//$msj="Se actualizo la configuracion del usuario. <b>".$nombre." ".$apellido."</b>";
		header("Location: ".$info);
	}
	catch(Exception $e)
	{
		header("Location: ".$err);
	}
	
?>