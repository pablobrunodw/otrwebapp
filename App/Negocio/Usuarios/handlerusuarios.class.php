<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";
		
	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'Entidades/usuario.class.php';	
	include_once PATH_NEGOCIO.'Funciones/Archivo/archivo.class.php';

	class HandlerUsuarios{		

		public function selectTodos(){
			try{			
				$u = new Usuario;
				return $u->select();				
			}
			catch(Exception $e)
			{
				throw new Exception($e->getMessage());	
			}
		}	

		public function selectById($id){
			try{		

				if(empty($id))
					throw new Exception("No se cargo el id del usuario");					

				$u = new Usuario;
				$u->setId($id);
				$user = $u->select();				

				return $user;
			}
			catch(Exception $e)
			{
				throw new Exception($e->getMessage());	
			}
		}	

		public function selectByPerfil($perfil){
			try{		

				if(empty($perfil))
					throw new Exception("No se cargo el perfil del usuario");					

				$u = new Usuario;
				$data = $u->selectByPerfil($perfil);				
	
				if(count($data)==1){
					$data = array('' => $data );                   
					return $data;
				}				
				else{
					return $data;
				}	
			}
			catch(Exception $e)
			{
				throw new Exception($e->getMessage());	
			}
		}	

		public function selectByEmail($email){
			try{
				if(empty($email))
					throw new Exception("No se cargó el email del usuario");
					
				$u=new Usuario;				
				$user = $u->selectByEmail($email);

				return $user;
			}
			catch(Exception $e){
				throw new Exception($e->getMessage());				
			}
		}

		public function insert ($nombre,$apellido,$email,$perfil){
			try {

				$u = new Usuario;
				$u->setNombre($nombre);
				$u->setApellido($apellido);
				$u->setEmail($email);
				$u->setUsuarioPerfil($perfil);				

				$u->insert(null);
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());		
			}
		}

		public function update ($id,$nombre,$apellido,$email,$foto){
			try {

				$u = new Usuario;
				$u->setId($id);
				$u = $u->select();

				$u->setNombre($nombre);
				$u->setApellido($apellido);
				$u->setEmail($email);				
				$u->setFotoPerfil($foto);
				$u->setUsuarioPerfil($u->getUsuarioPerfil());

				$u->update(null);
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());		
			}
		}

		public function delete ($id){
			try {
				
				$u = new Usuario;
				$u->setId($id);

				$u->delete(null);

			} catch (Exception $e) {
				throw new Exception($e->getMessage());			
			}
		}


		public function selectPerfil($id)
		{
			try{
				$u = $this->selectById($id);
				return $u->getUsuarioPerfil();
			}
			catch(Exception $e){
				throw new Exception($e->getMessage());
			}
		}
		
		public function updatePerfil($id,$nombre,$apellido,$foto){
			try{
				if(empty($id))
					throw new Exception("Cargue el id del usuario");				
				
				if(empty($nombre))
					throw new Exception("El nombre no puede estar vacio");

				if(empty($apellido))
					throw new Exception("El apellido no puede estar vacio");				
				
				$u = new Usuario;
				$u->setId($id);
				$u = $u->select();

				//################################//
				//	CARGAR IMAGEN AL SERVIDOR     //
				//################################//						
				$id = $id;
				if($foto["size"]>0)
				{
					if ($foto['size']>3000000)
						throw new Exception('El archivo es mayor que 3MB, debes reduzcirlo antes de subirlo');
						
					if (!($foto['type'] =="image/jpeg" || $foto['type'] =="image/gif" || $foto['type'] =="image/png"))	
						throw new Exception('Tu archivo tiene que ser JPG, PNG o GIF. Otros archivos no son permitidos');
					
					if($foto['type'] =="image/jpeg")
						$extencion = "jpg";

					if($foto['type'] =="image/gif")
						$extencion = "gif";

					if($foto['type'] =="image/png")
						$extencion = "png";

					$path_foto=trim($u->getEmail())."/perfil.".$extencion;
					$path_dir = PATH_ROOT.PATH_CLIENTE.trim($u->getEmail());
					$path_completo=PATH_ROOT.PATH_CLIENTE.$path_foto;	

					$a=new Archivo;
					$a->SubirArchivo($foto['tmp_name'],$path_completo);					
				}

				$u->setEmail($u->getEmail());
				$u->setNombre($nombre);
				$u->setApellido($apellido);				
				$u->setUsuarioPerfil($u->getUsuarioPerfil());

				if(!empty($path_foto))
					$u->setFotoPerfil($path_foto);

				$u->update(false);

			}
			catch(Exception $e)
			{
				throw new Exception($e->getMessage());				
			}
		}		

		public function updateUsuariosAdmin($id,$nombre,$apellido,$foto,$tipousuario,$idusersistema,$aliasusersistema,$perfil,$email,$password){
			try{
				if(empty($id))
					throw new Exception("Cargue el id del usuario");				
				
				if(empty($nombre))
					throw new Exception("El nombre no puede estar vacio");

				if(empty($apellido))
					throw new Exception("El apellido no puede estar vacio");												
				
				$u = new Usuario;
				$u->setId($id);
				$u = $u->select();

				//################################//
				//	CARGAR IMAGEN AL SERVIDOR     //
				//################################//						
				$id = $id;				
				if($foto["size"]>0)
				{
					if ($foto['size']>3000000)
						throw new Exception('El archivo es mayor que 3MB, debes reduzcirlo antes de subirlo');
						
					if (!($foto['type'] =="image/jpeg" || $foto['type'] =="image/gif" || $foto['type'] =="image/png"))	
						throw new Exception('Tu archivo tiene que ser JPG, PNG o GIF. Otros archivos no son permitidos');
					
					if($foto['type'] =="image/jpeg")
						$extencion = "jpg";

					if($foto['type'] =="image/gif")
						$extencion = "gif";

					if($foto['type'] =="image/png")
						$extencion = "png";

					$path_foto=trim($u->getEmail())."/perfil.".$extencion;
					$path_dir = PATH_ROOT.PATH_CLIENTE.trim($u->getEmail());
					$path_completo=PATH_ROOT.PATH_CLIENTE.$path_foto;	

					$a=new Archivo;
					$a->SubirArchivo($foto['tmp_name'],$path_completo);					
				}

				$u->setEmail($u->getEmail());
				$u->setUsuarioPerfil($u->getUsuarioPerfil());

				$u->setEmail($email);
				$u->setNombre($nombre);
				$u->setApellido($apellido);		
				$u->setPassword($password);				
				$u->setPasswordAux($password);					
				$u->setUsuarioPerfil($perfil);				
				
				if(!empty($tipousuario))		
				{
					$u->setTipoUsuario($tipousuario);
					$u->setUserSistema($idusersistema);
					$u->setAliasUserSistema($aliasusersistema);
				}
				else{
					$u->setTipoUsuario($u->getTipoUsuario());
					$u->setUserSistema($u->getUserSistema());
					$u->setAliasUserSistema($u->getAliasUserSistema());	
				}

				if(!empty($path_foto))
					$u->setFotoPerfil($path_foto);

				$u->update(false);

			}
			catch(Exception $e)
			{
				throw new Exception($e->getMessage());				
			}
		}		

		public function insertUsuariosAdmin($nombre,$apellido,$foto,$email,$password,$perfil,$tipousuario,$idusersistema,$aliasusersistema){
			try {

				if(empty($nombre))
					throw new Exception("El nombre no puede estar vacio");

				if(empty($apellido))
					throw new Exception("El apellido no puede estar vacio");	

				$carpeta_user = PATH_ROOT.PATH_CLIENTE.$email;

		        $a = new Archivo;
		        $a->CrearCarpeta($carpeta_user);
			        
				//################################//
				//	CARGAR IMAGEN AL SERVIDOR     //
				//################################//						
				if($foto["size"]>0)
				{
					if ($foto['size']>3000000)
						throw new Exception('El archivo es mayor que 3MB, debes reduzcirlo antes de subirlo');
						
					if (!($foto['type'] =="image/jpeg" || $foto['type'] =="image/gif" || $foto['type'] =="image/png"))	
						throw new Exception('Tu archivo tiene que ser JPG, PNG o GIF. Otros archivos no son permitidos');
					
					if($foto['type'] =="image/jpeg")
						$extencion = "jpg";

					if($foto['type'] =="image/gif")
						$extencion = "gif";

					if($foto['type'] =="image/png")
						$extencion = "png";

					$path_foto=trim($email)."/perfil.".$extencion;
					$path_dir = PATH_ROOT.PATH_CLIENTE.trim($email);
					$path_completo=PATH_ROOT.PATH_CLIENTE.$path_foto;	

					$a=new Archivo;
					$a->SubirArchivo($foto['tmp_name'],$path_completo);					
				}

				$u = new Usuario;
				$u->setNombre($nombre);
				$u->setApellido($apellido);		

				if(isset($path_foto))
					$u->setFotoPerfil($path_foto);
				else
					$u->setFotoPerfil("");

				$u->setEmail($email);
				$u->setPassword($password);				
				$u->setPasswordAux($password);				
				$u->setUsuarioPerfil($perfil);				
				$u->setTipoUsuario($tipousuario);
				$u->setUserSistema($idusersistema);
				$u->setAliasUserSistema($aliasusersistema);
				
				$u->insert(null);
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());		
			}
		}

		public function updateUsuarioSistemaActivo($usuario,$tipousuario,$idusersistema,$aliasusersistema){
			try{
				if(empty($usuario))
					throw new Exception("Cargue el id del usuario");				
				
				if(empty($tipousuario))
					throw new Exception("No se encontró la configuración para el tipo de usuario");				
				
				$u = new Usuario;
				$u->setId($usuario);
				$u = $u->select();
												
				$u->setTipoUsuario($tipousuario);
				$u->setUserSistema($idusersistema);
				$u->setAliasUserSistema($aliasusersistema);
				
				$u->updateUserActivo(false);

			}
			catch(Exception $e)
			{
				throw new Exception($e->getMessage());				
			}
		}		

	}
?>		