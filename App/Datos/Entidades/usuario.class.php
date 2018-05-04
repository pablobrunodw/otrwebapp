<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";

	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'BaseDatos/sql.class.php';
	include_once PATH_DATOS.'Entidades/usuarioperfil.class.php';
	include_once PATH_DATOS.'Entidades/tipousuario.class.php';
	include_once PATH_DATOS.'Entidades/multiusuario.class.php';

	class Usuario
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

		private $_apellido;
		public function getApellido(){ return $this->_apellido; }
		public function setApellido($apellido){ $this->_apellido=$apellido; }

		private $_email;
		public function getEmail(){ return $this->_email; }
		public function setEmail($email){ $this->_email=$email; }

		private $_password;
		public function getPassword(){ return $this->_password; }
		public function setPassword($password){ 
			$this->_password = md5($password); 
		}

		private $_estado;
		public function getEstado(){ return var_export($this->_estado,true); }
		public function setEstado($estado){ $this->_estado=$estado; }		

		private $_fotoPerfil;
		public function getFotoPerfil(){ return $this->_fotoPerfil; }
		public function setFotoPerfil($fotoPerfil){ $this->_fotoPerfil=$fotoPerfil; }

		private $_usuarioPerfil;
		public function getUsuarioPerfil(){ return $this->_usuarioPerfil; }
		public function setUsuarioPerfil($usuarioPerfil){ $this->_usuarioPerfil=$usuarioPerfil; }

		private $_tipoUsuario;
		public function getTipoUsuario(){ return $this->_tipoUsuario; }
		public function setTipoUsuario($tipoUsuario){ $this->_tipoUsuario=$tipoUsuario; }

		private $_userSistema;
		public function getUserSistema(){ return $this->_userSistema; }
		public function setUserSistema($userSistema){ $this->_userSistema=$userSistema; }

		private $_aliasUserSistema;
		public function getAliasUserSistema(){ return $this->_aliasUserSistema; }
		public function setAliasUserSistema($aliasUserSistema){ $this->_aliasUserSistema=$aliasUserSistema; }

		private $_passwordAux;
		public function getPasswordAux(){ return $this->_passwordAux; }
		public function setPasswordAux($passwordAux){ $this->_passwordAux = $passwordAux; }

		/*#############*/
		/* CONSTRUCTOR */
		/*#############*/

		function __construct(){
			$this->setId(0);
			$this->setNombre('');
			$this->setApellido('');
			$this->setEmail('');
			$this->setPassword('');			
			$this->setFotoPerfil('');
			$this->setUsuarioPerfil(new UsuarioPerfil);
			$this->setTipoUsuario(new TipoUsuario);
			$this->setUserSistema(0);
			$this->setAliasUserSistema('');
			$this->setEstado(true);		
			$this->setPasswordAux('');				
		}

		/*###################*/
		/* METODOS GENERICOS */
		/*###################*/

		public function insert($conexion)
		{
			try {
							
				# Validaciones 			
				if(empty($this->getEmail()))
					throw new Exception("Email vacio");
				
				# Query 			
				$query="INSERT INTO usuario (
		        						nombre,
		        						apellido,
		        						email,
		        						password,
		        						foto_perfil,	        						
		        						id_usuario_perfil,
		        						estado,
		        						password_aux
	        			) VALUES (
	        							'".$this->getNombre()."',
	        							'".$this->getApellido()."',
	        							'".$this->getEmail()."',
	        							'".$this->getPassword()."',
	        							'".$this->getFotoPerfil()."',
	        							".$this->getUsuarioPerfil()->getId().",	        							
	        							'".$this->getEstado()."',
	        							'".$this->getPasswordAux()."'
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
					throw new Exception("Usuario no identificado");

				if(empty($this->getEmail()))
					throw new Exception("Email vacio");			

				
				# Query 			
				$query="UPDATE usuario SET
								nombre='".$this->getNombre()."', 
								apellido='".$this->getApellido()."', 
								email='".$this->getEmail()."', 							
								foto_perfil='".$this->getFotoPerfil()."', 
								id_usuario_perfil=".$this->getUsuarioPerfil()->getId().",
								estado='".$this->getEstado()."',
								password='".$this->getPassword()."', 	
								password_aux='".$this->getPasswordAux()."'	
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
					throw new Exception("Usuario no identificado");

				# Query 			
				$query="UPDATE usuario SET							
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
					$query = "SELECT * FROM usuario WHERE estado='true'";
				}
				else{
					if(empty($this->getId()))
						throw new Exception("No se selecciono el Id del usuario");		

					$query="SELECT * FROM usuario WHERE id=".$this->getId();
				}

				# Ejecucion 				
				$result = SQL::selectObject($query, new Usuario);
						
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
				$this->setApellido(trim($filas['apellido']));
				$this->setEmail(trim($filas['email']));
				$this->setPassword(trim($filas['password']));
				$this->setFotoPerfil(trim($filas['foto_perfil']));				

				$this->setPasswordAux(trim($filas['password_aux']));

				$up = new UsuarioPerfil;
				$up->setId($filas['id_usuario_perfil']);
				$up = $up->select();								
				$this->setUsuarioPerfil($up);

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
			$this->setNombre('');
			$this->setApellido('');
			$this->setEmail('');
			$this->setPassword('');			
			$this->setFotoPerfil('');
			$this->setUsuarioPerfil(new UsuarioPerfil);
			$this->setTipoUsuario(new TipoUsuario);
			$this->setUserSistema(0);
			$this->setAliasUserSistema('');
			$this->setEstado(true);	

			$this->setPasswordAux('');				
		}

		private function createTable()
		{
			return 'CREATE TABLE IF NOT EXISTS';
		}

		/*########################*/
		/* METODOS PERSONALIZADOS */
		/*########################*/
		public function updatePassword($conexion)
		{			
			# Validaciones 			
			if(empty($this->getId()))
				throw new Exception("Usuario no identificado");

			if(empty($this->getPassword()))
				throw new Exception("La clave no puede estar vacia");
			
			# Query 			
			$query="UPDATE usuario SET
							password='".$this->getPassword()."',
							password_aux='".$this->getPasswordAux()."'
						WHERE id=".$this->getId();

			# Ejecucion 			
			return SQL::update($conexion,$query);
		}

		public function selectByLogin($email, $password)
		{
			# Validaciones 			
			if(empty($email))
				throw new Exception("Email vacio");

			if(empty($password))
				throw new Exception("Password vacia");
						
			# Query 			
			$query = "SELECT * FROM usuario WHERE email='".$email."' AND password='".md5($password)."' AND estado='true'";
			//$query = "SELECT * FROM usuario WHERE email='".$email."' AND password='".$password."' AND estado='true'";

			# Ejecucion 			
			$result = SQL::selectObject($query, new Usuario);
					
			return $result;			
		}

		public function selectByEmail($email)
		{
			# Validaciones 			
			if(empty($email))
				throw new Exception("Email vacio");
				
			# Query 							
			$query = "SELECT TOP 1 * FROM usuario WHERE email='".$email."' AND estado='true'";

			# Ejecucion 			
			$result = SQL::selectObject($query, new Usuario);

			return $result;			
		}

		public function selectByPerfil($perfil)
		{
			# Validaciones 			
			if(empty($perfil))
				throw new Exception("Perfil vacio");
				
			# Query 							
			$query = "SELECT usuario.* FROM usuario 
						INNER JOIN usuario_perfil ON
							usuario_perfil.id=usuario.id_usuario_perfil
						WHERE usuario_perfil.nombre='".$perfil."' AND usuario.estado='true'";

			//echo $query;
			//exit();

			# Ejecucion 			
			$result = SQL::selectObject($query, new Usuario);

			return $result;			
		}

		public function getMultiusuario(){
			$m = new Multiusuario;

			return $m->selectByUsuario($this->getId());
		}

		public function updateUserActivo($conexion)
		{		
			try {

				# Validaciones 			
				if(empty($this->getId()))
					throw new Exception("Usuario no identificado");	
				
				# Query 			
				$query="UPDATE usuario SET
								id_tipo_usuario=".$this->getTipoUsuario()->getId().",
								id_user_sistema=".$this->getUserSistema().",
								alias_user_sistema='".$this->getAliasUserSistema()."'								
							WHERE id=".$this->getId();

				# Ejecucion
				return SQL::update($conexion,$query);	

			} catch (Exception $e) {
				throw new Exception($e->getMessage());		
			}					
		}
	}
?>







