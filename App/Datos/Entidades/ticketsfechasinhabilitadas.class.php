<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";

	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'BaseDatos/sql.class.php';

	class TicketsFechasInhabilitadas
	{			
		/*#####################################*/
		/* DECLARACIONES / GETTERS AND SETTERS */
		/*#####################################*/

		private $_id;
		public function getId(){ return $this->_id; }
		public function setId($id){ $this->_id =$id; }

		private $_fecha;
		public function getFecha(){ return $this->_fecha; }
		public function setFecha($fecha){ $this->_fecha=$fecha; }

		private $_motivo;
		public function getMotivo(){ return $this->_motivo; }
		public function setMotivo($motivo){ $this->_motivo=$motivo; }

		private $_estado;
		public function getEstado(){ return var_export($this->_estado,true); }
		public function setEstado($estado){ $this->_estado=$estado; }			

		/*#############*/
		/* CONSTRUCTOR */
		/*#############*/

		function __construct(){
			$this->setId(0);
			$this->setFecha('');	
			$this->setMotivo('');
			$this->setEstado(true);
		}

		/*###################*/
		/* METODOS GENERICOS */
		/*###################*/

		public function insert($conexion)
		{
			try {

				# Validaciones 			
				if(empty($this->getFecha()))
					throw new Exception("Fecha Vacia");

				# Query 			
				$query="INSERT INTO tickets_fechas_inhabilitadas (
		        						fecha,				        						
		        						motivo,
		        						estado
	        			) VALUES (
	        							'".$this->getFecha()."',     		        							
	        							'".$this->getMotivo()."',     		        							
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
					throw new Exception("Fecha no identificada");
	
				if(empty($this->getFecha()))
					throw new Exception("Fecha Vacia");

				
				# Query 			
				$query="UPDATE tickets_fechas_inhabilitadas SET
								fecha='".$this->getFecha()."',													
								motivo='".$this->getMotivo()."',													
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
					throw new Exception("Fecha no identificada");
			
				# Query 			
				$query="UPDATE tickets_fechas_inhabilitadas SET							
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
					$query = "SELECT * FROM tickets_fechas_inhabilitadas WHERE estado='true'";
				}
				else
				{
					if(empty($this->getId()))
						throw new Exception("Fecha no identificada");		

					$query="SELECT * FROM tickets_fechas_inhabilitadas WHERE id=".$this->getId();
				}
				
				# Ejecucion 					
				$result = SQL::selectObject($query, new TicketsFechasInhabilitadas);
						
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
				$this->setMotivo($filas['motivo']);				
				$this->setEstado($filas['estado']);
			}
		}

		private function cleanClass()
		{
			$this->setId(0);
			$this->setFecha('');		
			$this->setMotivo('');					
			$this->setEstado(true);
		}

		private function createTable()
		{
			return 'CREATE TABLE IF NOT EXISTS';
		}

		/*########################*/
		/* METODOS PERSONALIZADOS */
		/*########################*/
	
		public function selecionarFechasInhabilitadasByFecha($fecha){
			try {
				
				if(empty($fecha))
					throw new Exception("Fecha vacia");
					

				$query="SELECT * FROM tickets_fechas_inhabilitadas WHERE fecha='".$fecha."' AND estado='true'";

				//echo $query;
				//exit;

				# Ejecucion 					
				$result = SQL::selectArray_2($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());			
			}
		}
	}
?>