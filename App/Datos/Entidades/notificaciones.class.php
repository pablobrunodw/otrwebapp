<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";

	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'BaseDatos/sql.class.php';

	include_once PATH_DATOS.'Entidades/usuario.class.php';

	class Notificaciones
	{			
		/*#####################################*/
		/* DECLARACIONES / GETTERS AND SETTERS */
		/*#####################################*/

		private $_id;
		public function getId(){ return $this->_id; }
		public function setId($id){ $this->_id =$id; }

		private $_fechaHora;
		public function getFechaHora(){ return $this->_fechaHora; }
		public function setFechaHora($fechaHora){ $this->_fechaHora=$fechaHora; }		

		private $_usuarioId;
		public function getUsuarioId(){ return $this->_usuarioId; }
		public function setUsuarioId($usuario_id){ $this->_usuarioId=$usuario_id; }
		
		private $_origen;
		public function getOrigen(){ return $this->_origen; }
		public function setOrigen($origen){ $this->_origen=$origen; }

		private $_detalle;
		public function getDetalle(){ return $this->_detalle; }
		public function setDetalle($detalle){ $this->_detalle=$detalle; }

		private $_estado;
		public function getEstado(){ return var_export($this->_estado,true); }
		public function setEstado($estado){ $this->_estado=$estado; }			

		private $_empresa_sistema;
		public function getEmpresaSistema(){ return $this->_empresaSistema; }
		public function setEmpresaSistema($empresaSistema){ $this->_empresaSistema=$empresaSistema; }		

		private $_plaza;
		public function getPlaza(){ return $this->_plaza; }
		public function setPlaza($plaza){ $this->_plaza=$plaza; }

		/*#############*/
		/* CONSTRUCTOR */
		/*#############*/

		function __construct(){
			$this->setId(0);
			$this->setUsuarioId(new Usuario);						
			$this->setFechaHora('');			
			$this->setOrigen('');			
			$this->setDetalle('');			
			$this->setEstado(true);
			$this->setEmpresaSistema('');	
			$this->setPlaza('');
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

				if(empty($this->getOrigen()))
					throw new Exception("Origen Vacio");				
				
				# Query 			
				$query="INSERT INTO notificaciones (
		        						usuario_id,		
		        						fecha_hora,			
		        						origen,		        						
		        						detalle,		  
		        						empresa_sistema,      	
		        						plaza,					
		        						estado
	        			) VALUES (
	        							".$this->getUsuarioId().",   	
	        							'".$this->getFechaHora()."',   
	        							'".$this->getOrigen()."',   		        							
	        							'".$this->getDetalle()."',   
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
					throw new Exception("Notificación no identificada");

				if(empty($this->getUsuarioId()))
					throw new Exception("Usuario vacio");

				if(empty($this->getOrigen()))
					throw new Exception("Origen Vacio");						
				
				# Query 			
				$query="UPDATE notificaciones SET
								usuario_id=".$this->getUsuarioId().",
								fecha_hora='".$this->getFechaHora()."',								
								origen='".$this->getOrigen()."',								
								detalle='".$this->getDetalle()."',	
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
					throw new Exception("Notificación no identificada");
			
				# Query 			
				$query="UPDATE notificaciones SET							
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
					$query = "SELECT * FROM notificaciones WHERE estado='true' ORDER BY fecha_hora DESC";
				}
				else
				{
					if(empty($this->getId()))
						throw new Exception("No se selecciono el Id de notificación");		

					$query="SELECT * FROM notificaciones WHERE id=".$this->getId();
				}
				
				# Ejecucion 					
				$result = SQL::selectObject($query, new Notificaciones);
						
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
				$this->setOrigen($filas['origen']);				
				$this->setDetalle(trim($filas['detalle']));				
				$this->setEstado($filas['estado']);

				$this->setEmpresaSistema($filas['empresa_sistema']);		
				$this->setPlaza(trim($filas['plaza']));		
			}
		}

		private function cleanClass()
		{
			$this->setId(0);
			$this->setUsuarioId(new Usuario);						
			$this->setFechaHora('');			
			$this->setOrigen('');			
			$this->setDetalle('');			
			$this->setEstado(true);
			$this->setEmpresaSistema('');
			$this->setPlaza('');
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
					$query="SELECT * FROM notificaciones WHERE estado='true' AND usuario_id=".$usuario_id." ORDER BY fecha_hora DESC";
				}
				else
				{			
					throw new Exception("No se selecciono el usuario.");							
				}

				//echo $query;
				//exit();
				
				# Ejecucion 					
				$result = SQL::selectObject($query, new Notificaciones);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());						
			}

		}

		public function selectByEmpresa($empresa_sistema)
		{			
			try {
											
				# Query
				if(!empty($empresa_sistema))
				{
					$query="SELECT * FROM notificaciones WHERE estado='true' AND empresa_sistema=".$empresa_sistema." ORDER BY fecha_hora DESC";
				}
				else
				{			
					throw new Exception("No se selecciono la empresa.");							
				}

				//echo $query;
				//exit();
				
				# Ejecucion 					
				$result = SQL::selectObject($query, new Notificaciones);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());						
			}

		}		
	}
?>