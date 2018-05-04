<?php
	include_once "../../../Config/config.ini.php";
	include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";  
	include_once PATH_NEGOCIO."Modulos/handlerpuntaje.class.php"; 	

	$handler = new HandlerSistema;
	$arrCliente = $handler->selectAllEmpresaFiltro(null,null,null,null,null);
	
	$datos="";
	foreach ($arrCliente as $key => $value) {
		$datos[]= array('empresa' => $value->EMPTT11_CODIGO,
					  'puntaje' => $_POST["id_".$value->EMPTT11_CODIGO]);	
	}

	$err = "../../../../index.php?view=configuraciones&config=config3&err=";
	$info = "../../../../index.php?view=configuraciones&config=config3&info=";	

	try
	{	
		if(!empty($datos)){

			$handlerTI = new HandlerPuntaje;			
			$handlerTI->guardarPuntajeByEmpresa($datos);					

			$msj="Se actualizaron todos los puntajes";
			header("Location: ".$info.$msj);				
		}
	}
	catch(Exception $e)
	{
		header("Location: ".$err.$e->getMessage());
	}
?>