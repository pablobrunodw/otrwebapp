
<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";

	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'BaseDatos/sql.class.php';	
	include_once PATH_DATOS.'Entidades/tipoimportacion.class.php';

	class EmpresaTipoImportacion
	{				
		/*#####################################*/
		/* DECLARACIONES / GETTERS AND SETTERS */
		/*#####################################*/

		private $_id;
		public function getId(){ return $this->_id; }
		public function setId($id){ $this->_id =$id; }

		private $_idEmpresaSistema;
		public function getIdEmpresaSistema(){ return $this->_idEmpresaSistema; }
		public function setIdEmpresaSistema($idEmpresaSistema){ $this->_idEmpresaSistema=$idEmpresaSistema; }

		private $_idTipoImportacion;
		public function getIdTipoImportacion(){ return $this->_idTipoImportacion; }
		public function setIdTipoImportacion($idTipoImportacion){ $this->_idTipoImportacion=$idTipoImportacion; }

		private $_estado;
		public function getEstado(){ return var_export($this->_estado,true); }
		public function setEstado($estado){ $this->_estado=$estado; }		

		/*#############*/
		/* CONSTRUCTOR */
		/*#############*/

		function __construct(){
			$this->setId(0);
			$this->setIdEmpresaSistema(0);			
			$this->setIdTipoImportacion(0);
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
					throw new Exception("Empresa sistema vacia");

				if(empty($this->getIdTipoImportacion()))
					throw new Exception("Tipo de importacion vacio");
				
				# Query 			
				$query="INSERT INTO empresa_tipo_importacion (
		        						id_empresa_sistema,
		        						id_tipo_importacion,
		        						estado
	        			) VALUES (
	        							".$this->getIdEmpresaSistema().",
	        							".$this->getIdTipoImportacion().",
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
					throw new Exception("Configuracion no identificada");

				if(empty($this->getIdEmpresaSistema()))
					throw new Exception("Empresa sistema vacia");

				if(empty($this->getIdTipoImportacion()))
					throw new Exception("Tipo de importacion vacia");
				
				# Query 			
				$query="UPDATE empresa_tipo_importacion SET
								id_empresa_sistema=".$this->getIdEmpresaSistema().", 
								id_tipo_importacion=".$this->getIdTipoImportacion().", 
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
					throw new Exception("Configuracion no identificada");

				# Query 			
				$query="UPDATE empresa_tipo_importacion SET							
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
				if(empty($this->getId())){

					if(empty($this->getIdEmpresaSistema()))
						throw new Exception("No se selecciono la empresa de referencia");		

					$query = "SELECT * FROM empresa_tipo_importacion WHERE id_empresa_sistema=".$this->getIdEmpresaSistema()." AND estado='true'";
				}
				else{
					if(empty($this->getId()))
						throw new Exception("No se selecciono el Id de la configuracion");		

					$query="SELECT * FROM empresa_tipo_importacion WHERE id=".$this->getId();
				}

				# Ejecucion 				
				$result = SQL::selectObject($query, new EmpresaTipoImportacion);
						
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
				$this->setIdEmpresaSistema(trim($filas['id_empresa_sistema']));

				$ti = new TipoImportacion;
				$ti->setId($filas['id_tipo_importacion']);
				$ti = $ti->select();								
				$this->setIdTipoImportacion($ti);											

				$this->setEstado($filas['estado']);
			}
		}

		private function cleanClass()
		{
			$this->setId(0);
			$this->setIdEmpresaSistema('');
			$this->setIdTipoImportacion('');			
			$this->setEstado(true);				
		}

		private function createTable()
		{
			return 'CREATE TABLE IF NOT EXISTS';
		}

		/*########################*/
		/* METODOS PERSONALIZADOS */
		/*########################*/	

		public function existeConfiguracion()
		{			
			try {							
				if(empty($this->getIdEmpresaSistema()))
					throw new Exception("No se selecciono la empresa de referencia");		

				if(empty($this->getIdTipoImportacion()))
					throw new Exception("No se cargo el tipo de importacion");						

				$query = "SELECT * FROM empresa_tipo_importacion WHERE id_empresa_sistema=".$this->getIdEmpresaSistema()." AND id_tipo_importacion='".$this->getIdTipoImportacion()."' AND estado='true'";
				
				//echo $query;
				//exit();

				# Ejecucion 				
				$result = SQL::selectObject($query, new EmpresaTipoImportacion);
						
				return $result;
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());
						
			}

		}	

		public function limpiarTabla($conexion)
		{			
			try {											
				$query = "DELETE FROM empresa_tipo_importacion";
				
				# Ejecucion 	
				return SQL::delete($conexion,$query);			
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());
						
			}

		}	

	}
?>