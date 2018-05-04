<?php

	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";

	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";

	include_once PATH_DATOS.'BaseDatos/conexionsistema.class.php';
	include_once PATH_DATOS.'BaseDatos/sql.class.php';

	include_once PATH_DATOS.'Entidades/loginlog.class.php';
	include_once PATH_DATOS.'Entidades/expediciones.class.php';
	include_once PATH_DATOS.'Entidades/guias.class.php';

	include_once PATH_NEGOCIO.'Funciones/Fechas/fechas.class.php';	

	class HandlerConsultasControl {

		public function controlInicioSesion($fdesde, $fhasta, $usuario){
			try {
				
				$f = new Fechas;

				if($fdesde==$fhasta)
				{
					$filtro_fdesde="";
					if(!empty($fdesde)){					
						$tmp = $f->FormatearFechas($fdesde,"Y-m-d","Y-m-d");				
						$filtro_fdesde = "CAST (login_log.fecha_hora AS DATE) = '".$tmp."' AND ";
					}

					$filtro_fhasta="";
					if(!empty($fhasta)){					
						$tmp = $f->FormatearFechas($fhasta,"Y-m-d","Y-m-d");				
						$filtro_fhasta = "CAST (login_log.fecha_hora AS DATE) =  '".$tmp."' AND ";
					}
				}
				else
				{					
					$filtro_fdesde="";
					if(!empty($fdesde)){					
						$tmp = $f->FormatearFechas($fdesde,"Y-m-d","Y-m-d");				
						$filtro_fdesde = "CAST (login_log.fecha_hora AS DATE) >= '".$tmp."' AND ";
					}

					$filtro_fhasta="";
					if(!empty($fhasta)){					
						$tmp = $f->FormatearFechas($fhasta,"Y-m-d","Y-m-d");				
						$filtro_fhasta = "CAST (login_log.fecha_hora AS DATE) <=  '".$tmp."' AND ";
					}
				}
											
				$filtro_usuario="";
				if(!empty($usuario))								
					$filtro_usuario = "login_log.usuario_id = ".$usuario." AND ";
													
				$filtro_estado = "login_log.estado = 'true'";

				$query = "SELECT login_log.*
							FROM login_log
								WHERE 									 
									".$filtro_fdesde." 
									".$filtro_fhasta." 										
									".$filtro_usuario."
									".$filtro_estado;
					//echo $query;
					//exit;

				$result = SQL::selectObject($query, new LoginLog);	

				if(count($result)==1)
					$resultFinal[0] = $result;		
				else
					$resultFinal = $result;									

				return $resultFinal;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function seleccionarExpedicionesByFiltros($fdesde, $fhasta, $tipo_expe, $estados_expe, $usuario){
			try {
				
				$f = new Fechas;

				if($fdesde==$fhasta)
				{
					$filtro_fdesde="";
					if(!empty($fdesde)){					
						$tmp = $f->FormatearFechas($fdesde,"Y-m-d","Y-m-d");				
						$filtro_fdesde = "fecha = '".$tmp."' AND ";
					}

					$filtro_fhasta="";
					if(!empty($fhasta)){					
						$tmp = $f->FormatearFechas($fhasta,"Y-m-d","Y-m-d");				
						$filtro_fhasta = "fecha =  '".$tmp."' AND ";
					}
				}
				else
				{					
					$filtro_fdesde="";
					if(!empty($fdesde)){					
						$tmp = $f->FormatearFechas($fdesde,"Y-m-d","Y-m-d");				
						$filtro_fdesde = "fecha >= '".$tmp."' AND ";
					}

					$filtro_fhasta="";
					if(!empty($fhasta)){					
						$tmp = $f->FormatearFechas($fhasta,"Y-m-d","Y-m-d");				
						$filtro_fhasta = "fecha <=  '".$tmp."' AND ";
					}
				}

				$filtro_tipo_expe="";
				if(!empty($tipo_expe))								
					$filtro_tipo_expe = "tipo_expediciones_id = ".$tipo_expe." AND ";

				$filtro_estados_expe="";
				if(!empty($estados_expe))								
					$filtro_estados_expe = "estados_expediciones_id = ".$estados_expe." AND ";				
											
				$filtro_usuario="";
				if(!empty($usuario))								
					$filtro_usuario = "usuario_id = ".$usuario." AND ";
				
				$filtro_sin_publicar = "sin_publicar = 'false' AND ";
				$filtro_estado = "estado = 'true'";				

				$query = "SELECT *
							FROM expediciones
								WHERE 									 
									".$filtro_fdesde." 
									".$filtro_fhasta." 										
									".$filtro_usuario."
									".$filtro_estados_expe."
									".$filtro_tipo_expe."									
									".$filtro_sin_publicar."
									".$filtro_estado." 
								ORDER BY id DESC";
					//echo $query;
					//exit;

				$result = SQL::selectObject($query, new Expediciones);	

				if(count($result)==1)
					$resultFinal[0] = $result;		
				else
					$resultFinal = $result;									

				return $resultFinal;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

		public function seleccionarGuiasByFiltros($fdesde, $fhasta, $usuario, $empresa){
			try {
				
				$f = new Fechas;

				if($fdesde==$fhasta)
				{
					$filtro_fdesde="";
					if(!empty($fdesde)){					
						$tmp = $f->FormatearFechas($fdesde,"Y-m-d","Y-m-d");				
						$filtro_fdesde = "CAST (fecha_hora AS DATE) = '".$tmp."' AND ";
					}

					$filtro_fhasta="";
					if(!empty($fhasta)){					
						$tmp = $f->FormatearFechas($fhasta,"Y-m-d","Y-m-d");				
						$filtro_fhasta = "CAST (fecha_hora AS DATE) =  '".$tmp."' AND ";
					}
				}
				else
				{					
					$filtro_fdesde="";
					if(!empty($fdesde)){					
						$tmp = $f->FormatearFechas($fdesde,"Y-m-d","Y-m-d");				
						$filtro_fdesde = "CAST (fecha_hora AS DATE) >= '".$tmp."' AND ";
					}

					$filtro_fhasta="";
					if(!empty($fhasta)){					
						$tmp = $f->FormatearFechas($fhasta,"Y-m-d","Y-m-d");				
						$filtro_fhasta = "CAST (fecha_hora AS DATE) <=  '".$tmp."' AND ";
					}
				}
											
				$filtro_usuario="";
				if(!empty($usuario))								
					$filtro_usuario = "usuario_id = ".$usuario." AND ";

				$filtro_cliente="";
				if($empresa>-1){												
					$filtro_cliente = "empresa_sistema = ".$empresa." AND ";						
				}

				//var_dump($filtro_cliente);
				//exit();

				$filtro_estado = "estado = 'true'";

				$query = "SELECT *
							FROM guias
								WHERE 									 
									".$filtro_fdesde." 
									".$filtro_fhasta." 										
									".$filtro_usuario."
									".$filtro_cliente."
									".$filtro_estado;
					//echo $query;
					//exit;

				$result = SQL::selectObject($query, new Guias);	

				if(count($result)==1)
					$resultFinal[0] = $result;		
				else
					$resultFinal = $result;									

				return $resultFinal;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());	
			}
		}

	}

?>