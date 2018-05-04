<?php
	include_once "../../../../Config/config.ini.php";
	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";		
	include_once PATH_NEGOCIO."UploadFile/handleruploadfile.class.php";	
	include_once PATH_NEGOCIO."Funciones/Archivo/archivo.class.php";

	$fechaing=(isset($_GET["fechaing"])?$_GET["fechaing"]:'');
	$nroing=(isset($_GET["nroing"])?$_GET["nroing"]:'');
	$carpetaUser=(isset($_GET["usuario"])?$_GET["usuario"]:'');
	
	// Selecciono los archivos a expotar				
	$handlerFU = new HandlerUploadFile;
	$arrAdjuntos = $handlerFU->selectByServicios($fechaing,$nroing);

	if(is_object($arrAdjuntos))
		$arrAdjuntos = array($arrAdjuntos);	

	//configuro el path y nombre del archivo
	$archivo = new Archivo;		
	$archivoZip = $archivo->generarNombreAleatorio(10).".zip";
	$directorio = PATH_ROOT.PATH_CLIENTE.$carpetaUser."/";     
	$pathFinal = $directorio.$archivoZip;

	// creo archivo en directorio del usuario logueado
	$zip = new ZipArchive();
	$filename = $pathFinal;

	if ($zip->open($filename, ZIPARCHIVE::CREATE)) 
	{
		foreach ($arrAdjuntos as $key => $value) {					
			$dir = PATH_ROOT.PATH_UPLOADFILE.$value->getRuta();			
			$nombre = substr($dir, strrpos($dir, "/")+1);
			$zip->addFile($dir,$value->getRuta());	
		}

	} 

	$zip->close();
	unset($zip);

	// descargo archivo zip creado
	$enlace = $pathFinal;
	$nameDownload = "servicio_".$fechaing."_".$nroing.".zip";
	header ("Content-type: application/zip");
	header ("Content-Disposition: attachment; filename=$nameDownload");
	header ("Content-Length: ".filesize($enlace));
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Expires: 0");

	readfile($enlace);

	//borro archivo del servidor para no generar espacios innecesarios
	unlink($pathFinal);

?>