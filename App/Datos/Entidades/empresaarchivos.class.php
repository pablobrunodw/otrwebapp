<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";

	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'BaseDatos/sql.class.php';

	class EmpresaArchivos
	{				
		/*#####################################*/
		/* DECLARACIONES / GETTERS AND SETTERS */
		/*#####################################*/

		private $_id;
		public function getId(){ return $this->_id; }
		public function setId($id){ $this->_id =$id; }

		private $_fechaSistema;
		public function getFechaSistema(){ return $this->_fechaSistema; }
		public function setFechaSistema($fechaSistema){ $this->_fechaSistema=$fechaSistema;}

		private $_nroSistema;
		public function getNroSistema(){ return $this->_nroSistema; }
		public function setNroSistema($nroSistema){ $this->_nroSistema=$nroSistema; }

		private $_categoria;
		public function getCategoria(){ return $this->_categoria; }
		public function setCategoria($categoria){ $this->_categoria=$categoria; }

		private $_ruta;
		public function getRuta(){ return $this->_ruta; }
		public function setRuta($ruta){ $this->_ruta=$ruta; }

		private $_extencion;
		public function getExtencion(){ return $this->_extencion; }
		public function setExtencion($extencion){ $this->_extencion=$extencion; }

		private $_publicado;
		public function getPublicado(){ return var_export($this->_publicado,true); }
		public function getPublicadoBoolean(){ return $this->_publicado; }
		public function setPublicado($publicado){ $this->_publicado=$publicado; }		

		private $_estado;
		public function getEstado(){ return var_export($this->_estado,true); }
		public function setEstado($estado){ $this->_estado=$estado; }		

		/*#############*/
		/* CONSTRUCTOR */
		/*#############*/

		function __construct(){
			$this->setId(0);
			$this->setFechaSistema('');			
			$this->setNroSistema(0);			
			$this->setCategoria('');
			$this->setRuta('');			
			$this->setExtencion('');			
			$this->setPublicado('');
			$this->setEstado(true);				
		}

		/*###################*/
		/* METODOS GENERICOS */
		/*###################*/

		public function insert($conexion)
		{
			try {
							
				# Validaciones 			
				if(empty($this->getFechaSistema()))
					throw new Exception("Fecha Sistema vacia");

				if(empty($this->getNroSistema()))
					throw new Exception("Nro Sistema vacio");
				
				if(empty($this->getCategoria()))
					throw new Exception("Categoria vacia");

				if(empty($this->getRuta()))
					throw new Exception("Ruta vacia");

				if(empty($this->getExtencion()))
					throw new Exception("Extencion vacia");				

				# Query 			
				$query="INSERT INTO empresa_archivos (
		        						fecha_sistema,
		        						nro_sistema,
		        						categoria,
		        						ruta,
		        						extencion,
		        						estado
	        			) VALUES (
	        							'".$this->getFechaSistema()."',
	        							".$this->getNroSistema().",
	        							'".$this->getCategoria()."',
	        							'".$this->getRuta()."',
	        							'".$this->getExtencion()."',
	        							'".$this->getEstado()."'
	        			)";        
				
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
					throw new Exception("Archivo no identificado");

				if(empty($this->getNroSistema()))
					throw new Exception("Nro Sistema vacio");
				
				if(empty($this->getCategoria()))
					throw new Exception("Categoria vacia");

				if(empty($this->getRuta()))
					throw new Exception("Ruta vacia");

				if(empty($this->getExtencion()))
					throw new Exception("Extencion vacia");
				
				# Query 			
				$query="UPDATE empresa_archivos SET
								fecha_sistema='".$this->getFechaSistema()."', 
								nro_sistema=".$this->getNroSistema().", 
								categoria='".$this->getCategoria()."', 
								ruta='".$this->getRuta()."', 
								extencion ='".$this->getExtencion()."', 
								estado='".$this->getEstado()."'
							WHERE id=".$this->getId();

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
					throw new Exception("Archivo no identificado");

				# Query 			
				$query="UPDATE empresa_archivos SET							
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
				if(empty($this->getId())){
					$query = "SELECT * FROM empresa_archivos WHERE estado='true'";
				}
				else{
					if(empty($this->getId()))
						throw new Exception("Archivo no identificado");

					$query="SELECT * FROM empresa_archivos WHERE id=".$this->getId();
				}

				# Ejecucion 				
				$result = SQL::selectObject($query, new EmpresaArchivos);
						
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
				$this->setFechaSistema($filas['fecha_sistema']);
				$this->setNroSistema($filas['nro_sistema']);
				$this->setCategoria(trim($filas['categoria']));
				$this->setRuta(trim($filas['ruta']));
				$this->setExtencion(trim($filas['extencion']));
				$this->setPublicado($filas['publicado']);
				$this->setEstado($filas['estado']);
			}
		}

		private function cleanClass()
		{
			$this->setId(0);
			$this->setFechaSistema('');			
			$this->setNroSistema(0);			
			$this->setCategoria('');
			$this->setRuta('');			
			$this->setExtencion('');		
			$this->setPublicado('');	
			$this->setEstado(true);				
		}

		private function createTable()
		{
			return 'CREATE TABLE IF NOT EXISTS';
		}

		/*########################*/
		/* METODOS PERSONALIZADOS */
		/*########################*/	

		public function selectCategoriaByServicio($fecha,$servicio,$categoria)
		{			
			try {

				if(empty($fecha))
					throw new Exception("Fecha no cargada");

				if(empty($servicio))
					throw new Exception("Servicio no cargado");

				if(empty($categoria))
					throw new Exception("Categoria no cargada");
		
				# Query				
				$query="SELECT * FROM empresa_archivos 
							WHERE 
								fecha_sistema='".$fecha."' AND 
								nro_sistema=".$servicio." AND 
								categoria='".$categoria."' AND 
								estado='true'";

				# Ejecucion 				
				$result = SQL::selectObject($query, new EmpresaArchivos);	

				return $result;
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());
						
			}
		}	

		public function selectByServicio($fecha,$servicio)
		{			
			try {

				if(empty($fecha))
					throw new Exception("Fecha no cargada");

				if(empty($servicio))
					throw new Exception("Servicio no cargado");			

				# Query				
				$query="SELECT * FROM empresa_archivos 
							WHERE 
								fecha_sistema='".$fecha."' AND 
								nro_sistema=".$servicio." AND 
								estado='true'";																	

				# Ejecucion 				
				$result = SQL::selectObject($query, new EmpresaArchivos);				

				return $result;
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());
						
			}
		}	

		public function publicar($fecha,$servicio){
			try {
				
				if(empty($fecha))
					throw new Exception("Fecha no cargada");

				if(empty($servicio))
					throw new Exception("Servicio no cargado");			

				# Query				
				$query="UPDATE empresa_archivos SET								
								publicado='true'
							WHERE 
								fecha_sistema='".$fecha."' AND 
								nro_sistema=".$servicio." AND 
								estado='true'";																	

				# Ejecucion 								
				return SQL::update(null,$query);				

			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}
		}

		public function despublicar($fecha,$servicio){
			try {

				if(empty($fecha))
					throw new Exception("Fecha no cargada");

				if(empty($servicio))
					throw new Exception("Servicio no cargado");			

				# Query				
				$query="UPDATE empresa_archivos SET								
								publicado='false'
							WHERE 
								fecha_sistema='".$fecha."' AND 
								nro_sistema=".$servicio." AND 
								estado='true'";																	

				# Ejecucion 								
				return SQL::update(null,$query);			

			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}
		}
	}
?>