<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";

	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'BaseDatos/sql.class.php';

	class PlazaCP
	{			
		/*#####################################*/
		/* DECLARACIONES / GETTERS AND SETTERS */
		/*#####################################*/

		private $_id;
		public function getId(){ return $this->_id; }
		public function setId($id){ $this->_id =$id; }

		private $_cp;
		public function getCP(){ return $this->_cp; }
		public function setCP($cp){ $this->_cp=$cp; }

		private $_cpNombre;
		public function getCPNombre(){ return $this->_cpNombre; }
		public function setCPNombre($cpNombre){ $this->_cpNombre=$cpNombre; }

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
			$this->setCP('');						
			$this->setCPNombre('');						
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
				if(empty($this->getCP()))
					throw new Exception("Codigo Postal vacio");

				if(empty($this->getPlaza()))
					throw new Exception("Plaza vacia");				

				# Query 			
				$query="INSERT INTO plazas_cp (
		        						cp,		
		        						cp_nombre,
		        						plaza,
		        						estado
	        			) VALUES (
	        							'".$this->getCP()."',     	
	        							'".$this->getCPNombre()."',
	        							'".$this->getPlaza()."',
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
					throw new Exception("Codigo postal no identificado");

				if(empty($this->getCP()))
					throw new Exception("Codigo Postal vacio");

				if(empty($this->getPlaza()))
					throw new Exception("Plaza vacia");	
				
				# Query 			
				$query="UPDATE plazas_cp SET
								cp='".$this->getCP()."',					
								cp_nombre='".$this->getCPNombre()."',
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
					throw new Exception("Codigo postal no identificado");
			
				# Query 			
				$query="UPDATE plazas_cp SET							
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
					$query = "SELECT * FROM plazas_cp WHERE estado='true'";
				}
				else
				{
					if(empty($this->getId()))
						throw new Exception("Codigo postal no identificado");		

					$query="SELECT * FROM plazas_cp WHERE id=".$this->getId();
				}
				
				# Ejecucion 					
				$result = SQL::selectObject($query, new PlazaCP);
						
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
				$this->setCP($filas['cp']);
				$this->setCPNombre(trim($filas['cp_nombre']));			
				$this->setPlaza($filas['plaza']);			
				$this->setEstado($filas['estado']);
			}
		}

		private function cleanClass()
		{
			$this->setId(0);
			$this->setCP('');						
			$this->setCPNombre('');						
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
	
		public function selecionarCpByPlaza($plaza){
			try {
											
				# Query
				if(empty($plaza))
					$query="SELECT * FROM plazas_cp WHERE estado='true'";
				else							
					$query="SELECT * FROM plazas_cp WHERE estado='true' AND plaza='".$plaza."'";
							
				# Ejecucion 					
				$result = SQL::selectObject($query, new PlazaCP);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());						
			}		
		}

		public function selecionarCpByCp($cp){
			try {
											
				# Query
				if(empty($cp))
					throw new Exception("Codigo postal vacio");
										
				$query="SELECT * FROM plazas_cp WHERE estado='true' AND cp='".$cp."'";
							
				# Ejecucion 					
				$result = SQL::selectObject($query, new PlazaCP);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());						
			}		
		}		
	}
?>