<?php
	include_once "../../../Config/config.ini.php";
	include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";  
	include_once PATH_NEGOCIO."Sistema/handlersupervisor.class.php";  
	include_once PATH_NEGOCIO."Modulos/handlerpuntaje.class.php"; 	

	$handler = new handlersupervisor;
	$arrSupervisor = $handler->selectAllSupervisor();
	
	$datos="";
	foreach ($arrSupervisor as $key => $value) {
		$datos[]= array('supervisor' => $value['id'],
					  'objetivo' => $_POST["id_".$value['id']]);	
	}

	$err = "../../../../index.php?view=configuraciones&config=config6&err=";
	$info = "../../../../index.php?view=configuraciones&config=config6&info=";	

	try
	{	
		if(!empty($datos)){

			$handlerTI = new HandlerPuntaje;			
			$handlerTI->guardarObjetivoBySupervisor($datos);					

			$msj="Se actualizaron todos los objetivos";
			header("Location: ".$info.$msj);				
		}
	}
	catch(Exception $e)
	{
		header("Location: ".$err.$e->getMessage());
	}
?>