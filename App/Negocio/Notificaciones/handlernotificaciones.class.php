<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";
		
	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'Entidades/notificaciones.class.php';
	include_once PATH_NEGOCIO.'Funciones/Fechas/fechas.class.php';

	class HandlerNotificaciones{		

		public 	function guardarNotificacion($usuario, $origen, $detalle, $empresa, $plaza){
			try {

				$f = new Fechas;
				$n = new Notificaciones;

				$n->setFechaHora($f->FechaHoraActual());
				$n->setUsuarioId($usuario);
				$n->setOrigen($origen);
				$n->setDetalle($detalle);
				$n->setEmpresaSistema($empresa);
				$n->setPlaza($plaza);

				$n->insert(false);

			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public function seleccionarByUsuario($usuario){
			try {
					
				$n = new Notificaciones;

				$result = $n->selectByUsuario($usuario);

				if( count($result)==1)
                    $resultFinal[0] = $result;
               	else
               		$resultFinal = $result;

				return $resultFinal;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public function seleccionarByEmpresa($empresa){
			try {
					
				$n = new Notificaciones;

				$result = $n->selectByEmpresa($empresa);

				if( count($result)==1)
                    $resultFinal[0] = $result;
               	else
               		$resultFinal = $result;

				return $resultFinal;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public function seleccionarTodo(){
			try {
					
				$n = new Notificaciones;

				$result = $n->select();

				if( count($result)==1)
                    $resultFinal[0] = $result;
               	else
               		$resultFinal = $result;

				return $resultFinal;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public function borrarNotificacion($id){
			try {
					
				$n = new Notificaciones;

				$n->setId($id);
				$n->delete(false);
						
				return $n;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public function establerFormatOrigen($origen){
			try {

				$data = "";				
				
				switch (trim($origen)) {
					case 'EXPEDICION [cambio estado]':
						$data["link"] = "view=exp_seguimiento";
						$data["tipo_usuario"] = 4;
						$data["perfil_usuario"] = 2;
						break;
					
					case 'EXPEDICION [solicitud]':
						$data["link"] = "view=exp_control";
						$data["tipo_usuario"] = 0;
						$data["perfil_usuario"] = 1;
						break;

					case 'GUIAS [envio]':
						$data["link"] = "view=guias_control";
						$data["tipo_usuario"] = 0;
						$data["perfil_usuario"] = 1;
						break;						
				}					

				return $data;							

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

	}

?>


