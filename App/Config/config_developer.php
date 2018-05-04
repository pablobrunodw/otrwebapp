<?php		
		#####################################
		# PATH INICIAL SISTEMA - DESARROLLO #
		#####################################
		ini_set('include_path','C:\\xampp\\htdocs\\webapp-commgroup');	

		############################
		# URL SISTEMA - DESARROLLO #
		############################		
		if (!defined('BASE_URL')) define('BASE_URL','http://desa.otrgroup.com.ar/');

		######################
		# RUTAS - DESARROLLO #
		######################
		if (!defined('PATH_VISTA')) define('PATH_VISTA','App/Vista/');
		if (!defined('PATH_NEGOCIO')) define('PATH_NEGOCIO','App/Negocio/');
		if (!defined('PATH_DATOS')) define('PATH_DATOS','App/Datos/');		
		if (!defined('PATH_CONFIG')) define('PATH_CONFIG','App/Config/');		
		if (!defined('PATH_CLIENTE')) define('PATH_CLIENTE','Usuario/');	
		
		if (!defined('PATH_UPLOADFILE')) define('PATH_UPLOADFILE','UploadFile/');	
		if (!defined('PATH_UPLOADGUIAS')) define('PATH_UPLOADGUIAS','UploadGuias/');
		if (!defined('PATH_UPLOADLEGAJOS')) define('PATH_UPLOADLEGAJOS','UploadLegajos/');	
		if (!defined('PATH_UPLOADTICKETS')) define('PATH_UPLOADTICKETS','UploadTickets/');	
		if (!defined('PATH_UPLOADLICENCIAS')) define('PATH_UPLOADLICENCIAS','UploadLicencias/');	
		if (!defined('PATH_UPLOADAYUDA')) define('PATH_UPLOADAYUDA','UploadAyuda/');	

		if (!defined('PATH_ROOT')) define('PATH_ROOT',$_SERVER['DOCUMENT_ROOT'].'/');				
		if (!defined('PATH_CARPETA_APP')) define('PATH_CARPETA_APP','desarrollo-commgroup/');	
		#######################
		# BASE DE DATOS - APP #
		#######################
		if (!defined('CADENA_SQL_APP')) define('CADENA_SQL_APP','EQUIPO-SISTEMAS\SQLEXPRESS, 1433');
		if (!defined('USUARIO_SQL_APP')) define('USUARIO_SQL_APP','UserTT2');
		if (!defined('PASSWORD_SQL_APP')) define('PASSWORD_SQL_APP','Conex12');
		if (!defined('BASE_DATOS_SQL_APP')) define('BASE_DATOS_SQL_APP','Prueba_AppWeb');	

		############################
		# BASE DE DATOS - CONSULTA #
		############################
		if (!defined('CADENA_SQL_CONSULTA')) define('CADENA_SQL_CONSULTA','EQUIPO-SISTEMAS\SQLEXPRESS, 1433');
		if (!defined('USUARIO_SQL_CONSULTA')) define('USUARIO_SQL_CONSULTA','UserTT2');
		if (!defined('PASSWORD_SQL_CONSULTA')) define('PASSWORD_SQL_CONSULTA','Conex12');
		if (!defined('BASE_DATOS_SQL_CONSULTA')) define('BASE_DATOS_SQL_CONSULTA','Prueba_Sistema');
		//if (!defined('BASE_DATOS_SQL_CONSULTA')) define('BASE_DATOS_SQL_CONSULTA','Sistema');

		######################
		# EMAIL - PRODUCCION #
		######################
		if (!defined('SERVER_EMAIL')) define('SERVER_EMAIL','smtp.mailgun.org');	
		if (!defined('USER_EMAIL')) define('USER_EMAIL','notify@mg.inescapp.com');	
		if (!defined('PASS_EMAIL')) define('PASS_EMAIL','inescapp100');		
		if (!defined('EMAIL_PRINCIPAL_ENVIADOR')) define('EMAIL_PRINCIPAL_ENVIADOR','info@otrgroup.com.ar');	
		if (!defined('NOMBRE_PRINCIPAL_ENVIADOR')) define('NOMBRE_PRINCIPAL_ENVIADOR','Equipo de OTR Group');	
		if (!defined('PORT_EMAIL')) define('PORT_EMAIL',2525);	

		########################################
		# CARPETA "FILES" USUARIO - PRODUCCION #
		########################################
		if (!defined('CARPETA_FILES_USUARIO')) define('CARPETA_FILES_USUARIO','userfile/');	

?>