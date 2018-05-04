<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";
		
	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	
	include_once PATH_DATOS.'Entidades/ayuda.class.php';
	include_once PATH_DATOS.'Entidades/ayudagrupo.class.php';

	include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
	include_once PATH_NEGOCIO."Funciones/Archivo/archivo.class.php"; 
	
	class HandlerAyuda{		

		public function selecionarGrupos(){
			try {
				$handler = new AyudaGrupo;								
				$data = $handler->select();
				
				if(count($data)==1){
					$data = array('' => $data );                   
					return $data;
				}				
				else{
					return $data;
				}	

			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public function selecionarGruposById($id){
			try {
				$handler = new AyudaGrupo;								
				$handler->setId($id);
				$data = $handler->select();
				
				if(count($data)==1){
					$data = array('0' => $data );                   
					return $data;
				}				
				else{
					return $data;
				}	

			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public function guardarGrupoABM($id,$nombre,$estado){
			try {

				if($estado=="EDITAR"){
					$handler = new AyudaGrupo;

					$handler->setId($id);
					$handler->select();

					$handler->setNombre($nombre);

					$handler->update(false);
				}
				else
				{
					$handler = new AyudaGrupo;

					$handler->setNombre($nombre);					
					$handler->insert(false);
				}
						
			} catch (Exception $e) {
				throw new Exception($e->getMessage());					
			}
		}	



		public function selecionarDocumentos(){
			try {
				$handler = new Ayuda;								
				$data = $handler->select();
				
				if(count($data)==1){
					$data = array('' => $data );                   
					return $data;
				}				
				else{
					return $data;
				}	

			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public function selecionarDocumentosById($id){
			try {
				$handler = new Ayuda;								
				$handler->setId($id);
				$data = $handler->select();
				
				if(count($data)==1){
					$data = array('0' => $data );                   
					return $data;
				}				
				else{
					return $data;
				}	

			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public function selecionarDocumentosByPerfil($perfil){			
			try {
				$handler = new Ayuda;								
				$data = $handler->select();			

				if(count($data)==1){
					$data = array('' => $data );                   
				}				

				$result=null;
				if(!empty($data)){
					foreach ($data as $key => $reg) {
						
						$roles = explode("|", $reg->getRoles());

						if(!empty($roles)){
							foreach ($roles as $key => $r) {								

								if($r==$perfil){
									$result[] = $reg;
								}
							}
						}
					}
				}

				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public function guardarDocumentosABM($id,$nombre,$grupo,$link,$roles,$adjunto,$estado){
			try {

				if($estado=="EDITAR"){
					$handler = new Ayuda;

					$handler->setId($id);
					$handler=$handler->select();					

					$handler->setNombre($nombre);
					$handler->setGrupo($grupo);
					$handler->setVideo($link);
					$handler->setRoles($roles);

					if(!empty($adjunto["size"]))
						$handler->setArchivo($this->cargarArchivos($grupo,$nombre,$adjunto));		

					$handler->update(false);
				}
				else
				{
					$handler = new Ayuda;
					$handler->setNombre($nombre);
					$handler->setGrupo($grupo);
					$handler->setVideo($link);
					$handler->setRoles($roles);

					if(!empty($adjunto["size"]))
						$handler->setArchivo($this->cargarArchivos($grupo,$nombre,$adjunto));

					$handler->insert(false);
				}
						
			} catch (Exception $e) {
				throw new Exception($e->getMessage());					
			}
		}	

		public function cargarArchivos($pathFile,$tipo,$file){
			try {

				if(!empty($file["size"])){
					$a=new Archivo;

					$ext = substr($file["name"],strrpos($file["name"],".")+1);	
					$path = $pathFile."/".$tipo.".".$ext;

					/*################################*/
					/*	CARGAR ARCHIVOS AL SERVIDOR   */
					/*################################*/										
					if($file["size"]>0)
					{
						if ($file['size']>3000000)
							throw new Exception('El archivo no puede ser mayor a 3MB. <br> Debes reduzcirlo antes de volver a subirlo');

						$path_dir=PATH_ROOT.PATH_UPLOADAYUDA.$pathFile;
						$path_completo=PATH_ROOT.PATH_UPLOADAYUDA.$path;	
									
						$a->CrearCarpeta($path_dir);
						$a->SubirArchivo($file['tmp_name'],$path_completo);					
					}		

					if(is_file($path_completo)){
						return PATH_UPLOADAYUDA.$path;
					}
					else{
						throw new Exception("Error al subir el archivo");		
					}
				}
				else{
					return "";
				}

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function eliminarDocumentosABM($id){
			try {
					$handler = new Ayuda;

					$handler->setId($id);
					$handler=$handler->select();	

					$handler->delete(false);

			} catch (Exception $e) {
				throw new Exception($e->getMessage());		
			}
		}
	
	}

?>
