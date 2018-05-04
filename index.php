<?php	
	include_once "App/Config/config.ini.php";	

	if(isset($_GET["view"]))
		$view = $_GET["view"];
	else
		$view = null;

	switch ($view) {
		case 'login':
			$include = PATH_VISTA.'Login/login.php';	
			break;
		//case 'login_registrar':
		//	$include = PATH_VISTA.'Login/registrar.php';	
		//	break;
		case 'login_recuperar':
			$include = PATH_VISTA.'Login/recuperar.php';	
			break;
		default:			
			$include = PATH_VISTA.'index.php';				
			break;
	}

	include_once $include;	
?>