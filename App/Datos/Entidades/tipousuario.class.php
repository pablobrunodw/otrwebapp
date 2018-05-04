<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";

	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'BaseDatos/sql.class.php';

	class TipoUsuario
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
		
		private $_tipoClave;
		public function getTipoClave(){ return $this->_tipoClave; }
		public function setTipoClave($tipoClave){ $this->_tipoClave=$tipoClave; }

		private $_estado;
		public function getEstado(){ return var_export($this->_estado,true); }
		public function setEstado($estado){ $this->_estado=$estado; }			

		/*#############*/
		/* CONSTRUCTOR */
		/*#############*/

		function __construct(){
			$this->setId(0);
			$this->setNombre('');						
			$this->setTipoClave('');
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
					throw new Exception("Nombre vacio");
				
				# Query 			
				$query="INSERT INTO tipo_usuario (
		        						nombre,					
		        						tipo_clave,
		        						estado
	        			) VALUES (
	        							'".$this->getNombre()."',   	
	        							'".$this->getTipoClave()."',   	
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
					throw new Exception("Tipo de usuario no identificado");

				if(empty($this->getNombre()))
					throw new Exception("Nombre vacio");
				
				# Query 			
				$query="UPDATE tipo_usuario SET
								nombre='".$this->getNombre()."',
								tipo_clave='".$this->getTipoClave()."',						
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
					throw new Exception("Tipo de usuario no identificado");
			
				# Query 			
				$query="UPDATE tipo_usuario SET							
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
					$query = "SELECT * FROM tipo_usuario WHERE estado='true' ORDER BY orden ASC";
				}
				else
				{
					if(empty($this->getId()))
						throw new Exception("No se selecciono el Id del tipo de usuario");		

					$query="SELECT * FROM tipo_usuario WHERE id=".$this->getId()." ORDER BY orden ASC";
				}
				
				# Ejecucion 					
				$result = SQL::selectObject($query, new TipoUsuario);
				
				///var_dump($query);
				//exit();

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
				$this->setTipoClave(trim($filas['tipo_clave']));		
				$this->setEstado($filas['estado']);
			}
		}

		private function cleanClass()
		{
			$this->setId(0);
			$this->setNombre('');					
			$this->setTipoClave('');					
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