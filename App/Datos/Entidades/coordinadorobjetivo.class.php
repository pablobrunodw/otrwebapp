<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";

	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'BaseDatos/sql.class.php';	

	class CoordinadorObjetivo
	{				
		/*#####################################*/
		/* DECLARACIONES / GETTERS AND SETTERS */
		/*#####################################*/

		private $_id;
		public function getId(){ return $this->_id; }
		public function setId($id){ $this->_id =$id; }

		private $_idCoordinadorSistema;
		public function getIdCoordinadorSistema(){ return $this->_idCoordinadorSistema; }
		public function setIdCoordinadorSistema($idCoordinadorSistema){ $this->_idCoordinadorSistema=$idCoordinadorSistema; }

		private $_objetivo;
		public function getObjetivo(){ return $this->_objetivo; }
		public function setObjetivo($objetivo){ $this->_objetivo=$objetivo; }

		private $_estado;
		public function getEstado(){ return var_export($this->_estado,true); }
		public function setEstado($estado){ $this->_estado=$estado; }		

		/*#############*/
		/* CONSTRUCTOR */
		/*#############*/

		function __construct(){
			$this->setId(0);
			$this->setIdCoordinadorSistema(0);			
			$this->setObjetivo(0);
			$this->setEstado(true);				
		}

		/*###################*/
		/* METODOS GENERICOS */
		/*###################*/

		public function insert($conexion)
		{
			try {
							
				# Validaciones 			
				if($this->getIdCoordinadorSistema()<0)
					throw new Exception("Coordinador sistema vacio");

				if(empty($this->getObjetivo()))
					throw new Exception("Objetivo vacio");
				
				# Query 			
				$query="INSERT INTO coordinador_objetivo (
		        						id_coordinador_sistema,
		        						objetivo,
		        						estado
	        			) VALUES (
	        							'".$this->getIdCoordinadorSistema()."',
	        							".$this->getObjetivo().",
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
					throw new Exception("Objetivo no identificado");

				if($this->getIdCoordinadorSistema()<0)
					throw new Exception("Coordinador sistema vacio");

				if(empty($this->getObjetivo()))
					throw new Exception("Objetivo vacio");
				
				# Query 			
				$query="UPDATE coordinador_objetivo SET
								id_coordinador_sistema='".$this->getIdCoordinadorSistema()."', 
								objetivo=".$this->getObjetivo().", 
								estado='".$this->getEstado()."'
							WHERE id=".$this->getId();


	        	//echo $query;
	        	//exit();

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
					throw new Exception("Objetivo no identificado");

				# Query 			
				$query="UPDATE coordinador_objetivo SET							
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

					if(empty($this->getIdCoordinadorSistema()))
						throw new Exception("No se selecciono el coordinador de referencia");		

					$query = "SELECT * FROM coordinador_objetivo WHERE id_coordinador_sistema='".$this->getIdCoordinadorSistema()."' AND estado='true'";
				}
				else{
					if(empty($this->getId()))
						throw new Exception("No se selecciono el Id de la categoria");		

					$query="SELECT * FROM coordinador_objetivo WHERE id=".$this->getId();
				}

				//echo $query;
				//exit();

				# Ejecucion 				
				$result = SQL::selectObject($query, new CoordinadorObjetivo);
						
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
				$this->setIdCoordinadorSistema(trim($filas['id_coordinador_sistema']));
				$this->setObjetivo(trim($filas['objetivo']));											
				$this->setEstado($filas['estado']);
			}
		}

		private function cleanClass()
		{
			$this->setId(0);
			$this->setIdCoordinadorSistema(0);
			$this->setObjetivo(0);			
			$this->setEstado(true);				
		}

		private function createTable()
		{
			return 'CREATE TABLE IF NOT EXISTS';
		}

		/*########################*/
		/* METODOS PERSONALIZADOS */
		/*########################*/	

		public function existeObjetivo()
		{			
			try {							
				if($this->getIdCoordinadorSistema()<0)
					throw new Exception("No se selecciono el coordinador de referencia");		

				if(empty($this->getObjetivo()))
					throw new Exception("No se cargo el objetivo");		

				$query = "SELECT * FROM coordinador_objetivo WHERE id_coordinador_sistema='".$this->getIdCoordinadorSistema()."' AND objetivo=".$this->getObjetivo()." AND estado='true'";
				
				//echo $query;
				//exit();

				# Ejecucion 				
				$result = SQL::selectObject($query, new CoordinadorObjetivo);
						
				return $result;
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());
						
			}

		}	

		public function limpiarTabla($conexion)
		{			
			try {											
				$query = "DELETE FROM coordinador_objetivo";
				
				# Ejecucion 	
				return SQL::delete($conexion,$query);			
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());
						
			}

		}	

	}
?>