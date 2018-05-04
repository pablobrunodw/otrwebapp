<?php
	include_once "../../../Config/config.ini.php";	

	include_once PATH_NEGOCIO."Modulos/handlerlegajos.class.php"; 
	
	$handler = new HandlerLegajos();
	
	$etapa = (isset($_POST["etapa_legajo"])?$_POST["etapa_legajo"]:'');

	$id = (isset($_POST["id"])?$_POST["id"]:'');
	$usuario = (isset($_POST["usuario"])?$_POST["usuario"]:'');

	$nombre = (isset($_POST["nombre"])?$_POST["nombre"]:'');	
	$cuit = (isset($_POST["cuit"])?$_POST["cuit"]:'');	
	$nacimiento = (isset($_POST["nacimiento"])?$_POST["nacimiento"]:'');	
	$direccion = (isset($_POST["direccion"])?$_POST["direccion"]:'');	
	$celular = (isset($_POST["celular"])?$_POST["celular"]:'');	
	$telefono = (isset($_POST["telefono"])?$_POST["telefono"]:'');	
	$estado_civil = (isset($_POST["estado_civil"])?$_POST["estado_civil"]:'');	
	$hijos = (isset($_POST["hijos"])?$_POST["hijos"]:'');	

	$dni_adjunto = (isset($_FILES["dni_adjunto"])?$_FILES["dni_adjunto"]:'');	
	$cuit_adjunto = (isset($_FILES["cuit_adjunto"])?$_FILES["cuit_adjunto"]:'');	
	$cv_adjunto = (isset($_FILES["cv_adjunto"])?$_FILES["cv_adjunto"]:'');	
	$cbu_adjunto = (isset($_FILES["cbu_adjunto"])?$_FILES["cbu_adjunto"]:'');	

	$licencia_adjunto = (isset($_FILES["licencia_adjunto"])?$_FILES["licencia_adjunto"]:'');	
	$licencia_adjunto_dorso = (isset($_FILES["licencia_adjunto_dorso"])?$_FILES["licencia_adjunto_dorso"]:'');	
	$titulo_adjunto = (isset($_FILES["titulo_adjunto"])?$_FILES["titulo_adjunto"]:'');	
	$titulo_adjunto_dorso = (isset($_FILES["titulo_adjunto_dorso"])?$_FILES["titulo_adjunto_dorso"]:'');	
	$mantenimiento_adjunto = (isset($_FILES["mantenimiento_adjunto"])?$_FILES["mantenimiento_adjunto"]:'');	
	$seguro_adjunto = (isset($_FILES["seguro_adjunto"])?$_FILES["seguro_adjunto"]:'');	
	$kmreal_adjunto = (isset($_FILES["kmreal_adjunto"])?$_FILES["kmreal_adjunto"]:'');	
	$gnc_adjunto = (isset($_FILES["gnc_adjunto"])?$_FILES["gnc_adjunto"]:'');	
	$hidraulica_adjunto = (isset($_FILES["hidraulica_adjunto"])?$_FILES["hidraulica_adjunto"]:'');	

	$patente_adjunto = (isset($_FILES["patente_adjunto"])?$_FILES["patente_adjunto"]:'');	
	$vtv_adjunto = (isset($_FILES["vtv_adjunto"])?$_FILES["vtv_adjunto"]:'');	

	$licencia_vto = (isset($_POST["licencia_vto"])?$_POST["licencia_vto"]:'');	
	$vtv_vto = (isset($_POST["vtv_vto"])?$_POST["vtv_vto"]:'');	

	$horas = (isset($_POST["horas"])?$_POST["horas"]:'');	
	$categoria = (isset($_POST["categoria"])?$_POST["categoria"]:'');	
	$oficina = (isset($_POST["oficina"])?$_POST["oficina"]:'');	
	$numero_legajo = (isset($_POST["numero_legajo"])?$_POST["numero_legajo"]:0);	

	try {
		switch ($etapa) {
			case 1:
				$err = "../../../../index.php?view=legajos_carga&pestania=1&err=";     		
				$info = "../../../../index.php?view=legajos_carga&pestania=1&info=";     		

				$handler->guardarLegajosEtapa1($id,$usuario,$nombre,$cuit,$nacimiento,$direccion,$celular,$telefono,$estado_civil,$hijos);
				
				$msj="Información Personal Guardada";
				header("Location: ".$info.$msj);
				
				break;	
			case 2:
				$err = "../../../../index.php?view=legajos_carga&pestania=2&err=";     		
				$info = "../../../../index.php?view=legajos_carga&pestania=2&info=";     		

				$handler->guardarLegajosEtapa2($id,$usuario,$dni_adjunto,$cuit_adjunto,$cv_adjunto,$cbu_adjunto);

				$msj="Documentación Personal Guardada";
				header("Location: ".$info.$msj);
				
				break;	
			case 3:
				$err = "../../../../index.php?view=legajos_carga&pestania=3&err=";     		
				$info = "../../../../index.php?view=legajos_carga&pestania=3&info=";     		

				$handler->guardarLegajosEtapa3($id,$usuario,$licencia_adjunto,$licencia_adjunto_dorso,$titulo_adjunto,$titulo_adjunto_dorso,$mantenimiento_adjunto,$seguro_adjunto,$kmreal_adjunto,$gnc_adjunto,$hidraulica_adjunto);

				$msj="Documentación Vehiculo Guardada";
				header("Location: ".$info.$msj);
				
				break;	
			case 4:
				$err = "../../../../index.php?view=legajos_carga&pestania=4&err=";     		
				$info = "../../../../index.php?view=legajos_carga&pestania=4&info=";     		

				$handler->guardarLegajosEtapa4($id,$usuario,$patente_adjunto,$vtv_adjunto);

				$msj="Documentación Vehiculo (No Excluyente) Guardada";
				header("Location: ".$info.$msj);
				
				break;	
			case 5:
				$err = "../../../../index.php?view=legajos_carga&pestania=5&err=";     		
				$info = "../../../../index.php?view=legajos_carga&pestania=5&info=";     		

				$handler->guardarLegajosEtapa5($id,$usuario,$licencia_vto,$vtv_vto);

				$msj="Vencimientos Guardados";
				header("Location: ".$info.$msj);
				
				break;		
			case 6:
				$err = "../../../../index.php?view=legajos_actualizar&usuario=".$usuario."&pestania=6&err=";     		
				$info = "../../../../index.php?view=legajos_actualizar&usuario=".$usuario."&pestania=6&info=";     		

				$handler->guardarLegajosEtapa6($id,$usuario,$horas,$oficina,$categoria,$numero_legajo);

				$msj="Información Guardadas";
				header("Location: ".$info.$msj);
				
				break;																	
		}
		
	} catch (Exception $e) {
		header("Location: ".$err.$e->getMessage());
	}
	
?>