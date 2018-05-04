<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";

	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'BaseDatos/sql.class.php';	

	class EmpresaArchivosTemplate
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

		private $_categoria;
		public function getCategoria(){ return $this->_categoria; }
		public function setCategoria($categoria){ $this->_categoria=$categoria; }

		private $_estado;
		public function getEstado(){ return var_export($this->_estado,true); }
		public function setEstado($estado){ $this->_estado=$estado; }		

		/*#############*/
		/* CONSTRUCTOR */
		/*#############*/

		function __construct(){
			$this->setId(0);
			$this->setIdEmpresaSistema(0);			
			$this->setCategoria('');
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

				if(empty($this->getCategoria()))
					throw new Exception("Categoria vacia");
				
				# Query 			
				$query="INSERT INTO empresa_archivos_template (
		        						id_empresa_sistema,
		        						categoria,
		        						estado
	        			) VALUES (
	        							".$this->getIdEmpresaSistema().",
	        							'".$this->getCategoria()."',
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
					throw new Exception("Template no identificado");

				if(empty($this->getIdEmpresaSistema()))
					throw new Exception("Empresa sistema vacia");

				if(empty($this->getCategoria()))
					throw new Exception("Categoria vacia");
				
				# Query 			
				$query="UPDATE empresa_archivos_template SET
								id_empresa_sistema=".$this->getIdEmpresaSistema().", 
								categoria='".$this->getCategoria()."', 
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
					throw new Exception("Template no identificado");

				# Query 			
				$query="UPDATE empresa_archivos_template SET							
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

					$query = "SELECT * FROM empresa_archivos_template WHERE id_empresa_sistema=".$this->getIdEmpresaSistema()." AND estado='true'";
				}
				else{
					if(empty($this->getId()))
						throw new Exception("No se selecciono el Id de la categoria");		

					$query="SELECT * FROM empresa_archivos_template WHERE id=".$this->getId();
				}

				# Ejecucion 				
				$result = SQL::selectObject($query, new EmpresaArchivosTemplate);
						
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
				$this->setCategoria(trim($filas['categoria']));											
				$this->setEstado($filas['estado']);
			}
		}

		private function cleanClass()
		{
			$this->setId(0);
			$this->setIdEmpresaSistema('');
			$this->setCategoria('');			
			$this->setEstado(true);				
		}

		private function createTable()
		{
			return 'CREATE TABLE IF NOT EXISTS';
		}

		/*########################*/
		/* METODOS PERSONALIZADOS */
		/*########################*/	

		public function existeCategoria()
		{			
			try {							
				if(empty($this->getIdEmpresaSistema()))
					throw new Exception("No se selecciono la empresa de referencia");		

				if(empty($this->getCategoria()))
					throw new Exception("No se cargo la categoria");		

				$query = "SELECT * FROM empresa_archivos_template WHERE id_empresa_sistema=".$this->getIdEmpresaSistema()." AND categoria='".$this->getCategoria()."' AND estado='true'";
				
				//echo $query;
				//exit();

				# Ejecucion 				
				$result = SQL::selectObject($query, new EmpresaArchivosTemplate);
						
				return $result;
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());
						
			}

		}	

		public function limpiarTabla($conexion)
		{			
			try {											
				$query = "DELETE FROM empresa_archivos_template";
				
				# Ejecucion 	
				return SQL::delete($conexion,$query);			
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());
						
			}

		}	

	}
?>