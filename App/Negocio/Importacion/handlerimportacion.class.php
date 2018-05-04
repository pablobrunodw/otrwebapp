<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";
		
	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'Entidades/tipoimportacion.class.php';	
	include_once PATH_DATOS.'Entidades/empresatipoimportacion.class.php';	
	include_once PATH_DATOS.'Entidades/importacion.class.php';
	include_once PATH_DATOS.'Entidades/importaciontipo1.class.php';
	include_once PATH_DATOS.'Entidades/importaciontipo2.class.php';

	include_once PATH_NEGOCIO.'Funciones/Excel/PHPExcel/IOFactory.php';
	include_once PATH_NEGOCIO.'Funciones/Archivo/archivo.class.php';
	include_once PATH_NEGOCIO.'Funciones/Fechas/fechas.class.php';
	include_once PATH_NEGOCIO.'Funciones/Mapas/mapas.class.php';

	include_once PATH_NEGOCIO.'Importacion/handlerplazacp.class.php';

	include_once PATH_NEGOCIO.'Sistema/handlersistema.class.php';

	class HandlerImportacion{		

		public function TipoImportacionTodos(){
			try {
				
				$handler = new TipoImportacion;								

				return $handler->select();


			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public function TipoImportacionById($id){
			try {
				
				if(empty($id))
					throw new Exception("No se encontró el registro");					

				$handler = new TipoImportacion;								
				$handler->setId($id);

				return $handler->select();


			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}		

		public function ConfiguracionByEmpresa($empresa){
			try {
				
				if(empty($empresa))
					throw new Exception("No se cargo la empresa");					

				$handler = new EmpresaTipoImportacion;								
				$handler->setIdEmpresaSistema($empresa);

				return $handler->select();


			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}		

		public function cargarExcel($archivo,$carpeta_user,$empresa,$fecha,$plaza){
			try {

				if(!$this->existeImportacion($empresa,$fecha,$plaza)){

					$path_excel = $archivo["tmp_name"];
					$objPHPExcel = PHPExcel_IOFactory::load($path_excel);

					foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) 
					{					
						$highestRow         = $worksheet->getHighestRow(); 
						$highestColumn      = $worksheet->getHighestColumn(); 
						$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

						for ($row = 1; $row <= $highestRow; ++ $row) {
							
							for ($col = 0; $col < $highestColumnIndex; ++ $col) {

								$cell = $worksheet->getCellByColumnAndRow($col, $row);								
								$rows[$row][$col] = $cell->getValue();						
							}											
						}
						
						$rows=json_encode($rows);

						$arch = new Archivo;
						$nombre = "tmp_".$arch->generarNombreAleatorio(10).".json";

						//$path = PATH_ROOT.PATH_CARPETA_APP.PATH_CLIENTE.$carpeta_user."/".$nombre;
						$path = PATH_ROOT.PATH_CLIENTE.$carpeta_user."/".$nombre;
						$arch->CrearArchivo($path,$rows);
					
						return $nombre;
					}

				}
				else{
					throw new Exception("Ya se importo el excel para los servicios de la fecha ".$fecha." y plaza ".$plaza."<br>Borre la importación anterior para poder cargarlos nuevamente.");					
				}

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function guardarRegistrosTipo1($fecha,$id_empresa_sistema,$tipo_importacion,$plaza,$datos){
			try {
			
				$impo = new Importacion;

				$conn = new ConexionApp();
				$conn->conectar(); 
				$conn->begin();

					//guardo cabecera
					$impo->setFecha($fecha);
					$impo->setIdEmpresaSistema($id_empresa_sistema);
					$impo->setIdTipoImportacion($tipo_importacion);
					$impo->setPlaza($plaza);
					$impo->insert($conn);	

					//obtengo el ultimo id guardado
					$id_impo_tmp = sqlsrv_query($conn->getConn(),"SELECT @@IDENTITY AS xID");					

					while ($fila = sqlsrv_fetch_array($id_impo_tmp, SQLSRV_FETCH_ASSOC)) {
						$row[]= $fila;
					}

					$id_impo = $row[0]["xID"];					

					//guardo detalle														
					foreach ($datos as $key => $value) {

						//falta provincia y pais
						$address = $value[4]."+".$value[5]."+".$value[8];												
						$mapas = new Mapas;					
						$med = $mapas->getLatLong($address);
						
						$latitud = $med["latitud"]; 
						$longitud = $med["longitud"];


						$impo_1 = new ImportacionTipo1;

						$impo_1->setFecha($fecha);
						$impo_1->setImportacion($id_impo);

						$impo_1->setTipoDoc($value[0]);
						$impo_1->setNroDoc($value[1]);
						$impo_1->setApellido($value[2]);
						$impo_1->setNombre($value[3]);					
						$impo_1->setCalle($value[4]);
						$impo_1->setNumero($value[5]);					
						$impo_1->setPiso($value[6]);					
						$impo_1->setDpto($value[7]);	
						$impo_1->setLocalidad($value[8]);	
						$impo_1->setCodPostal($value[9]);	
						$impo_1->setTelefono($value[10]);	
						$impo_1->setEmail($value[11]);	
						$impo_1->setHorario($value[12]);	
						$impo_1->setImpRendir($value[13]);	
						$impo_1->setProducto($value[14]);	
						$impo_1->setReproceso($value[15]);	
						$impo_1->setObservacion($value[16]);							
						$impo_1->setDocPedir($value[17]);	
						$impo_1->setCobroCliente($value[18]);

						$impo_1->setClienteTT($id_empresa_sistema);

						$impo_1->setLatitudTT($latitud);
						$impo_1->setLongitudTT($longitud);

						$impo_1->setPlaza($plaza);
												
						$impo_1->insert($conn);

						//echo "llego3";
						//exit();
					}

				$conn->commit();
				$conn->desconectar();	
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function guardarRegistrosTipo2($fecha,$id_empresa_sistema,$tipo_importacion,$plaza,$datos){
			try {
			
				$impo = new Importacion;

				$conn = new ConexionApp();
				$conn->conectar(); 
				$conn->begin();

					//guardo cabecera
					$impo->setFecha($fecha);
					$impo->setIdEmpresaSistema($id_empresa_sistema);
					$impo->setIdTipoImportacion($tipo_importacion);
					$impo->setPlaza($plaza);
					$impo->insert($conn);	
										
					//obtengo el ultimo id guardado
					$id_impo_tmp = sqlsrv_query($conn->getConn(),"SELECT @@IDENTITY AS xID");					

					while ($fila = sqlsrv_fetch_array($id_impo_tmp, SQLSRV_FETCH_ASSOC)) {
						$row[]= $fila;
					}

					$id_impo = $row[0]["xID"];					

					//guardo detalle														
					foreach ($datos as $key => $value) {

						$address = $value[25]."+".$value[27]."+".$value[28];	
						$mapas = new Mapas;					
						$med = $mapas->getLatLong($address);
						
						$latitud = $med["latitud"]; 
						$longitud = $med["longitud"];

						$impo_2 = new ImportacionTipo2;

						$impo_2->setFecha($fecha);
						$impo_2->setImportacion($id_impo);

						$impo_2->setNroGestion($value[0]);
						$impo_2->setFechaEnvio($value[1]);
						$impo_2->setNroSolicitudPNM($value[2]);
						$impo_2->setNroReceptoraPIN($value[3]);
						$impo_2->setTipoSuscriptor($value[4]);
						$impo_2->setApellidoNombre($value[5]);
						$impo_2->setRazonSocial($value[6]);
						$impo_2->setTipoDocumento($value[7]);
						$impo_2->setNroDocumento($value[8]);  
						$impo_2->setApellidoNombreApoderado($value[9]);
						$impo_2->setTipoDocumentoApoderado($value[10]);
						$impo_2->setNroDocumentoApoderado($value[11]);
						$impo_2->setTelefonoContacto($value[12]);
						$impo_2->setEmailContacto($value[13]);
						$impo_2->setOperadorDonador($value[14]);
						$impo_2->setModalidadContratacion($value[15]);
						$impo_2->setLinea1($value[16]);
						$impo_2->setLinea2($value[17]);
						$impo_2->setLinea3($value[18]);
						$impo_2->setLinea4($value[19]);
						$impo_2->setLinea5($value[20]);
						$impo_2->setOperadorReceptor($value[21]);
						$impo_2->setCantLineasPortar($value[22]);
						$impo_2->setFechaEstimadaPortacion($value[23]);
						$impo_2->setNroDocumentoPresolicitud($value[24]);
						$impo_2->setDomicilioCompletoEnvio($value[25]);
						$impo_2->setCodigoPostal($value[26]);
						$impo_2->setLocalidad($value[27]);
						$impo_2->setProvincia($value[28]);
						$impo_2->setInformacionAdicionalEnvio($value[29]);
						$impo_2->setHorarioContactoDesde($value[30]);
						$impo_2->setHorarioContactoHasta($value[31]);
						$impo_2->setHorarioContactoDesdeOp2($value[32]);
						$impo_2->setHorarioContactoHastaOp2($value[33]);
						$impo_2->setModoPago($value[34]);
						$impo_2->setCantSimcardsEntregar($value[35]);
						$impo_2->setCantLineas1($value[36]);
					    $impo_2->setCodPlan1($value[37]);
						$impo_2->setDescripcionPlan1($value[38]);
						$impo_2->setPrecioPlan1($value[39]);
						$impo_2->setCantLineas2($value[40]);
						$impo_2->setCodPlan2($value[41]);
						$impo_2->setDescripcionPlan2($value[42]);
						$impo_2->setPrecioPlan2($value[43]);
						$impo_2->setCantLineas3($value[44]);
						$impo_2->setCodPlan3($value[45]);
						$impo_2->setDescripcionPlan3($value[46]);
						$impo_2->setPrecioPlan3($value[47]);
						$impo_2->setCantLineas4($value[48]);
						$impo_2->setCodPlan4($value[49]);
						$impo_2->setDescripcionPlan4($value[50]);
						$impo_2->setPrecioPlan4($value[51]);
						$impo_2->setCantLineas5($value[52]);
						$impo_2->setCodPlan5($value[53]);
						$impo_2->setDescripcionPlan5($value[54]);
						$impo_2->setPrecioPlan5($value[55]);
				   		$impo_2->setEmailEnviarDocGestionada($value[56]);
						$impo_2->setEquipoVenta($value[57]);

						$impo_2->setSim1($value[58]);
						$impo_2->setSim2($value[59]);
						$impo_2->setSim3($value[60]);
						$impo_2->setSim4($value[61]);
						$impo_2->setSim5($value[62]);

						$impo_2->setPlaza($plaza);

						$impo_2->setClienteTT($id_empresa_sistema);

						$impo_2->setLatitudTT($latitud);
						$impo_2->setLongitudTT($longitud);
												
						$impo_2->insert($conn);
					}

				$conn->commit();
				$conn->desconectar();	
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function guardarRegistrosTipo3($fecha,$id_empresa_sistema,$tipo_importacion,$plaza,$datos){
			try {
				
				$impo = new Importacion;

				$conn = new ConexionApp();
				$conn->conectar(); 
				$conn->begin();

					//guardo cabecera
					$impo->setFecha($fecha);
					$impo->setIdEmpresaSistema($id_empresa_sistema);
					$impo->setIdTipoImportacion($tipo_importacion);
					$impo->setPlaza($plaza);
					$impo->insert($conn);	

					//obtengo el ultimo id guardado
					$id_impo_tmp = sqlsrv_query($conn->getConn(),"SELECT @@IDENTITY AS xID");					

					while ($fila = sqlsrv_fetch_array($id_impo_tmp, SQLSRV_FETCH_ASSOC)) {
						$row[]= $fila;
					}

					$id_impo = $row[0]["xID"];					

					//guardo detalle														
					foreach ($datos as $key => $value) {

						//falta provincia y pais
						$address = $value[6]."+".$value[7]."+".$value[10];												
						$mapas = new Mapas;					
						$med = $mapas->getLatLong($address);
						
						$latitud = $med["latitud"]; 
						$longitud = $med["longitud"];


						$impo_1 = new ImportacionTipo1;

						$impo_1->setFecha($value[1]);
						$impo_1->setImportacion($id_impo);

						$impo_1->setTipoDoc($value[2]);
						$impo_1->setNroDoc($value[3]);
						$impo_1->setApellido($value[4]);
						$impo_1->setNombre($value[5]);					
						$impo_1->setCalle($value[6]);
						$impo_1->setNumero($value[7]);					
						$impo_1->setPiso($value[8]);					
						$impo_1->setDpto($value[9]);	
						$impo_1->setLocalidad($value[10]);	
						$impo_1->setCodPostal($value[11]);	
						$impo_1->setTelefono($value[12]);	
						$impo_1->setEmail($value[14]);	
						$impo_1->setHorario($value[15]);	
						$impo_1->setImpRendir($value[16]);	
						$impo_1->setProducto($value[17]);	
						$impo_1->setReproceso($value[18]);	
						$impo_1->setObservacion($value[19]);							
						$impo_1->setDocPedir($value[20]);	
						//$impo_1->setCobroCliente($value[18]);

						$impo_1->setClienteTT($id_empresa_sistema);

						$impo_1->setLatitudTT($latitud);
						$impo_1->setLongitudTT($longitud);


						$hcp = new HandlerPlazaCP();
						$cp = $hcp->selecionarCpByCp($value[11]);				

						if(empty($cp)){							
							$impo_1->setPlaza("-");							
							$impo_1->setSinPlaza(true);	
							$impo_1->setEstado(false);	
						}
						else{
														
							if(count($cp)>1)
								$cp = $cp[0];

							if(!empty($cp->getPlaza())){
								$impo_1->setPlaza($cp->getPlaza());
							}
							else{
								$impo_1->setPlaza("-");
								$impo_1->setSinPlaza(true);	
								$impo_1->setEstado(false);								
							}
						}	
						
						$impo_1->insert($conn);

						//echo "llego3";
						//exit();
					}

				$conn->commit();
				$conn->desconectar();	
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}
		public function getTipoImortacionByEmpresa($empresa_id){
			try {

				$handler = new EmpresaTipoImportacion;				
				$handler->setIdEmpresaSistema($empresa_id);
				$objTI = $handler->select();																						
		
				return $objTI;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function guardarTipoImportacionByEmpresa($datos){
			try {

				$handler = new EmpresaTipoImportacion;				
				$handler->limpiarTabla(null);

				foreach ($datos as $key => $value) {

					$handler1 = new EmpresaTipoImportacion;				

					if(!empty($value["id_tipo_importacion"])){

						$handler1->setIdEmpresaSistema($value["empresa"]);
						$handler1->setIdTipoImportacion($value["id_tipo_importacion"]);
				
						if($this->existeConfiguracion($handler1->getIdEmpresaSistema(),$handler1->getIdTipoImportacion())){								
							$handler1->update(null);
						}
						else{
							$handler1->insert(null);
						}	

					}											

				}
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}
		}

		public function existeConfiguracion($empresa_id,$tipo_id){
			try {
				
				$handler = new EmpresaTipoImportacion;
				$handler->setIdEmpresaSistema($empresa_id);
				$handler->setIdTipoImportacion($tipo_id);

				$u=$handler->existeConfiguracion();

				if(!is_object($u))
					return false;
				else
					return true;


			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public function listarImportacionByEmpresa($empresa){
			try {

				if(empty($empresa))
					throw new Exception("Empresa vacia");
					
				$impo = new Importacion;
				$impo->setIdEmpresaSistema($empresa);
				$datos = $impo->selectOrderFechaDesc();				

				if(is_object($datos))
					$datos = array($datos);

				return $datos;
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public function getImportacionById($id){

			if(empty($id))
				throw new Exception("No se cargo el ID");
				
			$impo = new Importacion;
			$impo->setId($id);
			return $impo->select();			
		}
		

		public function deleteImportacionById($id){
			try {
				
				if(empty($id))
					throw new Exception("ID de importación no encontrado");
				
				$impo = new Importacion;
				$impo->setId($id);
				$impo = $impo->select();

				if(!$impo->importadoTT()){				
					$conn = new ConexionApp();
					$conn->conectar(); 
					$conn->begin();

						$impo = new Importacion;
						$impo->setId($id);
						$impo = $impo->select();

						$impo->delete($conn);

						$impo1 = new ImportacionTipo1;
						$impo1->setImportacion($id);
						$impo1->deleteByImportacion($coon);

						$impo2 = new ImportacionTipo2;
						$impo2->setImportacion($id);
						$impo2->deleteByImportacion($coon);						

					$conn->commit();
					$conn->desconectar();	
				}else{
					throw new Exception("No se puede eliminar una importación aprobada");
					
				}				

			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public function existeImportacion($empresa,$fecha,$plaza){
			try {

				if(empty($empresa))
					throw new Exception("Empresa vacia");
					
				if(empty($fecha))
					throw new Exception("Fecha vacia");
				
				if(empty($plaza))
					throw new Exception("Plaza vacia");
					

				$impo = new Importacion;
				$datos = $impo->existeImportacion($empresa,$fecha,$plaza);				 

				if(is_object($datos))
					$datos = array($datos);

				if(count($datos)>0)
					return true;
				else
					return false;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function selecionarImportacionTipo1SinPlaza($fdesde, $fhasta, $fcliente){
			try {
			
				$impo = new ImportacionTipo1;				
				$datos = $impo->selecionarImportacionSinPlaza($fdesde, $fhasta, $fcliente);				

				if(is_object($datos))
					$datos = array($datos);

				return $datos;
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public function asignarPlaza($id){
			try {
				$impo = new ImportacionTipo1;
				$impo->setId($id);
				$impo = $impo->select();

				$hcp = new HandlerPlazaCP();
				$cp = $hcp->selecionarCpByCp($impo->getCodPostal());
			

				if(empty($cp)){							
					throw new Exception("La plaza ".$impo->getCodPostal()." no esta cargada al sistema");					
				}
				else{
					
					if(count($cp)>1)
						$cp = $cp[0];

					if(!empty($cp->getPlaza())){
						$impo->setPlaza($cp->getPlaza());
						$impo->setImportacion($impo->getImportacion()->getId());				
						$impo->setFecha($impo->getFecha()->format('Y-m-d'));				
						$impo->setSinPlaza(false);	
						$impo->setEstado(true);							
					}
					else{
						throw new Exception("La plaza ".$impo->getCodPostal()." no esta cargada al sistema");													
					}
				}	

				$impo->update(false);

			} catch (Exception $e) {
				throw new Exception($e->getMessage());					
			}
		}

		public function eliminarServicioImportado($id){
			try {
				$impo = new ImportacionTipo1;
				$impo->setId($id);
				$impo = $impo->select();

				$impo->setImportacion($impo->getImportacion()->getId());	
				$impo->setFecha($impo->getFecha()->format('Y-m-d'));							
				$impo->setSinPlaza(false);				

				$impo->update(false);

			} catch (Exception $e) {
				throw new Exception($e->getMessage());					
			}
		}

	}

?>