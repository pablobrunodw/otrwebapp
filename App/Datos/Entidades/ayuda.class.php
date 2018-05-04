<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";

	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'BaseDatos/sql.class.php';

	include_once PATH_DATOS.'Entidades/ayudagrupo.class.php';
	include_once PATH_DATOS.'Entidades/usuarioperfil.class.php';

	class Ayuda
	{			
		/*#####################################*/
		/* DECLARACIONES / GETTERS AND SETTERS */
		/*#####################################*/

		private $_id;
		public function getId(){ return $this->_id; }
		public function setId($id){ $this->_id =$id; }

		private $_grupo;
		public function getGrupo(){ return $this->_grupo; }
		public function setGrupo($grupo){ $this->_grupo=$grupo; }

		private $_nombre;
		public function getNombre(){ return $this->_nombre; }
		public function setNombre($nombre){ $this->_nombre=$nombre; }

		private $_archivo;
		public function getArchivo(){ return $this->_archivo; }
		public function setArchivo($archivo){ $this->_archivo=$archivo; }

		private $_roles;
		public function getRoles(){ return $this->_roles; }
		public function setRoles($roles){ $this->_roles=$roles; }

		private $_video;
		public function getVideo(){ return $this->_video; }
		public function setVideo($video){ $this->_video=$video; }		
		
		private $_estado;
		public function getEstado(){ return var_export($this->_estado,true); }
		public function setEstado($estado){ $this->_estado=$estado; }			

		/*#############*/
		/* CONSTRUCTOR */
		/*#############*/

		function __construct(){
			$this->setId(0);
			$this->setGrupo(new AyudaGrupo);
			$this->setNombre('');						
			$this->setArchivo('');						
			$this->setRoles('');						
			$this->setVideo('');						
			$this->setEstado(true);
		}

		/*###################*/
		/* METODOS GENERICOS */
		/*###################*/

		public function insert($conexion)
		{
			try {

				# Validaciones 			
				if(empty($this->getGrupo()))
					throw new Exception("Grupo Vacio");	

				# Validaciones 			
				if(empty($this->getNombre()))
					throw new Exception("Nombre vacio");
				
				# Query 			
				$query="INSERT INTO ayuda (
										ayuda_grupo_id,
		        						nombre,	
		        						archivo,
		        						roles,
		        						video,			        						
		        						estado
	        			) VALUES (
	        							".$this->getGrupo().",   	
	        							'".$this->getNombre()."',     	
	        							'".$this->getArchivo()."',     	
	        							'".$this->getRoles()."',     	
	        							'".$this->getVideo()."',     	
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
					throw new Exception("Ayuda no identificada");

				# Validaciones 			
				if(empty($this->getGrupo()))
					throw new Exception("Grupo Vacio");	

				if(empty($this->getNombre()))
					throw new Exception("Nombre vacio");
				
				# Query 			
				$query="UPDATE ayuda SET
								ayuda_grupo_id=".$this->getGrupo().",
								nombre='".$this->getNombre()."',					
								roles='".$this->getRoles()."',					
								archivo='".$this->getArchivo()."',					
								video='".$this->getVideo()."',					
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
					throw new Exception("Ayuda no identificada");
			
				# Query 			
				$query="UPDATE ayuda SET							
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
					$query = "SELECT * FROM ayuda WHERE estado='true'";
				}
				else
				{
					if(empty($this->getId()))
						throw new Exception("No se selecciono el Id de ayuda");		

					$query="SELECT * FROM ayuda WHERE id=".$this->getId();
				}
				
				# Ejecucion 					
				$result = SQL::selectObject($query, new Ayuda);
						
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

				$ag = new AyudaGrupo;
				$ag->setId($filas['ayuda_grupo_id']);			
				$ag = $ag->select();
				$this->setGrupo($ag);

				$this->setNombre(trim($filas['nombre']));			
				$this->setArchivo(trim($filas['archivo']));			
				$this->setRoles(trim($filas['roles']));			
				$this->setVideo(trim($filas['video']));			
				$this->setEstado($filas['estado']);
			}
		}

		private function cleanClass()
		{
			$this->setId(0);
			$this->setGrupo(new AyudaGrupo);
			$this->setNombre('');						
			$this->setArchivo('');						
			$this->setRoles('');						
			$this->setVideo('');						
			$this->setEstado(true);
		}

		private function createTable()
		{
			return 'CREATE TABLE IF NOT EXISTS';
		}

		/*########################*/
		/* METODOS PERSONALIZADOS */
		/*########################*/

		public function getNombreRoles(){
			$handler = new UsuarioPerfil;
			$roles = explode("|", $this->getRoles());
			
			$nombre_roles = "";
			foreach ($roles as $key => $value) {
				if(!empty($value)){
					$handler->setId($value);
					$nombre_roles = $nombre_roles.$handler->select()->getNombre().",";				
				}
			}			
			return $nombre_roles;
		}
	}
?>