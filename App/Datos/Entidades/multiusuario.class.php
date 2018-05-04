<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";

	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'BaseDatos/sql.class.php';
	include_once PATH_DATOS.'Entidades/usuario.class.php';
	include_once PATH_DATOS.'Entidades/tipousuario.class.php';

	class Multiusuario
	{				
		/*#####################################*/
		/* DECLARACIONES / GETTERS AND SETTERS */
		/*#####################################*/

		private $_id;
		public function getId(){ return $this->_id; }
		public function setId($id){ $this->_id =$id; }

		private $_usuario;
		public function getUsuario(){ return $this->_usuario; }
		public function setUsuario($usuario){ $this->_usuario=$usuario; }	

		private $_tipoUsuario;
		public function getTipoUsuario(){ return $this->_tipoUsuario; }
		public function setTipoUsuario($tipoUsuario){ $this->_tipoUsuario=$tipoUsuario; }

		private $_userSistema;
		public function getUserSistema(){ return $this->_userSistema; }
		public function setUserSistema($userSistema){ $this->_userSistema=$userSistema; }

		private $_aliasUserSistema;
		public function getAliasUserSistema(){ return $this->_aliasUserSistema; }
		public function setAliasUserSistema($aliasUserSistema){ $this->_aliasUserSistema=$aliasUserSistema; }

		private $_estado;
		public function getEstado(){ return var_export($this->_estado,true); }
		public function setEstado($estado){ $this->_estado=$estado; }	

		/*#############*/
		/* CONSTRUCTOR */
		/*#############*/

		function __construct(){
			$this->setId(0);
			$this->setUsuario(new Usuario());			
			$this->setTipoUsuario(new TipoUsuario);
			$this->setUserSistema(0);
			$this->setAliasUserSistema('');
			$this->setEstado(true);				
		}

		/*###################*/
		/* METODOS GENERICOS */
		/*###################*/

		public function insert($conexion)
		{
			try {
							
				# Validaciones 			
				if(empty($this->getUsuario()))
					throw new Exception("Usuario vacio");
				
				if(empty($this->getTipoUsuario()))
					throw new Exception("Tipo de Usuario vacio");

				if(empty($this->getAliasUserSistema()))
					throw new Exception("Alias de Usuario vacio");

				# Query 			
				$query="INSERT INTO multiusuario (
		        						id_usuario,
		        						id_tipo_usuario,
		        						id_user_sistema,
		        						alias_user_sistema,		        								        						
		        						estado
	        			) VALUES (
	        							".$this->getUsuario()->getId().",
	        							".$this->getTipoUsuario()->getId().",
	        							".$this->getUserSistema().",
	        							'".$this->getAliasUserSistema()."',	        							
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
					throw new Exception("Asociación usuario no identificada");
		
				if(empty($this->getUsuario()))
					throw new Exception("Usuario vacio");
				
				if(empty($this->getTipoUsuario()))
					throw new Exception("Tipo de Usuario vacio");

				if(empty($this->getAliasUserSistema()))
					throw new Exception("Alias de Usuario vacio");		

				
				# Query 			
				$query="UPDATE multiusuario SET
								id_usuario=".$this->getUsuario()->getId().",
	        					id_tipo_usuario=".$this->getTipoUsuario()->getId().",
	        					id_user_sistema=".$this->getUserSistema().",
	        					alias_user_sistema='".$this->getAliasUserSistema()."',	  		        													
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
					throw new Exception("Asociación usuario no identificada");

				# Query 			
				$query="UPDATE multiusuario SET							
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
					$query = "SELECT * FROM multiusuario WHERE estado='true'";					
				}
				else{
					if(empty($this->getId()))
						throw new Exception("No se selecciono el Id de asociación de usuario");		

					$query="SELECT * FROM multiusuario WHERE id=".$this->getId();
				}

				# Ejecucion 				
				$result = SQL::selectObject($query, new Multiusuario);
						
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
				$u->setId($filas['id_usuario']);
				$u = $u->select();
				$this->setUsuario($u);

				$tu = new TipoUsuario;
				$tu->setId($filas['id_tipo_usuario']);
				$tu = $tu->select();
				$this->setTipoUsuario($tu);

				$this->setUserSistema($filas['id_user_sistema']);
				$this->setAliasUserSistema(trim($filas['alias_user_sistema']));
				$this->setEstado($filas['estado']);
			}
		}

		private function cleanClass()
		{
			$this->setId(0);
			$this->setUsuario(new Usuario());			
			$this->setTipoUsuario(new TipoUsuario);
			$this->setUserSistema(0);
			$this->setAliasUserSistema('');
			$this->setEstado(true);				
		}

		private function createTable()
		{
			return 'CREATE TABLE IF NOT EXISTS';
		}

		/*########################*/
		/* METODOS PERSONALIZADOS */
		/*########################*/	

		public function selectByUsuario($usuario){
			try {
				
				if(empty($usuario))
					throw new Exception("Usuario Vacio");					

				$query = "SELECT * FROM multiusuario WHERE estado='true' AND id_usuario=".$usuario;

				# Ejecucion 				
				$result = SQL::selectObject($query, new Multiusuario);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}
			
		}

	}
?>







