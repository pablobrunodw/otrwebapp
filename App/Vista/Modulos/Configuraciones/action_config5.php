<?php
	include_once "../../../Config/config.ini.php";
	include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";  
	include_once PATH_NEGOCIO."Modulos/handlerpuntaje.class.php"; 	

	$handler = new HandlerSistema;
	$arrCoordinador = $handler->selectAllCoordinador(null);
	
	$datos="";
	foreach ($arrCoordinador as $key => $value) {
		$datos[]= array('coordinador' => $value->CORDI11_ALIAS,
					  'objetivo' => $_POST["id_".$value->CORDI11_ALIAS]);	
	}

	$err = "../../../../index.php?view=configuraciones&config=config5&err=";
	$info = "../../../../index.php?view=configuraciones&config=config5&info=";	

	try
	{	
		if(!empty($datos)){

			$handlerTI = new HandlerPuntaje;			
			$handlerTI->guardarObjetivoByCoordinador($datos);					

			$msj="Se actualizaron todos los objetivos";
			header("Location: ".$info.$msj);				
		}
	}
	catch(Exception $e)
	{
		header("Location: ".$err.$e->getMessage());
	}
?>