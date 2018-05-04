<?php
	include_once "../../../Config/config.ini.php";
	//include_once PATH_NEGOCIO."Usuarios/handlerusuarios.class.php";		
	//include_once PATH_NEGOCIO."Usuarios/handlertipousuarios.class.php";	
	include_once PATH_NEGOCIO."Usuarios/handlerperfiles.class.php";			
	//include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";		

	$datos["id"]= (isset($_POST['id'])? $_POST['id']:'');
	$datos["nombre"]= (isset($_POST['nombre'])? $_POST['nombre']:'');
	$datos["chk_panel"] = (isset($_POST['chk_panel'])? $_POST['chk_panel']:'');
	$datos["chk_legajos"] = (isset($_POST['chk_legajos'])? $_POST['chk_legajos']:'');
	$datos["chk_tickets"] = (isset($_POST['chk_tickets'])? $_POST['chk_tickets']:'');
	$datos["chk_licencias"] = (isset($_POST['chk_licencias'])? $_POST['chk_licencias']:'');	
	//$datos["chk_capacitaciones"] = (isset($_POST['chk_capacitaciones'])? $_POST['chk_capacitaciones']:'');
	$datos["chk_guias"] = (isset($_POST['chk_guias'])? $_POST['chk_guias']:'');
	$datos["chk_inventario"] = (isset($_POST['chk_inventario'])? $_POST['chk_inventario']:'');
	$datos["chk_stock"] = (isset($_POST['chk_stock'])? $_POST['chk_stock']:'');
	$datos["chk_importacion"] = (isset($_POST['chk_importacion'])? $_POST['chk_importacion']:'');
	$datos["chk_servicios"] = (isset($_POST['chk_servicios'])? $_POST['chk_servicios']:'');
	$datos["chk_upload"] = (isset($_POST['chk_upload'])? $_POST['chk_upload']:'');
	$datos["chk_enviadas"] = (isset($_POST['chk_enviadas'])? $_POST['chk_enviadas']:'');
	$datos["chk_metricas"] = (isset($_POST['chk_metricas'])? $_POST['chk_metricas']:'');
	$datos["chk_puntajes"] = (isset($_POST['chk_puntajes'])? $_POST['chk_puntajes']:'');
	$datos["chk_ayuda"] = (isset($_POST['chk_ayuda'])? $_POST['chk_ayuda']:'');
	$datos["chk_inbox"] = (isset($_POST['chk_inbox'])? $_POST['chk_inbox']:'');
	$datos["chk_multiusuario"] = (isset($_POST['chk_multiusuario'])? $_POST['chk_multiusuario']:'');
	$datos["chk_perfil"] = (isset($_POST['chk_perfil'])? $_POST['chk_perfil']:'');
	$datos["chk_usuarios"] = (isset($_POST['chk_usuarios'])? $_POST['chk_usuarios']:'');
	$datos["chk_roles"] = (isset($_POST['chk_roles'])? $_POST['chk_roles']:'');
	$datos["chk_configuraciones"] = (isset($_POST['chk_configuraciones'])? $_POST['chk_configuraciones']:'');

	$err = "../../../../index.php?view=roles_edit&id=".$datos["id"]."&err=";     		
	$info = "../../../../index.php?view=roles&info=";     		
	
	try{
		$handler = new HandlerPerfiles;	
    	$handler->updateRoles($datos);		

		$msj="Se actualizo la configuracion del rol. <b>".$datos["nombre"]."</b>";
		header("Location: ".$info.$msj);
	}
	catch(Exception $e)
	{
		header("Location: ".$err.$e->getMessage());
	}
	
?>