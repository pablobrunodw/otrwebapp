<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";
		
	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'Entidades/empresaarchivostemplate.class.php';	
	include_once PATH_DATOS.'Entidades/empresaarchivos.class.php';
	include_once PATH_NEGOCIO.'Sistema/handlersistema.class.php';
	include_once PATH_NEGOCIO.'Funciones/Archivo/archivo.class.php';

	class HandlerUploadFile{		

		function existeCategoriaTemplate($empresa_id,$categoria){
			try {
				
				$handler = new EmpresaArchivosTemplate;
				$handler->setIdEmpresaSistema($empresa_id);
				$handler->setCategoria($categoria);

				$u=$handler->existeCategoria();

				if(!is_object($u))
					return false;
				else
					return true;


			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		function guardarCategoriasTemplate($datos){
			try {

				$handler = new EmpresaArchivosTemplate;				
				$handler->limpiarTabla(null);

				foreach ($datos as $key => $value) {				

					$cat = explode(",", $value["categorias"]);

					foreach ($cat as $key1 => $value1) {

						if(!empty($value1)){
							$handler1 = new EmpresaArchivosTemplate;				

							$handler1->setIdEmpresaSistema($value["empresa"]);
							$handler1->setCategoria($value1);

							if($this->existeCategoriaTemplate($handler1->getIdEmpresaSistema(),$handler1->getCategoria())){								
								$handler1->update(null);
							}
							else{
								$handler1->insert(null);
							}							
						}							
					}				
				}
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}
		}
		
		function stringCategoriasTemplate($empresa_id){
			try {

				$handler = new EmpresaArchivosTemplate;				
				$handler->setIdEmpresaSistema($empresa_id);
				$arrCat = $handler->select();												
				
				$categoria="";

				if(count($arrCat)==1)				
					$arrCat = array($arrCat);

				if(!empty($arrCat)){				
					foreach ($arrCat as $key => $value) {						
						$categoria = $categoria.$value->getCategoria().",";
					}					
				}
		
				return $categoria;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		function selectCategoriasByEmpresa($empresa_id){
			try {

				$handler = new EmpresaArchivosTemplate;				
				$handler->setIdEmpresaSistema($empresa_id);
				
				$arrDatos = $handler->select();
				
				if(is_object($arrDatos))
					$arrDatos = array($arrDatos);

				return $arrDatos;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}	
		}

		function selectCategoriaByServicio($fecha, $servicio, $categoria)
		{
			try {

				$handler = new EmpresaArchivos;								
				
				return $handler->selectCategoriaByServicio($fecha, $servicio, $categoria);

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}		
		}

		function selectByServicios($fecha,$servicio){
			try {
				
				$handler = new EmpresaArchivos;								
				return $handler->selectByServicio($fecha,$servicio);

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		function uploadFileServer($conexion,$fecha, $nro_sistema, $categoria, $pathFile, $file){
			try {

				$ext = substr($file["name"],strrpos($file["name"],".")+1);	
				//$path = $pathFile."/".$categoria.".".$ext;
				//$path = $pathFile."/".$file["name"].".".$ext;
				$path = $pathFile."/".$file["name"];

				/*################################*/
				/*	CARGAR ARCHIVOS AL SERVIDOR   */
				/*################################*/										
				if($file["size"]>0)
				{
					if ($file['size']>3000000)
						throw new Exception('El archivo no puede ser mayor a 3MB. <br> Debes reduzcirlo antes de volver a subirlo');

					$path_dir=PATH_ROOT.PATH_UPLOADFILE.$pathFile;
					$path_completo=PATH_ROOT.PATH_UPLOADFILE.$path;	
					
					$a=new Archivo;
					$a->CrearCarpeta($path_dir);
					$a->SubirArchivo($file['tmp_name'],$path_completo);					
				}				

				if(is_file($path_completo))
				{
					/*#####################################*/
					/*	GUARDO REGISTRO EN BASE DE DATOS   */
					/*#####################################*/				
					$handler = new EmpresaArchivos;

					$handler->setFechaSistema($fecha);
					$handler->setNroSistema($nro_sistema);
					$handler->setCategoria($categoria);
					$handler->setRuta($path);
					$handler->setExtencion($ext);

					$handler->insert($conexion);			
					
				}
					
			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		function quitarFileServer($conexion, $id_archivo, $ruta){
			try {
				
				$path_completo=PATH_ROOT.PATH_UPLOADFILE.$ruta;					

				if(is_file($path_completo))
				{						
					//borra de la base de datos
					$handler = new EmpresaArchivos;
					$handler->setId($id_archivo);
					$handler->delete($conexion);			

					//borra el archivo del servidor	
					$a=new Archivo;
					$a->EliminarArchivo($path_completo);										
				}
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		function adjuntosCompletos($fecha,$servicio,$empresa)
		{
			try {	
				
				$ea = new EmpresaArchivos;
				$eat = new EmpresaArchivosTemplate;

				$arrEA = $ea->selectByServicio($fecha,$servicio);	

				if(is_object($arrEA))
					$arrEA = array($arrEA);

				$eat->setIdEmpresaSistema($empresa);
				$arrEAT = $eat->select();

				if(is_object($arrEAT))
					$arrEAT = array($arrEAT);

				$totalEA = (!empty($arrEA)?count($arrEA):0);
				$totalEAT = (!empty($arrEAT)?count($arrEAT):0);

				//no hay registros configurados 
				if($totalEAT==0)
					return -1;

				if($totalEA == 0)
					return 0;  //todavia no se cargaron registros
				
				if($totalEA > 0)
					return 1; //se cargaron archivos


			} catch (Exception $e) {
				throw new Exception($e->getMessage());		
			}
		}

		function selectServiciosPublicados($fdesde, $fhasta, $estado, $empresa, $gestor, $gerente, $coordinador, $operador, $equipovta)
		{
			try {				
				$handler = new HandlerSistema;
				$arrServicios = $handler->selectServicios($fdesde, $fhasta, $estado, $empresa, $gestor, $gerente, $coordinador, $operador, $equipovta);


				$arrDatos = null;

				if(!empty($arrServicios)){					
					foreach ($arrServicios as $key => $value) {
						if($this->estaPublicado($value->SERTT11_FECSER->format('Y-m-d'), $value->SERTT12_NUMEING))
							$arrDatos[] = $value;						
					}
				}

				return $arrDatos;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());		
			}			
		}

		function publicar($fecha, $servicio)
		{
			try {

				$ea = new EmpresaArchivos;
				$ea->publicar($fecha, $servicio);

			} catch (Exception $e) {
				throw new Exception($e->getMessage());		
			}
		}

		function despublicar ($fecha, $servicio)
		{
			try {
				
				$ea = new EmpresaArchivos;
				$ea->despublicar($fecha, $servicio);				

			} catch (Exception $e) {
				throw new Exception($e->getMessage());		
			}
		}

		function estaPublicado ($fecha, $servicio)
		{
			try {
				$ea = new EmpresaArchivos;
				$arrServicios = $ea->selectByServicio($fecha, $servicio);

				$estado = false;
				if(!empty($arrServicios))
				{
					if(is_object($arrServicios))		
						$arrServicios = array($arrServicios);

					foreach ($arrServicios as $key => $value) {											
						
						if($value->getPublicadoBoolean())
							$estado = true;
					}										
				}	
				
				return $estado;
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());			
			}
		}
	}

?>