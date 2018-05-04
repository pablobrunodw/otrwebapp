<?php
	include_once "../../../Config/config.ini.php";	

	include_once PATH_NEGOCIO."Guias/handlerguias.class.php"; 
	
	include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
	
	$f_fecha = new Fechas;
	$hanlder = new HandlerGuias();

	$fechaHora = $f_fecha->FechaHoraActual();
	$usuario = (isset($_POST["usuario"])?$_POST["usuario"]:'');
	$imagen = (isset($_FILES["imagen"])?$_FILES["imagen"]:'');
	$observaciones = (isset($_POST["observaciones"])?$_POST["observaciones"]:'');	

	$arrEmpresas = (isset($_POST["slt_empresas"])?$_POST["slt_empresas"]:'');
	/*
	$empresas="";
	foreach ($arrEmpresas as $key => $value) {
		$empresas = $value."/";
	}	
	*/

	$err = "../../../../index.php?view=guias_seguimiento&err=";     		
	$info = "../../../../index.php?view=guias_seguimiento&info=";     		

	try {
		$hanlder->guardarGuias($fechaHora,$usuario,$imagen,$observaciones,$arrEmpresas);

		$msj="La guía fue enviada con éxito.";
		header("Location: ".$info.$msj);

	} catch (Exception $e) {
		header("Location: ".$err.$e->getMessage());
	}
	
?>