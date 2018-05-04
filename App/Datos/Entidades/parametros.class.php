<?php
	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";

	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';
	include_once PATH_DATOS.'BaseDatos/sql.class.php';	

	class Parametros
	{			
		/*#####################################*/
		/* DECLARACIONES / GETTERS AND SETTERS */
		/*#####################################*/

	

		/*#############*/
		/* CONSTRUCTOR */
		/*#############*/

		

		/*###################*/
		/* METODOS GENERICOS */
		/*###################*/

		
		/*########################*/
		/* METODOS PERSONALIZADOS */
		/*########################*/

		public function selectById($id)
		{			
			try {
											
				# Query
				if(!empty($id))
				{
					$query="SELECT * FROM parametros WHERE id=".$id;
				}
				else
				{			
					throw new Exception("No se selecciono el id.");							
				}

				//echo $query;
				//exit();
				
				# Ejecucion 					
				$result = SQL::selectArray($query);
						
				return $result;

			} catch (Exception $e) {
				throw new Exception($e->getMessage());						
			}

		}
	}
?>