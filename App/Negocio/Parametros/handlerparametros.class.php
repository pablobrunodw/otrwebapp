<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";
		
	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'Entidades/parametros.class.php';

	class HandlerParametros{		

		public function seleccionarById($id){
			try {
					
				$p = new Parametros;

				$result = $p->selectById($id);

				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

	}

?>


