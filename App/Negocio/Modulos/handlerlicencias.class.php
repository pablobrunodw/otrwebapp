<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";
		
	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	
	include_once PATH_DATOS.'Entidades/licencias.class.php';
	include_once PATH_DATOS.'Entidades/tipolicencias.class.php';
	include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
	include_once PATH_NEGOCIO."Funciones/Archivo/archivo.class.php"; 
	
	class HandlerLicencias{		

		public function selecionarTipos(){
			try {
				$handler = new TipoLicencias;								
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

		public function selecionarTiposById($id){
			try {
				$handler = new TipoLicencias;								
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

		public function guardarTipoABM($id,$nombre,$dias,$estado){
			try {

				if($estado=="EDITAR"){
					$handler = new TipoLicencias;

					$handler->setId($id);
					$handler->select();

					$handler->setNombre($nombre);
					$handler->setDias($dias);

					$handler->update(false);
				}
				else
				{
					$handler = new TipoLicencias;

					$handler->setNombre($nombre);
					$handler->setDias($dias);
					$handler->insert(false);
				}
						
			} catch (Exception $e) {
				throw new Exception($e->getMessage());					
			}
		}	

		public function seleccionarByFiltros($fdesde,$fhasta,$usuario){
			try {
					
				$handler = new Licencias;

				$data = $handler->seleccionarByFiltros($fdesde,$fhasta,$usuario);

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

		public function seleccionarLicencias($usuario){
			try {
					
				$handler = new licencias;
				$handler->setUsuarioId($usuario);
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

		public function seleccionarLicenciasById($id){
			try {
					
				$handler = new licencias;
				$handler->setId($id);
				$data = $handler->select();
							
				return $data;				
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}		

		public function aprobarLicencias($id){
			try {

				if(empty($id))
					throw new Exception("No se encontro la licencia");
					
				$t = new Licencias;
				$t->setId($id);
				$t = $t->select();				

				$handler = new Licencias;
				$handler->aprobarLicencias($id);				
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}	
		public function desaprobarLicencias($id){
			try {

				if(empty($id))
					throw new Exception("No se encontro la licencia");
					
				$t = new Licencias;
				$t->setId($id);
				$t = $t->select();				

				$handler = new Licencias;
				$handler->desaprobarLicencias($id);				
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}			

		public function eliminarLicencias($id){
			try {

				if(empty($id))
					throw new Exception("No se encontro la licencia");
					
				$t = new Licencias;
				$t->setId($id);
				$t = $t->select();

				if($t->getAprobado())
					throw new Exception("No se puede eliminar la licencia con estado Aprobad");

				$t->delete(false);
					
			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function guardarLicencias($fecha,$usuario,$tipoLicencia,$observaciones,$fechaInicio,$fechaFin,$adjunto1,$adjunto2){
			try {

				$f = new Fechas;
				$dif_dias = $f->DiasDiferenciaFechas($fechaInicio,$fechaFin,"Y-m-d");
				
				$dias_licencia = $this->selecionarTiposById($tipoLicencia)[0]->getDias();
				//$fechaFin = date ( 'Y-m-d', strtotime('+'.$dias.' day', strtotime($fechaInicio))) ;

				if($dif_dias>$dias_licencia)
					throw new Exception("Se excede la cantidad de ".$dias_licencia." dias permitido por el tipo de licencia");									

				$handler = new Licencias;						
				$handler->setTipoLicenciasId($tipoLicencia);
				$handler->setUsuarioId($usuario);
				$handler->setFecha($fecha);
				$handler->setFechaInicio($fechaInicio);
				$handler->setFechaFin($fechaFin);
				$handler->setObservaciones($observaciones);				
				
				if(!empty($adjunto1["size"]))
					$handler->setAdjunto1($this->cargarArchivos($usuario,"ADJUNTO_1",$adjunto1));

				if(!empty($adjunto2["size"]))
					$handler->setAdjunto2($this->cargarArchivos($usuario,"ADJUNTO_2",$adjunto2));				

				//var_dump($handler);
				//exit();

				$handler->insert(false);

				//####################
				//## NOTIFICACIONES ##
				/*$u = new Usuario;
				$u->setId($usuario);
				$u = $u->select();				

				$alias = $u->getAliasUserSistema();

				$hanlder_sistema = new HandlerSistema;
				$arrDatos = $hanlder_sistema->getPlazaByCordinador($alias);
				$plaza = $arrDatos[0]->PLAZA;

				$origen = "LICENCIAS [generacion]";
				$detalle = "<b>".$u->getNombre()."</b> envió una nueva solicitud de licencias";

				$n_handler = new HandlerNotificaciones;				
				$n_handler->guardarNotificacion($usuario,$origen,$detalle,0,$plaza);*/
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());					
			}
		}		

		public function guardarAdjunto1($id,$adjunto1){
			try {
				
				$handler = new Licencias;						
				$handler->setId($id);		
				$handler = $handler->select();		
	
				$usuario = $handler->getUsuarioId()->getId();

				$handler->setUsuarioId($usuario);
				$handler->setTipoLicenciasId($handler->getTipoLicenciasId()->getId());
				$handler->setFecha($handler->getFecha()->format('Y-m-d'));
				$handler->setFechaInicio($handler->getFechaInicio()->format('Y-m-d'));
				$handler->setFechaFin($handler->getFechaFin()->format('Y-m-d'));

				if(!empty($adjunto1["size"]))
					$handler->setAdjunto1($this->cargarArchivos($usuario,"ADJUNTO_1",$adjunto1));

				$handler->update(false);

				//####################
				//## NOTIFICACIONES ##
				/*$u = new Usuario;
				$u->setId($usuario);
				$u = $u->select();				

				$alias = $u->getAliasUserSistema();

				$hanlder_sistema = new HandlerSistema;
				$arrDatos = $hanlder_sistema->getPlazaByCordinador($alias);
				$plaza = $arrDatos[0]->PLAZA;

				$origen = "LICENCIAS [generacion]";
				$detalle = "<b>".$u->getNombre()."</b> envió una nueva solicitud de licencias";

				$n_handler = new HandlerNotificaciones;				
				$n_handler->guardarNotificacion($usuario,$origen,$detalle,0,$plaza);*/
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());					
			}
		}	
		public function guardarAdjunto2($id,$adjunto2){
			try {
				
				$handler = new Licencias;						
				$handler->setId($id);		
				$handler = $handler->select();		
	
				$usuario = $handler->getUsuarioId()->getId();

				$handler->setUsuarioId($usuario);
				$handler->setTipoLicenciasId($handler->getTipoLicenciasId()->getId());
				$handler->setFecha($handler->getFecha()->format('Y-m-d'));
				$handler->setFechaInicio($handler->getFechaInicio()->format('Y-m-d'));
				$handler->setFechaFin($handler->getFechaFin()->format('Y-m-d'));

				if(!empty($adjunto2["size"]))
					$handler->setAdjunto2($this->cargarArchivos($usuario,"ADJUNTO_2",$adjunto2));

				$handler->update(false);

				//####################
				//## NOTIFICACIONES ##
				/*$u = new Usuario;
				$u->setId($usuario);
				$u = $u->select();				

				$alias = $u->getAliasUserSistema();

				$hanlder_sistema = new HandlerSistema;
				$arrDatos = $hanlder_sistema->getPlazaByCordinador($alias);
				$plaza = $arrDatos[0]->PLAZA;

				$origen = "LICENCIAS [generacion]";
				$detalle = "<b>".$u->getNombre()."</b> envió una nueva solicitud de licencias";

				$n_handler = new HandlerNotificaciones;				
				$n_handler->guardarNotificacion($usuario,$origen,$detalle,0,$plaza);*/
				
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

						$path_dir=PATH_ROOT.PATH_UPLOADLICENCIAS.$pathFile;
						$path_completo=PATH_ROOT.PATH_UPLOADLICENCIAS.$path;	
									
						$a->CrearCarpeta($path_dir);
						$a->SubirArchivo($file['tmp_name'],$path_completo);					
					}		

					if(is_file($path_completo)){
						return PATH_UPLOADLICENCIAS.$path;
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
	}

?>
