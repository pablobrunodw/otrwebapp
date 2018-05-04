<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";
		
	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'Entidades/usuarioperfil.class.php';

	class HandlerPerfiles{		

		public function selectTodos(){
			try{			
				$up = new UsuarioPerfil;
				return $up->select();				
			}
			catch(Exception $e)
			{
				throw new Exception($e->getMessage());	
			}
		}	

		public function selectTodosNoAdmin(){
			try{			
				$up = new UsuarioPerfil;
				return $up->selectNoAdmin();				
			}
			catch(Exception $e)
			{
				throw new Exception($e->getMessage());	
			}
		}

		public function selectById($id){
			try{			

				if(empty($id))
					throw new Exception("No se encontro el identificador del regsitro");					

				$up = new UsuarioPerfil;
				$up->setId($id);
				$up = $up->select();				

				return $up;
			}
			catch(Exception $e)
			{
				throw new Exception($e->getMessage());	
			}
		}	

		public function updateRoles($datos){

			try {
							
				$up = new UsuarioPerfil;
				$up->setId($datos["id"]);
				$up = $up->select();

				$up->setModuloLegajos(($datos['chk_legajos']=="on"?true:false));
				$up->setModuloTickets(($datos['chk_tickets']=="on"?true:false));
				$up->setModuloLicencias(($datos['chk_licencias']=="on"?true:false));
				//$up->setModuloCapacitaciones(($datos['chk_capacitaciones']=="on"?true:false));
				$up->setModuloGuias(($datos['chk_guias']=="on"?true:false));
				$up->setModuloInventarios(($datos['chk_inventario']=="on"?true:false));
				$up->setModuloStock(($datos['chk_stock']=="on"?true:false));
				$up->setModuloImportacion(($datos['chk_importacion']=="on"?true:false));
				$up->setModuloEnviadas(($datos['chk_enviadas']=="on"?true:false));
				$up->setModuloMetricas(($datos['chk_metricas']=="on"?true:false));
				$up->setModuloPuntajes(($datos['chk_puntajes']=="on"?true:false));
				$up->setModuloUsuarios(($datos['chk_usuarios']=="on"?true:false));
				$up->setModuloRoles(($datos['chk_roles']=="on"?true:false));
				$up->setModuloServicios(($datos['chk_servicios']=="on"?true:false));
				$up->setModuloUpload(($datos['chk_upload']=="on"?true:false));	
				$up->setModuloPerfil(($datos['chk_perfil']=="on"?true:false));	
				$up->setModuloConfiguracion(($datos['chk_configuraciones']=="on"?true:false));	
				$up->setModuloAyuda(($datos['chk_ayuda']=="on"?true:false));	
				$up->setModuloInbox(($datos['chk_inbox']=="on"?true:false));	
				$up->setModuloPanel(($datos['chk_panel']=="on"?true:false));	
				$up->setModuloMultiusuario(($datos['chk_multiusuario']=="on"?true:false));	

				$up->update();
			} catch (Exception $e) {
				throw new Exception($e->getMessage());
				
			}				
		}	
	}	
?>		