<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";
		
	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'Entidades/usuario.class.php';	
	include_once PATH_DATOS.'Entidades/usuarioperfil.class.php';	
	include_once PATH_DATOS.'Entidades/loginlog.class.php';	

	include_once PATH_NEGOCIO."Funciones/Email/email.class.php";
	include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php";
	include_once PATH_NEGOCIO."Funciones/Archivo/archivo.class.php";	
	include_once PATH_NEGOCIO."Funciones/IP/ip.class.php";	

	class AccesoSistema{		

		public function autentificar($email,$password)
		{
			try{
				$u = new Usuario();
				$user = $u->selectByLogin($email,$password);


				if(!empty($user))
				{	

					session_start([
					    'cookie_lifetime' => 2592000,
					    'gc_maxlifetime'  => 2592000,
					]);

			        $_SESSION["logueado"]="SI";
			        $_SESSION["usuario"]=$user->getId();  
			        $_SESSION["pass"]=$user->getPassword();     	        			        
				}
				else
				{
					throw new Exception("Fallo en inicio de session. No se encontro el usuario o contraseña");									
				}
			}
			catch(Exception $e)
			{
				throw new Exception($e->getMessage());
				
			}
		}

		public function registrar($nombre, $apellido, $email, $password)
		{
			try{

				if(empty($nombre))
					throw new Exception("El nombre no puede estar vacio");				

				if(empty($apellido))
					throw new Exception("El apellido no puede estar vacio");

				if(empty($email))
					throw new Exception("El email no puede estar vacio");

				if(empty($password))
					throw new Exception("La contraseña no puede estar vacia");			

				$u = new Usuario;
				if($u->selectByEmail($email))
				{
					if($u->getEstado())
						throw new Exception("El usuario ya existe. Recupere su contraseña");
					else
						throw new Exception("El usuario existe pero se encuentra deshabilitado. Comuniquese con nuestro soporte técnico");
				}
				

				$conn = new ConexionApp();
				$conn->conectar(); 
				$conn->begin();

					//selecciono el perfil de usuario desde el registro
					$up = new UsuarioPerfil;
					$up->setId(2);
					$up->select();

					//guardar usuario
					$u = new Usuario;
					$u->setNombre($nombre);
					$u->setApellido($apellido);
					$u->setEmail($email);
					$u->setPassword($password);
					$u->setPasswordAux($password);
					$u->setUsuarioPerfil($up); //perfil de usuario registrado
					$u->insert($conn);
					
			        $carpeta_user = PATH_ROOT.PATH_CLIENTE.$email;

			        $a = new Archivo;
			        $a->CrearCarpeta($carpeta_user);
				
				$conn->commit();
				$conn->desconectar();				
			}
			catch(Exception $e)
			{							
				throw new Exception($e->getMessage());				  
			}
		}

		public function recuperar($email)
		{
			try
			{	
				if(empty($email))
					throw new Exception("El email no puede estar vacio");

				$nueva_pass=(string)rand();

				$u = new Usuario;
				$u = $u->selectByEmail($email);				

				if(!is_null($u))
				{
					$u->setPassword($nueva_pass);
					$u->setPasswordAux($nueva_pass);
					$u->updatePassword(false);					

					$email = new Email;
					$dest = array( array($u->getEmail(), $u->getNombre()." ".$u->getApellido(), ""));
					$email->setDestinatario($dest);
					$email->setAsunto("Recuperación de Contraseña");
					$email->setHtmlCuerpo("<p>Se generó una nueva contraseña. <br> Puede modificarla una vez que inicie sesión desde la configuración de su perfil. <br><br> <u>Contraseña Temporal:</u> <b>".$nueva_pass."</b></p>");
					$email->enviar();
				}
				else
				{
					throw new Exception("El usuario no existe.<br>Contactese con un administrador para crear el acceso.");
				}
				
			}
			catch(Exception $e)
			{
				throw new Exception($e->getMessage());				  
			}
		}

		public function cambiarPassword($id, $password)
		{
			try {
				if(empty($password))
					throw new Exception("La contraseña no puede estar vacia");

				$u = new Usuario;
				$u->setId($id);
				$u->setPassword($password);
				$u->setPasswordAux($password);
				$u->updatePassword(false);	
					
			} 
			catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public function registrarLoginLog($usuario){
			try {

				$l = new LoginLog;
				$f = new Fechas;
				$ip = New IP;

				$registrar = false;
				$geo = $ip->GeoIp($ip->ObtenerIp());				
				$login = $l->selectByUsuario($usuario);
															

				if(empty($login)){
					$registrar = true;
				}
				else
				{
					$fecha_ultimo_login = $login->getFechaHora()->format('Y-m-d');
					
					if($fecha_ultimo_login == $f->FechaActual()){
						$registrar = false;
					}
					else
					{
						$registrar = true;	
					}
				}

				if($registrar){
					$l->setUsuarioId($usuario);										
					$l->setFechaHora($f->FechaHoraActual());
					$l->setIp($ip->ObtenerIp());
					$l->setLatitud($geo["latitud"]);		
					$l->setLongitud($geo["longitud"]);		
					$l->setDetalle($geo["ciudad"].", ".$geo["provincia"].", ".$geo["pais"]);		

					$l->insert(false);
				}
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}
			
		}
	}

?>
