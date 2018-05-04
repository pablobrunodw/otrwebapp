<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";

	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'BaseDatos/sql.class.php';

	class TipoLicencias
	{			
		/*#####################################*/
		/* DECLARACIONES / GETTERS AND SETTERS */
		/*#####################################*/

		private $_id;
		public function getId(){ return $this->_id; }
		public function setId($id){ $this->_id =$id; }		
		
		private $_nombre;
		public function getNombre(){ return $this->_nombre; }
		public function setNombre($nombre){ $this->_nombre=$nombre; }

		private $_dias;
		public function getDias(){ return $this->_dias; }
		public function setDias($dias){ $this->_dias=$dias; }

		private $_estado;
		public function getEstado(){ return var_export($this->_estado,true); }
		public function setEstado($estado){ $this->_estado=$estado; }			

		/*#############*/
		/* CONSTRUCTOR */
		/*#############*/

		function __construct(){
			$this->setId(0);
			$this->setNombre('');
			$this->setDias('');		
			$this->setEstado(true);			
		}

		/*###################*/
		/* METODOS GENERICOS */
		/*###################*/

		public function insert($conexion)
		{
			try {

				# Validaciones 			
				if(empty($this->getNombre()))
					throw new Exception("Nombre Vacio");	

				# Query 			
				$query="INSERT INTO tipo_licencias (
		        						nombre,		        						
		        						dias,		        						
		        						estado
	        			) VALUES (
	        							'".$this->getNombre()."',   		        							
	        							".$this->getDias().",   		        								        							
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
					throw new Exception("Tipo de Licencia no identificada");

				if(empty($this->getNombre()))
					throw new Exception("Nombre Vacio");	

				# Query 			
				$query="UPDATE tipo_licencias SET
								nombre='".$this->getNombre()."',
								dias=".$this->getDias().",								
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
					throw new Exception("Tipo Licencia no identificada");
			
				# Query 			
				$query="UPDATE tipo_licencias SET							
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
					$query = "SELECT * FROM tipo_licencias WHERE estado='true' ORDER BY id ASC";
				}
				else
				{
					if(empty($this->getId()))
						throw new Exception("No se selecciono el Id del Tipo de Licencia");		

					$query="SELECT * FROM tipo_licencias WHERE id=".$this->getId()." ORDER BY id ASC";
				}
				
				# Ejecucion 					
				$result = SQL::selectObject($query, new TipoLicencias);
						
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

				$this->setNombre($filas['nombre']);				
				$this->setDias($filas['dias']);							
				$this->setEstado($filas['estado']);
			}
		}

		private function cleanClass()
		{
			$this->setId(0);
			$this->setNombre('');
			$this->setDias('');		
			$this->setEstado(true);	
		}

		private function createTable()
		{
			return 'CREATE TABLE IF NOT EXISTS';
		}

		/*########################*/
		/* METODOS PERSONALIZADOS */
		/*########################*/
	
	}
?>