<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";
		
	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'Entidades/plazascp.class.php';	
	include_once PATH_NEGOCIO.'Sistema/handlersistema.class.php';

	class HandlerPlazaCP{		

		public function selecionarCp(){
			try {
				$handler = new PlazaCP;								
				$data = $handler->select();
				
				if(count($data)==1){
					$data = array('' => $data );                   
					return $data;
				}				
				else{
					return $data;
				}	

			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public function selecionarCpById($id){
			try {
				$handler = new PlazaCP;								
				$handler->setId($id);
				$data = $handler->select();
				
				if(count($data)==1){
					$data = array('0' => $data );                   
					return $data;
				}				
				else{
					return $data;
				}	

			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public function selecionarCpByPlaza($alias){
			try {
				$handler = new PlazaCP;											
				$data = $handler->selecionarCpByPlaza($alias);
				
				if(count($data)==1){
					$data = array('0' => $data );                   
					return $data;
				}				
				else{
					return $data;
				}	

			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}		

		public function selecionarCpByCp($cp){
			try {
				$handler = new PlazaCP;											
				$data = $handler->selecionarCpByCp($cp);
										
				return $data;				

			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}	

		public function guardarCpABM($id,$cp,$cp_nombre,$plaza,$estado){
			try {

				if($estado=="EDITAR"){
					$handler = new PlazaCP;

					$handler->setId($id);
					$handler->select();

					$handler->setCP($cp);
					$handler->setCPNombre($cp_nombre);
					$handler->setPlaza($plaza);

					$handler->update(false);
				}
				
				if($estado=="NUEVO"){
					$handler = new PlazaCP;

					$handler->setCP($cp);
					$handler->setCPNombre($cp_nombre);
					$handler->setPlaza($plaza);
					$handler->insert(false);
				}
				
				if($estado=="ELIMINAR"){
					$handler = new PlazaCP;

					$handler->setId($id);
					$handler->select();

					$handler->delete(null);
				}
						
			} catch (Exception $e) {
				throw new Exception($e->getMessage());					
			}
		}	
	}

?>


