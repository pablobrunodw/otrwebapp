<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";

	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'BaseDatos/sql.class.php';

	class UsuarioPerfil
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
		
		private $_estado;
		public function getEstado(){ return var_export($this->_estado,true); }
		public function setEstado($estado){ $this->_estado=$estado; }			

		private $_itemAdministrador;	
		public function getItemAdministradorString(){ return var_export($this->_itemAdministrador,true); }
		public function getItemAdministradorBoolean(){ return $this->_itemAdministrador; }
		public function setItemAdministrador($itemAdministrador){ $this->_itemAdministrador=$itemAdministrador; }			


		private $_moduloLegajos;	
		public function getModuloLegajosString(){ return var_export($this->_moduloLegajos,true); }
		public function getModuloLegajosBoolean(){ return $this->_moduloLegajos; }
		public function setModuloLegajos($moduloLegajos){ $this->_moduloLegajos=$moduloLegajos; }	

		private $_moduloTickets;	
		public function getModuloTicketsString(){ return var_export($this->_moduloTickets,true); }
		public function getModuloTicketsBoolean(){ return $this->_moduloTickets; }
		public function setModuloTickets($moduloTickets){ $this->_moduloTickets=$moduloTickets; }	

		private $_moduloLicencias;	
		public function getModuloLicenciasString(){ return var_export($this->_moduloLicencias,true); }
		public function getModuloLicenciasBoolean(){ return $this->_moduloLicencias; }
		public function setModuloLicencias($moduloLicencias){ $this->_moduloLicencias=$moduloLicencias; }	

		private $_moduloCapacitaciones;	
		public function getModuloCapacitacionesString(){ return var_export($this->_moduloCapacitaciones,true); }
		public function getModuloCapacitacionesBoolean(){ return $this->_moduloCapacitaciones; }
		public function setModuloCapacitaciones($moduloCapacitaciones){ $this->_moduloCapacitaciones=$moduloCapacitaciones; }	

		private $_moduloGuias;	
		public function getModuloGuiasString(){ return var_export($this->_moduloGuias,true); }
		public function getModuloGuiasBoolean(){ return $this->_moduloGuias; }
		public function setModuloGuias($moduloGuias){ $this->_moduloGuias=$moduloGuias; }	

		private $_moduloInventarios;	
		public function getModuloInventariosString(){ return var_export($this->_moduloInventarios,true); }
		public function getModuloInventariosBoolean(){ return $this->_moduloInventarios; }
		public function setModuloInventarios($moduloInventarios){ $this->_moduloInventarios=$moduloInventarios; }

		private $_moduloStock;	
		public function getModuloStockString(){ return var_export($this->_moduloStock,true); }
		public function getModuloStockBoolean(){ return $this->_moduloStock; }
		public function setModuloStock($moduloStock){ $this->_moduloStock=$moduloStock; }

		private $_moduloImportacion;	
		public function getModuloImportacionString(){ return var_export($this->_moduloImportacion,true); }
		public function getModuloImportacionBoolean(){ return $this->_moduloImportacion; }
		public function setModuloImportacion($moduloImportacion){ $this->_moduloImportacion=$moduloImportacion; }

		private $_moduloEnviadas;	
		public function getModuloEnviadasString(){ return var_export($this->_moduloEnviadas,true); }
		public function getModuloEnviadasBoolean(){ return $this->_moduloEnviadas; }
		public function setModuloEnviadas($moduloEnviadas){ $this->_moduloEnviadas=$moduloEnviadas; }											

		private $_moduloMetricas;	
		public function getModuloMetricasString(){ return var_export($this->_moduloMetricas,true); }
		public function getModuloMetricasBoolean(){ return $this->_moduloMetricas; }
		public function setModuloMetricas($moduloMetricas){ $this->_moduloMetricas=$moduloMetricas; }

		private $_moduloPuntajes;	
		public function getModuloPuntajesString(){ return var_export($this->_moduloPuntajes,true); }
		public function getModuloPuntajesBoolean(){ return $this->_moduloPuntajes; }
		public function setModuloPuntajes($moduloPuntajes){ $this->_moduloPuntajes=$moduloPuntajes; }		

		private $_moduloUsuarios;	
		public function getModuloUsuariosString(){ return var_export($this->_moduloUsuarios,true); }
		public function getModuloUsuariosBoolean(){ return $this->_moduloUsuarios; }
		public function setModuloUsuarios($moduloUsuarios){ $this->_moduloUsuarios=$moduloUsuarios; }

		private $_moduloRoles;	
		public function getModuloRolesString(){ return var_export($this->_moduloRoles,true); }
		public function getModuloRolesBoolean(){ return $this->_moduloRoles; }
		public function setModuloRoles($moduloRoles){ $this->_moduloRoles=$moduloRoles; }		

		private $_moduloServicios;	
		public function getModuloServiciosString(){ return var_export($this->_moduloServicios,true); }
		public function getModuloServiciosBoolean(){ return $this->_moduloServicios; }
		public function setModuloServicios($moduloServicios){ $this->_moduloServicios=$moduloServicios; }	

		private $_moduloUpload;	
		public function getModuloUploadString(){ return var_export($this->_moduloUpload,true); }
		public function getModuloUploadBoolean(){ return $this->_moduloUpload; }
		public function setModuloUpload($moduloUpload){ $this->_moduloUpload=$moduloUpload; }	

		private $_moduloPerfil;	
		public function getModuloPerfilString(){ return var_export($this->_moduloPerfil,true); }
		public function getModuloPerfilBoolean(){ return $this->_moduloPerfil; }
		public function setModuloPerfil($moduloPerfil){ $this->_moduloPerfil=$moduloPerfil; }	

		private $_moduloConfiguracion;	
		public function getModuloConfiguracionString(){ return var_export($this->_moduloConfiguracion,true); }
		public function getModuloConfiguracionBoolean(){ return $this->_moduloConfiguracion; }
		public function setModuloConfiguracion($moduloConfiguracion){ $this->_moduloConfiguracion=$moduloConfiguracion; }	

		private $_moduloAyuda;	
		public function getModuloAyudaString(){ return var_export($this->_moduloAyuda,true); }
		public function getModuloAyudaBoolean(){ return $this->_moduloAyuda; }
		public function setModuloAyuda($moduloAyuda){ $this->_moduloAyuda=$moduloAyuda; }	

		private $_moduloInbox;	
		public function getModuloInboxString(){ return var_export($this->_moduloInbox,true); }
		public function getModuloInboxBoolean(){ return $this->_moduloInbox; }
		public function setModuloInbox($moduloInbox){ $this->_moduloInbox=$moduloInbox; }	

		private $_moduloPanel;	
		public function getModuloPanelString(){ return var_export($this->_moduloPanel,true); }
		public function getModuloPanelBoolean(){ return $this->_moduloPanel; }
		public function setModuloPanel($moduloPanel){ $this->_moduloPanel=$moduloPanel; }	

		private $_moduloMultiusuario;	
		public function getModuloMultiusuarioString(){ return var_export($this->_moduloMultiusuario,true); }
		public function getModuloMultiusuarioBoolean(){ return $this->_moduloMultiusuario; }
		public function setModuloMultiusuario($moduloMultiusuario){ $this->_moduloMultiusuario=$moduloMultiusuario; }	

		private $_moduloHerramientas;	
		public function getModuloHerramientasString(){ return var_export($this->_moduloHerramientas,true); }
		public function getModuloHerramientasBoolean(){ return $this->_moduloHerramientas; }
		public function setModuloHerramientas($moduloHerramientas){ $this->_moduloHerramientas=$moduloHerramientas; }	

		/*#############*/
		/* CONSTRUCTOR */
		/*#############*/

		function __construct(){
			$this->setId(0);
			$this->setNombre('');						
			$this->setItemAdministrador(false);			
			$this->setEstado(true);

			$this->setModuloLegajos(false);
			$this->setModuloTickets(false);
			$this->setModuloLicencias(false);
			$this->setModuloCapacitaciones(false);
			$this->setModuloGuias(false);
			$this->setModuloInventarios(false);
			$this->setModuloStock(false);
			$this->setModuloImportacion(false);
			$this->setModuloEnviadas(false);
			$this->setModuloMetricas(false);
			$this->setModuloPuntajes(false);
			$this->setModuloUsuarios(false);
			$this->setModuloRoles(false);
			$this->setModuloServicios(false);
			$this->setModuloUpload(false);
			$this->setModuloPerfil(false);
			$this->setModuloConfiguracion(false);
			$this->setModuloAyuda(false);
			$this->setModuloInbox(false);
			$this->setModuloPanel(false);
			$this->setModuloMultiusuario(false);						
			$this->setModuloHerramientas(false);						
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
				$query="INSERT INTO usuario_perfil (
		        						nombre,	        						
		        						item_administrador,	        						
		        						estado,
										m_legajos, 
										m_tickets,
										m_licencias,
										m_capacitaciones,
										m_guias,
										m_inventarios,
										m_stock,
										m_importacion,
										m_enviadas,
										m_usuarios,
										m_roles,
										m_metricas,
										m_puntajes,
										m_servicios,
										m_upload,
										m_perfil,
										m_configuracion,
										m_ayuda,
										m_inbox,
										m_panel,
										m_multiusuario,
										m_herramientas,
	        			) VALUES (
	        							'".$this->getNombre()."',   	        											
	        							'".$this->getItemAdministradorString()."',        							
	        							'".$this->getEstado()."',
										'".$this->getModuloLegajosString()."',  
										'".$this->getModuloTicketsString()."',  
										'".$this->getModuloLicenciasString()."',  
										'".$this->getModuloCapacitacionesString()."',  
										'".$this->getModuloGuiasString()."',  
										'".$this->getModuloInventariosString()."', 
										'".$this->getModuloStockString()."', 
										'".$this->getModuloImportacionString()."', 
										'".$this->getModuloEnviadasString()."',  
										'".$this->getModuloUsuariosString()."',  
										'".$this->getModuloRolesString()."',  
										'".$this->getModuloMetricasString()."',  
										'".$this->getModuloPuntajesString()."',
										'".$this->getModuloServiciosString()."',
										'".$this->getModuloUploadString()."',
										'".$this->getModuloPerfilString()."',
										'".$this->getModuloConfiguracionString()."',
										'".$this->getModuloAyudaString()."',
										'".$this->getModuloInboxString()."',
										'".$this->getModuloPanelString()."',
										'".$this->getModuloMultiusuarioString()."'
										'".$this->getModuloHerramientasString()."'
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
					throw new Exception("Perfil de usuario no identificado");

				if(empty($this->getNombre()))
					throw new Exception("Nombre vacio");
				
				# Query 			
				$query="UPDATE usuario_perfil SET
								nombre='".$this->getNombre()."', 							
								item_administrador='".$this->getItemAdministradorString()."',							
								estado='".$this->getEstado()."',
								m_legajos='".$this->getModuloLegajosString()."', 
								m_tickets='".$this->getModuloTicketsString()."',
								m_licencias='".$this->getModuloLicenciasString()."',
								m_capacitaciones='".$this->getModuloCapacitacionesString()."',
								m_guias='".$this->getModuloGuiasString()."',
								m_inventarios='".$this->getModuloInventariosString()."',
								m_stock='".$this->getModuloStockString()."',
								m_importacion='".$this->getModuloImportacionString()."',
								m_enviadas='".$this->getModuloEnviadasString()."',
								m_usuarios='".$this->getModuloUsuariosString()."',
								m_roles='".$this->getModuloRolesString()."',
								m_metricas='".$this->getModuloMetricasString()."',
								m_puntajes='".$this->getModuloPuntajesString()."',
								m_servicios='".$this->getModuloServiciosString()."',
								m_upload='".$this->getModuloUploadString()."',
								m_perfil='".$this->getModuloPerfilString()."',
								m_configuracion='".$this->getModuloConfiguracionString()."',
								m_ayuda='".$this->getModuloAyudaString()."',						
								m_inbox='".$this->getModuloInboxString()."',
								m_panel='".$this->getModuloPanelString()."',
								m_multiusuario='".$this->getModuloMultiusuarioString()."'
								m_herramientas='".$this->getModuloHerramientasString()."'
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
					throw new Exception("Pefil de usuario no identificado");
			
				# Query 			
				$query="UPDATE usuario_perfil SET							
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
					$query = "SELECT * FROM usuario_perfil WHERE estado='true'";
				}
				else
				{
					if(empty($this->getId()))
						throw new Exception("No se selecciono el Id del perfil de usuario");		

					$query="SELECT * FROM usuario_perfil WHERE id=".$this->getId();
				}
				
				# Ejecucion 					
				$result = SQL::selectObject($query, new UsuarioPerfil);
						
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
				$this->setItemAdministrador($filas['item_administrador']);
				$this->setEstado($filas['estado']);

				$this->setModuloLegajos($filas['m_legajos']);
				$this->setModuloTickets($filas['m_tickets']);
				$this->setModuloLicencias($filas['m_licencias']);
				$this->setModuloCapacitaciones($filas['m_capacitaciones']);
				$this->setModuloGuias($filas['m_guias']);
				$this->setModuloInventarios($filas['m_inventarios']);
				$this->setModuloStock($filas['m_stock']);
				$this->setModuloImportacion($filas['m_importacion']);
				$this->setModuloEnviadas($filas['m_enviadas']);
				$this->setModuloMetricas($filas['m_metricas']);
				$this->setModuloPuntajes($filas['m_puntajes']);
				$this->setModuloUsuarios($filas['m_usuarios']);
				$this->setModuloRoles($filas['m_roles']);	
				$this->setModuloServicios($filas['m_servicios']);	
				$this->setModuloUpload($filas['m_upload']);	
				$this->setModuloPerfil($filas['m_perfil']);	
				$this->setModuloConfiguracion($filas['m_configuracion']);	
				$this->setModuloAyuda($filas['m_ayuda']);	
				$this->setModuloInbox($filas['m_inbox']);	
				$this->setModuloPanel($filas['m_panel']);	
				$this->setModuloMultiusuario($filas['m_multiusuario']);	
				$this->setModuloHerramientas($filas['m_herramientas']);	
			}
		}

		private function cleanClass()
		{
			$this->setId(0);
			$this->setNombre('');			
			$this->setItemAdministrador(false);
			$this->setEstado(true);

			$this->setModuloLegajos(false);
			$this->setModuloTickets(false);
			$this->setModuloLicencias(false);
			$this->setModuloCapacitaciones(false);
			$this->setModuloGuias(false);
			$this->setModuloInventarios(false);
			$this->setModuloStock(false);
			$this->setModuloImportacion(false);
			$this->setModuloEnviadas(false);
			$this->setModuloMetricas(false);
			$this->setModuloPuntajes(false);
			$this->setModuloUsuarios(false);
			$this->setModuloRoles(false);	
			$this->setModuloServicios(false);
			$this->setModuloUpload(false);
			$this->setModuloPerfil(false);
			$this->setModuloConfiguracion(false);
			$this->setModuloAyuda(false);					
			$this->setModuloInbox(false);		

			$this->setModuloPanel(false);
			$this->setModuloMultiusuario(false);					
			$this->setModuloHerramientas(false);					
		}

		private function createTable()
		{
			return 'CREATE TABLE IF NOT EXISTS';
		}

		/*########################*/
		/* METODOS PERSONALIZADOS */
		/*########################*/

		public function selectNoAdmin()
		{			
			try {

				$query="SELECT * FROM usuario_perfil WHERE estado='True' AND item_administrador='False'";
							
				# Ejecucion 					
				$result = SQL::selectObject($query, new UsuarioPerfil);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());						
			}

		}		
	}
?>







