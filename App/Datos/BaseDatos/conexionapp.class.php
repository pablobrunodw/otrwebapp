<?php		

	class ConexionApp {	   	
	   	private $conn;

		public function conectar()
		{
			$serverName = CADENA_SQL_APP; 
			$connectionInfo = array( "Database"=>BASE_DATOS_SQL_APP, "UID"=>USUARIO_SQL_APP, "PWD"=>PASSWORD_SQL_APP, "CharacterSet" => "UTF-8" );
			$this->conn = sqlsrv_connect($serverName, $connectionInfo);	        

	        if (!$this->conn) {	            	        	
	            throw new Exception('Error al conectar al servidor sqlserver: '.sqlsrv_errors()[0]["message"]);
	        }	        	       
	    }

	    public function begin(){
    		sqlsrv_begin_transaction($this->conn);
		}

		public function commit(){    		
    		sqlsrv_commit($this->conn);
		}

		public function rollback(){
    		sqlsrv_rollback($this->conn);
		}

	    public function getConn(){
			
			if (empty($this->conn))    			
    			throw new Exception('Error de conexion con la base de datos');			
			else			
				return $this->conn;				
	    }

	    public function desconectar(){

	    	sqlsrv_close($this->conn);
	    }

	    public function __destruct() {
	    	//se puede hacer algo antes de cerrar la conexion
       		//mysqli_close($this->link);
   		}
}
