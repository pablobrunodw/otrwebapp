<?php
	include_once "../../../../Config/config.ini.php";
	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";		
	include_once PATH_NEGOCIO."UploadFile/handleruploadfile.class.php";	
	include_once PATH_NEGOCIO."Funciones/Archivo/archivo.class.php";

	$param = (isset($_GET["param"])?$_GET["param"]:'');
	$carpetaUser=(isset($_GET["usuario"])?$_GET["usuario"]:'');

	$param = substr($param,0,-1);
	$arrParam = explode("/", $param);

	//configuro el path y nombre del archivo
	$archivo = new Archivo;		
	$archivoZip = $archivo->generarNombreAleatorio(10).".zip";
	$directorio = PATH_ROOT.PATH_CLIENTE.$carpetaUser."/";     
	$pathFinal = $directorio.$archivoZip;

	// creo archivo en directorio del usuario logueado
	$zip = new ZipArchive();
	$filename = $pathFinal;

	if($resultZip = $zip->open($filename, ZIPARCHIVE::CREATE))
	{
		foreach ($arrParam as $key => $value) {		

			//formateo de fechas
			$anio=substr($value,0,4);
			$mes=substr($value,4,2);
			$dia=substr($value,6,2);

			$dateString = $anio."-".$mes."-".$dia;
			$myDateTime = DateTime::createFromFormat('Y-m-d', $dateString);
			
			$fechaing = $myDateTime->format('Y-m-d');
			$nroing=substr($value,9,10);						

			// Selecciono los archivos a expotar				
			$handlerFU = new HandlerUploadFile;
			$arrAdjuntos = $handlerFU->selectByServicios($fechaing,$nroing);

			if(is_object($arrAdjuntos))
				$arrAdjuntos = array($arrAdjuntos);

			foreach ($arrAdjuntos as $key1 => $value1) {					
				$dir = PATH_ROOT.PATH_UPLOADFILE.$value1->getRuta();			
				$nombre = substr($dir, strrpos($dir, "/")+1);
				$zip->addFile($dir,$value1->getRuta());	
			}
		}	
		
	}

	$zip->close();
	unset($zip);

	// descargo archivo zip creado
	$enlace = $pathFinal;
	$nameDownload = "lote_servicio_".$archivoZip.".zip";
	header ("Content-type: application/zip");
	header ("Content-Disposition: attachment; filename=$nameDownload");
	header ("Content-Length: ".filesize($enlace));
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Expires: 0");

	readfile($enlace);

	//borro archivo del servidor para no generar espacios innecesarios
	unlink($pathFinal);

?>