<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";

	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'BaseDatos/sql.class.php';

	include_once PATH_DATOS.'Entidades/usuario.class.php';

	class Guias
	{			
		/*#####################################*/
		/* DECLARACIONES / GETTERS AND SETTERS */
		/*#####################################*/

		private $_id;
		public function getId(){ return $this->_id; }
		public function setId($id){ $this->_id =$id; }		
		
		private $_usuarioId;
		public function getUsuarioId(){ return $this->_usuarioId; }
		public function setUsuarioId($usuario_id){ $this->_usuarioId=$usuario_id; }

		private $_fechaHora;
		public function getFechaHora(){ return $this->_fechaHora; }
		public function setFechaHora($fechaHora){ $this->_fechaHora=$fechaHora; }		

		private $_imagen;
		public function getImagen(){ return $this->_imagen; }
		public function setImagen($imagen){ $this->_imagen=$imagen; }
		
		private $_observaciones;
		public function getObservaciones(){ return $this->_observaciones; }
		public function setObservaciones($observaciones){ $this->_observaciones=$observaciones; }

		private $_empresa_sistema;
		public function getEmpresaSistema(){ return $this->_empresaSistema; }
		public function setEmpresaSistema($empresaSistema){ $this->_empresaSistema=$empresaSistema; }

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
			$this->setUsuarioId(new Usuario);			
			$this->setFechaHora('');
			$this->setImagen('');
			$this->setObservaciones('');
			$this->setEmpresaSistema('');	
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
				if(empty($this->getUsuarioId()))
					throw new Exception("Usuario Vacio");	

				if(empty($this->getFechaHora()))
					throw new Exception("Fecha Vacia");	

				if(empty($this->getImagen()))
					throw new Exception("Imagen Vacia");					
				
				# Query 			
				$query="INSERT INTO guias (
		        						usuario_id,
		        						fecha_hora,		        						
		        						imagen,		        						
		        						observaciones,
		        						empresa_sistema,    
		        						plaza,   						
		        						estado
	        			) VALUES (
	        							".$this->getUsuarioId().",   	
	        							'".$this->getFechaHora()."',   	
	        							'".$this->getImagen()."',   		        							
	        							'".$this->getObservaciones()."',   	
	        							".$this->getEmpresaSistema().",   	
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
					throw new Exception("Guía no identificada");

				if(empty($this->getUsuarioId()))
					throw new Exception("Usuario Vacio");	

				if(empty($this->getFechaHora()))
					throw new Exception("Fecha Vacia");	

				if(empty($this->getImagen()))
					throw new Exception("Imagen Vacia");	

				# Query 			
				$query="UPDATE guias SET
								usuario_id=".$this->getUsuarioId().",
								fecha_hora='".$this->getFechaHora()."',
								imagen='".$this->getImagen()."',								
								observaciones='".$this->getObservaciones()."',
								empresa_sistema=".$this->getEmpresaSistema().",
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
					throw new Exception("Guía no identificada");
			
				# Query 			
				$query="UPDATE guias SET							
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
					$query = "SELECT * FROM guias WHERE estado='true' ORDER BY fecha_hora DESC";
				}
				else
				{
					if(empty($this->getId()))
						throw new Exception("No se selecciono el Id de la guía");		

					$query="SELECT * FROM guias WHERE id=".$this->getId()." ORDER BY fecha_hora DESC";
				}
				
				# Ejecucion 					
				$result = SQL::selectObject($query, new Guias);
						
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

				$u = new Usuario;
				$u->setId($filas['usuario_id']);			
				$u = $u->select();
				$this->setUsuarioId($u);					

				$this->setFechaHora($filas['fecha_hora']);				
				$this->setImagen(trim($filas['imagen']));				
				$this->setObservaciones(trim($filas['observaciones']));	
				$this->setEmpresaSistema($filas['empresa_sistema']);			

				$this->setPlaza(trim($filas['plaza']));	
				
				$this->setEstado($filas['estado']);
			}
		}

		private function cleanClass()
		{
			$this->setId(0);
			$this->setUsuarioId(new Usuario);			
			$this->setFechaHora('');
			$this->setImagen('');
			$this->setObservaciones('');		
			$this->setEmpresaSistema('');
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
		
		public function selectByUsuario($usuario_id)
		{			
			try {
											
				# Query
				if(!empty($usuario_id))
				{
					$query="SELECT * FROM guias WHERE estado='true' AND usuario_id=".$usuario_id." ORDER BY fecha_hora DESC";
				}
				else
				{			
					throw new Exception("No se selecciono el usuario.");							
				}

				//echo $query;
				//exit();
				
				# Ejecucion 					
				$result = SQL::selectObject($query, new Guias);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());						
			}

		}		

		public function getUrlGuias(){
			try {
								
				return BASE_URL.PATH_UPLOADGUIAS.$this->getImagen();

			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}
		}
	}
?>