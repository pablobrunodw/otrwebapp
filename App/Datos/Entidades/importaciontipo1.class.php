<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";

	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'BaseDatos/sql.class.php';
	include_once PATH_DATOS.'Entidades/importacion.class.php';

	class ImportacionTipo1
	{			
		/*#####################################*/
		/* DECLARACIONES / GETTERS AND SETTERS */
		/*#####################################*/

		private $_id;
		public function getId(){ return $this->_id; }
		public function setId($id){ $this->_id =$id; }

		private $_fecha;
		public function getFecha(){ return $this->_fecha; }
		public function setFecha($fecha){ $this->_fecha=$fecha;}

		private $_importacion;
		public function getImportacion(){ return $this->_importacion; }
		public function setImportacion($importacion){ $this->_importacion=$importacion; }

		private $_tipoDoc;
		public function getTipoDoc(){ return $this->_tipoDoc; }
		public function setTipoDoc($tipoDoc){ $this->_tipoDoc=$tipoDoc;}

		private $_nroDoc;
		public function getNroDoc(){ return $this->_nroDoc; }
		public function setNroDoc($nroDoc){ $this->_nroDoc=$nroDoc;}
		
		private $_apellido;
		public function getApellido(){ return $this->_apellido; }
		public function setApellido($apellido){ $this->_apellido=$apellido;}
		
		private $_nombre;
		public function getNombre(){ return $this->_nombre; }
		public function setNombre($nombre){ $this->_nombre=$nombre;}

		private $_calle;
		public function getCalle(){ return $this->_calle; }
		public function setCalle($calle){ $this->_calle=$calle;}

		private $_numero;
		public function getNumero(){ return $this->_numero; }
		public function setNumero($numero){ $this->_numero=$numero;}

		private $_piso;
		public function getPiso(){ return $this->_piso; }
		public function setPiso($piso){ $this->_piso=$piso;}
		
		private $_dpto;
		public function getDpto(){ return $this->_dpto; }
		public function setDpto($dpto){ $this->_dpto=$dpto;}
		
		private $_localidad;
		public function getLocalidad(){ return $this->_localidad; }
		public function setLocalidad($localidad){ $this->_localidad=$localidad;}

		private $_codPostal;
		public function getCodPostal(){ return $this->_codPostal; }
		public function setCodPostal($codPostal){ $this->_codPostal=$codPostal;}

		private $_telefono;
		public function getTelefono(){ return $this->_telefono; }
		public function setTelefono($telefono){ $this->_telefono=$telefono;}
		
		private $_email;
		public function getEmail(){ return $this->_email; }
		public function setEmail($email){ $this->_email=$email;}
		
		private $_horario;
		public function getHorario(){ return $this->_horario; }
		public function setHorario($horario){ $this->_horario=$horario;}

		private $_impRendir;
		public function getImpRendir(){ return $this->_impRendir; }
		public function setImpRendir($impRendir){ $this->_impRendir=$impRendir;}

		private $_producto;
		public function getProducto(){ return $this->_producto; }
		public function setProducto($producto){ $this->_producto=$producto;}
		
		private $_reproceso;
		public function getReproceso(){ return $this->_reproceso; }
		public function setReproceso($reproceso){ $this->_reproceso=$reproceso;}
		
		private $_observacion;
		public function getObservacion(){ return $this->_observacion; }
		public function setObservacion($observacion){ $this->_observacion=$observacion;}

		private $_docPedir;
		public function getDocPedir(){ return $this->_docPedir; }
		public function setDocPedir($docPedir){ $this->_docPedir=$docPedir;}
		
		private $_cobroCliente;
		public function getCobroCliente(){ return $this->_cobroCliente; }
		public function setCobroCliente($cobroCliente){ $this->_cobroCliente=$cobroCliente;}

		private $_estado;
		public function getEstado(){ return var_export($this->_estado,true); }
		public function setEstado($estado){ $this->_estado=$estado; }		

		private $_fechaTT;
		public function getFechaTT(){ return $this->_fechaTT; }
		public function setFechaTT($fechaTT){ $this->_fechaTT=$fechaTT;}

		private $_numeroTT;
		public function getNumeroTT(){ return $this->_numeroTT; }
		public function setNumeroTT($numeroTT){ $this->_numeroTT=$numeroTT;}

		private $_clienteTT;
		public function getClienteTT(){ return $this->_clienteTT; }
		public function setClienteTT($clienteTT){ $this->_clienteTT=$clienteTT;}

		private $_longitudTT;
		public function getLongitudTT(){ return $this->_longitudTT; }
		public function setLongitudTT($longitudTT){ $this->_longitudTT=$longitudTT;}

		private $_latitudTT;
		public function getLatitudTT(){ return $this->_latitudTT; }
		public function setLatitudTT($latitudTT){ $this->_latitudTT=$latitudTT;}

		private $_plaza;
		public function getPlaza(){ return $this->_plaza; }
		public function setPlaza($plaza){ $this->_plaza=$plaza; }

		private $_sinPlaza;
		public function getSinPlaza(){ return var_export($this->_sinPlaza,true); }
		public function setSinPlaza($sinPlaza){ $this->_sinPlaza=$sinPlaza; }	

		/*#############*/
		/* CONSTRUCTOR */
		/*#############*/

		function __construct(){
			$this->setId(0);
			$this->setFecha('');
			$this->setImportacion(new Importacion);
			$this->setTipoDoc('');
			$this->setNroDoc('');
			$this->setApellido('');
			$this->setNombre('');			
			$this->setCalle('');
			$this->setNumero('');
			$this->setPiso('');
			$this->setDpto('');
			$this->setLocalidad('');
			$this->setCodPostal('');
			$this->setTelefono('');
			$this->setEmail('');
			$this->setHorario('');
			$this->setImpRendir('');
			$this->setProducto('');
			$this->setReproceso('');
			$this->setObservacion('');
			$this->setDocPedir('');
			$this->setCobroCliente('');
			
			$this->setEstado(true);
			$this->setSinPlaza(false);

			$this->setFechaTT('');
			$this->setNumeroTT(0);
			$this->setClienteTT(0);
			$this->setLongitudTT('');
			$this->setLatitudTT('');

			$this->setPlaza('');
		}

		/*###################*/
		/* METODOS GENERICOS */
		/*###################*/

		public function insert($conexion)
		{
			try {

				# Validaciones 			
				if(empty($this->getImportacion()))
					throw new Exception("Importación vacia");

				if(empty($this->getFecha()))
					throw new Exception("Fecha vacia");

				if(empty($this->getPlaza()))
					throw new Exception("Plaza vacia");				
				
				# Query 			
				$query="INSERT INTO importacion_tipo1 (		        						
										id_importacion,
										fecha,	
										tipo_doc,
										nro_doc,	
										apellido,
										nombre,	
										calle,	
										numero,
										piso,	
										dpto,	
										localidad,
										cod_postal,	
										telefono,	
										email,	
										horario,
										imp_rendir,	
										producto,	
										reproceso,	
										observacion,	
										doc_pedir,	
										cobro_cliente,																		
										cliente_tt,
										longitud_tt,
										latitud_tt,
										plaza,
										sin_plaza,
										estado
	        			) VALUES (

										".$this->getImportacion().",
										'".$this->getFecha()."',
										'".$this->getTipoDoc()."',
										'".$this->getNroDoc()."',
										'".$this->getApellido()."',
										'".$this->getNombre()."',
										'".$this->getCalle()."',
										'".$this->getNumero()."',
										'".$this->getPiso()."',
										'".$this->getDpto()."',
										'".$this->getLocalidad()."',
										'".$this->getCodPostal()."',
										'".$this->getTelefono()."',
										'".$this->getEmail()."',
										'".$this->getHorario()."',
										'".$this->getImpRendir()."',
										'".$this->getProducto()."',
										'".$this->getReproceso()."',
										'".$this->getObservacion()."',
										'".$this->getDocPedir()."',
										'".$this->getCobroCliente()."',
										".$this->getClienteTT().",
										'".$this->getLatitudTT()."',
										'".$this->getLongitudTT()."',
										'".$this->getPlaza()."',
										'".$this->getSinPlaza()."',
										'".$this->getEstado()."'
	        			)";        		

				# Ejecucion 					
				return SQL::insert($conexion,$query);
			
			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}		
		}

		public function update($conexion)
		{
			try {

				# Validaciones 			
				if(empty($this->getId()))
					throw new Exception("Registro ed importación no identificado");

				if(empty($this->getImportacion()))
					throw new Exception("Importación vacia");

				if(empty($this->getFecha()))
					throw new Exception("Fecha vacia");

				if(empty($this->getPlaza()))
					throw new Exception("Plaza vacia");				
				
				# Query 			
				$query="UPDATE importacion_tipo1 SET
								id_importacion=".$this->getImportacion().",
								fecha='".$this->getFecha()."',
								tipo_doc='".$this->getTipoDoc()."',
								nro_doc='".$this->getNroDoc()."',	
								apellido='".$this->getApellido()."',
								nombre='".$this->getNombre()."',
								calle='".$this->getCalle()."',	
								numero='".$this->getNumero()."',	
								piso='".$this->getPiso()."',	
								dpto='".$this->getDpto()."',	
								localidad='".$this->getLocalidad()."',
								cod_postal='".$this->getCodPostal()."',	
								telefono='".$this->getTelefono()."',
								email='".$this->getEmail()."',	
								horario='".$this->getHorario()."',
								imp_rendir='".$this->getImpRendir()."',
								producto='".$this->getProducto()."',
								reproceso='".$this->getReproceso()."',	
								observacion='".$this->getObservacion()."',
								doc_pedir='".$this->getDocPedir()."',
								cobro_cliente='".$this->getCobroCliente()."',
								cliente_tt=".$this->getClienteTT().",
								latitud_tt='".$this->getLongitudTT()."',
								longitud_tt='".$this->getLatitudTT()."',
								plaza='".$this->getPlaza()."',
								sin_plaza='".$this->getSinPlaza()."',
								estado='".$this->getEstado()."'										
							WHERE id=".$this->getId();

				//echo $query;
				//exit;

				# Ejecucion 					
				return SQL::update($conexion,$query);	

			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}		
		}

		public function delete($conexion)
		{
			try {
				
				# Validaciones 			
				if(empty($this->getId()))
					throw new Exception("Registro de importación no identificado");
			
				# Query 			
				$query="UPDATE importacion_tipo1 SET							
								estado='false'
							WHERE id=".$this->getId();

				# Ejecucion 	
				return SQL::delete($conexion,$query);

			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}
		}

		public function select()
		{			
			try {
											
				# Query
				if(empty($this->getId()))
				{
					if(empty($this->getImportacion())){
						$query = "SELECT * FROM importacion_tipo1 WHERE estado='true'";
					}
					else{
						if(gettype($this->getImportacion())=="string")
							$query="SELECT * FROM importacion_tipo1 WHERE id_importacion=".$this->getImportacion()." AND estado='true'";
						else
							$query="SELECT * FROM importacion_tipo1 WHERE id_importacion=".$this->getImportacion()->getId()." AND estado='true'";
					}
				}
				else
				{
					if(empty($this->getId()))
						throw new Exception("No se selecciono el Id del registro de importación");		

					$query="SELECT * FROM importacion_tipo1 WHERE id=".$this->getId();
				}
				
				# Ejecucion 					
				$result = SQL::selectObject($query, new ImportacionTipo1);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());						
			}

		}

		public function setPropiedadesBySelect($filas)
		{	
			if(empty($filas)){
				$this->cleanClass();
			}
			else{
				$this->setId($filas['id']);
				$this->setFecha($filas['fecha']);
				$this->setTipoDoc($filas['tipo_doc']);
				$this->setNroDoc($filas['nro_doc']);
				$this->setApellido($filas['apellido']);
				$this->setNombre($filas['nombre']);
				$this->setCalle($filas['calle']);
				$this->setNumero($filas['numero']);
				$this->setPiso($filas['piso']);
				$this->setDpto($filas['dpto']);
				$this->setLocalidad($filas['localidad']);
				$this->setCodPostal($filas['cod_postal']);
				$this->setTelefono($filas['telefono']);
				$this->setEmail($filas['email']);
				$this->setHorario($filas['horario']);
				$this->setImpRendir($filas['imp_rendir']);
				$this->setProducto($filas['producto']);
				$this->setReproceso($filas['reproceso']);
				$this->setObservacion($filas['observacion']);
				$this->setDocPedir($filas['doc_pedir']);
				$this->setCobroCliente($filas['cobro_cliente']);
				$this->setFechaTT($filas['fecha_tt']);
				$this->setNumeroTT($filas['numero_tt']);
				$this->setClienteTT($filas['cliente_tt']);
				$this->setLongitudTT($filas['longitud_tt']);
				$this->setLatitudTT($filas['latitud_tt']);
				$this->setPlaza($filas['plaza']);				
				
				$this->setSinPlaza($filas['sin_plaza']);
				$this->setEstado($filas['estado']);

				$im = new Importacion;
				$im->setId($filas['id_importacion']);
				$im = $im->select();												
				$this->setImportacion($im);
			}
		}

		private function cleanClass()
		{
			$this->setId(0);
			$this->setFecha('');
			$this->setImportacion(new Importacion);
			$this->setTipoDoc('');
			$this->setNroDoc('');
			$this->setApellido('');
			$this->setNombre('');
			$this->setCalle('');
			$this->setNumero('');
			$this->setPiso('');
			$this->setDpto('');
			$this->setLocalidad('');
			$this->setCodPostal('');
			$this->setTelefono('');
			$this->setEmail('');
			$this->setHorario('');
			$this->setImpRendir('');
			$this->setProducto('');
			$this->setReproceso('');
			$this->setObservacion('');
			$this->setDocPedir('');
			$this->setCobroCliente('');
			
			$this->setSinPlaza(false);
			$this->setEstado(true);

			$this->setFechaTT('');
			$this->setNumeroTT(0);
			$this->setClienteTT(0);
			$this->setLongitudTT('');
			$this->setLatitudTT('');

			$this->setPlaza('');
		}

		private function createTable()
		{
			return 'CREATE TABLE IF NOT EXISTS';
		}

		/*########################*/
		/* METODOS PERSONALIZADOS */
		/*########################*/


		function deleteByImportacion($conexion){
			try {
				
				# Validaciones 			
				if(empty($this->getImportacion()))
					throw new Exception("Importación no identificada");
			
				# Query 			
				$query="UPDATE importacion_tipo1 SET estado='false' WHERE id_importacion =".$this->getImportacion();

				# Ejecucion 	
				return SQL::delete($conexion,$query);

			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}
		}

		public function selecionarImportacionSinPlaza($fdesde, $fhasta, $fcliente){
			try {

				$f = new Fechas;

				if($fdesde==$fhasta)
				{
					$filtro_fdesde="";
					if(!empty($fdesde)){					
						$tmp = $f->FormatearFechas($fdesde,"Y-m-d","Y-m-d");				
						$filtro_fdesde = "CAST (importacion_tipo1.fecha AS DATE) = '".$tmp."' AND ";
					}

					$filtro_fhasta="";
					if(!empty($fhasta)){					
						$tmp = $f->FormatearFechas($fhasta,"Y-m-d","Y-m-d");				
						$filtro_fhasta = "CAST (importacion_tipo1.fecha AS DATE) =  '".$tmp."' AND ";
					}
				}
				else
				{					
					$filtro_fdesde="";
					if(!empty($fdesde)){					
						$tmp = $f->FormatearFechas($fdesde,"Y-m-d","Y-m-d");				
						$filtro_fdesde = "CAST (importacion_tipo1.fecha AS DATE) >= '".$tmp."' AND ";
					}

					$filtro_fhasta="";
					if(!empty($fhasta)){					
						$tmp = $f->FormatearFechas($fhasta,"Y-m-d","Y-m-d");				
						$filtro_fhasta = "CAST (importacion_tipo1.fecha AS DATE) <=  '".$tmp."' AND ";
					}
				}
											
				$filtro_cliente="";
				if(!empty($fcliente))								
					$filtro_cliente = "importacion_tipo1.cliente_tt = ".$fcliente." AND ";
																	
				$filtro_estado = "importacion_tipo1.estado = 'false' AND";
				$filtro_sinplaza = "importacion_tipo1.sin_plaza = 'true'";


				$query="SELECT * FROM importacion_tipo1 							
								WHERE
									".$filtro_fdesde." 
									".$filtro_fhasta." 										
									".$filtro_cliente."
									".$filtro_estado."
									".$filtro_sinplaza;
				# Ejecucion 					
				$result = SQL::selectObject($query, new ImportacionTipo1);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}
		}

		function countAprobado($id){
			try {

				if(empty($id))
					throw new Exception("No se encontro la importación");
					
				$query="SELECT * FROM importacion_tipo1 WHERE id_importacion=".$id." AND NOT numero_tt IS NULL";

				//echo $query;
				//exit();

				# Ejecucion 					
				$result = SQL::selectObject($query, new ImportacionTipo1);
						
				return $result;
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());			
			}
		}
	}
?>