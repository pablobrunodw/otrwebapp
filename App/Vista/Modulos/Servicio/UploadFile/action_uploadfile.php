<?php
	include_once "../../../../Config/config.ini.php";
	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_NEGOCIO."Sistema/handlersistema.class.php";		
	include_once PATH_NEGOCIO."UploadFile/handleruploadfile.class.php";	
	include_once PATH_NEGOCIO."Funciones/Archivo/archivo.class.php";

	$nroing = (isset($_POST['field_NUMERO'])? $_POST['field_NUMERO']:''); 
	$fechaing = (isset($_POST['field_FECHA'])? $_POST['field_FECHA']:'');
	$dni = (isset($_POST['field_DNI'])? $_POST['field_DNI']:'');
	$fecha_servicio = (isset($_POST['field_FECHA_SERVICIO'])? $_POST['field_FECHA_SERVICIO']:'');	
	//$empresa = (isset($_POST['field_EMPRESA'])? $_POST['field_EMPRESA']:'');	
	
	$handler = new HandlerSistema;
	$servicio = $handler->selectUnServicio($fechaing,$nroing);	

	$handlerUF = new HandlerUploadFile;
  	$allCategoria = $handlerUF->selectCategoriasByEmpresa($servicio[0]->SERTT91_CODEMPRE);
		
	$err = "../../../../../../index.php?view=upload_file&fechaing=".$fechaing."&nroing=".$nroing."&err=";     		
	$info = "../../../../../../index.php?view=upload_file&fechaing=".$fechaing."&nroing=".$nroing."&info=";     		

	try
	{			
		
	  	if(!empty($allCategoria)){
			foreach ($allCategoria as $key => $value) {			
				$archivos = (isset($_FILES[$value->getCategoria()])? $_FILES[$value->getCategoria()]:'');
				$pathFile = $dni."/".$fecha_servicio;				

				$eliminar = (isset($_POST["eliminar_".$value->getCategoria()])? $_POST["eliminar_".$value->getCategoria()]:'');
				$id_archivo = (isset($_POST["idArchivo_".$value->getCategoria()])? $_POST["idArchivo_".$value->getCategoria()]:'');
				$ruta = (isset($_POST["ruta_".$value->getCategoria()])? $_POST["ruta_".$value->getCategoria()]:'');

				if($eliminar=='on'){														
					$result = $handlerUF->quitarFileServer(null,$id_archivo,$ruta);
				}
				else{				
					if(!empty($archivos["type"]))
						$result = $handlerUF->uploadFileServer(null,$fechaing,$nroing,$value->getCategoria(),$pathFile,$archivos);
				}
			}
		}		

		$msj="Fin de transacción";
		header("Location: ".$info.$msj);
	}
	catch(Exception $e)
	{
		header("Location: ".$err.$e->getMessage());
	}
	
?>