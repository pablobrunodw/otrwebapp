<?php

	if(realpath("App/Config/config.ini.php"))
		include_once "App/Config/config.ini.php";
	
	if(realpath("../../Config/config.ini.php"))
		include_once "../../Config/config.ini.php";

	include_once PATH_DATOS.'BaseDatos/conexionsistema.class.php';

	class SQLsistema{
		
		public static function selectObject($query)
		{
			try {
				
				# Setea Conexion: abre una nueva conexion a la base de datos
				$conn = new ConexionSistema();
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
		        while ($fila = sqlsrv_fetch_object($result)) {
					$row[]= $fila;
				}				

				# Desconecta la conexion activa
				$conn->desconectar();
				
				return $row;				

			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}

		public static function selectArray ($query)
		{
			try {
				
				# Setea Conexion: abre una nueva conexion a la base de datos
				$conn = new ConexionSistema();
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
		        while ($fila = sqlsrv_fetch_array($result)) {
					$row[]= $fila;
				}				

				# Desconecta la conexion activa
				$conn->desconectar();
				
				return $row;				

			} catch (Exception $e) {
				throw new Exception($e->getMessage());				
			}
		}
	}
?>