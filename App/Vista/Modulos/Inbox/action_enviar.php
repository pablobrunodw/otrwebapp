<?php
	include_once "../../../Config/config.ini.php";	
	include_once PATH_NEGOCIO."Funciones/Email/email.class.php"; 
	include_once PATH_NEGOCIO."Funciones/Fechas/fechas.class.php"; 
	
	$f_fecha= new Fechas;
	$f_email= new Email;

	$fecha_hora = $f_fecha->FechaHoraActual();
	$fecha = $f_fecha->FormatearFechas($fecha_hora,"Y-m-d H:i:s","d/m/Y");
	$hora = $f_fecha->FormatearFechas($fecha_hora,"Y-m-d H:i:s","H:i:s");
	$emailRemitente = (isset($_POST["emailremitente"])?$_POST["emailremitente"]:'');
	$nombreRemitente = (isset($_POST["nombreremitente"])?$_POST["nombreremitente"]:'');
	$asunto = (isset($_POST["asunto"])?$_POST["asunto"]:'');
	$mensaje =  (isset($_POST["mensaje"])?$_POST["mensaje"]:'');

	$html = "<b>Fecha: </b>  ". $fecha." <br>
			 <b>Hora: </b>  ". $hora." <br>
			 <h2>Mensaje Enviado desde Plataforma de Consultas de Servicios</h2><hr>
			 <b>Asunto: </b>  ". $asunto." <br>
			 <b>Mensaje: </b> ". $mensaje;
	
	$err = "../../../../index.php?view=inbox&err=";     		
	$info = "../../../../index.php?view=inbox&info=";     		

	$dest = array(array(EMAIL_PRINCIPAL_ENVIADOR,NOMBRE_PRINCIPAL_ENVIADOR));
	$f_email->setDestinatario($dest);

	$f_email->setEmailRemitente($emailRemitente);
	$f_email->setNombreRemitente($nombreRemitente);				
	$f_email->setAsunto($asunto);
	$f_email->setHtmlCuerpo($html);		

	try {
		$f_email->enviar();	

		$msj="La consulta a sido enviada con éxito.";
		header("Location: ".$info.$msj);

	} catch (Exception $e) {
		header("Location: ".$err.$e->getMessage());
	}
	
?>