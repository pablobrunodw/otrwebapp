<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";
		
	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	
	include_once PATH_DATOS.'Entidades/expediciones.class.php';
	include_once PATH_DATOS.'Entidades/expedicionestipo.class.php';
	include_once PATH_DATOS.'Entidades/expedicionesestados.class.php';

	include_once PATH_NEGOCIO.'Sistema/handlerconsultascontrol.class.php';

	include_once PATH_NEGOCIO.'Notificaciones/handlernotificaciones.class.php';

	include_once PATH_NEGOCIO.'Sistema/handlersistema.class.php';

	include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 	
	
	class HandlerExpediciones{		

		public function selecionarTipos(){
			try {
				$handler = new ExpedicionesTipo;								

				return $handler->select();

			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public function selecionarEstados(){
			try {
				$handler = new ExpedicionesEstados;								

				return $handler->select();

			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public function seleccionarByFiltros($fdesde, $fhasta, $tipo_expe, $estados_expe, $usuario){
			try {
					
				$handler = new HandlerConsultasControl;

				$result = $handler->seleccionarExpedicionesByFiltros($fdesde, $fhasta, $tipo_expe, $estados_expe, $usuario);

				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public function guardarItemExpedicion($fecha,$usuario,$detalle,$observaciones,$tipo,$cant,$estados){
			try {

				$handler = new Expediciones;
				$h_estados = new ExpedicionesEstados;

				$estados = $h_estados->getPendiente()->getId();
				$observaciones = "";				

				$handler->setTipoExpediciones($tipo);
				$handler->setEstadosExpediciones($estados);
				$handler->setUsuarioId($usuario);
				$handler->setFecha($fecha);
				$handler->setCantidad($cant);
				$handler->setDetalle($detalle);
				$handler->setObservaciones($observaciones);

				$handler->insert(false);				
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());					
			}
		}

		public function eliminarItemExpedicion($id){
			try {

				$handler = new Expediciones;
				$handler->setId($id);
				$handler->select();

				$handler->delete(false);				
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());					
			}
		}

		public function publicarItems($id_usuario)
		{
			try {			
				$datos = $this->seleccionarSinPublicar($id_usuario);

				if(!empty($datos)){

					if(count($datos)<=1)
	                  $consulta_tmp[0]=$datos;
	                else
	                  $consulta_tmp=$datos;

					foreach ($consulta_tmp as $key => $value) {
						
						$exp = new Expediciones;
						$exp->setId($value->getId());
						$exp = $exp->select();

						$exp->setTipoExpediciones($exp->getTipoExpediciones()->getId());
						$exp->setEstadosExpediciones($exp->getEstadosExpediciones()->getId());
						$exp->setUsuarioId($exp->getUsuarioId()->getId());
						$exp->setFecha($exp->getFecha()->format('Y-m-d'));						
						$exp->setSinPublicar(false);
						
						$exp->update(false);
					}

					//####################
					//## NOTIFICACIONES ##
					$u = new Usuario;
					$u->setId($id_usuario);
					$u = $u->select();				

					$alias = $u->getAliasUserSistema();

					$hanlder_sistema = new HandlerSistema;
					$arrDatos = $hanlder_sistema->getPlazaByCordinador($alias);
					$plaza = $arrDatos[0]->PLAZA;

					$origen = "EXPEDICION [solicitud]";
					$detalle = "<b>".$u->getNombre()."</b> envió una nueva solicitud de stock";

					$n_handler = new HandlerNotificaciones;				
					$n_handler->guardarNotificacion($id_usuario,$origen,$detalle,0,$plaza);

				}

			} catch (Exception $e) {
				throw new Exception($e->getMessage());		
			}
		}

		public function guardarExpedicion($fecha,$usuario,$detalle,$observaciones,$tipo,$cant,$estados){
			try {

				$handler = new Expediciones;
				$h_estados = new ExpedicionesEstados;

				$estados = $h_estados->getPendiente()->getId();
				$observaciones = "";				

				$handler->setTipoExpediciones($tipo);
				$handler->setEstadosExpediciones($estados);
				$handler->setUsuarioId($usuario);
				$handler->setFecha($fecha);
				$handler->setCantidad($cant);
				$handler->setDetalle($detalle);
				$handler->setObservaciones($observaciones);

				$handler->insert(false);

				//####################
				//## NOTIFICACIONES ##
				$u = new Usuario;
				$u->setId($usuario);
				$u = $u->select();				

				$alias = $u->getAliasUserSistema();

				$hanlder_sistema = new HandlerSistema;
				$arrDatos = $hanlder_sistema->getPlazaByCordinador($alias);
				$plaza = $arrDatos[0]->PLAZA;

				$origen = "EXPEDICION [solicitud]";
				$detalle = "<b>".$u->getNombre()."</b> envió una nueva solicitud de stock";

				$n_handler = new HandlerNotificaciones;				
				$n_handler->guardarNotificacion($usuario,$origen,$detalle,0,$plaza);
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());					
			}
		}

		public function cambiarEstadoExpedicion($id,$estados,$observaciones){
			try {			

				$handler = new Expediciones;
				$handler->setId($id);
				$handler = $handler->select();	

				$usuario = $handler->getUsuarioId()->getId();
				$tipo_expedicion = $handler->getTipoExpediciones()->getNombre();

				if($estados == $handler->getEstadosExpediciones()->getId())
					throw new Exception("El estado nuevo tiene que ser distinto al estado actual.");
					

				$handler->setFecha($handler->getFecha()->format('Y-m-d'));				
				$handler->setTipoExpediciones($handler->getTipoExpediciones()->getId());				
				$handler->setUsuarioId($handler->getUsuarioId()->getId());				

				$handler->setEstadosExpediciones($estados);				

				$text_obs=$observaciones." || ".$handler->getObservaciones();
				$handler->setObservaciones($text_obs);

				$handler->update(false);

				//####################
				//## NOTIFICACIONES ##
				//####################
				$u = new Usuario;
				$u->setId($usuario);
				$u = $u->select();

				$alias = $u->getAliasUserSistema();

				$hanlder_sistema = new HandlerSistema;
				$arrDatos = $hanlder_sistema->getPlazaByCordinador($alias);
				$plaza = $arrDatos[0]->PLAZA;

				$origen = "EXPEDICION [cambio estado]";
				$detalle = "Se modificó el estado del registro ".$tipo_expedicion;

				$n_handler = new HandlerNotificaciones;				
				$n_handler->guardarNotificacion($usuario,$origen,$detalle,0,$plaza);

			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public function guardarTipoABM($grupo,$nombre,$estado,$id){
			try {

				if($estado=="EDITAR"){
					$handler = new ExpedicionesTipo;

					$handler->setId($id);
					$handler->select();

					$handler->setGrupo($grupo);
					$handler->setNombre($nombre);

					$handler->update(false);
				}
				else
				{
					$handler = new ExpedicionesTipo;

					$handler->setGrupo($grupo);
					$handler->setNombre($nombre);
					$handler->insert(false);
				}
						
			} catch (Exception $e) {
				throw new Exception($e->getMessage());					
			}
		}	

		public function seleccionarSinPublicar($usuario){
			try {
					
				$handler = new Expediciones;

				$result = $handler->seleccionarSinPublicar($usuario);

				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}
	}

?>


