<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";

	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'BaseDatos/sql.class.php';

	include_once PATH_DATOS.'Entidades/usuario.class.php';

	class Legajos
	{			
		/*#####################################*/
		/* DECLARACIONES / GETTERS AND SETTERS */
		/*#####################################*/

		private $_id;
		public function getId(){ return $this->_id; }
		public function setId($id){ $this->_id =$id; }		
		
		private $_usuarioId;
		public function getUsuarioId(){ return $this->_usuarioId; }
		public function setUsuarioId($usuario_id){ $this->_usuarioId=$usuario_id; }		

		private $_nombre;
		public function getNombre(){ return $this->_nombre; }
		public function setNombre($nombre){ $this->_nombre=$nombre; }
		private $_cuit;
		public function getCuit(){ return $this->_cuit; }
		public function setCuit($cuit){ $this->_cuit=$cuit; }
		private $_nacimiento;
		public function getNacimiento(){ return $this->_nacimiento; }
		public function setNacimiento($nacimiento){ $this->_nacimiento=$nacimiento; }
		private $_direccion;
		public function getDireccion(){ return $this->_direcion; }
		public function setDireccion($direcion){ $this->_direcion=$direcion; }						
		private $_celular;
		public function getCelular(){ return $this->_celular; }
		public function setCelular($celular){ $this->_celular=$celular; }	
		private $_telefono;
		public function getTelefono(){ return $this->_telefono; }
		public function setTelefono($telefono){ $this->_telefono=$telefono; }			
		private $_estadoCivil;
		public function getEstadoCivil(){ return $this->_estadoCivil; }
		public function setEstadoCivil($estadoCivil){ $this->_estadoCivil=$estadoCivil; }	
		private $_hijos;
		public function getHijos(){ return $this->_hijos; }
		public function setHijos($hijos){ $this->_hijos=$hijos; }			

		private $_dniAdjunto;
		public function getDniAdjunto(){ return $this->_dniAdjunto; }
		public function setDniAdjunto($dniAdjunto){ $this->_dniAdjunto=$dniAdjunto; }
		private $_dniDorsoAdjunto;
		public function getDniDorsoAdjunto(){ return $this->_dniDorsoAdjunto; }
		public function setDniDorsoAdjunto($dniDorsoAdjunto){ $this->_dniDorsoAdjunto=$dniDorsoAdjunto; }		
		private $_cuitAdjunto;
		public function getCuitAdjunto(){ return $this->_cuitAdjunto; }
		public function setCuitAdjunto($cuitAdjunto){ $this->_cuitAdjunto=$cuitAdjunto; }
		private $_cvAdjunto;
		public function getCvAdjunto(){ return $this->_cvAdjunto; }
		public function setCvAdjunto($cvAdjunto){ $this->_cvAdjunto=$cvAdjunto; }		
		private $_cbuAdjunto;
		public function getCbuAdjunto(){ return $this->_cbuAdjunto; }
		public function setCbuAdjunto($cbuAdjunto){ $this->_cbuAdjunto=$cbuAdjunto; }		

		private $_licenciaAdjunto;
		public function getLicenciaAdjunto(){ return $this->_licenciaAdjunto; }
		public function setLicenciaAdjunto($licenciaAdjunto){ $this->_licenciaAdjunto=$licenciaAdjunto; }
		private $_licenciaAdjuntoDorso;
		public function getLicenciaAdjuntoDorso(){ return $this->_licenciaAdjuntoDorso; }
		public function setLicenciaAdjuntoDorso($licenciaAdjuntoDorso){ $this->_licenciaAdjuntoDorso=$licenciaAdjuntoDorso; }		
		private $_tituloAdjunto;
		public function getTituloAdjunto(){ return $this->_tituloAdjunto; }
		public function setTituloAdjunto($tituloAdjunto){ $this->_tituloAdjunto=$tituloAdjunto; }		
		private $_tituloAdjuntoDorso;
		public function getTituloAdjuntoDorso(){ return $this->_tituloAdjuntoDorso; }
		public function setTituloAdjuntoDorso($tituloAdjuntoDorso){ $this->_tituloAdjuntoDorso=$tituloAdjuntoDorso; }			
		private $_seguroAdjunto;
		public function getSeguroAdjunto(){ return $this->_seguroAdjunto; }
		public function setSeguroAdjunto($seguroAdjunto){ $this->_seguroAdjunto=$seguroAdjunto; }	
		private $_mantenimientoAdjunto;
		public function getMantenimientoAdjunto(){ return $this->_mantenimientoAdjunto; }
		public function setMantenimientoAdjunto($mantenimientoAdjunto){ $this->_mantenimientoAdjunto=$mantenimientoAdjunto; }	
		private $_kmrealAdjunto;
		public function getKmrealAdjunto(){ return $this->_kmrealAdjunto; }
		public function setKmrealAdjunto($kmrealAdjunto){ $this->_kmrealAdjunto=$kmrealAdjunto; }	
		private $_gncAdjunto;
		public function getGncAdjunto(){ return $this->_gncAdjunto; }
		public function setGncAdjunto($gncAdjunto){ $this->_gncAdjunto=$gncAdjunto; }	
		private $_hidraulicaAdjunto;
		public function getHidraulicaAdjunto(){ return $this->_hidraulicaAdjunto; }
		public function setHidraulicaAdjunto($hidraulicaAdjunto){ $this->_hidraulicaAdjunto=$hidraulicaAdjunto; }

		private $_marcaVehiculo;
		public function getMarcaVehiculo(){ return $this->_marcaVehiculo; }
		public function setMarcaVehiculo($marcaVehiculo){ $this->_marcaVehiculo=$marcaVehiculo; }
		private $_modeloVehiculo;
		public function getModeloVehiculo(){ return $this->_modeloVehiculo; }
		public function setModeloVehiculo($modeloVehiculo){ $this->_modeloVehiculo=$modeloVehiculo; }
		private $_anioVehiculo;
		public function getAnioVehiculo(){ return $this->_anioVehiculo; }
		public function setAnioVehiculo($anioVehiculo){ $this->_anioVehiculo=$anioVehiculo; }
		private $_kmRecorridoVehiculo;
		public function getKmRecorridoVehiculo(){ return $this->_kmRecorridoVehiculo; }
		public function setKmRecorridoVehiculo($kmRecorridoVehiculo){ $this->_kmRecorridoVehiculo=$kmRecorridoVehiculo; }				

		private $_patenteAdjunto;
		public function getPatenteAdjunto(){ return $this->_patenteAdjunto; }
		public function setPatenteAdjunto($patenteAdjunto){ $this->_patenteAdjunto=$patenteAdjunto; }
		private $_vtvAdjunto;
		public function getVtvAdjunto(){ return $this->_vtvAdjunto; }
		public function setVtvAdjunto($vtvAdjunto){ $this->_vtvAdjunto=$vtvAdjunto; }		

		private $_licenciaVto;
		public function getLicenciaVto(){ return $this->_licenciaVto; }
		public function setLicenciaVto($licenciaVto){ $this->_licenciaVto=$licenciaVto; }		
		private $_vtvVto;
		public function getVtvVto(){ return $this->_vtvVto; }
		public function setVtvVto($vtvVto){ $this->_vtvVto=$vtvVto; }	
		private $_hidraulicaVto;
		public function getHidraulicaVto(){ return $this->_hidraulicaVto; }
		public function setHidraulicaVto($hidraulicaVto){ $this->_hidraulicaVto=$hidraulicaVto; }	
		private $_gncVto;
		public function getGncVto(){ return $this->_gncVto; }
		public function setGncVto($gncVto){ $this->_gncVto=$gncVto; }	
		private $_seguroVto;
		public function getSeguroVto(){ return $this->_seguroVto; }
		public function setSeguroVto($seguroVto){ $this->_seguroVto=$seguroVto; }								

		private $_horas;
		public function getHoras(){ return $this->_horas; }
		public function setHoras($horas){ $this->_horas=$horas; }		
		private $_oficina;
		public function getOficina(){ return $this->_oficina; }
		public function setOficina($oficina){ $this->_oficina=$oficina; }		
		private $_categoria;
		public function getCategoria(){ return $this->_categoria; }
		public function setCategoria($categoria){ $this->_categoria=$categoria; }		
		private $_numeroLegajo;
		public function getNumeroLegajo(){ return $this->_numeroLegajo; }
		public function setNumeroLegajo($numeroLegajo){ $this->_numeroLegajo=$numeroLegajo; }	

		private $_estado;
		public function getEstado(){ return var_export($this->_estado,true); }
		public function setEstado($estado){ $this->_estado=$estado; }			

		private $_enviado;
		public function getEnviado(){ return var_export($this->_enviado,true); }
		public function setEnviado($enviado){ $this->_enviado=$enviado; }

		private $_aprobado;
		public function getAprobado(){ return var_export($this->_aprobado,true); }
		public function setAprobado($aprobado){ $this->_aprobado=$aprobado; }					

		/*#############*/
		/* CONSTRUCTOR */
		/*#############*/

		function __construct(){
			$this->setId(0);
			$this->setUsuarioId(new Usuario);			

			$this->setNombre('');			
			$this->setCuit('');
			$this->setNacimiento('');
			$this->setDireccion('');
			$this->setCelular('');
			$this->setTelefono('');
			$this->setEstadoCivil('');
			$this->setHijos('');
			$this->setDniAdjunto('');
			$this->setDniDorsoAdjunto('');
			$this->setCuitAdjunto('');
			$this->setCvAdjunto('');
			$this->setCbuAdjunto('');
			$this->setLicenciaAdjunto('');
			$this->setLicenciaAdjuntoDorso('');
			$this->setTituloAdjunto('');
			$this->setTituloAdjuntoDorso('');
			$this->setMantenimientoAdjunto('');
			$this->setSeguroAdjunto('');
			$this->setKmrealAdjunto('');
			$this->setGncAdjunto('');
			$this->setHidraulicaAdjunto('');
			$this->setPatenteAdjunto('');
			$this->setMarcaVehiculo('');
			$this->setModeloVehiculo('');
			$this->setAnioVehiculo('');
			$this->setKmRecorridoVehiculo('');
			$this->setVtvAdjunto('');
			$this->setLicenciaVto('');
			$this->setVtvVto('');
			$this->setHidraulicaVto('');
			$this->setGncVto('');
			$this->setSeguroVto('');
			$this->setHoras(0);
			$this->setCategoria('');
			$this->setOficina('');
			$this->setNumeroLegajo(0);
			$this->setEstado(true);
			$this->setAprobado(false);
			$this->setEnviado(false);
		}

		/*###################*/
		/* METODOS GENERICOS */
		/*###################*/

		public function insert($conexion)
		{
			try {

				# Validaciones 			
				if(empty($this->getUsuarioId()))
					throw new Exception("Usuario Vacio");	
				
				# Query 			
				$query="INSERT INTO legajos (
		        						id_usuario,
		        						nombre,		    
		        						cuit,
		        						nacimiento,
		        						direccion,
		        						celular,
		        						telefono,
		        						estado_civil,
		        						hijos,		        						    					
		        						dni_adjunto,		        								        						
		        						dni_dorso_adjunto,	
		        						cuit_adjunto,
		        						cv_adjunto,
		        						cbu_adjunto,
		        						licencia_adjunto,
		        						licencia_adjunto_dorso,
		        						titulo_adjunto,
		        						titulo_adjunto_dorso,
		        						mantenimiento_adjunto,
		        						seguro_adjunto,
		        						kmreal_adjunto,
		        						gnc_adjunto,
		        						hidraulica_adjunto,
		        						patente_adjunto,
		        						vtv_adjunto,
		        						marca_vehiculo,
		        						modelo_vehiculo,
		        						anio_vehiculo,
		        						km_recorrido_vehiculo,
		        						licencia_vto,
		        						vtv_vto,
		        						hidraulica_vto,
		        						gnc_vto,
		        						seguro_vto,
		        						horas,
		        						oficina,
		        						categoria,
		        						numero_legajo,
		        						aprobado,
		        						enviado,
		        						estado
	        			) VALUES (
	        							".$this->getUsuarioId().",   	
	        							'".$this->getNombre()."',   
										'".$this->getCuit()."',   
										'".$this->getNacimiento()."',   
										'".$this->getDireccion()."',   
										'".$this->getCelular()."',   
										'".$this->getTelefono()."',   
										'".$this->getEstadoCivil()."',   
										'".$this->getHijos()."',   										
	        							'".$this->getDniAdjunto()."',   	
	        							'".$this->getDniDorsoAdjunto()."',   	
	        							'".$this->getCuitAdjunto()."',   	
	        							'".$this->getCvAdjunto()."',   	
	        							'".$this->getCbuAdjunto()."',   	
	        							'".$this->getLicenciaAdjunto()."',   	
	        							'".$this->getLicenciaAdjuntoDorso()."',   	
	        							'".$this->getTituloAdjunto()."',   	
	        							'".$this->getTituloAdjuntoDorso()."',   	
	        							'".$this->getMantenimientoAdjunto()."',   	
	        							'".$this->getSeguroAdjunto()."',   	
	        							'".$this->getKmrealAdjunto()."',   	
	        							'".$this->getGncAdjunto()."',   	
	        							'".$this->getHidraulicaAdjunto()."',   	
	        							'".$this->getPatenteAdjunto()."', 
	        							'".$this->getVtvAdjunto()."', 
	        							'".$this->getMarcaVehiculo()."', 
	        							'".$this->getModeloVehiculo()."', 
	        							'".$this->getAnioVehiculo()."', 
	        							'".$this->getKmRecorridoVehiculo()."', 
	        							'".$this->getLicenciaVto()."',	        							
	        							'".$this->getVtvVto()."', 
	        							'".$this->getHidraulicaVto()."', 
	        							'".$this->getGncVto()."', 
	        							'".$this->getSeguroVto()."', 
	        							".$this->getHoras().",
	        							'".$this->getOficina()."', 
	        							'".$this->getCategoria()."', 
	        							".$this->getNumeroLegajo().",
	        							'".$this->getAprobado()."',   
	        							'".$this->getEnviado()."',   
	        							'".$this->getEstado()."'
	        			)";        
			
	        	//echo $query;
	        	//exit();

				# Ejecucion 					
				return SQL::insert($conexion,$query);
			
			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}		
		}

		public function update($conexion)
		{
			try {

				# Validaciones 			
				if(empty($this->getId()))
					throw new Exception("Legajo no identificado");

				if(empty($this->getUsuarioId()))
					throw new Exception("Usuario Vacio");			

				# Query 			
				$query="UPDATE legajos SET
								id_usuario=".$this->getUsuarioId().",								
								nombre='".$this->getNombre()."',
								cuit='".$this->getCuit()."',
								nacimiento='".$this->getNacimiento()."',
								direccion='".$this->getDireccion()."',
								celular='".$this->getCelular()."',
								telefono='".$this->getTelefono()."',
								estado_civil='".$this->getEstadoCivil()."',
								hijos='".$this->getHijos()."',
								dni_adjunto='".$this->getDniAdjunto()."',
								dni_dorso_adjunto='".$this->getDniDorsoAdjunto()."',
								cuit_adjunto='".$this->getCuitAdjunto()."',
								cv_adjunto='".$this->getCvAdjunto()."',
								cbu_adjunto='".$this->getCbuAdjunto()."',
								licencia_adjunto='".$this->getLicenciaAdjunto()."',														
								licencia_adjunto_dorso='".$this->getLicenciaAdjuntoDorso()."',														
								titulo_adjunto='".$this->getTituloAdjunto()."',		
								titulo_adjunto_dorso='".$this->getTituloAdjuntoDorso()."',		
								mantenimiento_adjunto='".$this->getMantenimientoAdjunto()."',		
								seguro_adjunto='".$this->getSeguroAdjunto()."',		
								kmreal_adjunto='".$this->getKmrealAdjunto()."',		
								gnc_adjunto='".$this->getGncAdjunto()."',		
								hidraulica_adjunto='".$this->getHidraulicaAdjunto()."',		
								patente_adjunto='".$this->getPatenteAdjunto()."',
								vtv_adjunto='".$this->getVtvAdjunto()."',
								marca_vehiculo='".$this->getMarcaVehiculo()."',
								modelo_vehiculo='".$this->getModeloVehiculo()."',
								anio_vehiculo='".$this->getAnioVehiculo()."',
								km_recorrido_vehiculo='".$this->getKmRecorridoVehiculo()."',
								licencia_vto='".$this->getLicenciaVto()."',
								vtv_vto='".$this->getVtvVto()."',
								hidraulica_vto='".$this->getHidraulicaVto()."',
								gnc_vto='".$this->getGncVto()."',
								seguro_vto='".$this->getSeguroVto()."',
								horas=".$this->getHoras().",
								oficina='".$this->getOficina()."',
								categoria='".$this->getCategoria()."',
								numero_legajo=".$this->getNumeroLegajo().",
								aprobado='".$this->getAprobado()."',
								enviado='".$this->getEnviado()."',
								estado='".$this->getEstado()."'
							WHERE id=".$this->getId();

	        	//echo $query;
	        	//exit();

				# Ejecucion 					
				return SQL::update($conexion,$query);	

			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}		
		}

		public function delete($conexion)
		{
			try {
				
				# Validaciones 			
				if(empty($this->getId()))
					throw new Exception("Legajo no identificado");
			
				# Query 			
				$query="UPDATE legajos SET							
								estado='false'
							WHERE id=".$this->getId();

				# Ejecucion 	
				return SQL::delete($conexion,$query);

			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}
		}

		public function select()
		{			
			try {
											
				# Query
				if(empty($this->getId()))
				{
					$query = "SELECT * FROM legajos WHERE estado='true'";
				}
				else
				{
					if(empty($this->getId()))
						throw new Exception("No se selecciono el Id del Legajo");		

					$query="SELECT * FROM legajos WHERE id=".$this->getId();
				}
				
				# Ejecucion 					
				$result = SQL::selectObject($query, new Legajos);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());						
			}

		}

		public function setPropiedadesBySelect($filas)
		{	
			if(empty($filas)){
				$this->cleanClass();
			}
			else{
				$this->setId($filas['id']);				

				$u = new Usuario;
				$u->setId($filas['id_usuario']);			
				$u = $u->select();
				$this->setUsuarioId($u);					

				$this->setNombre($filas['nombre']);				
				$this->setCuit($filas['cuit']);				
				$this->setNacimiento($filas['nacimiento']);	
				$this->setDireccion($filas['direccion']);			
				$this->setCelular($filas['celular']);				
				$this->setTelefono($filas['telefono']);				
				$this->setEstadoCivil($filas['estado_civil']);				
				$this->setHijos($filas['hijos']);				
				$this->setDniAdjunto($filas['dni_adjunto']);				
				$this->setDniDorsoAdjunto($filas['dni_dorso_adjunto']);				
				$this->setCuitAdjunto($filas['cuit_adjunto']);
				$this->setCvAdjunto($filas['cv_adjunto']);
				$this->setCbuAdjunto($filas['cbu_adjunto']);
				$this->setLicenciaAdjunto(trim($filas['licencia_adjunto']));		
				$this->setLicenciaAdjuntoDorso(trim($filas['licencia_adjunto_dorso']));		
				$this->setTituloAdjunto($filas['titulo_adjunto']);	
				$this->setTituloAdjuntoDorso($filas['titulo_adjunto_dorso']);	
				$this->setMantenimientoAdjunto($filas['mantenimiento_adjunto']);	
				$this->setSeguroAdjunto($filas['seguro_adjunto']);	
				$this->setKmrealAdjunto($filas['kmreal_adjunto']);	
				$this->setGncAdjunto($filas['gnc_adjunto']);	
				$this->setHidraulicaAdjunto($filas['hidraulica_adjunto']);				
				$this->setPatenteAdjunto($filas['patente_adjunto']);							
				$this->setVtvAdjunto($filas['vtv_adjunto']);							
				$this->setMarcaVehiculo($filas['marca_vehiculo']);							
				$this->setModeloVehiculo($filas['modelo_vehiculo']);							
				$this->setAnioVehiculo($filas['anio_vehiculo']);							
				$this->setKmRecorridoVehiculo($filas['km_recorrido_vehiculo']);							
				$this->setLicenciaVto($filas['licencia_vto']);							
				$this->setVtvVto($filas['vtv_vto']);							
				$this->setHidraulicaVto($filas['hidraulica_vto']);							
				$this->setGncVto($filas['gnc_vto']);							
				$this->setSeguroVto($filas['seguro_vto']);											
				$this->setHoras($filas['horas']);	
				$this->setOficina($filas['oficina']);	
				$this->setCategoria($filas['categoria']);	
				$this->setNumeroLegajo($filas['numero_legajo']);	
				$this->setAprobado($filas['aprobado']);
				$this->setEnviado($filas['enviado']);
				$this->setEstado($filas['estado']);
			}
		}

		private function cleanClass()
		{
			$this->setId(0);
			$this->setUsuarioId(new Usuario);			

			$this->setNombre('');			
			$this->setCuit('');
			$this->setNacimiento('');
			$this->setDireccion('');
			$this->setCelular('');
			$this->setTelefono('');
			$this->setEstadoCivil('');
			$this->setHijos('');
			$this->setDniAdjunto('');
			$this->setDniDorsoAdjunto('');
			$this->setCuitAdjunto('');
			$this->setCvAdjunto('');
			$this->setCbuAdjunto('');
			$this->setLicenciaAdjunto('');
			$this->setLicenciaAdjuntoDorso('');
			$this->setTituloAdjunto('');
			$this->setTituloAdjuntoDorso('');
			$this->setMantenimientoAdjunto('');
			$this->setSeguroAdjunto('');
			$this->setKmrealAdjunto('');
			$this->setGncAdjunto('');
			$this->setHidraulicaAdjunto('');
			$this->setPatenteAdjunto('');			
			$this->setVtvAdjunto('');
			$this->setMarcaVehiculo('');
			$this->setModeloVehiculo('');
			$this->setAnioVehiculo('');
			$this->setKmRecorridoVehiculo('');			
			$this->setLicenciaVto('');
			$this->setVtvVto('');
			$this->setHidraulicaVto('');
			$this->setGncVto('');
			$this->setSeguroVto('');			
			$this->setHoras(0);
			$this->setCategoria('');
			$this->setNumeroLegajo(0);
			$this->setOficina('');			
			$this->setEstado(true);
			$this->setAprobado(false);
			$this->setEnviado(false);
		}

		private function createTable()
		{
			return 'CREATE TABLE IF NOT EXISTS';
		}

		/*########################*/
		/* METODOS PERSONALIZADOS */
		/*########################*/
	
		public function selectByUsuario($usuario)
		{			
			try {

				if(empty($usuario))
					throw new Exception("No se selecciono el Usuario");		

				$query="SELECT TOP 1 * FROM legajos WHERE id_usuario=".$usuario;
				
				# Ejecucion 					
				$result = SQL::selectObject($query, new Legajos);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());						
			}

		}

		public function enviarLegajo($id){
			try {

				# Validaciones 			
				if(empty($id))
					throw new Exception("Legajo no identificado");

				# Query 			
				$query="UPDATE legajos SET								
								enviado=1
							WHERE id=".$id;

	        	//echo $query;
	        	//exit();

				# Ejecucion 					
				return SQL::update($conexion,$query);					

			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}
		}

		public function rechazarLegajo($id){
			try {

				# Validaciones 			
				if(empty($id))
					throw new Exception("Legajo no identificado");

				# Query 			
				$query="UPDATE legajos SET								
								enviado=0
							WHERE id=".$id;

	        	//echo $query;
	        	//exit();

				# Ejecucion 					
				return SQL::update($conexion,$query);					

			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}
		}

		public function seleccionarByFiltros($usuario){
			try {

				if(empty($usuario))
					$query="SELECT * FROM legajos WHERE enviado=1";
				else
					$query="SELECT * FROM legajos WHERE enviado=1 AND id_usuario=".$usuario;
				
				# Ejecucion 					
				$result = SQL::selectObject($query, new Legajos);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());						
			}			
		}

	}
?>