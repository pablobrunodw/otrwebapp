<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";
		
	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'Entidades/tickets.class.php';
	include_once PATH_DATOS.'Entidades/ticketsconceptos.class.php';
	include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
	include_once PATH_NEGOCIO."Funciones/Archivo/archivo.class.php"; 
	
	class HandlerTickets{		

		public function seleccionarTickets($usuario){
			try {
					
				$handler = new Tickets;
				return $handler->selectByUsuario($usuario);						
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public function seleccionarByFiltros($fdesde,$fhasta,$usuario){
			try {
					
				$handler = new Tickets;

				$data = $handler->seleccionarByFiltros($fdesde,$fhasta,$usuario,null);

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
		public function seleccionarByFiltrosAprobacion($fdesde,$fhasta,$usuario){
			try {
					
				$handler = new Tickets;

				$data = $handler->seleccionarByFiltros($fdesde,$fhasta,$usuario,true);

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
		public function enviarTickets($id,$reintegro,$aledanio,$operaciones){
			try {

				if(empty($id))
					throw new Exception("No se encontro el ticket");
					
				$t = new Tickets;
				$t->setId($id);
				$t = $t->select();

				if($t->getAprobado())
					throw new Exception("No se puede enviar el tickets con estados Aprobados");

				$handler = new Tickets;
				$handler->enviarTickets($id,$reintegro,$aledanio,$operaciones);				
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function rechazarTickets($id){
			try {

				if(empty($id))
					throw new Exception("No se encontro el ticket");
					
				$t = new Tickets;
				$t->setId($id);
				$t = $t->select();

				if($t->getAprobado())
					throw new Exception("No se puede rechazar el tickets con estados Aprobados");

				$handler = new Tickets;
				$handler->rechazarTickets($id);				
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}
		public function aprobarTickets($id,$reintegro,$aledanio,$operaciones){
			try {

				if(empty($id))
					throw new Exception("No se encontro el ticket");
					
				$t = new Tickets;
				$t->setId($id);
				$t = $t->select();				

				$handler = new Tickets;
				$handler->aprobarTickets($id,$reintegro,$aledanio,$operaciones);				
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}	
		public function desaprobarTickets($id){
			try {

				if(empty($id))
					throw new Exception("No se encontro el ticket");
					
				$t = new Tickets;
				$t->setId($id);
				$t = $t->select();				

				$handler = new Tickets;
				$handler->desaprobarTickets($id);				
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}			
		public function eliminarTickets($id){
			try {

				if(empty($id))
					throw new Exception("No se encontro el ticket");
					
				$t = new Tickets;
				$t->setId($id);
				$t = $t->select();

				if($t->getEnviado())
					throw new Exception("No se puede eliminar el tickets con estados Enviados");

				if($t->getAprobado())
					throw new Exception("No se puede eliminar el tickets con estados Aprobados");

				$t->delete(false);
					
			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function guardarTickets($usuario,$fecha_hora,$tipo,$punto_venta,$numero,$razon_social,$cuit,$iibb,$domicilio,$condicion_fiscal,$importe,$adjunto,$concepto){
			try {
				
				$fecha=substr($fecha_hora,0,10);
				$hora =substr($fecha_hora,11,5);
				$fecha_hora = $fecha." ".$hora;
				
				$t = new Tickets;
				$t->setUsuarioId($usuario);
				$t->setFechaHora($fecha_hora);
				$t->setTipo($tipo);
				$t->setPuntoVenta($punto_venta);
				$t->setNumero($numero);
				$t->setRazonSocial($razon_social);
				$t->setCuit($cuit);
				$t->setIibb($iibb);
				$t->setDomicilio($domicilio);
				$t->setCondFiscal($condicion_fiscal);
				$t->setImporte($importe);
				$t->setConcepto($concepto);

				$nombre=$cuit."_".$punto_venta."_".$numero;
				if(!empty($adjunto["size"]))
					$t->setAdjunto($this->cargarArchivos($usuario,$nombre,$adjunto));

				$t->insert(false);
				
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

						$path_dir=PATH_ROOT.PATH_UPLOADTICKETS.$pathFile;
						$path_completo=PATH_ROOT.PATH_UPLOADTICKETS.$path;	
									
						$a->CrearCarpeta($path_dir);
						$a->SubirArchivo($file['tmp_name'],$path_completo);					
					}		

					if(is_file($path_completo)){
						return PATH_UPLOADTICKETS.$path;
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

		public function selecionarConceptos(){
			try {
				$handler = new TicketsConceptos;								
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

		public function selecionarConceptosById($id){
			try {
				$handler = new TicketsConceptos;								
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

		public function guardarConceptosABM($id,$nombre,$estado){
			try {

				if($estado=="EDITAR"){
					$handler = new TicketsConceptos;

					$handler->setId($id);
					$handler->select();

					$handler->setNombre($nombre);

					$handler->update(false);
				}
				else
				{
					$handler = new TicketsConceptos;

					$handler->setNombre($nombre);					
					$handler->insert(false);
				}
						
			} catch (Exception $e) {
				throw new Exception($e->getMessage());					
			}
		}	

	}

?>
