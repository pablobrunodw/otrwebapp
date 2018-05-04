<?php
	class Archivo
	{
		function VaciarCarpeta($dir)
		{ 
			try {		

				if(!is_dir($dir))
					throw new Exception("Error al encontrar el directorio");
					

			    $current_dir = opendir($dir); 
			    while($entryname = readdir($current_dir)){ 
			        if(is_dir("$dir/$entryname") and ($entryname != "." and $entryname!="..")){ 
			            $this->VaciarCarpeta("${dir}/${entryname}");   
			        }elseif($entryname != "." and $entryname!=".."){ 
			            unlink("${dir}/${entryname}"); 
			        } 
			    } 
			    closedir($current_dir); 			    

			 } catch (Exception $e) {
				throw new Exception($e->getMessage());			
			}
		}  

		function CrearCarpeta($dir)
		{
			try {
				
				$flag=false;

				if(!is_dir($dir))
				{
					$flag= mkdir($dir, 0777, true); 	 
				
					if(!$flag)
						throw new Exception("No se pudo crear la carpeta");					
				}

			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}

		}

		function SubirArchivo($file,$path)
		{
			try {

				$pos = strripos($path,"/");
				$carpeta = substr($path, 0,$pos);

				if(!is_dir($carpeta)) 					
					$this->CrearCarpeta($carpeta);									
						
		 		/*
		 		if(is_writable($dir))
		 			chmod($dir,'0777');	 				 		
		 		*/		 
		 				
				if(!move_uploaded_file($file, $path))	
					throw new Exception("Error al subir el archivo");			
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());					
			}
		}

		function CrearArchivo($path,$contenido)
		{
			try {

				if(empty($path))
					throw new Exception("El path esta vacio");

				if(empty($contenido))
					throw new Exception("El contenido esta vacio");									

				$flag = file_put_contents($path,$contenido);

				//var_dump($flag);
				//exit();

				if(empty($flag))
					throw new Exception("Error al crear los archivos");			

				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());						
			}
		}

		function CambiarPermisos($path)
		{
			try {

				if(empty($path))
					throw new Exception("El path esta vacio");

				$flag = chmod($path, 0755);

				if(empty($flag))
					throw new Exception("No se pudo cambiar los permios");
					

			} catch (Exception $e) {
				throw new Exception($e->getMessage());								
			}
		}

		function EliminarArchivo($path)
		{
			try {
				
				if(is_file($path))
					unlink($path);

			} catch (Exception $e) {
				throw new Exception($e->getMessage());						
			}
		}


		function generarNombreAleatorio($longitud) {
			$key = '';
			$pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
			$max = strlen($pattern)-1;
			for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
		 	return $key;
		}
		
	}
?>