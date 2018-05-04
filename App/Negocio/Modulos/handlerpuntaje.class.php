<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";
		
	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	
	include_once PATH_DATOS.'Entidades/empresapuntaje.class.php';
	include_once PATH_DATOS.'Entidades/gestorobjetivo.class.php';

	include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
	include_once PATH_NEGOCIO."Funciones/Archivo/archivo.class.php"; 
	
	class HandlerPuntaje{		
		public function buscarPuntaje($empresa_id){
			try {

				$handler = new EmpresaPuntaje;				
				$handler->setIdEmpresaSistema($empresa_id);
				$objPuntaje = $handler->select();																

				if(!empty($objPuntaje))				
					return $objPuntaje->getPuntaje();
				else
					return 0;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}
		public function guardarPuntajeByEmpresa($datos){
			try {

				$handler = new EmpresaPuntaje;				
				$handler->limpiarTabla(null);

				foreach ($datos as $key => $value) {

					$handler1 = new EmpresaPuntaje;				

					if(!empty($value["puntaje"])){

						$handler1->setIdEmpresaSistema($value["empresa"]);
						$handler1->setPuntaje($value["puntaje"]);
				
						if($this->existeConfiguracionPuntaje($handler1->getIdEmpresaSistema(),$handler1->getPuntaje())){								
							$handler1->update(null);
						}
						else{
							$handler1->insert(null);
						}	

					}											

				}
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}
		}		
		public function existeConfiguracionPuntaje($empresa_id,$puntaje){
			try {
				
				$handler = new EmpresaPuntaje;
				$handler->setIdEmpresaSistema($empresa_id);
				$handler->setPuntaje($puntaje);

				$u=$handler->existePuntaje();

				if(!is_object($u))
					return false;
				else
					return true;


			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}		


		public function buscarObjetivo($gestor_id){
			try {

				$handler = new GestorObjetivo;				
				$handler->setIdGestorSistema($gestor_id);
				$objObjetivo = $handler->select();																

				if(!empty($objObjetivo))				
					return $objObjetivo->getObjetivo();
				else
					return 0;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}
		public function guardarObjetivoByGestor($datos){
			try {

				$handler = new GestorObjetivo;				
				$handler->limpiarTabla(null);

				foreach ($datos as $key => $value) {

					$handler1 = new GestorObjetivo;				

					if(!empty($value["objetivo"])){

						$handler1->setIdGestorSistema($value["gestor"]);
						$handler1->setObjetivo($value["objetivo"]);
				
						if($this->existeConfiguracionObjetio($handler1->getIdGestorSistema(),$handler1->getObjetivo())){								
							$handler1->update(null);
						}
						else{
							$handler1->insert(null);
						}	

					}											

				}
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}
		}			

		public function existeConfiguracionObjetio($gestor_id,$objetivo){
			try {
				
				$handler = new GestorObjetivo;
				$handler->setIdGestorSistema($gestor_id);
				$handler->setObjetivo($objetivo);

				$u=$handler->existeObjetivo();

				if(!is_object($u))
					return false;
				else
					return true;


			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}			
	}