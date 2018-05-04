<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";
		
	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'Entidades/tipousuario.class.php';

	class HandlerTipoUsuarios{		

		public function selectTodos(){
			try{			
				$tu = new TipoUsuario;
				return $tu->select();				
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

				$tu = new TipoUsuario;
				$tu->setId($id);
				$tu->select();				

				return $tu;
			}
			catch(Exception $e)
			{
				throw new Exception($e->getMessage());	
			}
		}			
	}	
?>		