<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";

	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'BaseDatos/sql.class.php';	

	class SupervisorObjetivo
	{				
		/*#####################################*/
		/* DECLARACIONES / GETTERS AND SETTERS */
		/*#####################################*/

		private $_id;
		public function getId(){ return $this->_id; }
		public function setId($id){ $this->_id =$id; }

		private $_idSupervisorSistema;
		public function getIdSupervisorSistema(){ return $this->_idSupervisorSistema; }
		public function setIdSupervisorSistema($idSupervisorSistema){ $this->_idSupervisorSistema=$idSupervisorSistema; }

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
			$this->setIdSupervisorSistema(0);			
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
				if($this->getIdSupervisorSistema()<0)
					throw new Exception("Supervisor sistema vacia");

				if(empty($this->getObjetivo()))
					throw new Exception("Objetivo vacio");
				
				# Query 			
				$query="INSERT INTO supervisor_objetivo (
		        						id_supervisor_sistema,
		        						objetivo,
		        						estado
	        			) VALUES (
	        							".$this->getIdSupervisorSistema().",
	        							".$this->getObjetivo().",
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
					throw new Exception("Objetivo no identificado");

				if($this->getIdSupervisorSistema()<0)
					throw new Exception("Supervisor sistema vacia");

				if(empty($this->getObjetivo()))
					throw new Exception("Objetivo vacio");
				
				# Query 			
				$query="UPDATE supervisor_objetivo SET
								id_supervisor_sistema=".$this->getIdSupervisorSistema().", 
								objetivo=".$this->getObjetivo().", 
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
					throw new Exception("Objetivo no identificado");

				# Query 			
				$query="UPDATE supervisor_objetivo SET							
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

					if($this->getIdSupervisorSistema()<0)
						throw new Exception("No se selecciono el supervisor de referencia");		

					$query = "SELECT * FROM supervisor_objetivo WHERE id_supervisor_sistema=".$this->getIdSupervisorSistema()." AND estado='true'";
				}
				else{
					if(empty($this->getId()))
						throw new Exception("No se selecciono el Id del supervisor");		

					$query="SELECT * FROM supervisor_objetivo WHERE id=".$this->getId();
				}

				//echo $query;
				//exit();

				# Ejecucion 				
				$result = SQL::selectObject($query, new SupervisorObjetivo);
						
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
				$this->setIdSupervisorSistema(trim($filas['id_supervisor_sistema']));
				$this->setObjetivo(trim($filas['objetivo']));											
				$this->setEstado($filas['estado']);
			}
		}

		private function cleanClass()
		{
			$this->setId(0);
			$this->setIdSupervisorSistema(0);
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
				if($this->getIdSupervisorSistema()<0)
					throw new Exception("No se selecciono el supervisor de referencia");		

				if(empty($this->getObjetivo()))
					throw new Exception("No se cargo el objetivo");		

				$query = "SELECT * FROM supervisor_objetivo WHERE id_supervisor_sistema=".$this->getIdSupervisorSistema()." AND objetivo=".$this->getObjetivo()." AND estado='true'";
				
				//echo $query;
				//exit();

				# Ejecucion 				
				$result = SQL::selectObject($query, new SupervisorObjetivo);
						
				return $result;
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());
						
			}

		}	

		public function limpiarTabla($conexion)
		{			
			try {											
				$query = "DELETE FROM supervisor_objetivo";
				
				# Ejecucion 	
				return SQL::delete($conexion,$query);			
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());
						
			}

		}	

	}
?>