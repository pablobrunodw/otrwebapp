<?php		
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";

	include_once "lib/class.smtp.php";
	include_once "lib/class.phpmailer.php";
	
	class Email 
	{

		########################################
		#  Declaraciones / Getter and setters  #
		########################################

		public $_servidor;		
		public function getServidor(){ return $this->_servidor; }
		public function setServidor($servidor){ $this->_servidor =$servidor; }

		public $_port;		
		public function getPort(){ return $this->_port; }
		public function setPort($port){ $this->_port =$port; }

		public $_usuario;
		public function getUsuario(){ return $this->_usuario; }
		public function setUsuario($usuario){ $this->_usuario =$usuario; }

		public $_password;
		public function getPassword(){ return $this->_password; }
		public function setPassword($password){ $this->_password =$password; }

		public $_nombre_remitente;		
		public function getNombreRemitente(){ return $this->_nombre_remitente; }
		public function setNombreRemitente($nombre_remitente){ $this->_nombre_remitente =$nombre_remitente; }

		public $_email_remitente;
		public function getEmailRemitente(){ return $this->_email_remitente; }
		public function setEmailRemitente($email_remitente){ $this->_email_remitente =$email_remitente; }

		public $_destinatario;
		public function getDestinatario(){ return $this->_destinatario; }
		public function setDestinatario($destinatario){ $this->_destinatario =$destinatario; }

		public $_destinatarios_ocultos;
		public function getDestinatariosOcultos(){ return $this->_destinatarios_ocultos; }
		public function setDestinatariosOcultos($destinatarios_ocultos){ $this->_destinatarios_ocultos =$destinatarios_ocultos; }

		public $_asunto;
		public function getAsunto(){ return $this->_asunto; }
		public function setAsunto($asunto){ $this->_asunto =$asunto; }

		public $_html_cuerpo;		
		public function getHtmlCuerpo(){ return $this->_html_cuerpo; }
		public function setHtmlCuerpo($html_cuerpo){ $this->_html_cuerpo =$html_cuerpo; }

		public $_redireccionar;
		public function getRedireccionar(){ return $this->_redireccionar; }
		public function setRedireccionar($redireccionar){ $this->_redireccionar =$redireccionar; }

		public $_redireccionar_error;		
		public function getRedireccionarError(){ return $this->_redireccionar_error; }
		public function setRedireccionarError($redireccionar_error){ $this->_redireccionar_error =$redireccionar_error; }

		public $_cuerpo_alt;
		public function getCuerpoAlt(){ return $this->_cuerpo_alt; }
		public function setCuerpoAlt($cuerpo_alt){ $this->_cuerpo_alt =$cuerpo_alt; }

		###############
		#   Metodos   #
		###############

		function __construct(){	
			$this->setServidor(SERVER_EMAIL);
			$this->setUsuario(USER_EMAIL);
			$this->setPassword(PASS_EMAIL);
			$this->setEmailRemitente(EMAIL_PRINCIPAL_ENVIADOR);
			$this->setNombreRemitente(NOMBRE_PRINCIPAL_ENVIADOR);	
			$this->setPort(PORT_EMAIL);		
		}
		
		function enviar(){

			try {
							
				$mail = new PHPMailer();

				// Activo condificacción utf-8
				$mail->CharSet = "UTF-8";

				// Aclaramos que vamos a usar SMTP
				$mail->IsSMTP();

				// la dirección del servidor, por ej.: smtp.servidor.com
				$mail->Host = $this->getServidor();

				// dirección remitente, por ej.: no-responder@miempresa.com
				$mail->From = $this->getEmailRemitente();

				// nombre remitente, por ej.: "Servicio de envío automático"
				$mail->FromName = $this->getNombreRemitente();

				// puerto utilizado para el envio de email
				$mail->Port = $this->getPort();

				// asunto y cuerpo alternativo del mensaje
				$mail->Subject = $this->getAsunto();
				$mail->AltBody = $this->getCuerpoAlt();

				// Cuerpo del mensaje HTML, definido en la variable $body
				$mail->MsgHTML($this->getHtmlCuerpo());
								
				//destinatarios			
				$mail->AddAddress($this->getDestinatario()[0][0], $this->getDestinatario()[0][1]." ".$this->getDestinatario()[0][2]);
				
				if(!empty($this->getDestinatariosOcultos()))
				{
					foreach ($this->getDestinatariosOcultos() as $ocultos) {
						$mail->AddBCC($ocultos[0], $ocultos[1]." ".$ocultos[2]);
					}
				}		

				//si el SMTP necesita autenticación
				$mail->SMTPAuth = true;

				// Credenciales usuario
				$mail->Username = $this->getUsuario();
				$mail->Password = $this->getPassword();
				 
				if(!$mail->Send()) 
				{																
					if(!empty($this->getRedireccionarError()))					
						header('Location:'.$this->getRedireccionarError());					
					else					
						throw new Exception("Error enviando: " . $mail->ErrorInfo);									
				} 
				else 
				{				
					if(!empty($this->getRedireccionar()))				
						header('Location:'.$this->getRedireccionar());					
				}
			} 
			catch (Exception $e) {
				throw new Exception($e->getMessage());				  
			}
		}

		function cronjobEnviar(){

			try {
							
				$mail = new PHPMailer(true);

				// Activo condificacción utf-8
				$mail->CharSet = "UTF-8";

				// Aclaramos que vamos a usar SMTP
				$mail->IsSMTP();

				// la dirección del servidor, por ej.: smtp.servidor.com
				$mail->Host = $this->getServidor();

				// dirección remitente, por ej.: no-responder@miempresa.com
				$mail->From = $this->getEmailRemitente();

				// nombre remitente, por ej.: "Servicio de envío automático"
				$mail->FromName = $this->getNombreRemitente();

				// puerto utilizado para el envio de email
				$mail->Port = $this->getPort();

				// asunto y cuerpo alternativo del mensaje
				$mail->Subject = $this->getAsunto();
				$mail->AltBody = $this->getCuerpoAlt();

				// Cuerpo del mensaje HTML, definido en la variable $body
				$mail->MsgHTML($this->getHtmlCuerpo());
				
				//destinatarios			
				$mail->AddAddress($this->getDestinatario()[0][0], $this->getDestinatario()[0][1]." ".$this->getDestinatario()[0][2]);
				
				if(!empty($this->getDestinatariosOcultos()))
				{
					foreach ($this->getDestinatariosOcultos() as $ocultos) {
						$mail->AddBCC($ocultos[0], $ocultos[1]." ".$ocultos[2]);
					}
				}
							
				//si el SMTP necesita autenticación
				$mail->SMTPAuth = true;

				// Credenciales usuario
				$mail->Username = $this->getUsuario();
				$mail->Password = $this->getPassword();
				 
				return $mail->Send();				
			}
			catch (phpmailerException $e)
			{
				return $e->errorMessage();
			}
			catch (Exception $e) {
				throw new Exception($e->getMessage());				  
			}
		}
	}

?>