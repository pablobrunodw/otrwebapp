<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";

	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'BaseDatos/sql.class.php';
	include_once PATH_DATOS.'Entidades/tipoimportacion.class.php';
	include_once PATH_DATOS.'Entidades/importaciontipo1.class.php';	
	include_once PATH_DATOS.'Entidades/importaciontipo2.class.php';	

	class Importacion
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

		private $_idEmpresaSistema;
		public function getIdEmpresaSistema(){ return $this->_idEmpresaSistema; }
		public function setIdEmpresaSistema($idEmpresaSistema){ $this->_idEmpresaSistema=$idEmpresaSistema; }
		
		private $_idTipoImportacion;
		public function getIdTipoImportacion(){ return $this->_idTipoImportacion; }
		public function setIdTipoImportacion($idTipoImportacion){ $this->_idTipoImportacion=$idTipoImportacion; }

		private $_plaza;
		public function getPlaza(){ return $this->_plaza; }
		public function setPlaza($plaza){ $this->_plaza=$plaza; }

		private $_estado;
		public function getEstado(){ return var_export($this->_estado,true); }
		public function setEstado($estado){ $this->_estado=$estado; }			

		/*#############*/
		/* CONSTRUCTOR */
		/*#############*/

		function __construct(){
			$this->setId(0);
			$this->setFecha('');
			$this->setIdEmpresaSistema(0);						
			$this->setIdTipoImportacion(new TipoImportacion);
			$this->setPlaza('');
			$this->setEstado(true);
		}

		/*###################*/
		/* METODOS GENERICOS */
		/*###################*/

		public function insert($conexion)
		{
			try {

				# Validaciones 			
				if(empty($this->getIdEmpresaSistema()))
					throw new Exception("Empresa vacia");

				if(empty($this->getIdTipoImportacion()))
					throw new Exception("Tipo Importacion vacio");

				if(empty($this->getFecha()))
					throw new Exception("Fecha vacia");

				if(empty($this->getPlaza()))
					throw new Exception("Plaza vacia");
								
				# Query 			
				$query="INSERT INTO importacion (
		        						fecha,
		        						id_empresa_sistema,
		        						id_tipo_importacion,
		        						plaza,
		        						estado
	        			) VALUES (
	        							'".$this->getFecha()."',
	        							".$this->getIdEmpresaSistema().",
	        							".$this->getIdTipoImportacion().",
	        							'".$this->getPlaza()."',
	        							'".$this->getEstado()."'
	        			)";        					        		        		

	        			//echo $query;
	        			//exit();

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
					throw new Exception("Importación no identificada");

				if(empty($this->getIdEmpresaSistema()))
					throw new Exception("Empresa vacia");

				if(empty($this->getIdTipoImportacion()))
					throw new Exception("Tipo Importacion vacio");

				if(empty($this->getFecha()))
					throw new Exception("Fecha vacia");

				if(empty($this->getPlaza()))
					throw new Exception("Plaza vacia");				
				
				# Query 			
				$query="UPDATE importacion SET
								fecha='".$this->getFecha()."',					
								id_empresa_sistema=".$this->getIdEmpresaSistema().",					
								id_tipo_importacion=".$this->getIdTipoImportacion().",					
								plaza='".$this->getPlaza()."',
								estado='".$this->getEstado()."'
							WHERE id=".$this->getId();

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
					throw new Exception("Importación no identificada");
			
				# Query 			
				$query="UPDATE importacion SET							
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
					if(empty($this->getIdEmpresaSistema()))
						throw new Exception("No se selecciono la empresa");		
					
					$query = "SELECT * FROM importacion WHERE id_empresa_sistema=".$this->getIdEmpresaSistema()." AND estado='true'";
				}
				else
				{
					if(empty($this->getId()))
						throw new Exception("No se selecciono el Id de la importación");		

					$query="SELECT * FROM importacion WHERE id=".$this->getId();
				}
				
				//echo $query;
				//exit();

				# Ejecucion 					
				$result = SQL::selectObject($query, new Importacion);
						
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
				$this->setIdEmpresaSistema($filas['id_empresa_sistema']);				
				
				$ti = new TipoImportacion;
				$ti->setId($filas['id_tipo_importacion']);			
				$ti = $ti->select();
				$this->setIdTipoImportacion($ti);

				$this->setPlaza($filas['plaza']);				
				$this->setEstado($filas['estado']);				
			}
		}

		private function cleanClass()
		{
			$this->setId(0);
			$this->setFecha('');
			$this->setIdEmpresaSistema(0);						
			$this->setIdTipoImportacion(0);
			$this->setPlaza('');
			$this->setEstado(true);
		}

		private function createTable()
		{
			return 'CREATE TABLE IF NOT EXISTS';
		}

		/*########################*/
		/* METODOS PERSONALIZADOS */
		/*########################*/
		
		function selectDetalle(){
			try {
				$datos=null;

				if($this->getIdTipoImportacion()->getId()==1 || $this->getIdTipoImportacion()->getId()==3){
					$impo1 = new ImportacionTipo1;
					$impo1->setImportacion($this->getId());
					$datos = $impo1->select();				
				}else{
					$impo2 = new ImportacionTipo2;
					$impo2->setImportacion($this->getId());
					$datos = $impo2->select();				
				}

				return $datos;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		function countAprobados(){
			try {
				$datos=null;

				if($this->getIdTipoImportacion()->getId()==1 || $this->getIdTipoImportacion()->getId()==3){									
					$impo1 = new ImportacionTipo1;
					$datos = $impo1->countAprobado($this->getId());
				}else{
					$impo2 = new ImportacionTipo2;
					$datos = $impo2->countAprobado($this->getId());			
				}				

				return count($datos);

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function selectOrderFechaDesc()
		{			
			try {
											
				# Query				
				if(empty($this->getIdEmpresaSistema()))
					throw new Exception("No se selecciono la empresa");		
				
				$query = "SELECT TOP 20 * FROM importacion WHERE id_empresa_sistema=".$this->getIdEmpresaSistema()." AND estado='true' ORDER BY fecha DESC";
											
				//echo $query;
				//exit();

				# Ejecucion 					
				$result = SQL::selectObject($query, new Importacion);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());						
			}

		}

		function importadoTT(){
			try {
				$datos=null;

				$estImportado=false;
				
				if($this->getIdTipoImportacion()->getId()==1 || $this->getIdTipoImportacion()->getId()==3){
					$impo1 = new ImportacionTipo1;
					$impo1->setImportacion($this->getId());
					$datos = $impo1->select();	

					
					if(!empty($datos)){

						if(count($datos)>1){
							foreach ($datos as $key => $value) {
								if($value->getNumeroTT()>0)
									$estImportado = true;						
							}			
						}
						else{
							if($datos->getNumeroTT()>0)
								$estImportado = true;													
						}
					}												
				}
				else{
					$impo2 = new ImportacionTipo2;
					$impo2->setImportacion($this->getId());
					$datos = $impo2->select();	

					
					if(!empty($datos)){
						if(count($datos)>1){
							foreach ($datos as $key => $value) {
								if($value->getNumeroTT()>0)
									$estImportado = true;						
							}	
						}
						else{
							if($datos->getNumeroTT()>0)
								$estImportado = true;								
						}		
					}		
				}

				return $estImportado;
			
			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		function existeImportacion($empresa,$fecha,$plaza){
			try {
				
				# Query				
				if(empty($empresa))
					throw new Exception("No se selecciono la empresa");		

				if(empty($fecha))
					throw new Exception("No se selecciono la fecha");		
				
				if(empty($plaza))
					throw new Exception("No se selecciono la plaza");						

				$query = "SELECT * FROM importacion WHERE id_empresa_sistema=".$empresa." AND fecha='".$fecha."' AND plaza='".$plaza."' AND estado='true'";
															
				# Ejecucion 					
				$result = SQL::selectObject($query, new Importacion);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());						
			}
		}
	}
?>