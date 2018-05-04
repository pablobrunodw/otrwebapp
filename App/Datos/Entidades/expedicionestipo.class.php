<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";

	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'BaseDatos/sql.class.php';

	class ExpedicionesTipo
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

		private $_grupo;
		public function getGrupo(){ return $this->_grupo; }
		public function setGrupo($grupo){ $this->_grupo=$grupo; }

		private $_estado;
		public function getEstado(){ return var_export($this->_estado,true); }
		public function setEstado($estado){ $this->_estado=$estado; }			

		/*#############*/
		/* CONSTRUCTOR */
		/*#############*/

		function __construct(){
			$this->setId(0);			
			$this->setNombre('');
			$this->setGrupo('');			
			$this->setEstado(true);
		}

		/*###################*/
		/* METODOS GENERICOS */
		/*###################*/

		public function insert($conexion)
		{
			try {

				# Validaciones 			
				if(empty($this->getGrupo()))
					throw new Exception("Grupo Vacio");

				if(empty($this->getNombre()))
					throw new Exception("Nombre Vacio");
				
				# Query 			
				$query="INSERT INTO expediciones_tipo (		        						
		        						nombre,		        						
		        						grupo,		        						
		        						estado
	        			) VALUES (	        							
	        							'".$this->getNombre()."',   	
	        							'".$this->getGrupo()."',   		        							
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
					throw new Exception("Tipo de expedición no identificado");

				if(empty($this->getGrupo()))
					throw new Exception("Grupo Vacio");				

				if(empty($this->getNombre()))
					throw new Exception("Nombre Vacio");
								
				# Query 			
				$query="UPDATE expediciones_tipo SET								
								nombre='".$this->getNombre()."',
								grupo='".$this->getGrupo()."',								
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
					throw new Exception("Tipo de expedición no identificado");
			
				# Query 			
				$query="UPDATE expediciones_tipo SET							
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
					$query = "SELECT * FROM expediciones_tipo WHERE estado='true' ORDER BY grupo, nombre";
				}
				else
				{
					if(empty($this->getId()))
						throw new Exception("No se selecciono el Id del tipo de expedición");		

					$query="SELECT * FROM expediciones_tipo WHERE id=".$this->getId();
				}
				
				# Ejecucion 					
				$result = SQL::selectObject($query, new ExpedicionesTipo);
						
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
				$this->setNombre(trim($filas['nombre']));
				$this->setGrupo(trim($filas['grupo']));				
				$this->setEstado($filas['estado']);
			}
		}

		private function cleanClass()
		{
			$this->setId(0);			
			$this->setNombre('');
			$this->setGrupo('');			
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