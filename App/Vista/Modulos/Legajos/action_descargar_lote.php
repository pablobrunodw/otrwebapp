<?php
	include_once "../../../Config/config.ini.php";
	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";		
	include_once PATH_NEGOCIO."Modulos/handlerlegajos.class.php";	
	include_once PATH_NEGOCIO."Funciones/Archivo/archivo.class.php";

	$usuario=(isset($_GET["usuario"])?$_GET["usuario"]:'');
	$carpetaUser = (isset($_GET["carpeta"])?$_GET["carpeta"]:'');;

	$handler = new HandlerLegajos;
	$legajo = $handler->seleccionarLegajos($usuario);

	
	//configuro el path y nombre del archivo
	$archivo = new Archivo;		
	$archivoZip = $archivo->generarNombreAleatorio(10).".zip";
	//$archivoZip = trim($legajo->getNombre()).".zip";
	$directorio = PATH_ROOT.PATH_CLIENTE.$carpetaUser."/";     
	$pathFinal = $directorio.$archivoZip;

	// creo archivo en directorio del usuario logueado
	$zip = new ZipArchive();
	$filename = $pathFinal;
		
	if ($resultZip = $zip->open($filename, ZIPARCHIVE::CREATE)) 
	{					
		$dir = PATH_ROOT;	
		if(!empty($legajo->getDniAdjunto())){
			$ext= substr($legajo->getDniAdjunto(),strrpos($legajo->getDniAdjunto(),'/')+1);
			$zip->addFile(trim($dir.$legajo->getDniAdjunto()),trim($ext));	
		}
		
		if(!empty($legajo->getCuitAdjunto())){
			$ext= substr($legajo->getCuitAdjunto(),strrpos($legajo->getCuitAdjunto(),'/')+1);
			$zip->addFile($dir.$legajo->getCuitAdjunto(),trim($ext));	
		}

		if(!empty($legajo->getCvAdjunto())){
			$ext= substr($legajo->getCvAdjunto(),strrpos($legajo->getCvAdjunto(),'/')+1);
			$zip->addFile($dir.$legajo->getCvAdjunto(),trim($ext));	
		}

		if(!empty($legajo->getCbuAdjunto())){
			$ext= substr($legajo->getCbuAdjunto(),strrpos($legajo->getCbuAdjunto(),'/')+1);
			$zip->addFile($dir.$legajo->getCbuAdjunto(),trim($ext));	
		}

		if(!empty($legajo->getLicenciaAdjunto())){
			$ext= substr($legajo->getLicenciaAdjunto(),strrpos($legajo->getLicenciaAdjunto(),'/')+1);
			$zip->addFile($dir.$legajo->getLicenciaAdjunto(),trim($ext));	
		}

		if(!empty($legajo->getLicenciaAdjuntoDorso())){
			$ext= substr($legajo->getLicenciaAdjuntoDorso(),strrpos($legajo->getLicenciaAdjuntoDorso(),'/')+1);
			$zip->addFile($dir.$legajo->getLicenciaAdjuntoDorso(),trim($ext));
		}

		if(!empty($legajo->getTituloAdjunto())){
			$ext= substr($legajo->getTituloAdjunto(),strrpos($legajo->getTituloAdjunto(),'/')+1);
			$zip->addFile($dir.$legajo->getTituloAdjunto(),trim($ext));	
		}

		if(!empty($legajo->getTituloAdjuntoDorso())){
			$ext= substr($legajo->getTituloAdjuntoDorso(),strrpos($legajo->getTituloAdjuntoDorso(),'/')+1);
			$zip->addFile($dir.$legajo->getTituloAdjuntoDorso(),trim($ext));	
		}

		if(!empty($legajo->getMantenimientoAdjunto())){
			$ext= substr($legajo->getMantenimientoAdjunto(),strrpos($legajo->getMantenimientoAdjunto(),'/')+1);
			$zip->addFile($dir.$legajo->getMantenimientoAdjunto(),trim($ext));	
		}

		if(!empty($legajo->getSeguroAdjunto())){
			$ext= substr($legajo->getSeguroAdjunto(),strrpos($legajo->getSeguroAdjunto(),'/')+1);
			$zip->addFile($dir.$legajo->getSeguroAdjunto(),trim($ext));																					
		}

		if(!empty($legajo->getKmrealAdjunto())){
			$ext= substr($legajo->getKmrealAdjunto(),strrpos($legajo->getKmrealAdjunto(),'/')+1);
			$zip->addFile($dir.$legajo->getKmrealAdjunto(),trim($ext));																					
		}

		if(!empty($legajo->getGncAdjunto())){
			$ext= substr($legajo->getGncAdjunto(),strrpos($legajo->getGncAdjunto(),'/')+1);
			$zip->addFile($dir.$legajo->getGncAdjunto(),trim($ext));																					
		}

		if(!empty($legajo->getHidraulicaAdjunto())){
			$ext= substr($legajo->getHidraulicaAdjunto(),strrpos($legajo->getHidraulicaAdjunto(),'/')+1);
			$zip->addFile($dir.$legajo->getHidraulicaAdjunto(),trim($ext));																													
		}
		
	}

	$zip->close();	
	unset($zip);

	// descargo archivo zip creado
	$enlace = $pathFinal;
	$nameDownload = "lote_legajo_".trim($legajo->getNombre()).".zip";
	header ("Content-type: application/zip");
	header ("Content-Disposition: attachment; filename=$nameDownload");
	//header ("Content-Length: ".filesize($enlace));
	//header ("Cache-Control: no-cache, must-revalidate");
	//header ("Expires: 0");

	readfile($enlace);
	
	//borro archivo del servidor para no generar espacios innecesarios
	unlink($pathFinal);
?>