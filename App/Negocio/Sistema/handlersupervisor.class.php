<?php
	
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";

	include_once PATH_DATOS.'BaseDatos/conexionsistema.class.php';
	include_once PATH_DATOS.'BaseDatos/sqlsistema.class.php';
	include_once PATH_NEGOCIO.'Funciones/Fechas/fechas.class.php';

	class HandlerSupervisor {

		private $supervisores = array(	
							array(
								'id' => 1, 
								'nombre' => 'JUAN CARLOS ZARATE',
								'plazas' =>  array(
										array('alias' => 'CABA'),
										array('alias' => 'FAGUAGA'),
										array('alias' => 'MAR DEL PLATA'),
										array('alias' => 'FERREYRA'),
									),
								),
							array(
								'id' => 2, 
								'nombre' => 'ADOLFO CORIA',
								'plazas' =>  array(
										array('alias' => 'SALINAS'),
										array('alias' => 'MENDOZA'),
										array('alias' => 'ROMANO'),
										array('alias' => 'NEUQUEN'),
									),
								)
							);

		public function selectAllSupervisor(){
			try {
				
				return $this->supervisores;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function selectSupervisorById($id){
			try {
				
				$objSupervisor = null;
				foreach ($this->supervisores as $key => $value) {
					if($value["id"]==$id){
						$objSupervisor = $value;
					}
				}

				return $objSupervisor;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());		
			}
		}

		public function selectPlazasBySupervisorId($id){
			try {

				$objSupervisor = null;
				foreach ($this->supervisores as $key => $value) {
					if($value["id"]==$id){
						$objSupervisor = $value;
					}
				}

				return $objSupervisor["plazas"];
							
			} catch (Exception $e) {
				throw new Exception($e->getMessage());		
			}
		}
	}

?>