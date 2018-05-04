<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";
		
	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';	
	include_once PATH_DATOS.'Entidades/legajos.class.php';
	/*include_once PATH_NEGOCIO.'Sistema/handlerconsultascontrol.class.php';
	include_once PATH_NEGOCIO.'Notificaciones/handlernotificaciones.class.php';
	include_once PATH_NEGOCIO.'Sistema/handlersistema.class.php';*/
	include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
	include_once PATH_NEGOCIO."Funciones/Archivo/archivo.class.php"; 
	
	class HandlerLegajos{		
		public function seleccionarTodosLegajos(){
			try {
				$handler = new Legajos;
				return $handler->select();

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function seleccionarLegajos($usuario){
			try {
					
				$handler = new Legajos;
				return $handler->selectByUsuario($usuario);						
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public function seleccionarByFiltros($usuario){
			try {
					
				$handler = new Legajos;

				$data = $handler->seleccionarByFiltros($usuario);

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

		public function crearLegajo($usuario){
			try {
				$legajo = new Legajos;
				$legajo->setUsuarioId($usuario);
				$legajo->insert(false);

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function enviarLegajo($id){
			try {
				$handler = new Legajos;
				$handler->enviarLegajo($id);				
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function rechazarLegajo($id){
			try {
				$handler = new Legajos;
				$handler->rechazarLegajo($id);				
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function guardarLegajosEtapa1($id, $usuario, $nombre, $cuit, $nacimiento, $direccion, $celular, $telefono, $estado_civil, $hijos){
			try {

				$handler = new Legajos;		
				$handler->setId($id);				
				$handler = $handler->select();

				$handler->setUsuarioId($usuario);
				$handler->setNacimiento($handler->getNacimiento()->format('m-d-Y'));
				$handler->setLicenciaVto($handler->getLicenciaVto()->format('m-d-Y'));
				$handler->setVtvVto($handler->getVtvVto()->format('m-d-Y'));

				$handler->setNombre($nombre);
				$handler->setCuit($cuit);
				$handler->setNacimiento($nacimiento);
				$handler->setDireccion($direccion);
				$handler->setCelular($celular);
				$handler->setTelefono($telefono);
				$handler->setEstadoCivil($estado_civil);
				$handler->setHijos($hijos);
								
				$handler->update(false);
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());					
			}
		}		

		public function guardarLegajosEtapa2($id, $usuario, $dni_adjunto, $cuit_adjunto, $cv_adjunto, $cbu_adjunto){
			try {

				$handler = new Legajos;		
				$handler->setId($id);				
				$handler = $handler->select();

				$handler->setUsuarioId($usuario);
				$handler->setNacimiento($handler->getNacimiento()->format('m-d-Y'));
				$handler->setLicenciaVto($handler->getLicenciaVto()->format('m-d-Y'));
				$handler->setVtvVto($handler->getVtvVto()->format('m-d-Y'));

				if(!empty($dni_adjunto["size"]))
					$handler->setDniAdjunto($this->cargarArchivos($usuario,"DNI",$dni_adjunto));

				if(!empty($cuit_adjunto["size"]))
					$handler->setCuitAdjunto($this->cargarArchivos($usuario,"CUIT",$cuit_adjunto));

				if(!empty($cv_adjunto["size"]))
					$handler->setCvAdjunto($this->cargarArchivos($usuario,"CV",$cv_adjunto));

				if(!empty($cbu_adjunto["size"]))
					$handler->setCbuAdjunto($this->cargarArchivos($usuario,"CBU",$cbu_adjunto));
								
				$handler->update(false);
	
			} catch (Exception $e) {
				throw new Exception($e->getMessage());					
			}
		}	

		public function guardarLegajosEtapa3($id, $usuario, $licencia_adjunto, $licencia_adjunto_dorso, $titulo_adjunto, $titulo_adjunto_dorso, $mantenimiento_adjunto, $seguro_adjunto, $kmreal_adjunto, $gnc_adjunto, $hidraulica_adjunto){
			try {

				$handler = new Legajos;		
				$handler->setId($id);				
				$handler = $handler->select();

				$handler->setUsuarioId($usuario);
				$handler->setNacimiento($handler->getNacimiento()->format('m-d-Y'));
				$handler->setLicenciaVto($handler->getLicenciaVto()->format('m-d-Y'));
				$handler->setVtvVto($handler->getVtvVto()->format('m-d-Y'));

				if(!empty($licencia_adjunto["size"]))
					$handler->setLicenciaAdjunto($this->cargarArchivos($usuario,"LICENCIA",$licencia_adjunto));

				if(!empty($licencia_adjunto_dorso["size"]))
					$handler->setLicenciaAdjuntoDorso($this->cargarArchivos($usuario,"LICENCIA_DORSO",$licencia_adjunto_dorso));

				if(!empty($titulo_adjunto["size"]))
					$handler->setTituloAdjunto($this->cargarArchivos($usuario,"TITULO",$titulo_adjunto));

				if(!empty($titulo_adjunto_dorso["size"]))
					$handler->setTituloAdjuntoDorso($this->cargarArchivos($usuario,"TITULO_DORSO",$titulo_adjunto_dorso));

				if(!empty($mantenimiento_adjunto["size"]))
					$handler->setMantenimientoAdjunto($this->cargarArchivos($usuario,"MANTENIMIENTO",$mantenimiento_adjunto));

				if(!empty($seguro_adjunto["size"]))
					$handler->setSeguroAdjunto($this->cargarArchivos($usuario,"SEGURO",$seguro_adjunto));

				if(!empty($kmreal_adjunto["size"]))
					$handler->setkmrealAdjunto($this->cargarArchivos($usuario,"KMREAL",$kmreal_adjunto));

				if(!empty($gnc_adjunto["size"]))
					$handler->setGncAdjunto($this->cargarArchivos($usuario,"GNC",$gnc_adjunto));

				if(!empty($hidraulica_adjunto["size"]))
					$handler->setHidraulicaAdjunto($this->cargarArchivos($usuario,"HIDRAULICA",$hidraulica_adjunto));								

				$handler->update(false);				
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());					
			}
		}	

		public function guardarLegajosEtapa4($id, $usuario, $patente_adjunto, $vtv_adjunto){
			try {

				$handler = new Legajos;		
				$handler->setId($id);				
				$handler = $handler->select();

				$handler->setUsuarioId($usuario);				
				$handler->setNacimiento($handler->getNacimiento()->format('m-d-Y'));
				$handler->setLicenciaVto($handler->getLicenciaVto()->format('m-d-Y'));
				$handler->setVtvVto($handler->getVtvVto()->format('m-d-Y'));

				if(!empty($patente_adjunto["size"]))
					$handler->setPatenteAdjunto($this->cargarArchivos($usuario,"PATENTE",$patente_adjunto));

				if(!empty($vtv_adjunto["size"]))
					$handler->setVtvAdjunto($this->cargarArchivos($usuario,"VTV",$vtv_adjunto));

				$handler->update(false);				
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());					
			}
		}	

		public function guardarLegajosEtapa5($id, $usuario, $licencia_vto, $vtv_vto){
			try {

				$handler = new Legajos;		
				$handler->setId($id);				
				$handler = $handler->select();

				$handler->setUsuarioId($usuario);				
				$handler->setNacimiento($handler->getNacimiento()->format('m-d-Y'));
				$handler->setLicenciaVto($handler->getLicenciaVto()->format('m-d-Y'));
				$handler->setVtvVto($handler->getVtvVto()->format('m-d-Y'));

				$handler->setLicenciaVto($licencia_vto);
				$handler->setVtvVto($vtv_vto);

				$handler->update(false);				
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());					
			}
		}

		public function guardarLegajosEtapa6($id, $usuario, $horas, $oficina, $categoria, $nro_legajo){
			try {

				$handler = new Legajos;		
				$handler->setId($id);				
				$handler = $handler->select();

				$handler->setUsuarioId($usuario);				
				$handler->setNacimiento($handler->getNacimiento()->format('m-d-Y'));
				$handler->setLicenciaVto($handler->getLicenciaVto()->format('m-d-Y'));
				$handler->setVtvVto($handler->getVtvVto()->format('m-d-Y'));

				$handler->setHoras($horas);
				$handler->setOficina($oficina);
				$handler->setCategoria($categoria);
				$handler->setNumeroLegajo($nro_legajo);

				$handler->update(false);				
				
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

						$path_dir=PATH_ROOT.PATH_UPLOADLEGAJOS.$pathFile;
						$path_completo=PATH_ROOT.PATH_UPLOADLEGAJOS.$path;	
						
						
						$a->CrearCarpeta($path_dir);
						$a->SubirArchivo($file['tmp_name'],$path_completo);					
					}		

					if(is_file($path_completo)){
						return PATH_UPLOADLEGAJOS.$path;
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
