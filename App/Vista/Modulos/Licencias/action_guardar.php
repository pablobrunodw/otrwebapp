<?php
	include_once "../../../Config/config.ini.php";	

	include_once PATH_NEGOCIO."Modulos/handlerlicencias.class.php"; 
	
	include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
	
	$f_fecha = new Fechas;
	$handler = new HandlerLicencias();

	$fecha = $f_fecha->FechaActual();
	$usuario = (isset($_POST["usuario"])?$_POST["usuario"]:'');
	$tipoLiencia = (isset($_POST["tipo_licencia"])?$_POST["tipo_licencia"]:'');	

	$fecha_desde = (isset($_POST["fecha_desde"])?$_POST["fecha_desde"]:'');
	$fecha_hasta = (isset($_POST["fecha_hasta"])?$_POST["fecha_hasta"]:'');

	$observaciones = (isset($_POST["observaciones"])?$_POST["observaciones"]:'');;

	$adjunto1 = (isset($_FILES["adjunto1"])?$_FILES["adjunto1"]:'');
	$adjunto2 = (isset($_FILES["adjunto2"])?$_FILES["adjunto2"]:'');
	
	$err = "../../../../index.php?view=licencias_carga&err=";     		
	$info = "../../../../index.php?view=licencias_carga&info=";     		

	try {
		$handler->guardarLicencias($fecha,$usuario,$tipoLiencia,$observaciones,$fecha_desde,$fecha_hasta,$adjunto1,$adjunto2);

		$msj="Item Cargado";
		header("Location: ".$info.$msj);

	} catch (Exception $e) {
		header("Location: ".$err.$e->getMessage());
	}
	
?>