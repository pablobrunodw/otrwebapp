<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";
		
	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'Entidades/guias.class.php';
	include_once PATH_DATOS.'Entidades/usuario.class.php';

	include_once PATH_NEGOCIO.'Sistema/handlerconsultascontrol.class.php';
	include_once PATH_NEGOCIO.'Sistema/handlersistema.class.php';
	include_once PATH_NEGOCIO.'Funciones/Archivo/archivo.class.php';	

	include_once PATH_NEGOCIO.'Notificaciones/handlernotificaciones.class.php';


	class HandlerGuias{		

		public function seleccionarByFiltros($fdesde, $fhasta, $usuario, $empresa){
			try {
					
				$handler = new HandlerConsultasControl;

				$result = $handler->seleccionarGuiasByFiltros($fdesde, $fhasta, $usuario, $empresa);

				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public function guardarGuias($fechaHora,$usuario,$imagen,$observaciones,$arrEmpresas){
			try {
				
				$ext = substr($imagen["name"],strrpos($imagen["name"],".")+1);	
				//$path = $pathFile."/".$categoria.".".$ext;
				//$path = $pathFile."/".$file["name"].".".$ext;

				$a=new Archivo;
				$path = $a->generarNombreAleatorio(10).".".$ext;				

				/*################################*/
				/*	CARGAR ARCHIVOS AL SERVIDOR   */
				/*################################*/										
				if($imagen["size"]>0)
				{
					if ($imagen['size']>3000000)
						throw new Exception('El archivo es mayor que 3MB, debes reduzcirlo antes de subirlo');										

					$path_dir=PATH_ROOT.PATH_UPLOADGUIAS;
					$path_completo=PATH_ROOT.PATH_UPLOADGUIAS.$path;	
					
					$a=new Archivo;
					$a->CrearCarpeta($path_dir);
					$a->SubirArchivo($imagen['tmp_name'],$path_completo);					
				}				


				if(is_file($path_completo))
				{
					foreach ($arrEmpresas as $key => $value) {
						$handler = new Guias;				

						$handler->setUsuarioId($usuario);
						$handler->setFechaHora($fechaHora);				
						$handler->setImagen($path);
						$handler->setObservaciones($observaciones);

							//SET PLAZA
							$u = new Usuario;
							$u->setId($usuario);
							$u = $u->select();
							$alias = $u->getAliasUserSistema();

							$hanlder_sistema = new HandlerSistema;
							$arrDatos = $hanlder_sistema->getPlazaByCordinador($alias);
							$plaza = $arrDatos[0]->PLAZA;

						$handler->setPlaza($plaza);
						
						$handler->setEmpresaSistema($value);

						$handler->insert(false);

						//####################
						//## NOTIFICACIONES ##
						//####################
						$u = new Usuario;
						$u->setId($usuario);
						$u = $u->select();

						$origen = "GUIAS [envio]";
						$detalle = "<b>".$u->getNombre()."</b> envió una guías";

						$n_handler = new HandlerNotificaciones;				
						$n_handler->guardarNotificacion($usuario,$origen,$detalle,$value,$plaza);
					}

				}
				else{
					throw new Exception("No se pudo guardar la imagen.");					
				}
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());					
			}
		}
	}

?>


