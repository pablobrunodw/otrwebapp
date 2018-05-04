<?php

	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";

	include_once PATH_DATOS.'BaseDatos/conexionapp.class.php';

	class SQL{

		public static function insert ($conn, $query)
		{
			try {

				return self::execute($conn, $query);				

			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public static function update ($conn, $query)
		{
			try {

				return self::execute($conn, $query);				
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public static function delete ($conn, $query)
		{
			try {

				return self::execute($conn, $query);				
				
			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		private static function execute ($connParam, $query)
		{			
			try {							
				# Setea Conexion: prepara para las transacciones añidadas			
				if(empty($connParam)){
					$conn = new ConexionApp();
					$conn->conectar(); 
					$conn->begin();
				}
				else{
					$conn = $connParam;
				}
				
				# Ejecuta la consulta			
				$result = sqlsrv_query($conn->getConn(),$query);

				# Cierra conexion si es una transaccion simple 			
				if(empty($connParam)){
					$conn->commit();
	        		$conn->desconectar();        	
	        	}

				# Errores en la transacciones 				
	        	if (!$result){	        			
	        		$conn->rollback();
	        		throw new Exception('Error en la transacción: '.sqlsrv_errors()[0]["message"]);
	        	}

	        	return $result;

        	} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public static function selectObject ($query, $obj)
		{
			try {
				
				# Setea Conexion: abre una nueva conexion a la base de datos
				$conn = new ConexionApp();
				$link = $conn->conectar(); 				

				# Realiza la consulta
				$result = sqlsrv_query($conn->getConn(),$query);

				# Desconecta la conexion activa si encuentro un error
		        if (!$result){
		        	$err = sqlsrv_errors()[0]["message"];
		        	$conn->desconectar();
		        	throw new Exception('Error en la consulta: '.$err);	       
		        }

		        # Genera un array de objetos para retornar
		        $row = null;		        
		        while ($fila = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {			        			        	
		        	$objReg = new $obj();
		        	$objReg->setPropiedadesBySelect($fila);		        			        			        	
					$row[]= $objReg;					
				}				

				# Desconecta la conexion activa
				$conn->desconectar();

				if(count($row)>1)
					return $row;
				else
					return $row[0];

			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public static function selectArray ($query)
		{
			try {
				
				# Setea Conexion: abre una nueva conexion a la base de datos
				$conn = new ConexionApp();
				$link = $conn->conectar(); 				

				# Realiza la consulta
				$result = sqlsrv_query($conn->getConn(),$query);

				# Desconecta la conexion activa si encuentro algun error
		        if (!$result){
		        	$err = sqlsrv_errors()[0]["message"];
		        	$conn->desconectar();
		        	throw new Exception('Error en la consulta: '.$err);	       
		        }

		        # Genera un array para retornar
		        $row = null;
		        while ($fila = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
					$row[]= $fila;
				}

				# Desconecta la conexion activa
				$conn->desconectar();

				if(count($row)>1)
					return $row;
				else
					return $row[0];

			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public static function lastId($conn) {
			try {
				/*				
			   	$result = sqlsrv_query($conn->getConn(),"SELECT @@IDENTITY AS xID");			   	

			    return $result;	
			   	*/

			} catch (Exception $e) {
				throw new Exception($e->getMessage());					
			}		    
		}
		
	}
?>