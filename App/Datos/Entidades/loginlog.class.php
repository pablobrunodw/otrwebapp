<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";

	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'BaseDatos/sql.class.php';

	include_once PATH_DATOS.'Entidades/usuario.class.php';

	class LoginLog
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

		private $_ip;
		public function getIp(){ return $this->_ip; }
		public function setIp($ip){ $this->_ip=$ip; }

		private $_detalle;
		public function getDetalle(){ return $this->_detalle; }
		public function setDetalle($detalle){ $this->_detalle=$detalle; }

		private $_latitud;
		public function getLatitud(){ return $this->_latitud; }
		public function setLatitud($latitud){ $this->_latitud=$latitud; }

		private $_longitud;
		public function getLongitud(){ return $this->_longitud; }
		public function setLongitud($longitud){ $this->_longitud=$longitud; }

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
			$this->setIp('');
			$this->setDetalle('');
			$this->setLatitud('');
			$this->setLongitud('');
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
				
				# Query 			
				$query="INSERT INTO login_log (
		        						usuario_id,					
		        						fecha_hora,
		        						ip,
		        						detalle,
		        						latitud,
		        						longitud,
		        						estado
	        			) VALUES (
	        							".$this->getUsuarioId().",   	
	        							'".$this->getFechaHora()."',   	
	        							'".$this->getIp()."',   	
	        							'".$this->getDetalle()."',   	
	        							'".$this->getLatitud()."',   	
	        							'".$this->getLongitud()."',   	
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
					throw new Exception("Login log no identificado");

				if(empty($this->getUsuarioId()))
					throw new Exception("Usuario vacio");
				
				# Query 			
				$query="UPDATE login_log SET
								usuario_id=".$this->getUsuarioId().",
								fecha_hora='".$this->getFechaHora()."',
								ip='".$this->getIp()."',
								detalle='".$this->getDetalle()."',
								latitud='".$this->getLatitud()."',
								longitud='".$this->getLongitud()."',
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
					throw new Exception("Login log no identificado");
			
				# Query 			
				$query="UPDATE login_log SET							
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
					$query = "SELECT * FROM login_log WHERE estado='true' ORDER BY fecha_hora DESC";
				}
				else
				{
					if(empty($this->getId()))
						throw new Exception("No se selecciono el Id de login log");		

					$query="SELECT * FROM login_log WHERE id=".$this->getId()." ORDER BY fecha_hora DESC";
				}
				
				# Ejecucion 					
				$result = SQL::selectObject($query, new loginlog);
						
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
				$this->setIp(trim($filas['ip']));
				$this->setDetalle(trim($filas['detalle']));
				$this->setLatitud(trim($filas['latitud']));
				$this->setLongitud(trim($filas['longitud']));
				$this->setEstado($filas['estado']);
			}
		}

		private function cleanClass()
		{
			$this->setId(0);
			$this->setUsuarioId(new Usuario);						
			$this->setFechaHora('');
			$this->setIp('');
			$this->setDetalle('');
			$this->setLatitud('');
			$this->setLongitud('');			
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
					$query="SELECT TOP 1 * FROM login_log WHERE estado='true' AND usuario_id=".$usuario_id." ORDER BY fecha_hora DESC";
				}
				else
				{			
					throw new Exception("No se selecciono el usuario.");							
				}

				//echo $query;
				//exit();
				
				# Ejecucion 					
				$result = SQL::selectObject($query, new loginlog);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());						
			}

		}
	}
?>