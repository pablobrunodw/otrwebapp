<?php
	include_once "../../../Config/config.ini.php";
	include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";  
	include_once PATH_NEGOCIO."Modulos/handlerpuntaje.class.php"; 	

	$handler = new HandlerSistema;
	$arrGestor = $handler->selectAllGestor(null);
	
	$datos="";
	foreach ($arrGestor as $key => $value) {
		$datos[]= array('gestor' => $value->GESTOR11_CODIGO,
					  'objetivo' => $_POST["id_".$value->GESTOR11_CODIGO]);	
	}

	$err = "../../../../index.php?view=configuraciones&config=config4&err=";
	$info = "../../../../index.php?view=configuraciones&config=config4&info=";	

	try
	{	
		if(!empty($datos)){

			$handlerTI = new HandlerPuntaje;			
			$handlerTI->guardarObjetivoByGestor($datos);					

			$msj="Se actualizaron todos los objetivos";
			header("Location: ".$info.$msj);				
		}
	}
	catch(Exception $e)
	{
		header("Location: ".$err.$e->getMessage());
	}
?>